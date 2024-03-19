@extends('admin.layouts.master')

@section('title', 'Pizza Edit Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-title ">
                                    <button type="submit" class="btn btn-black" onclick="history.back()"><i class="fa-solid fa-left-long"></i></button>
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



                            <div class="row mt-4">
                                <div class="col-3 offset-1 ">
                                    <img src="{{ asset('storage/' . $pizza->image) }}" alt={{ $pizza->name }}
                                        class="img-thumbnail img-sm" />
                                </div>

                                <div class="col-5 offset-1">
                                    <h2 class="my-3 text-danger"> <i class="fa-solid fa-pizza-slice me-2 fs-4"></i>
                                        {{ $pizza->name }}</h2>

                                    <span class="my-3 btn btn-warning"> <i class="fa-solid fa-money-bill-1-wave me-2 fs-4"></i>{{ $pizza->price }} MMK</span>
                                    <span class="my-3 btn btn-warning"> <i class="fa-regular fa-clock me-2 fs-4"></i>{{ $pizza->waiting_time }} mins</span>
                                    <span class="my-3 btn btn-warning"> <i class="fa-solid fa-clone me-2 fs-4"></i>{{ $pizza->category_name }}</span>
                                    <span class="my-3 btn btn-warning"> <i class="fa-solid fa-eye me-2 fs-4"></i>{{ $pizza->view_count }}</span>

                                    <div class="my-3 text-muted"> <i class="fa-regular fa-message me-2 fs-4"></i>
                                         {{ $pizza->description }}</div>
                                    <div class="my-3 text-muted"> <i class="fa-solid fa-calendar-day me-2 fs-4"></i>
                                        {{ $pizza->created_at }}</div>
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
