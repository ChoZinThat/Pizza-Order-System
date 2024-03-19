@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->


                    <div class="row mt-3">
                        <div class="col-2 offset-9 bg-white shadow-sm p-1 text-center">
                            <h3>Total - {{$users->total()}}</h3>
                        </div>
                    </div>

                    @if (session('delete'))
                    <div class="col-4 offset-8 mt-1">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{ session('delete') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody class="dataTable">
                                @foreach ($users as $user)
                                    <tr>
                                        <input type="hidden" id="userId" value="{{$user->id}}">
                                        <td class="col-2">
                                            @if ($user->image == null)
                                            @if ($user->gender == 'male')
                                                <img src="{{ asset('image/default_user.jpg') }}"
                                                    alt={{ $user->name }} class=" img-thumbnail">
                                            @else
                                                <img src="{{ asset('image/Default-Profile-Female.jpg') }}"
                                                    alt={{ $user->name }} class=" img-thumbnail">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $user->image) }}"
                                                alt={{ $user->name }}
                                                class=" img-thumbnail" />
                                        @endif
                                        </td>
                                        <td>{{ $user->name}}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->phone}}</td>
                                        <td>{{ $user->gender}}</td>
                                        <td>{{ $user->address}}</td>
                                        <td class="">
                                            <select name="role" class="changeRole ">
                                                <option value="user" @if($user->role == "user") selected @endif> User</option>
                                                <option value="admin" @if($user->role == "admin") selected @endif> Admin</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{route('admin#userAccountDelete',$user->id)}}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                          <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="mt-2">
                            {{ $users->links()}}
                        </div>

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

            $('.changeRole').change(function() {
                $role = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();

                $data = {
                    'user_id': $userId,
                    'role': $role
                }

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/roleChange',
                    data: $data,
                    dataType: 'json',

                })

                location.reload();

            })

        })
    </script>
@endsection
