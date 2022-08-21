<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-3">

            <div class="bg-white shadow-xl sm:rounded-lg p-8 col-span-2">

                @if(session('message'))

                    <p class="mb-3 border p-2 rounded-full">{{ session('message')}}</p>

                @endif

                @if($post->post_url != '')

                    <a class="mb-5 inline-block" href="{{ $post->post_url }}" target="_blank">Link</a>

                @endif

                @if($post->post_image != '')

                    <img src="{{ Storage::disk('posts')->url($post->id . '/thumbnail_' . $post->post_image)}}" alt="Image">

                @endif

                <p class="text-lg mb-5">{{ $post->post_text }}</p>

                <hr>

                @auth

                    <h3 class="font-semibold tracking-wide text-lg mt-5">Comments:</h3>

                    @forelse ($post->comments as $comment)

                        <div class="mb-2">
                            <p class="font-semibold text-sm">{{ $comment->user->name }}</p>

                            <p class="text-xs">{{ $comment->created_at->diffForHumans() }}</p>

                            <p>{{ $comment->comment_text }}</p>

                        </div>

                    @empty

                        <p class="mb-5">No comments yet.</p>

                    @endforelse

                    <hr>

                    <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="my-5">
                        @csrf

                        <p>Add Comment:</p>

                        <textarea required class="block my-3 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="comment_text"></textarea>

                        <button class="rounded-full bg-black text-white px-2 py-1" type="submit">Add comment</button>

                    </form>

                    <hr>

                    <div class="flex items-end justify-end mt-5">

                        @can('post-edit', $post)

                            <a class="rounded-full bg-black text-white px-2 py-1 inline-block mr-5" href="{{ route('communities.posts.edit', [$post->community, $post]) }}">Edit post</a>

                        @endcan

                        @can('post-delete', $post)

                            <form action="{{ route('communities.posts.destroy', [$post->community, $post]) }}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-full bg-black text-white px-2 py-1 ml-4" onclick="confirm('Are you sure?')">Delete</button>
                            </form>

                        @else

                            <hr>

                            <form action="{{ route('post_report', $post->id) }}" method="POST" >
                                @csrf
                                @method('POST')
                                <button type="submit" class="rounded-full bg-black text-white text-xs px-2 py-1 " onclick="confirm('Are you sure?')">Report post as inappropriate</button>
                            </form>

                        @endcan

                    </div>

                @endauth

            </div>

            @include('side_section')

        </div>

    </div>

</x-app-layout>
