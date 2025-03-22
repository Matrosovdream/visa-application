<div class="bg-white p-4 pr-10 rounded-lg shadow ml-auto summary mb-10">
    <h2 class="text-lg font-semibold mb-3">
        {{ __('Summary') }}:
    </h2>
    {!! $article['summary'] ?? '' !!}
</div>

<div class="content">
    {!! $article['content'] !!}
</div>