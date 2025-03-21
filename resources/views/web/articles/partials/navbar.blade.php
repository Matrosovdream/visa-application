<nav class="text-sm text-gray-500 mb-4">

    @foreach( $breadcrumbs as $breadcrumb )

        <a href="{{ $breadcrumb['url'] ?? '' }}" class="text-blue-600">
            {{ $breadcrumb['title'] }}
        </a>

        @if( !$loop->last )
            &gt;
        @endif

    @endforeach

</nav>