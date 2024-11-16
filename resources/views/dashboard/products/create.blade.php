@extends('dashboard.layouts.app')

@section('content')

<form id="kt_ecommerce_add_product_form"
	class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
	data-kt-redirect="apps/ecommerce/catalog/products.html" data-select2-id="select2-data-kt_ecommerce_add_product_form"
	method="POST" action="{{ route('dashboard.products.store') }}">
	@csrf

	<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-250px mb-7 me-lg-10"
		data-select2-id="select2-data-130-l6c6">

		<div class="card card-flush py-4">
			<div class="card-header">
				<div class="card-title">
					<h2>Status</h2>
				</div>
				<div class="card-toolbar">
					<div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
				</div>
			</div>

			<div class="card-body pt-0">

				<select class="form-select mb-2" data-control="select2" data-hide-search="true"
					data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select"
					name="status">
					<option></option>
					<option value="published" selected="selected">Published</option>
					<option value="draft">Draft</option>
				</select>

				<div class="text-muted fs-7">Set the product status.</div>
				<div class="d-none mt-10">
					<label for="kt_ecommerce_add_product_status_datepicker" class="form-label">
						Select publishing date and time
					</label>
					<input class="form-control" id="kt_ecommerce_add_product_status_datepicker"
						placeholder="Pick date & time" />
				</div>
			</div>
		</div>
	</div>

	<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

		<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2"
			role="tablist">
			<li class="nav-item" role="presentation">
				<a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
					href="#kt_ecommerce_add_product_general" aria-selected="true" role="tab">General</a>
			</li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane fade active show" id="kt_ecommerce_add_product_general" role="tab-panel">
				<div class="d-flex flex-column gap-7 gap-lg-10">
					<!--begin::General options-->
					<div class="card card-flush py-4">
						<!--begin::Card header-->
						<div class="card-header">
							<div class="card-title">
								<h2>General</h2>
							</div>
						</div>
						<!--end::Card header-->
						<!--begin::Card body-->
						<div class="card-body pt-0">
							<!--begin::Input group-->
							<div class="mb-10 fv-row fv-plugins-icon-container">
								<!--begin::Label-->
								<label class="required form-label">Product Name</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" name="product_name" class="form-control mb-2"
									placeholder="Product name" value="{{ old('product_name') }}">
								<!--end::Input-->
								<!--begin::Description-->
								<div class="text-muted fs-7">A product name is required and recommended to be unique.
								</div>
								<!--end::Description-->
								<div
									class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
								</div>
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div>
								<!--begin::Label-->
								<label class="form-label">Description</label>
								<!--end::Label-->

								<div id="kt_ecommerce_add_product_description" class="min-h-200px mb-2">
									<textarea name="description" id="editor1" class="form-control"
										rows="10">{{ old('description') }}</textarea>
								</div>

								<!--begin::Description-->
								<div class="text-muted fs-7">Set a description to the product for better visibility.
								</div>
								<!--end::Description-->
							</div>
							<!--end::Input group-->
						</div>
						<!--end::Card header-->
					</div>
					<!--end::General options-->

				</div>
			</div>

		</div>

		<div class="d-flex justify-content-end">
			<button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
				<span class="indicator-label">Save Changes</span>
			</button>
		</div>

	</div>
</form>

@endsection