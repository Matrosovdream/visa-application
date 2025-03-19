@extends('web.layouts.app')

@section('content')

    <div class="mx-auto p-10 blog-single">
        <nav class="text-sm text-gray-500 mb-4">
            Home &gt;
            <span class="text-blue-600">
                {{ $article['title'] }}
            </span>
        </nav>

        <h1 class="text-3xl font-bold mb-2">
            {{ $article['title'] }}
        </h1>
        
        <div class="flex items-center text-gray-600 text-sm mb-6">
            <img src="https://icon2.cleanpng.com/20180705/wjv/kisspng-computer-icons-user-interface-administrator-5b3ebfcc7ce331.3763403515308389885116.jpg" alt="Author" class="rounded-full w-8 h-8 mr-2">
            <span class="font-semibold">Admin</span>
            <span class="mx-2">|</span>
            <span>4 min read</span>
            <span class="mx-2">|</span>
            <span>Updated on {{ $article['Model']->created_at->format('F j, Y') }}</span>
        </div>

        <div class="flex flex-col md:flex-row gap-10 justify-between">

            <div class="md:w-1/3 bg-white p-4 rounded-lg md:sticky md:top-4 h-fit jump">
                <h2 class="text-lg font-semibold mb-3">Jump to:</h2>
                <ul class="space-y-2 text-blue-600">
                    <li>01 | Applying for a visa through the government or a third-party visa service</li>
                    <li>02 | Understanding visa scams</li>
                    <li>03 | Why use an online visa service?</li>
                    <li>04 | Why you can trust us for all your travel documents</li>
                    <li>05 | Need more information about visas?</li>
                </ul>
            </div>

            <div class="md:w-7/12 ">

                <div class="bg-white p-4 pr-10 rounded-lg shadow ml-auto summary mb-10">
                    <h2 class="text-lg font-semibold mb-3">Summary</h2>
                    {!! $article['summary'] ?? '' !!}
                </div>

                <div class="content">
                    {!! $article['content'] !!}
                </div>

            </div>
        </div>
    </div>


@php /*
    <section class="blog pt-30 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-post-wrapper">

                        <article class="post-details">
                            <ul class="post-meta ul_li">
                                <li>
                                    <span class="posted-on">
                                        {{ $article['Model']->created_at->format('F j, Y') }}
                                    </span>
                                </li>
                            </ul>

                            <h2>{{ $article['title'] }}</h2>

                            <div class="summary">
                                {!! $article['summary'] ?? '' !!}
                            </div>

                            <div class="content">
                                {!! $article['content'] !!}
                            </div>

                        </article>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="blog-sidebar">


                    </div>
                </div>

            </div>
        </div>
    </section>
*/ @endphp    

@endsection