<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Community') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-3">

            <div class="bg-white shadow-xl sm:rounded-lg p-8 col-span-2">

                @if(session('message'))
                    <p class="rounded-full bg-black text-white px-2 py-1 inline-block mb-5">{{ session('message') }}</p>
                @endif

                <div class="mb-3">

                    <a href="{{ route('communities.create') }}" class="rounded-full bg-black text-white px-2 py-1 mb-3">Create Community</a>

                </div>

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">

                        <tr class="text-left">

                            <th class="px-3 py-2">Name</th>

                            <th></th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($communities as $community)

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 community-item">

                                <td class="p-3"><a href="{{ route('communities.show', $community) }}">{{ $community->name }}</a></td>
                                <td class="p-3 flex space-x-2">
                                    <a class="rounded-full bg-black text-white px-2 py-1" href="{{ route('communities.edit', $community) }}">Edit</a>

                                    <form action="{{ route('communities.destroy', $community) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-full bg-black text-white px-2 py-1" onclick="alert('Are you sure?')">Delete</button>
                                    </form>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            @include('side_section')

        </div>

    </div>

</x-app-layout>
