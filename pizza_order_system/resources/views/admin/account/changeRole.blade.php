@extends('admin.layouts.master')

@section('title', 'Change Role Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-title ">
                                <button type="submit" class="btn btn-black" onclick="history.back()"><i
                                        class="fa-solid fa-left-long"></i></button>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2 my-3">Change Role</h3>
                            </div>

                            <hr>

                            <form action="{{ route('admin#changeRole', $account->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row mt-4">
                                    <div class="col-4 offset-1 ">
                                        @if ($account->image == null)
                                            @if ($account->gender == 'male')
                                                <img src="{{ asset('image/default_user.jpg') }}" alt={{ $account->name }}
                                                    class="img-thumbnail">
                                            @else
                                                <img src="{{ asset('image/Default-Profile-Female.jpg') }}"
                                                    alt={{ $account->name }} class="img-thumbnail">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}" alt={{ $account->name }} />
                                        @endif

                                        <div class="mt-3">
                                            <button class="btn btn-dark col-12" type="submit">
                                                <i class="fa-solid fa-circle-chevron-right me-2"></i>Change Role
                                            </button>
                                        </div>

                                    </div>


                                    <div class="col-6">
                                        <div class="form-group ">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text"
                                                class="form-control  @error('name') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin's Name"
                                                value="{{ old('name', $account->name) }}" disabled>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="cc-payment" class="control-label mb-1 ">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin') selected @endif>
                                                    Admin</option>
                                                <option value="user" @if ($account->role == 'user') selected @endif>
                                                    User</option>
                                            </select>
                                        </div>

                                        <div class="form-group ">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email"
                                                class="form-control  @error('email') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin's Email"
                                                value="{{ old('email', $account->email) }}" disabled>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender"
                                                class="form-control  @error('gender') is-invalid @enderror" disabled>
                                                <option value="">Choose Gender...</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif>
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
                                                value="{{ old('phone', $account->phone) }}" disabled>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="cc-payment" class="mb-1">Address</label>
                                            <textarea name="address" id="" cols="30" rows="5"
                                                class="form-control  @error('address') is-invalid @enderror" placeholder="Enter Admin's Address" disabled>{{ old('address', $account->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
    <!-- END MAIN CONTENT-->
@endsection
