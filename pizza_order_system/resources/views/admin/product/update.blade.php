@extends('admin.layouts.master')

@section('title', 'Pizza Update Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-10 offset-1">
                    <div class="card">

                        <div class="card-body">

                            <div class="card-title">
                                <a href="{{ route('products#list') }}">
                                    <button type="submit" class="btn btn-black"><i class="fa-solid fa-left-long"></i></button>
                                </a>
                                <h3 class="text-center title-2 my-3">Pizza Update Page</h3>
                            </div>

                            <form action="{{ route('product#update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                <div class="row mt-4">
                                    <div class="col-4 offset-1 ">

                                        <img src="{{ asset('storage/' . $pizza->image) }}" alt={{ $pizza->name }} />


                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage" id=""
                                                class="form-control @error('pizzaImage') is-invalid @enderror">
                                            @error('pizzaImage')
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
                                            <input id="cc-pament" name="pizzaName" type="text"
                                                class="form-control  @error('pizzaName') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name..."
                                                value="{{ old('pizzaName', $pizza->name) }}">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="cc-payment" class="mb-1">Description</label>
                                            <textarea name="pizzaDescription" id="" cols="30" rows="5"
                                                class="form-control  @error('pizzaDescription') is-invalid @enderror" placeholder="Enter Pizza Description...">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory"
                                                class="form-control  @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose pizza Category...</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}"
                                                        @if ($c->id == $pizza->category_id) selected @endif>
                                                        {{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number"
                                                class="form-control  @error('pizzaPrice') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price..."
                                                value="{{ old('pizzaPrice', $pizza->price) }}">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>



                                        <div class="form-group ">
                                            <label for="cc-payment" class="control-label mb-1">Waiting time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="number"
                                                class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Pizza waiting time..."
                                                value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group ">
                                            <label for="cc-payment" class="control-label mb-1 ">View Count</label>
                                            <input id="cc-pament" name="viewCount" type="text" class="form-control "
                                                value="{{ $pizza->view_count }}" disabled>
                                        </div>

                                        <div class="form-group ">
                                            <label for="cc-payment" class="control-label mb-1 ">Created At</label>
                                            <input id="cc-pament" name="viewCount" type="text" class="form-control "
                                                value="{{ $pizza->created_at }}" disabled>
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
