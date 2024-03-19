@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5" style="height: 350px">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="dataTable">
                        @foreach ($order as $o)
                            <tr>
                                <td>{{ $o->created_at->format('M-d-Y') }}</td>
                                <td>{{ $o->order_code }}</td>
                                <td>{{ $o->total_price }} kyats</td>
                                <td>
                                    @if ($o->status == 0)
                                        <span class="text-warning"><i class="fa-regular fa-clock me-2"></i>Pending...</span>
                                    @elseif ($o->status == 1)
                                        <span class="text-success"><i class="fa-solid fa-check me-2"></i>Successs</span>
                                    @elseif ($o->status == 2)
                                        <span class="text-danger"><i class="fa-solid fa-xmark me-2"></i>Rejected</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">{{ $order->links() }}</div>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection
