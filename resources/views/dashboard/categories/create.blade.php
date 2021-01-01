@extends('layouts.dashboard.app')
@section('content')
    <h2 style="font-family: Andalus">Dashboard</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.index') }}">Category</a></li>
            <li class="breadcrumb-item active">Add Category</li>

        </ol>
    </nav>

    <div class="tile mb-4">
        <form action="{{route('dashboard.categories.store') }}" method="post">
            @csrf
            @include('dashboard.pariales.error')
         <div class="form-group">
             <label >Name :</label>
             <input type="text" name="name" placeholder="Enter Category Name" value="{{old('name')  }}" class="form-control">
         </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus">ADD</i></button>
            </div>
        </form>
    </div>




@endsection