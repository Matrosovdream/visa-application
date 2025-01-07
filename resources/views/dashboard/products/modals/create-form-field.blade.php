<div class="modal fade" id="kt_modal_product_form_field_{{ $entity }}" tabindex="-1" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Create new field</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>

            <div class="modal-body py-lg-10 px-lg-10">
                <form method="POST" action="{{ route('dashboard.productfieldsreference.store') }}">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    <input type="hidden" name="entity" value="{{ $entity }}" />
                    <input type="hidden" name="required" value="0" />

                    <div class="mb-10 w-50 fv-row fv-plugins-icon-container">
                        <label class="required form-label">Field</label>
                        <select name="field_id" class="form-select form-select-solid mb-2">
                            <option>Select field</option>
                            @foreach($formFields['fields'] as $field)
                                <option value="{{ $field['id'] }}">{{ $field['title'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-10 w-50 fv-row fv-plugins-icon-container">
                        <label class="required form-label">Section</label>
                        <select name="section" class="form-select form-select-solid mb-2">
                            <option>Select section</option>
                            @foreach($formFields['sections'] as $code=>$section)
                                <option value="{{ $code }}">{{ $section['title'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-10 w-50 fv-row fv-plugins-icon-container">
                        <label class="required form-label">Required</label>
                        <select name="required" class="form-select form-select-solid mb-2">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <div class="d-flex flex-stack">

                        <div></div>

                        <div>
                            <button type="submit" class="btn btn-lg btn-primary">
                                Save
                                <i class="ki-duotone ki-arrow-right fs-3 ms-1 me-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i></button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>