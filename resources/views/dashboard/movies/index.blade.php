@extends('layouts.dashboard.app')
@section('content')
    <h2 style="font-family: Andalus">movie</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Movie</li>
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

                        @if(auth()->user()->haspermission('create_movies'))

                        <a href="{{ route('dashboard.movies.create') }}" class="btn btn-primary"><i class="fa fa-plus">ADD</i></a>
                       @else
                            <a href="#" class="btn disabled btn-primary"><i class="fa fa-plus">ADD</i></a>
                        @endif

                    </div>
                    </form>
                </div>{{--end of row--}}

                <div class="row">
                    <div class="col-md-12">

                        @if($movies->count() >0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>permissions</th>
                                <th>Count</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($movies as$i=>$movie)

                                <tr>
                                    <td>{{$i++  }}</td>
                                    <td>{{$movie->name }}</td>
                                    <td>
                                        @foreach($movie->permissions as $per)
                                            <h5 style="display: inline-block">
                                                <i class="badge badge-info">{{ $per->name }}</i>
                                            </h5>
                                        @endforeach
                                    </td>
                                    <td>
                                       {{$movie->users_count}}
                                    </td>
                                    <td >

                                        @if(auth()->user()->haspermission('update_movies'))

                                        <a  href="{{ route('dashboard.movies.edit' , $movie->id) }}" class="btn btn-warning"><i class="fa fa-edit"> Edit</i></a>

                                      @else
                                            <a  href="#" class="btn disabled btn-warning"><i class="fa fa-edit"> Edit</i></a>

                                        @endif
                                            @if(auth()->user()->haspermission('delete_movies'))

                                            <form style="display: inline-block" action="{{ route('dashboard.movies.destroy', $movie->id) }}" method="post">
                                            {{ method_field('delete') }}
                                            @csrf
                                            <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"> Delete</i></button>
                                        </form>

                                                @else
                                                <button type="submit" class="btn disabled btn-danger"><i class="fa fa-trash"> Delete</i></button>

                                                @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            {{ $movies->appends(request()->query())->links() }}

                        @else
                            <h2 style="font-family: 'Arabic Typesetting'; font-weight: 400; text-align: center ">Not Found Any Data</h2>
                            @endif

                    </div>


                </div>

            </div>
        </div>
    </div>


@endsection