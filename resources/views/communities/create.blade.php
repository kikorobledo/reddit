<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Community') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-3">

            <div class="bg-white shadow-xl sm:rounded-lg p-8 col-span-2">

                <form method="POST" class="w-1/2 mx-auto" action="{{ route('communities.store') }}">
                    @csrf

                    <x-jet-validation-errors class="mb-4 mx-auto" />

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="description" value="{{ __('Description') }}" />

                        <textarea name="description" id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required >{{ old('description') }}</textarea>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="topics" value="{{ __('Topics') }}" />

                        <select name="topics[]" multiple id="topics" class="select2 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="old('topics')" required >

                            @foreach ($topics as $topic)

                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Create Community') }}
                        </x-jet-button>
                    </div>
                </form>

            </div>

            @include('side_section')

        </div>

    </div>

    <script>

        $(document).ready(function() {
            $('.select2').select2();
        });

    </script>

</x-app-layout>
