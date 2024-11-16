@extends('web.layouts.app')

@section('content')

<div class="container my-4">

    @include('web.account.orders.partials.backlink', ['url' => route('web.account.order', $order->id)])

    <h2 class="mb-25">
        {{ __('Ready documents') }}
    </h2>

    <hr />

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-35">

        @foreach($order->certificates as $item)

            <div class="col active-status-block">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="mb-10">
                            {{ $item->file->filename }}
                        </h5>
                    </div>
                    <div
                        class="card-footer bg-white mb-10 mt-10 border-0 d-flex justify-content-between align-items-center">
                        <a href="{{ route('file.download', $item->file->id) }}" class="text-decoration-none">
                            {{ __('Download') }}
                        </a>
                        <a href="{{ route('file.download', $item->file->id) }}" class="btn-arrow">➔</a>
                    </div>
                </div>
            </div>

        @endforeach    

    </div>

</div>


<style>
    /* Additional custom styles */
    .progress-bar-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-top: 20px;
    }

    .applicant-card {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
        align-items: start;
    }

    .btn-complete {
        background-color: #28a745;
        color: white;
    }

    .order-summary,
    .order-details {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .order-details {
        background-color: rgb(248 249 249);
    }

    .order-details table th,
    .order-details table td {
        background-color: rgb(248 249 249);
    }

    .block-border {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 20px;
    }

    .card-body {
        background-color: rgb(248 249 249);
    }

    .card-status {
        background-color: #d1ecf1;
        color: #0c5460;
        border-radius: 10px;
        padding: 4px 8px 2px 8px;
        font-size: 0.8rem;
        font-weight: bold;
    }

    .card-progress {
        background-color: #e9ecef;
        border-radius: 50%;
        padding: 5px;
        font-size: 0.8rem;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-country img {
        width: 20px;
        margin-right: 5px;
    }

    .btn-arrow {
        background: linear-gradient(90deg, #00d7b0, #00e65b);
        color: white;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        border: none;
    }

    .card-text {
        font-size: 15px;
    }

    .non-active-status-block {
        opacity: 0.5;
    }

    .active-status-block {
        opacity: 1;
    }
</style>

@endsection