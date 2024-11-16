@extends('dashboard.layouts.app')

@section('content')

<div class="d-flex flex-column flex-xl-row">
    <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
        <div class="card mb-5 mb-xl-8">
            
            <div class="card-body pt-15">
                
                <div class="d-flex flex-center flex-column mb-5">
                    
                    <div class="symbol symbol-150px symbol-circle mb-7">
                        <img src="{{ asset('assets/admin/media/avatars/300-2.png') }}" alt="image" />
                    </div>
                    
                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">{{ $user->name }}</a>
                    <a href="#" class="fs-5 fw-semibold text-muted text-hover-primary mb-6">{{ $user->email }}</a>
                    
                </div>

                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bold">Details</div>
                    <span
                        class="badge badge-light-{{ $user->role == 'admin' ? 'primary' : 'success' }} badge-pill">
                        {{ $user->getRole()->title }}
                    </span>
                </div>

                <div class="separator separator-dashed my-3"></div>
                <div class="pb-5 fs-6">
                    
                    <div class="fw-bold mt-5">Account ID</div>
                    <div class="text-gray-600">#{{ $user->id }}</div>
                    
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
            
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                    href="#kt_ecommerce_customer_advanced">Advanced Settings</a>
            </li>
            
        </ul>

        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade active show" id="kt_ecommerce_customer_general" role="tabpanel">
                <div class="card pt-4 mb-6 mb-xl-9">

                    <div class="card-header border-0">
                        <div class="card-title">
                            <h2>Profile</h2>
                        </div>
                    </div>
                    
                    
                    <div class="card-body pt-0 pb-5">
                        
                        <form class="form" method="POST" action="{{ route('dashboard.users.update', $user->id) }}" id="kt_ecommerce_customer_profile">
                            @csrf

                            <input type="hidden" name="action" value="save_general" />

                            <div class="row row-cols-1 row-cols-md-2">
                                
                                <div class="col">
                                    <div class="fv-row mb-7">
                                        
                                        <label class="fs-6 fw-semibold mb-2">
                                            <span class="required">Role</span>
                                        </label>
                                        
                                        <select name="role" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                            @foreach($roles as $role)
                                                <option 
                                                value="{{ $role->slug }}" 
                                                {{ $user->getRole()->slugF == $role->slug ? 'selected' : '' }}>
                                                    {{ $role->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div>

                            </div>

                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2 required">Name</label>
                                <input 
                                    type="text" 
                                    name="name"
                                    value="{{ $user->name }}" 
                                    class="form-control form-control-solid" 
                                    placeholder="" 
                                    />
                                
                            </div>
                            
                            <div class="row row-cols-1 row-cols-md-2">
                                
                                <div class="col">
                                    <div class="fv-row mb-7">
                                        
                                        <label class="fs-6 fw-semibold mb-2">
                                            <span class="required">Email</span>
                                        </label>
                                        
                                        <input 
                                            type="email" 
                                            class="form-control form-control-solid" 
                                            placeholder=""
                                            name="gen_email" 
                                            value="{{ $user->email }}" 
                                            disabled
                                            />
                                        
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
                        </form>
                        
                    </div>
                    
                </div>
                
            </div>
            
            
            <div class="tab-pane fade" id="kt_ecommerce_customer_advanced" role="tabpanel">
                <div class="card pt-4 mb-6 mb-xl-9">
                    
                    <div class="card-header border-0">
                        
                        <div class="card-title">
                            <h2>Security Details</h2>
                        </div>
                        
                    </div>
                    
                    
                    <div class="card-body pt-0 pb-5">
                        
                        <form class="form" method="POST" action="{{ route('dashboard.users.update', $user->id) }}" id="kt_ecommerce_customer_profile">
                            @csrf

                            <input type="hidden" name="action" value="save_password" />

                            <div class="row row-cols-1 row-cols-md-2">
                                
                                <div class="col">
                                    <div class="fv-row mb-7">
                                        
                                        <label class="fs-6 fw-semibold mb-2">
                                            <span class="required">Password</span>
                                        </label>
                                        
                                        <input 
                                            type="password" 
                                            class="form-control form-control-solid" 
                                            placeholder=""
                                            name="password" 
                                            value="" 
                                            />
                                        
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
                        </form>
                        
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection