<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>Order fields</h2>
        </div>
    </div>

    <div class="card-body pt-0">
        <div class="" data-kt-ecommerce-catalog-add-product="auto-options">

            <div id="kt_ecommerce_add_product_options">

                @include('dashboard.products.form-fields.index', ['fields' => $fields])

                <div class="form-group mt-5">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#kt_modal_product_form_field_order"
                        class="btn btn-sm btn-light-primary">
                        <i class="ki-duotone ki-plus fs-2"></i>Add another field</button>
                </div>

            </div>

        </div>
    </div>

</div>