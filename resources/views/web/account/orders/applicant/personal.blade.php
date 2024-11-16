@extends('web.layouts.app')

@section('content')

<div class="container my-4">

    @include('web.account.orders.partials.backlink', ['url' => route('web.account.order', $order->id)])

    <h2 class="mb-25">
        {{ $order->getProduct()->name }} - {{ __('Personal information') }}
    </h2>

    <div class="row">
        <div class="row">
            <div class="col-md-3">
                @include('web.account.orders.partials.sidebar')
            </div>

            <div class="col-md-9">
                <!-- General Information Form -->
                <div class="card p-4">

                    <div class="application-section-head mb-25">
                        <h3 class="card-title">
                            {{ __('Personal information') }}
                        </h3>
                        <p class="card-text text-warning"></p>
                    </div>

                    <form 
                        method="POST" 
                        action="{{ route('web.account.order.applicant.fields.update', ['order_id' => $order->id, 'applicant_id' => $applicant->id]) }}"
                        class="xb-item--form contact-from w-75 apply-form"
                        enctype="multipart/form-data"
                        >
                        @csrf

                        @include('web.account.orders.partials.applicant-fields')

                        <button type="submit" class="btn btn-primary" id="next-1">
                            {{ __('Save') }}
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>


    <style>
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
    </style>

    @endsection