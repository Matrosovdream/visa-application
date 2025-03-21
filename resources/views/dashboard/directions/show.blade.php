@extends('dashboard.layouts.app')

@section('content')

<form class="form" method="POST" action="{{ route('dashboard.directions.update', $direction['id']) }}" id="kt_ecommerce_customer_profile">
    @csrf

    <div class="d-flex flex-column flex-xl-row">
        <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
            <div class="card mb-5 mb-xl-8">

                <div class="card-body pt-5">

                    <div class="d-flex flex-stack fs-4 py-3">
                        <div class="fw-bold">
                            Edit Direction <br/     >
                                {{ $direction['countryFrom']['title'] }}
                                ->
                                {{ $direction['countryTo']['title'] }}
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="flex-lg-row-fluid ms-lg-15">

            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">

                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                        href="#kt_ecommerce_customer_general">General Settings</a>
                </li>

            </ul>

            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade active show" id="kt_ecommerce_customer_general" role="tabpanel">
                    <div class="card pt-4 mb-6 mb-xl-9">

                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Direction</h2>
                            </div>
                        </div>


                        <div class="card-body pt-0 pb-5">

                            <div class="row row-cols-1 row-cols-md-2">

                                <div class="col">
                                    <div class="fv-row mb-7">

                                        <label class="fs-6 fw-semibold mb-2">
                                            <span class="required">Visa required</span>
                                        </label>

                                        <select name="visa_req" class="form-select form-select-solid" data-control="select2"
                                            data-hide-search="true">
                                            @foreach($references['visa_req'] as $ref)
                                                @if($ref['id'] == 3) @continue @endif
                                                    
                                                <option 
                                                    value="{{ $ref['id'] }}"
                                                    {{ $direction['visa_req'] == $ref['id'] ? 'selected' : '' }}
                                                    >
                                                    {{ $ref['name'] }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-end">

                                <button type="submit" id="kt_ecommerce_customer_profile_submit"
                                    class="btn btn-light-primary">
                                    <span class="indicator-label">Save</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>

                            </div>


                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</form>

@endsection