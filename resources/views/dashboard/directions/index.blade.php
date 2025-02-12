@extends('dashboard.layouts.app')

@section('content')

<div class="card card-flush">

    <form action="{{ route('dashboard.directions.index') }}" method="GET">

        <div class="card-header align-items-center py-5 gap-2 gap-md-5">

            <div class="card-title">
                
            </div>

            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">

                <div class="w-100 mw-150px">
        
                    <select name="visa_req" class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                        data-placeholder="Visa?" data-kt-ecommerce-product-filter="Visa?">
                        
                        @foreach($references['visa_req'] as $item)
                            <option 
                                value="{{ $item['id'] }}"
                                @if( isset( request()->visa_req ) )
                                    {{ request()->visa_req == $item['id'] ? 'selected' : '' }}
                                @endif
                                >
                                {{ $item['name'] }}
                            </option>
                        @endforeach

                    </select>

                </div>

                <div class="w-100 mw-200px">
    
                    <select name="country_from" class="form-select form-select-solid" data-control="select2" data-hide-search="false"
                        data-placeholder="Country from" data-kt-ecommerce-product-filter="Country from">
                        <option></option>
                        <option value="all">All</option>

                        @foreach($references['country']['items'] as $country)
                            <option 
                                value="{{ $country['id'] }}"
                                {{ request()->get('country_from') == $country['id'] ? 'selected' : '' }}
                                >
                                {{ $country['name'] }}
                            </option>
                        @endforeach
                        
                    </select>

                </div>

                <div class="w-100 mw-200px">
    
                    <select name="country_to" class="form-select form-select-solid" data-control="select2" data-hide-search="false"
                        data-placeholder="Country to" data-kt-ecommerce-product-filter="Country to">
                        <option></option>
                        <option value="all">All</option>
                        
                        @foreach($references['country']['items'] as $country)
                            <option 
                                value="{{ $country['id'] }}"
                                {{ request()->get('country_to') == $country['id'] ? 'selected' : '' }}
                                >
                                {{ $country['name'] }}
                            </option>
                        @endforeach

                    </select>

                </div>

                <button type="submit" class="btn btn-primary">Filter</button>

            </div>
        </div>

    </form>

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
                        <th class="min-w-200px text-center">Visa requirements</th>
                        <th class="min-w-200px">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">

                    @foreach($directions['items'] as $direction)

                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" />
                                </div>
                            </td>
                            <td>
                                <a href=""
                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                    data-kt-ecommerce-product-filter="product_name">
                                    {{ $direction['countryFrom']['name'] }}
                                </a>
                                ->
                                <a href=""
                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                    data-kt-ecommerce-product-filter="product_name">
                                    {{ $direction['countryTo']['name'] }}
                                </a>
                            </td>
                            <td class="text-center">
                                @if ($direction['visa_req'] == 1)
                                    <div class="badge badge-light-primary">Yes</div>
                                @else
                                    <div class="badge badge-light-danger">No</div>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('dashboard.directions.show', $direction['id']) }}" class="menu-link px-3">
                                    Edit
                                </a>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>


        <div id="" class="row">
            {{ $directions['Model']->appends(request()->query())->links('dashboard.includes.pagination.default') }}

        </div>
        </div>

    </div>

</div>

@endsection