<div class="items-center flex flex-col">

    <a href="#" wire:click.prevent="vote(1)">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="gray">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
        </svg>
    </a>

    <h2>{{ $sumVotes }}</h2>

    <a href="#" wire:click.prevent="vote(-1)">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" fill="none" viewBox="0 0 24 24" stroke="gray">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
        </svg>
    </a>

</div>
