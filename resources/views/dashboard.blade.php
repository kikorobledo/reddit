<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Most Popular Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-3">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg col-span-2 p-8">

                @forelse ($posts as $post)

                    <div class="flex items-center space-x-6">

                        @livewire('post-votes', ['post' => $post])

                        <div class="my-3">

                            <a class="text-2xl font-light mb-3" href="{{ route('communities.posts.show', [$post->community, $post]) }}">{{ $post->title }}</a>

                            <p>{{ \Illuminate\Support\Str::words($post->post_text, 10) }}</p>

                            <p>{{ $post->created_at->diffForHumans() }}</p>

                        </div>


                    </div>

                    <hr>

                @empty

                @endforelse

            </div>

            @include('side_section')

        </div>

    </div>

</x-app-layout>
