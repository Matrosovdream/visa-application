@extends('web.layouts.app')

@section('content')

    <div class="mx-auto p-10 blog-single">

        @include('web.articles.partials.header')

        <div class="flex flex-col md:flex-row gap-10 justify-between">

            @include('web.articles.partials.sidebar', ['breadcrumbs' => $breadcrumbs])

            <div class="md:w-7/12 ">

                @include('web.articles.partials.content')

            </div>
        </div>
    </div>

@endsection