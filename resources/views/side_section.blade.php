<div class="">

    <div class="bg-white shadow-xl sm:rounded-lg p-8 mb-5">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            Newest Posts
        </h2>

        @foreach ($newest_communities as $post)

            <a href="{{ route('communities.posts.show', [$post->community, $post]) }}">{{ $post->title }}</a>

            <p class="text-xs">{{ $post->created_at->diffForHumans() }}</p>

        @endforeach

    </div>

    <div class="bg-white shadow-xl sm:rounded-lg p-8">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
            Newest Communities
        </h2>

        @foreach ($newest_posts as $community)

            <a href="{{ route('communities.show', $community) }}">{{ $community->name }} ({{ $community->posts_count }} posts)</a>

            <p class="text-xs">{{ $community->created_at->diffForHumans() }}</p>


        @endforeach

    </div>

</div>
