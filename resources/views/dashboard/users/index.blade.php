@extends('layouts.dashboard.app')
@section('content')
    <h2 style="font-family: Andalus">user</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">User</li>
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
                            <div class="form-group">
                                <select name="role_id" class="form-control">
                                    <option value="">All</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name  }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search">SEARCH</i></button>
                        @if(auth()->user()->haspermission('create_users'))

                        <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"><i class="fa fa-plus">ADD</i></a>
                   @else
                            <a href="#" class="btn disabled btn-primary"><i class="fa fa-plus">ADD</i></a>

                        @endif
                    </div>
                    </form>
                </div>{{--end of row--}}

                <div class="row">
                    <div class="col-md-12">

                        @if($users->count() >0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as$i=>$user)

                                <tr>
                                    <td>{{$i+=1  }}</td>
                                    <td>{{$user->name }}</td>
                                    <td>{{$user->email }}</td>
                                   {{--<td>{{ implode(' -' ,  $user->roles->pluck('name')->toArray())  }}</td>--}}
                                        <td>
                                            @foreach($user->roles as $roles)

                                            <h5 style="display: inline-block"> <i class="badge badge-info">{{ $roles->name }} </i></h5>
                                            @endforeach

                                        </td>


                                    <td >
                                        @if(auth()->user()->haspermission('update_users'))

                                        <a  href="{{ route('dashboard.users.edit' , $user->id) }}" class="btn btn-warning"><i class="fa fa-edit"> Edit</i></a>

                                       @else
                                            <a  href="#" class="btn disabled btn-warning"><i class="fa fa-edit"> Edit</i></a>

                                        @endif

                                            @if(auth()->user()->haspermission('delete_users'))


                                            <form style="display: inline-block" action="{{ route('dashboard.users.destroy', $user->id) }}" method="post">
                                            {{ method_field('delete') }}
                                            @csrf
                                            <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"> Delete</i></button>
                                        </form>


                                            @else
                                                    <button type="button" class="btn disabled btn-danger"><i class="fa fa-trash"> Delete</i></button>
                                         @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            {{ $users->appends(request()->query())->links() }}

                        @else
                            <h2 style="font-family: 'Arabic Typesetting'; font-weight: 400; text-align: center ">Not Found Any Data</h2>
                            @endif

                    </div>


                </div>

            </div>
        </div>
    </div>


@endsection