<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>Offers</h2>
        </div>
    </div>

    <div class="card-body pt-0">
        <div class="" data-kt-ecommerce-catalog-add-product="auto-options">

            <div id="kt_ecommerce_add_product_options">

                @if(count($product->offers) > 0)

                    <div class="form-group">
                        <div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3">

                            <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">

                                <div class="w-100 w-md-200px">Title</div>
                                <div class="w-100 w-md-100px">Price</div>
                                <div class="w-200 w-md-200px">Duration title</div>
                                <div class="w-100 w-md-100px text-right">Duration hours</div>
                                <div class="w-50 w-md-50px"></div>

                            </div>

                            @foreach($product->offers as $offer)

                                <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">

                                    <div class="w-100 w-md-200px">
                                        <input type="text" class="form-control" name="offers[{{ $offer->id }}][name]"
                                            value="{{ $offer->name }}" disabled />
                                    </div>

                                    <div class="w-100 w-md-100px">
                                        <input type="text" class="form-control" name="offers[{{ $offer->id }}]['price']"
                                            value="{{ $offer->price }}" disabled />
                                    </div>

                                    <div class="w-200 w-md-200px">
                                        <input type="text" class="form-control"
                                            name="offers[{{ $offer->id }}][meta][duration_title]"
                                            value="{{ $offer->getMeta('duration') }}" disabled />
                                    </div>

                                    <div class="w-100 w-md-100px">
                                        <input type="text" class="form-control"
                                            name="offers[{{ $offer->id }}][meta][duration_hours]"
                                            value="{{ $offer->getMeta('duration_hours') }}" disabled />
                                    </div>

                                    <div class="w-50 w-md-50px">

                                        <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_product_offer_{{ $offer->id }}">
                                            Edit
                                        </a>

                                    </div>

                                </div>

                            @endforeach

                        </div>
                    </div>

                @endif

                <div class="form-group mt-5">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#kt_modal_product_offer_new"
                        class="btn btn-sm btn-light-primary">
                        <i class="ki-duotone ki-plus fs-2"></i>Add another offer</button>
                </div>

            </div>

        </div>
    </div>

</div>