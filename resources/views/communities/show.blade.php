<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $community->name }}
        </h2>

        <div class="flex justify-end items-center space-x-3">

            <a href="{{ route('communities.show', $community) }}" class="rounded-full bg-black text-white text-xs px-3 py-1 mb-3">Newest Post</a>

            <a href="{{ route('communities.show', $community) }}?sort=popular" class="rounded-full bg-black text-white text-xs px-3 py-1 mb-3">Popular this week</a>

        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8  grid grid-cols-3 gap-3">

            <div class="bg-white shadow-xl sm:rounded-lg p-8 col-span-2">

                <div class="mb-10">

                    <a href="{{ route('communities.posts.create', $community) }}" class="rounded-full bg-black text-white text-sm px-3 py-1 mb-3">Create Post</a>

                </div>

                <div>

                    @forelse ($posts as $post)

                        <div class="flex items-center space-x-6">

                            @livewire('post-votes', ['post' => $post])

                            <div class="my-3">

                                <a class="text-2xl font-light mb-3" href="{{ route('communities.posts.show', [$community, $post]) }}">{{ $post->title }}</a>

                                <p>{{ \Illuminate\Support\Str::words($post->post_text, 10) }}</p>

                                <p>{{ $post->created_at->diffForHumans() }}</p>

                            </div>


                        </div>

                        <hr>

                    @empty

                    @endforelse

                    <div class="mt-4">

                        {{ $posts->links() }}

                    </div>

                </div>

            </div>

            @include('side_section')

        </div>

    </div>

</x-app-layout>
