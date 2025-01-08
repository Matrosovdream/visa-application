@if(count($fields) > 0)

    <div class="form-group">
        <div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3">

            <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">

                <div class="w-250 w-md-200px">Title</div>
                <div class="w-250 w-md-100px">Section</div>
                <div class="w-100 w-md-100px text-center">Required</div>
                <div class="w-100 w-md-100px text-center">Default value</div>
                <div class="w-100 w-md-100px text-center">Classes</div>
                <div class="w-50 w-md-50px"></div>

            </div>

            @foreach($fields as $field)

                <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">

                    <div class="w-250 w-md-200px">
                        <input type="text" class="form-control" name="offer_name[]" value="{{ $field['field']['title'] }}"
                            disabled />
                    </div>

                    <div class="w-250 w-md-100px">
                        <input type="text" class="form-control" name="offer_price[]" value="{{ $field['section'] }}" disabled />
                    </div>

                    <div class="w-100 w-md-100px text-center">
                        @if($field['required'])
                            <span class="badge badge-light-success">Yes</span>
                        @else
                            <span class="badge badge-light-danger">No</span>
                        @endif
                    </div>

                    <div class="w-100 w-md-100px">
                        <input type="text" class="form-control" name="offer_price[]" value="{{ $field['default_value'] }}"
                            disabled />
                    </div>

                    <div class="w-100 w-md-100px">
                        <input type="text" class="form-control" name="offer_price[]" value="{{ $field['classes'] }}"
                            disabled />
                    </div>

                    <div class="w-50 w-md-50px">

                        <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_product_form_field_{{ $field['id'] }}">
                            Edit
                        </a>

                    </div>

                </div>

            @endforeach

        </div>
    </div>

@endif