@extends('admin.layouts.master')

@section('title', 'Category List Page')

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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>

                        <div class="col-3 offset-6">
                            <form action="{{ route('category#list') }}">
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

                    <div class="row mt-2 ">
                        <div class="col-1 offset-10 bg-white shadow-sm p-1 text-center">
                            <h3><i class="fa-solid fa-database"></i> - {{ $categories->total() }}</h3>
                        </div>
                    </div>

                    @if (session('categoryDeleted'))
                        <div class="col-4 offset-8 mt-1">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('categoryDeleted') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>{{ $category->id }}</td>
                                            <td class="col-5">{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('category#editPage', $category->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete', $category->id) }}">
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
                            {{-- for pagination --}}
                            <div class="mt-3">{{ $categories->links() }}</div>
                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no category here !</h3>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
