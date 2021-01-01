@extends('layouts.dashboard.app')
@section('content')
    <h2 style="font-family: Andalus">Dashboard</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.roles.index') }}">Role</a></li>
            <li class="breadcrumb-item active">Edit Role</li>

        </ol>
    </nav>

    <div class="tile mb-4">
        <form action="{{route('dashboard.roles.update',$role->id) }}" method="post">
            @csrf
            @method('put')
            @include('dashboard.pariales.error')
            <div class="form-group">
                <label >Name :</label>
                <input type="text" name="name" value="{{old('name', $role->name) }}" class="form-control">
            </div>
            <div class="form-group">
                <h4>Persmissions :</h4>
                <table class="table table-hover">
                    <thead>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">Model</th>
                    <th>Persmissions</th>
                    </thead>

                    <tbody>
                    @php
                        $models=['users' ,'categories' ,'roles' , 'movies' ,'settings']
                    @endphp

                    @foreach($models as $index =>$model)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $model }}</td>
                            <td>
                                @php
                                    $per_map=['create','read','update','delete']
                                @endphp
                                @if($model == 'settings')
                                   @php
                                       $per_map=['create','read']

                                   @endphp
                                 @endif
                                <select   name="persmissions[]" class="select2 form-control" multiple>
                                    @foreach($per_map as $per)
                                        <option {{ $role->hasPermission($per.'_'.$model) ? 'selected':'' }}
                                                value="{{$per.'_'.$model  }}">{{$per  }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"> EDIT</i></button>
            </div>
        </form>
    </div>




@endsection