@extends('web.layouts.app')

@section('content')

    <div class="mx-auto p-10 flex flex-col lg:flex-row justify-between gap-6">

        <!-- Articles Section (55% on desktop, full width on mobile) -->
        <div class="w-full lg:w-[55%]">

            @include('web.articles.partials.navbar')
            
            <h1 class="text-3xl font-bold text-gray-900 mt-4">
                All categories: 
                <span class="text-blue-600">
                    Travel
                </span>
            </h1>

            <div class="mt-4 space-y-4">

                @foreach( $groups['items'] as $group )

                    <a 
                        href="{{ route('articles.show', $group['slug']) }}" 
                        class="block p-4 bg-white shadow rounded-lg hover:bg-gray-50 flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-900">
                            {{ $group['name'] }}
                        </span>
                        <span class="text-gray-400">›</span>
                    </a>

                @endforeach

            </div>
        </div>

        @include('web.articles.partials.apply-form')

    </div>

@endsection