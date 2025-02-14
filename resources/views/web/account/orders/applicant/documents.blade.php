@extends('web.layouts.app')

@section('content')

    <div class="flex h-screen p-6">
        <!-- Sidebar -->
        <aside class="w-1/4 p-6 ml-6 bg-white">

            <a href="#" class="text-blue-600 mb-4 inline-block hover:underline">&larr; Back to all orders</a>
            @include('web.account.orders.partials.backlink', ['url' => route('web.account.order', $order->id)])

            <h2 class="text-3xl font-semibold mb-6">
                {{ $order->getProduct()->name }} - {{ __('Trip Details') }}
            </h2>

            <div class="space-y-6">
                @include('web.account.orders.partials.sidebar')
            </div>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 max-w-5xl">
            <div class="bg-white border-2 border-solid border-evisasuperlight rounded-3xl p-8">

            <div class="application-section-head mb-25">
                    <h3 class="card-title">{{ __('Documents') }}</h3>
                    <p class="card-text text-warning">{{ __('Passport page is required') }}</p>
                </div>

                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach($applicant->documents as $document)
                        <div class="col">
                            <div class="card shadow-sm h-100">
                                <!-- We display filename, path, description and remove form -->
                                <div class="card-body">
                                    <a href="{{ route('file.download', $document->document->id) }}">
                                        <h5 class="card-title">
                                            {{ $document->document->filename }}
                                        </h5>
                                    </a>
                                    @php /*
                                    <p class="card-text">Description: 
                                        @if( $document->document->description )
                                            {{ $document->document->description }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                    */ @endphp

                                    <form action="{{ route('web.account.order.applicant.document.delete', ['order_id' => $order->id, 'applicant_id' => $applicant->id, 'document_id' => $document->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-danger btn-remove mt-15">
                                                {{ __('Remove') }}
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <br/>
                <hr class="mb-15 mt-25">
                <h5 class="card-title">{{ __('Add new document') }}</h5>

                <!-- Documents form with the one field input file and description -->
                <form action="{{ route('web.account.order.applicant.documents.store', ['order_id' => $order->id, 'applicant_id' => $applicant->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="file" class="form-control" id="document" name="document">
                    </div>
                    @php /*
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            {{ __('Document Description') }}
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    */ @endphp
                    <button type="submit" class="btn btn-primary">
                        {{ __('Add file') }}
                    </button>
                </form>


            </div>
        </main>
    </div>






@endsection