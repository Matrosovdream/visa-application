@extends('dashboard.layouts.app')

@section('content')

    <form class="form" method="POST" action="{{ route('dashboard.articles.update', $article['id']) }}">
        @csrf

        <div class="d-flex flex-column flex-xl-row">
            <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                <div class="card mb-5 mb-xl-8">

                    <div class="card-body pt-5">

                        <div class="d-flex flex-stack fs-4 py-3">
                            <div class="fw-bold">{{ $title }}</div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="flex-lg-row-fluid ms-lg-15">

                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach

                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">

                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                            href="#kt_general">General</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_content">Content</a>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade active show" id="kt_general" role="tabpanel">
                        <div class="card pt-4 mb-6 mb-xl-9">

                            <div class="card-body pt-0 pb-5">

                                <input type="hidden" name="action" value="save_general" />

                                <div class="row mb-7">

                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Is active</label>

                                    <div class="col-lg-8 d-flex align-items-center">
                                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                            <input class="form-check-input w-45px h-30px" type="checkbox" name="published"
                                                id="published" value="1" {{ $article['published'] ? 'checked' : '' }} />
                                            <label class="form-check-label" for="allowmarketing"></label>
                                        </div>
                                    </div>

                                </div>

                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2 required">Title</label>
                                    <input type="name" name="title" value="{{ $article['title'] }}"
                                        class="form-control form-control-solid" placeholder="" />
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2 required">Slug</label>
                                    <input type="text" name="slug" value="{{ $article['slug'] }}"
                                        class="form-control form-control-solid" placeholder="" />
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2 required">Short description</label>
                                    <textarea name="short_description" class="form-control form-control-solid"
                                        placeholder="" style="height: 100px;">{{ $article['short_description'] }}</textarea>

                                </div>

                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2 required">Summary</label>
                                    <textarea 
                                        name="summary" 
                                        class="form-control form-control-solid" 
                                        id="kceditor-summary"
                                        style="height: 200px;"
                                        placeholder=""
                                        >{{ $article['summary'] }}</textarea>
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

                    <div class="tab-pane fade" id="kt_content" role="tabpanel">
                        <div class="card pt-4 mb-6 mb-xl-9">

                            <div class="card-body pt-0 pb-5">

                                <input type="hidden" name="action" value="save_content" />

                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold mb-2 required">Summary</label>
                                    <textarea name="content" class="form-control form-control-solid" id="kceditor-content"
                                        placeholder="" style="height: 800px;">{{ $article['content'] }}</textarea>
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

    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.0/classic/ckeditor.js"></script>

    <script>

        var editors = ['kceditor-summary', 'kceditor-content'];

        editors.forEach(function (editor) {
            ClassicEditor
                .create(document.querySelector('#' + editor), {
                    sourceEditing: true,
                    htmlSupport: {
                        allow: [
                            {
                                name: /.*/,
                                attributes: true,
                                classes: true,
                                styles: true
                            }
                        ]
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });

    </script>

@endsection