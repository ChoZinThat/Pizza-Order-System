@extends('user.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 my-3">Account Edit Page</h3>
                        </div>
                        <hr>

                        @if (session('success'))
                            <div class="col-3 offset-8">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-cloud-arrow-down"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('user#update', Auth::user()->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row mt-4">
                                <div class="col-4 offset-1 ">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/default_user.jpg') }}"
                                                alt={{ Auth::user()->name }} class="img-thumbnail">
                                        @else
                                            <img src="{{ asset('image/Default-Profile-Female.jpg') }}"
                                                alt={{ Auth::user()->name }} class="img-thumbnail">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            alt={{ Auth::user()->name }}  class="img-thumbnail">
                                    @endif

                                    <div class="mt-3">
                                        <input type="file" name="image" id=""
                                            class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="mt-3">
                                        <button class="btn btn-dark col-12" type="submit">
                                            <i class="fa-solid fa-circle-chevron-right me-2"></i>Update
                                        </button>
                                    </div>

                                </div>


                                <div class="col-6">
                                    <div class="form-group ">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text"
                                            class="form-control  @error('name') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Admin's Name"
                                            value="{{ old('name', Auth::user()->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group ">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="email"
                                            class="form-control  @error('email') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Admin's Email"
                                            value="{{ old('email', Auth::user()->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group ">
                                        <label for="cc-payment" class="control-label mb-1">Gender</label>
                                        <select name="gender"
                                            class="form-control  @error('gender') is-invalid @enderror">
                                            <option value="">Choose Gender...</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                Male</option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group ">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="number"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Admin's Phone"
                                            value="{{ old('phone', Auth::user()->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group ">
                                        <label for="cc-payment" class="mb-1">Address</label>
                                        <textarea name="address" id="" cols="30" rows="5"
                                            class="form-control  @error('address') is-invalid @enderror" placeholder="Enter Admin's Address">{{ old('address', Auth::user()->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group ">
                                        <label for="cc-payment" class="control-label mb-1 ">Role</label>
                                        <input id="cc-pament" name="role" type="text" class="form-control "
                                            value="{{ old('role', Auth::user()->role) }}" disabled>
                                    </div>
                                </div>


                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
