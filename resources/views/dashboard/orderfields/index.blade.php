@extends('dashboard.layouts.app')

@section('content')

<div class="card card-flush">

    <form action="{{ route('dashboard.orderfields.index') }}" method="GET">

        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" name="s" value="{{ request()->s }}"
                        class="form-control form-control-solid w-250px ps-12" placeholder="Search Fields">
                </div>
            </div>

            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <div class="w-100 mw-150px">
                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                        data-placeholder="Status" name="status">
                        <option></option>
                        <option value="all">All</option>
                        <option value="published">Published</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <a href="{{ route('dashboard.orderfields.create') }}" class="btn btn-primary">Add field</a>
            </div>
        </div>

    </form>

    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="max-w-150px">Title</th>
                        <th class="">Slug</th>
                        <th class="">Type</th>
                        <th class="">Section</th>
                        <th class="">Is email</th>
                        <th class="">Is phone</th>
                        <th class="">Is full name</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">

                    @foreach($items as $item)

                        <tr>
                            <td>
                                <a href="{{ route('dashboard.orderfields.show', $item->id) }}"
                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                    data-kt-ecommerce-product-filter="product_name">
                                    {{ $item->title }}
                                </a>
                            </td>
                            <td class="">
                                <a href="{{ route('dashboard.orderfields.show', $item->id) }}"
                                    class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                    data-kt-ecommerce-product-filter="product_name">
                                    {{ $item->slug }}
                                </a>
                            </td>
                            <td class="">
                                {{ $item->type }}
                            </td>
                            <td class="pe-0">
                                {{ $item->section }}
                            </td>
                            <td class="pe-0">
                                {{ $item->is_email ? 'Yes' : '' }}
                            </td>
                            <td class="pe-0">
                                {{ $item->is_phone ? 'Yes' : '' }}
                            </td>
                            <td class="pe-0">
                                {{ $item->is_fullname ? 'Yes' : '' }}
                            </td>

                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>

                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                    data-kt-menu="true">

                                    <div class="menu-item px-3">
                                        <a href="{{ route('dashboard.articles.show', $item->id) }}"
                                            class="menu-link px-3">Edit</a>
                                    </div>

                                    <div class="menu-item px-3">
                                        <form action="{{ route('dashboard.orderfields.destroy', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="menu-link px-3" type="submit">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>


        <div id="" class="row">
            {{ $items->links('dashboard.includes.pagination.default') }}
        </div>

    </div>

</div>

@endsection