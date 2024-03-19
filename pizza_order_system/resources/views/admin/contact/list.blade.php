@extends('admin.layouts.master')

@section('title', 'Contact Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">User Message</h2>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-3" >
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>

                        <div class="col-3 offset-6">
                            <form action="{{ route('admin#contactList') }}">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search..."
                                        value="{{ request('key') }}">
                                    <button type="submit" class="btn btn-dark"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-1 mb-2">
                        <div class="col-1 offset-10 bg-white shadow-sm p-1 text-center">
                            <h3><i class="fa-solid fa-envelope-open-text me-2"></i> {{ $contact->total() }}</h3>
                        </div>
                    </div>


                    @if (session('messageDelete'))
                        <div class="col-4 offset-8 mt-1">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('messageDelete') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if(count($contact) != 0)
                        @foreach ($contact as $c)
                        <div class="card">
                            <div class="card-header">
                              <h5>{{$c->name}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2"><p class="card-text">Email  </p></div>
                                    <div class="col-3"><p class="card-text"> {{$c->email}}</p></div>
                                </div>
                                <div class="row">
                                    <div class="col-2"><p class="card-text">Subject  </p></div>
                                    <div class="col-3"><p class="card-text">{{$c->subject}}</p></div>
                                </div>
                                <div class="row">
                                    <div class="col-2"><p class="card-text">Message  </p></div>
                                    <div class="col-3"><p class="card-text">{{$c->message}}</p></div>
                                </div>
                              <div class="row mt-3">
                                <p class="col-4">
                                    <small>
                                        <i class="fa-solid fa-bell me-2"></i>
                                        {{ $c->created_at->format('F-d-Y H:i:s') }}
                                    </small>
                                </p>
                                <a href="{{route('admin#deleteMessage',$c->id)}}" class="btn btn-danger offset-5 col-2"><i class="fa-solid fa-trash-can me-2"></i>Delete</a>
                              </div>
                            </div>
                          </div>
                        @endforeach
                    @else
                    <h3 class="text-danger">There is no message here...</h3>
                    @endif

                    <div class="mt-2">{{$contact->links()}}</div>

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
