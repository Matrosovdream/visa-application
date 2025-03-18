@extends('web.layouts.app')

@section('content')

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

@endsection