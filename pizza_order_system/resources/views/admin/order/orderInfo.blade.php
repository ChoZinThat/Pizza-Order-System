@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <a href="{{route('admin#orderList')}}">
                        <button class="btn btn-outline-black mb-3"><i class="fa-solid fa-arrow-left"></i>Back</button>
                    </a>


                    <div class="card col-6">
                        <div class="card-body">
                            <div class="row mb-4" style="border-bottom: 1px solid black">
                                <h3 class="text-warning"><i class="fa-solid fa-clipboard-list me-3"></i>Order Info</h3>
                                <small class="text-danger mb-2"><i class="fa-solid fa-triangle-exclamation me-2"></i>Delivery Fee Included</small>
                            </div>

                            <div class="row mb-2">
                                <div class="col-5"><i class="fa-regular fa-user me-2"></i>Name</div>
                                <div class="col">{{strtoupper($orderInfo[0]->user_name)}}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-5"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                <div class="col">{{$orderInfo[0]->order_code}}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-5"><i class="fa-regular fa-clock me-2"></i>Ordered Date</div>
                                <div class="col">{{$orderInfo[0]->created_at->format('F-d-Y')}}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-5"><i class="fa-solid fa-sack-dollar me-2"></i>Total Price</div>
                                <div class="col">{{$total->total_price}} kyats</div>
                            </div>

                        </div>
                    </div>


                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order Id</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody class="dataTable">
                                @foreach ($orderInfo as $o)
                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td>{{$o->id}}</td>
                                        <td class="col-2">
                                            <img src="{{asset('storage/'.$o->product_image)}}" class="img-thumbnail shadow-sm">
                                        </td>
                                        <td>{{$o->product_name}}</td>
                                        <td>{{$o->created_at->format('F-d-Y')}}</td>
                                        <td>{{$o->total/$o->qty}}</td>
                                        <td>{{$o->qty}}</td>
                                        <td>{{$o->total}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection


