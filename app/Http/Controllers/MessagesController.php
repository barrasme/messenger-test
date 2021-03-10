<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    /**
     * @var array
     */
    private $rules = [
        'body' => 'required|max:255'
    ];

    /**
     * @var array
     */
    private $messages = [
        'body.required'     => 'You must supply a body',
        'body.max'          => 'The message cannot exceed 255 characters'
    ];

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $messages = Message::with('author')->orderBy('created_at', 'desc')->get();

        return view('messages.index')
            ->with('messages', $messages);
    }

    /**
     * @param  NewMessage  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $status_code = 500;
        $standardMessage = 'Oops something went really wrong';

        try{
            //Validate the user
            $user = User::where('id', $request->user_id)->first();
            if(!$user){
                $status_code = 404;
                throw new \Exception('The user was not found');
            }

            //Validate the body length
            if(!isset($request->body) || strlen($request->body) > 255){
                $status_code = 422;
                throw new \Exception('The message body was missing, malformed or too long');
            }

            //If we got this far then we're probably pretty happy
            $data = [
                'user_id' => $request->user_id,
                'body' => $request->body
            ];

            Message::create($data);

            return response()->json([
                'error' => 'Your message was created'
            ], 200);

        }
        catch(\Exception $exception){

            $message = $exception->getMessage();
            if(!$message){
                $message = $standardMessage;
            }

            return response()->json([
                'error' => $message
            ], $status_code);
        }



    }
}
