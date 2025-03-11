@extends('web.layouts.app')

@section('content')
    <div class="flex min-h-screen p-6">
        <!-- Sidebar -->
        <aside class="w-1/4 p-6 ml-6 bg-white rounded-lg shadow-md hidden md:block">
            @include('web.account.orders.partials.backlink', ['url' => route('web.account.order', $order->id)])

            <h2 class="text-2xl font-semibold mb-6">
                {{ $order->getProduct()->name }} - {{ __('Trip Details') }}
            </h2>

            <div class="space-y-6 orders-user-sidebar">
                @include('web.account.orders.partials.sidebar')
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 max-w-5xl">
            <div class="bg-white border-2 border-solid border-evisasuperlight rounded-3xl p-8">

                <h1 class="text-2xl font-medium mb-6">
                    {{ __('Documents') }}
                </h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($applicant->documents as $document)
                        <div class="bg-white p-6 rounded-lg shadow-md mb-4">
                            <a href="{{ route('file.download', $document->document->id) }}" class="text-blue-600 hover:underline">
                                <h5 class="text-lg font-medium">{{ $document->document->filename }}</h5>
                            </a>
                            
                            <form action="{{ route('web.account.order.applicant.document.delete', ['order_id' => $order->id, 'applicant_id' => $applicant->id, 'document_id' => $document->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="text-right mt-3">
                                    <button type="submit" class="px-4 py-2 rounded-lg">
                                        {{ __('Remove') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>

                <hr class="my-6 border-gray-300">
                <h5 class="text-lg font-semibold">{{ __('Add new document') }}</h5>

                <form
                    action="{{ route('web.account.order.applicant.documents.store', ['order_id' => $order->id, 'applicant_id' => $applicant->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <div class="relative border border-gray-300 rounded-lg bg-gray-100 p-3 text-center cursor-pointer hover:bg-gray-200">
                            <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="document" name="document">
                            <span class="text-gray-600">Click to upload or drag and drop</span>
                        </div>
                    </div>

                    <button 
                        type="submit"
                        class="mt-2 bg-evisablue text-white font-medium px-4 py-2 rounded-lg hover:bg-evisabluekhover"
                        >
                        {{ __('Add file') }}
                    </button>
                </form>
            </div>
        </main>
    </div>
@endsection