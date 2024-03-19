@extends('admin.layouts.master')

@section('title', 'Account Detail Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 my-3">Account Info</h3>
                            </div>

                            @if (session('success'))
                                <div class="col-12">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-cloud-arrow-down"></i> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif


                            <hr>
                            <div class="row mt-4">
                                <div class="col-3 offset-1 ">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/default_user.jpg') }}" alt={{ Auth::user()->name }}
                                                class="img-thumbnail">
                                        @else
                                            <img src="{{ asset('image/Default-Profile-Female.jpg') }}"
                                                alt={{ Auth::user()->name }} class="img-thumbnail">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            class="img-thumbnail shadow-sm" alt={{ Auth::user()->name }} />
                                    @endif
                                </div>

                                <div class="col-4 offset-1">
                                    <h4 class="my-3 text-muted"> <i class="fa-solid fa-user-pen me-2"></i>
                                        {{ Auth::user()->name }}</h4>
                                    <h4 class="my-3 text-muted"> <i class="fa-solid fa-envelope me-2"></i>
                                        {{ Auth::user()->email }}</h4>
                                    <h4 class="my-3 text-muted"> <i class="fa-solid fa-mars-and-venus me-2"></i>
                                        {{ Auth::user()->gender }}</h4>
                                    <h4 class="my-3 text-muted"> <i class="fa-solid fa-phone me-2"></i>
                                        {{ Auth::user()->phone }}</h4>
                                    <h4 class="my-3 text-muted"> <i class="fa-solid fa-address-card me-2"></i>
                                        {{ Auth::user()->address }}</h4>
                                    <h4 class="my-3 text-muted"> <i class="fa-solid fa-user-clock me-2"></i>
                                        {{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                                </div>

                                <div class="row mt-3">
                                    <div class="text-end">
                                        <a href="{{ route('admin#edit') }}">
                                            <button class="btn btn-outline-dark">
                                                <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
