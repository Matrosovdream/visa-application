<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>Attached countries</h2>
        </div>
    </div>

    <div class="card-body pt-0">
        <div class="mb-10 fv-row fv-plugins-icon-container">
            <label class="required form-label">Countries list</label>

            <select multiple class="form-select mb-2" data-control="select2" data-hide-search="true"
                data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select" name="countries[]">
                <option></option>

                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ in_array($country->id, $product->countries->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach

            </select>

            <div class="text-muted fs-7">Set the product countries.</div>

        </div>

    </div>

</div>