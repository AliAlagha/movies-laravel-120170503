@extends('layouts.dashboard.app')
@section('content')
    <h2 style="font-family: Andalus">Category</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Category</li>
        </ol>
    </nav>

    <div class="tile mp-4">
        <div class="row">
            <div class="col-12">
                <div class="row">

                    <div class="col-md-4">
                        <form action="" method="get">
                            <div class="form-group">
                                <input type="text" autofocus name="search" class="form-control" value="{{ request()->search }}" placeholder="search">
                            </div>

                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search">SEARCH</i></button>

                        @if(auth()->user()->haspermission('create_categories'))

                        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary"><i class="fa fa-plus">ADD</i></a>
                         @else
                            <a  href="#" class="btn disabled btn-primary"><i class="fa fa-plus">ADD</i></a>

                        @endif
                    </div>
                    </form>
                </div>{{--end of row--}}

                <div class="row">
                    <div class="col-md-12">

                        @if($categories->count() >0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as$i=>$category)

                                <tr>
                                    <td>{{$i++  }}</td>
                                    <td>{{$category->name }}</td>
                                    <td >


                                        @if(auth()->user()->haspermission('update_categories'))

                                        <a  href="{{ route('dashboard.categories.edit' , $category->id) }}" class="btn btn-warning"><i class="fa fa-edit"> Edit</i></a>
                                        @else

                                            <a  href="#" class="btn disabled btn-warning"><i class="fa fa-edit"> Edit</i></a>

                                        @endif


                                        @if(auth()->user()->haspermission('delete_categories'))

                                        <form style="display: inline-block" action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                                            {{ method_field('delete') }}
                                            @csrf
                                            <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"> Delete</i></button>
                                        </form>

                                            @else
                                                <button type="submit" class="btn btn-danger disabled"><i class="fa fa-trash"> Delete</i></button>

@endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            {{ $categories->appends(request()->query())->links() }}

                        @else
                            <h2 style="font-family: 'Arabic Typesetting'; font-weight: 400; text-align: center ">Not Found Any Data</h2>
                            @endif

                    </div>


                </div>

            </div>
        </div>
    </div>


@endsection