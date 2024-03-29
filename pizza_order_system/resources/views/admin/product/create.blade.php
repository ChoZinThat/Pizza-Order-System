
@extends('admin.layouts.master')

@section('title','Product Create Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('products#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Form</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="pizzaName" type="text" class="form-control  @error('pizzaName') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Product's name"  value="{{old('pizzaName')}}" >
                                    @error('pizzaName')
                                        <div class="invalid-feedback">{{ $message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                    <select name="pizzaCategory" class="form-control  @error('pizzaCategory') is-invalid @enderror"  value="{{old('pizzaCategory')}}">
                                        <option value="">Choose your category...</option>
                                        @foreach ($categories as $c)
                                        <option value="{{$c->id}}" >{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pizzaCategory')
                                        <div class="invalid-feedback">{{ $message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea name="pizzaDescription" class="form-control  @error('pizzaDescription') is-invalid @enderror" cols="30" rows="5" placeholder="Enter Product's Description..."  value="{{old('pizzaDescription')}}"></textarea>
                                    @error('pizzaDescription')
                                        <div class="invalid-feedback">{{ $message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                    <input type="file" name="pizzaImage" class="form-control  @error('pizzaImage') is-invalid @enderror">
                                    @error('pizzaImage')
                                        <div class="invalid-feedback">{{ $message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Pizza Waiting Time</label>
                                    <input id="cc-pament" name="pizzaWaitingTime" type="number" class="form-control  @error('pizzaWaitingTime') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Product's waiting time..." value="{{old('pizzaWaitingTime')}}">
                                    @error('pizzaWaitingTime')
                                        <div class="invalid-feedback">{{ $message}}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="pizzaPrice" type="number" class="form-control  @error('pizzaPrice') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Product's Price..." value="{{old('pizzaPrice')}}">
                                    @error('pizzaPrice')
                                        <div class="invalid-feedback">{{ $message}}</div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Add your pizza</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
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
