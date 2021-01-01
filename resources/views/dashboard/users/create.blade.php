@extends('layouts.dashboard.app')
@section('content')
    <h2 style="font-family: Andalus">Dashboard</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.users.index') }}">User</a></li>
            <li class="breadcrumb-item active">Add Category</li>

        </ol>
    </nav>

    <div class="tile mb-4">
        <form action="{{route('dashboard.users.store') }}" method="post">
            @csrf
            @include('dashboard.pariales.error')
            <div class="form-group">
                <label>Name :</label>
                <input type="text" name="name" placeholder="Enter Category Name" value="{{old('name')  }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>E-mail:</label>
                <input type="text" name="email" placeholder="Enter E-mail Adress" value="{{old('email')  }}"
                       class="form-control">
            </div>




            <div class="form-group">
                <label>Password:</label>
                <input type="Password" name="password" placeholder="Enter Category Name" value="{{old('password')  }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>Password Confirmation:</label>
                <input type="Password" name="password_confirmation" placeholder="Enter Category Name" value="{{old('password')  }}"
                       class="form-control">
            </div>
            <div class="form-group">
                <label>Roles:</label>
                <select name="roles_id" class="selected2 form-control" >
                    @foreach($roles as $role)
                        <option value="{{$role->id  }}">{{$role->name}}</option>


                    @endforeach
                </select>

            </div>


            <h4></h4>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus">ADD</i></button>
            </div>
        </form>
    </div>




@endsection