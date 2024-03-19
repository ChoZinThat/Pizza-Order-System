@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="dataTable">
                        @foreach ($cartList as $c)
                        <tr>
                            <input type="hidden" class="userId" value="{{$c->user_id}}">
                            <input type="hidden" class="productId" value="{{$c->product_id}}">
                            <input type="hidden" class="orderId" value="{{$c->id}}">
                            <td><img src="{{asset('storage/'.$c->pizza_image)}}" alt="" style="width: 100px;" class="img-thumbnail shadow-sm"></td>
                            <td class="align-middle">{{$c->pizza_name}}</td>
                            <td class="align-middle" id="price">{{$c->pizza_price}} kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-white border-0 text-center" id="qty" value="{{$c->qty}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle col-3" id="total">{{ $c->pizza_price*$c->qty}}  kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-white pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $totalPrice}} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotal">{{$totalPrice+3000}} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-bold mt-3 py-2 orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold mt-1 py-2 " id="cancelOrderBtn">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            //when + button is clicked
            $('.btn-plus').click(function(){
                $partentNode = $(this).parents("tr");
                $price = $partentNode.find('#price').text().replace('kyats','');
                $qty = Number($partentNode.find('#qty').val());

                $total =$price*$qty;
                $partentNode.find('#total').html($total+ "kyats");

                summaryCalculation();
            })

            //when - button is clicked
            $('.btn-minus').click(function(){
                $partentNode = $(this).parents("tr");
                $price = $partentNode.find('#price').text().replace('kyats','');
                $qty = Number($partentNode.find('#qty').val());

                $total = $price*$qty;
                $partentNode.find('#total').html($total+ 'kyats');

                summaryCalculation();
            })

            //when x button is clicked
            $('.btnRemove').click(function(){
                $partentNode = $(this).parents("tr");
                $productId = $partentNode.find('.productId').val();
                $orderId = $partentNode.find('.orderId').val();
                $partentNode.remove();
                summaryCalculation();

                $.ajax({
                    type : 'get',
                    url : '/user/ajax/clear/cart/item',
                    data : { 'productId': $productId , 'orderId' : $orderId },
                    dataType : 'json',
                })
            })

            //summary calculatioin function
            function summaryCalculation(){
                $subTotal = 0;
                $('#dataTable tr').each(function(index,row){
                    $subTotal += Number($(row).find('#total').text().replace("kyats",""));
                });

                $('#subTotal').html(`${$subTotal} kyats`);
                $('#finalTotal').html(`${$subTotal+3000} kyats` );
            }
        })

    </script>

    <script>
        $(document).ready(function(){
            //when order btn is clicked
            $('.orderBtn').click(function(){
                $orderList = [];
                $random = Math.floor(Math.random() * 100000000);

                $('#dataTable tr').each(function(index,row){
                    $orderList.push({
                        'user_id' : $(row).find('.userId').val(),
                        'product_id' : $(row).find('.productId').val(),
                        'qty' : $(row).find('#qty').val(),
                        'total' : Number($(row).find('#total').text().replace('kyats','')) ,
                        'order_code':  $random
                    });
                });

                $.ajax({
                    type : 'get',
                    url : '/user/ajax/order',
                    data :  Object.assign({}, $orderList), //change object to array
                    dataType : 'json',
                    success : function(response){
                        if(response.status == 'true'){
                            window.location.href = 'http://localhost:8000/user/home';
                        }
                    }

                })
            })

            //when clear cart btn is click
            $('#cancelOrderBtn').click(function(){
                $('#dataTable tr').remove();
                $('#subTotal').html(`0 kyats`);
                $('#finalTotal').html(`3000 kyats`);

                $.ajax({
                    type : 'get',
                    url : '/user/ajax/clear/cart',
                    dataType : 'json',
                })
            })
        })
    </script>
@endsection




