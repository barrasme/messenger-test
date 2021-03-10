<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if(count($messages) < 1)
                        <div class="border-red-500 bg-red-100 p-4">
                            You don't have any messages stored
                        </div>
                    @else

                        <table class="border-2 w-full">
                            <thead>
                                <tr class="border-b-2">
                                    <td class="p-2 font-bold">ID</td>
                                    <td class="p-2 font-bold">Message</td>
                                    <td class="p-2 font-bold">Author Name</td>
                                    <td class="p-2 font-bold">Created</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                        <tr class="border-b-2 bg-gray-100">
                                            <td class="p-2">
                                                {{$message->id}}
                                            </td>
                                            <td class="p-2">
                                                {{ $message->body }}
                                            </td>
                                            <td class="p-2">
                                                {{ $message->author->name }}
                                            </td>
                                            <td class="p-2">
                                                {{ $message->created_at->diffForHumans() }}
                                                <small class="text-gray-400">on {{ $message->created_at->format('jS M Y') }}</small>
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
