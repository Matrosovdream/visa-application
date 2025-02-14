<div class="mx-auto max-w-md rounded-lg bg-white">
    <h2 class="mb-1 px-4 text-2xl font-semibold">Order details</h2>
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="">
                    <th class="px-4 py-2 text-left font-semibold text-sm text-evisamedium">
                        Product name
                    </th>
                    <th class="px-4 py-2 text-right font-semibold text-sm text-evisamedium">
                        Price
                    </th>
                    <th class="px-4 py-2 text-right font-semibold text-sm text-evisamedium">
                        Quantity
                    </th>
                    <th class="px-4 py-2 text-right font-semibold text-sm text-evisamedium">
                        Subtotal
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach($order->getCart() as $item)
                    <tr class="border-t">
                        <td class="px-4 py-2 text-sm text-evisablack">
                            {{ $item['product']['name'] }} ({{ $item['offer']['name'] }})
                        </td>
                        <td class="px-4 py-2 text-center text-sm text-evisablack">
                            {{ $item['offer']['price'] }} {{ $order->getCurrency() }}
                        </td>
                        <td class="px-4 py-2 text-center text-sm text-evisablack">
                            {{ $item['quantity'] }}
                        </td>
                        <td class="px-4 py-2 text-center text-sm text-evisablack">
                            {{ $item['offer']['total'] }} {{ $order->getCurrency() }}
                        </td>
                    </tr>
                    @foreach($item['extras'] as $extra)

                        <tr class="border-t">
                            <td class="px-4 py-2 text-sm text-evisablack">
                                {{ $extra['name'] }}
                            </td>
                            <td class="px-4 py-2 text-center text-sm text-evisablack">
                                {{ $extra['price'] }} {{ $order->getCurrency() }}
                            </td>
                            <td class="px-4 py-2 text-center text-sm text-evisablack">
                                {{ $extra['quantity'] }}
                            </td>
                            <td class="px-4 py-2 text-center text-sm text-evisablack">
                                {{ $extra['total'] }} {{ $order->getCurrency() }}
                            </td>
                        </tr>

                    @endforeach    

                @endforeach
            </tbody>
            <tfoot>
                <tr class="border-t border-solid border-t-2 border-evisasuperlight">
                    <td class="px-4 py-2 font-semibold text-evisablack" colspan="3">
                        {{ __('Total') }}
                    </td>
                    <td class="px-4 py-2 text-right font-semibold text-evisablack">
                        {{ $order->getTotal() }} {{ $order->getCurrency() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>