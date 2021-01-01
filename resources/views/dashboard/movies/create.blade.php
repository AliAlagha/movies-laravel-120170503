@extends('layouts.dashboard.app')

@push('styles')
    <style>
        #movie_input_warapper
        {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 25vh;
            flex-direction:column ;
            cursor: pointer;
            border: 1px solid black;

        }
    </style>

@endpush
@section('content')
    <h2 style="font-family: Andalus">Dashboard</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.movies.index') }}">Movie</a></li>
            <li class="breadcrumb-item active">Add Movie</li>

        </ol>
    </nav>

    <div class="tile mb-4">
        <div id="movie_input_warapper"
             onclick="document.getElementById('file').click()"
            <i class="fa fa-video-camera fa-2x">
                Click To Upload
            </i>
        </div>
        <input type="file" id="file" style="display: none">
        <form id="movie_property" action="{{route('dashboard.movies.store') }}" method="post"
              style="display: none">
            @csrf
            @include('dashboard.pariales.error')

            <div class="form-group">
                <label >Uploading</label>
                <div class="progress">
                    <div class="progress-bar"  id="movie_upload-progress" role="progressbar"></div>
                </div>
            </div>
            <div class="form-group">
                <label>Name :</label>
                <input type="text" name="name" id="movie_name" value="{{old('name')  }}"
                       class="form-control">
            </div>
            <div class="form-group">
                <label>Description :</label>
                <input type="text" name="name" value="{{old('description')  }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>Poster :</label>
                <input type="file" name="poster" value="{{old('poster')  }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>Image :</label>
                <input type="file" name="image" value="{{old('image')  }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>Year :</label>
                <input type="text" name="year" value="{{old('year')  }}"
                       class="form-control">
            </div>
            <div class="form-group">
                <label>Rating :</label>
                <input type="number" min="1" name="rating" value="{{old('rating')  }}"
                       class="form-control">
            </div>


            <h4></h4>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus">ADD</i></button>
            </div>
        </form>
    </div>



@endsection