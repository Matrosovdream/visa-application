<div class="md:w-1/3 bg-white p-4 rounded-lg md:sticky md:top-4 h-fit jump">

    <h2 class="text-lg font-semibold mb-3">
        {{ __('Jump to') }}:
    </h2>

    <ul class="space-y-2 text-blue-600">

        @foreach( $article['contentLinks'] as $count=>$link )
            <li>
                <a href="{{ $link['link'] }}">
                    0{{ $count+1 }} | {{ $link['text'] }}
                </a>
            </li>
        @endforeach
        
    </ul>
</div>