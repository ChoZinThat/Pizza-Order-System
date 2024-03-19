@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->


                    <form action={{route("admin#sortStatus")}} method="get">
                        @csrf
                        <div class="input-group col-5 offset-7">
                            <select class="form-select" name="status" id="inputGroupSelect04"
                                aria-label="Example select with button addon">
                                <option value="">All</option>
                                <option value="0" @if (request('status') == '0') selected @endif>Pending</option>
                                <option value="1" @if (request('status') == '1') selected @endif>Accept</option>
                                <option value="2" @if (request('status') == '2') selected @endif>Reject</option>
                            </select>
                            <button class="btn btn-dark" type="submit"><i
                                    class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                        </div>
                    </form>



                    <div class="row mt-3">
                        <div class="col-1 offset-10 bg-white shadow-sm p-1 text-center">
                            <h3><i class="fa-solid fa-layer-group"></i> - {{ count($order) }}</h3>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Order Code</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="dataTable">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" id="orderId" value="{{ $o->id }}">
                                        <td >{{ $o->user_name }}</td>
                                        <td >
                                            <a href="{{route('admin#orderInfo',$o->order_code)}}">
                                                {{ $o->order_code }}
                                            </a>
                                        </td>
                                        <td >{{ $o->total_price }} kyats</td>
                                        <td >{{ $o->created_at->format('F-d-Y') }}</td>
                                        <td>
                                            <select name="status" class="order">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Accept</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>
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

@section('scriptSource')
    <script>
        $(document).ready(function() {
            // $('#status').change(function(){
            //     $status = $('#status').val();

            //     $.ajax({
            //         type : 'get',
            //         url : 'http://localhost:8000/order/ajax/sortStatus',
            //         data : { 'status' : $status },
            //         dataType : 'json',
            //         success : function(response){

            //             $list = ``;
            //                 for ($i = 0; $i < response.length; $i++) {
            //                 //for status chagne
            //                 if(response[$i].status == 0){
            //                     $option = `
        //                                 <select name="status" class="order">
        //                                     <option value="0" selected>Pending</option>
        //                                     <option value="1" >Accept</option>
        //                                     <option value="2" >Reject</option>
        //                                 </select>`;
            //                 }
            //                 else if(response[$i].status == 1){
            //                     $option = `
        //                                 <select name="status" class="order">
        //                                     <option value="0" >Pending</option>
        //                                     <option value="1" selected>Accept</option>
        //                                     <option value="2" >Reject</option>
        //                                 </select>`;
            //                 }
            //                 else if(response[$i].status == 2){
            //                     $option = `
        //                                 <select name="status" class="order">
        //                                     <option value="0" >Pending</option>
        //                                     <option value="1" >Accept</option>
        //                                     <option value="2" selected>Reject</option>
        //                                 </select>`;
            //                 }

            //                 //for date change
            //                 $month = ['January','February','March','April','May','June','July','August','September','October','Novembre','December'];
            //                 $dbDate = new Date(response[$i].created_at);

            //                 $date = $month[$dbDate.getMonth()] + "-" + $dbDate.getDate() + "-" + $dbDate.getFullYear();

            //                 $list += `
        //                 <tr class="tr-shadow">
        //                     <td class="">${response[$i].user_name}</td>
        //                     <td class="">${response[$i].order_code}</td>
        //                     <td class="">${response[$i].total_price} kyats</td>
        //                     <td class="">${$date}</td>
        //                     <td>${$option}</td>
        //                     </tr>
        //                 `;
            //                 }
            //                 $('.dataTable').html($list);

            //         }
            //     })
            // })


            $('.order').change(function() {
                $orderStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $orderId = $parentNode.find('#orderId').val();

                $data = {
                    'order_id': $orderId,
                    'status': $orderStatus
                }

                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/order/ajax/changeStatus',
                    data: $data,
                    dataType: 'json',
                    success: function() {

                    }
                })




            })

        })
    </script>
@endsection
