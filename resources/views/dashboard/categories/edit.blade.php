@extends('layouts.dashboard.app')
@section('content')
    <h2 style="font-family: Andalus">Dashboard</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.index') }}">Category</a></li>
            <li class="breadcrumb-item active">Edit Category</li>

        </ol>
    </nav>

    <div class="tile mb-4">
        <form action="{{route('dashboard.categories.update',$category->id) }}" method="post">
            @csrf
            @method('put')
            @include('dashboard.pariales.error')
            <div class="form-group">
                <label >Name :</label>
                <input type="text" name="name" value="{{old('name', $category->name) }}" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"> EDIT</i></button>
            </div>
        </form>
    </div>




@endsection