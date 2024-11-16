@extends('dashboard.layouts.app')

@section('content')

<div class="card card-flush">

    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                    data-kt-check-target="#kt_ecommerce_products_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="min-w-200px">Direction</th>
                        <th class="min-w-200px">Visa requirements</th>
                        <th class="min-w-200px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">

                    @foreach($directions as $direction)

                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" />
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('dashboard.directions.show', $direction->countryFrom->id) }}"
                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                    data-kt-ecommerce-product-filter="product_name">
                                    {{ $direction->countryFrom->name }}
                                </a>
                                ->
                                <a href="{{ route('dashboard.directions.show', $direction->countryTo->id) }}"
                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                    data-kt-ecommerce-product-filter="product_name">
                                    {{ $direction->countryTo->name }}
                                </a>
                            </td>
                            <td>
                                @if ( $direction->visa_req == 1 )
                                    <div class="badge badge-light-primary">Yes</div>
                                @else
                                    <div class="badge badge-light-danger">No</div>
                                @endif
                            </td>
                            <td class="text-right">
                                @php /*
                                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                </a>

                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                    data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a href="{{ route('dashboard.directions.show', $direction->id) }}"
                                            class="menu-link px-3">Edit</a>
                                    </div>
                                </div>
                                */ @endphp

                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>


        <div id="" class="row">
            {{ $directions->links('dashboard.includes.pagination.default') }}
        </div>

    </div>

</div>

@endsection