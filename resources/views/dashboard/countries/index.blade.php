@extends('dashboard.layouts.app')

@section('content')

<div class="card card-flush">

    <form action="{{ route('dashboard.countries.index') }}" method="GET">

        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" data-kt-ecommerce-product-filter="search" name="s" value="{{ request()->s }}"
                        class="form-control form-control-solid w-250px ps-12" placeholder="Search Countries">
                </div>
            </div>
        </div>

    </form>

    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-200px">Name</th>
                        <th class="min-w-200px">Code</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">

                    @foreach($countries as $country)

                        <tr>
                            <td>
                                <a href="#"
                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                    data-kt-ecommerce-product-filter="product_name">
                                    {{ $country->name }}
                                </a>
                            </td>
                            <td>
                                {{ $country->code }}
                            </td>
                            <td class="text-center pe-0">
                                <?php /* ?>
                                @if ( $gateways->is_active == 1 )
                                    <div class="badge badge-light-primary">Enabled</div>
                                @else
                                    <div class="badge badge-light-danger">Disabled</div>
                                @endif
                                <?php */ ?>
                            </td>
                            <?php /* ?>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{ route('dashboard.orders.edit', $order->id) }}"
                                            class="menu-link px-3">Edit</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="menu-link px-3" type="submit">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </td>
                            <?php */ ?>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>


        <div id="" class="row">
            {{ $countries->links('dashboard.includes.pagination.default') }}
        </div>

    </div>

</div>

@endsection