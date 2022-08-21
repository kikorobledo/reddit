<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-3">

            <div class="bg-white shadow-xl sm:rounded-lg p-8 col-span-2">

                <form method="POST" class="w-1/2 mx-auto" action="{{ route('communities.posts.update', [$community, $post]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <x-jet-validation-errors class="mb-4 mx-auto" />

                    <div>
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $post->title }}" required  />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="post_text" value="{{ __('Text') }}" />

                        <textarea name="post_text" id="post_text" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" >{{ $post->post_text }}</textarea>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="post_url" value="{{ __('URL') }}" />
                        <x-jet-input id="post_url" class="block mt-1 w-full" type="text" name="post_url"  value="{{ $post->post_url }}" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="post_image" value="{{ __('Image') }}" />
                        <x-jet-input id="post_image" class="block mt-1 w-full" type="file" name="post_image" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Save Post') }}
                        </x-jet-button>
                    </div>
                </form>

            </div>

            @include('side_section')

        </div>

    </div>

</x-app-layout>
