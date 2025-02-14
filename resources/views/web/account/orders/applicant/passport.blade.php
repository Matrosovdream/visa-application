@extends('web.layouts.app')

@section('content')


    <div class="flex h-screen p-6">
        <!-- Sidebar -->
        <aside class="w-1/4 p-6 ml-6 bg-white">

            <a href="#" class="text-blue-600 mb-4 inline-block hover:underline">&larr; Back to all orders</a>
            @include('web.account.orders.partials.backlink', ['url' => route('web.account.order', $order->id)])

            <h2 class="text-3xl font-semibold mb-6">
                {{ $order->getProduct()->name }} - {{ __('Passport') }}
            </h2>

            <div class="space-y-6">
                @include('web.account.orders.partials.sidebar')
            </div>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 max-w-5xl">
            <div class="bg-white border-2 border-solid border-evisasuperlight rounded-3xl p-8">

                <h1 class="text-2xl font-medium mb-6">
                    {{ __('Passport') }}
                </h1>

                <form method="POST"
                    action="{{ route('web.account.order.applicant.fields.update', ['order_id' => $order->id, 'applicant_id' => $applicant->id]) }}"
                    class="grid grid-cols-2 gap-6">
                    @csrf

                    <input type="hidden" name="next_page" value="{{ $next_page ?? '' }}">

                    @include(
                        'web.partials.fields-loop',
                        [
                            'values' => $fieldValues,
                            'fields' => $formFields,
                            'entity' => 'traveller'
                        ]
                    )

                    <div class="col-span-2">
                        <button type="submit"
                            class="mt-2 bg-evisablue text-white font-medium px-4 py-2 rounded-lg hover:bg-evisabluekhover"
                            id="next-1">
                            {{ __('Save and continue') }}
                        </button>
                    </div>

                </form>

            </div>
        </main>
    </div>

@endsection