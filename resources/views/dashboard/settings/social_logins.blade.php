@extends('layouts.dashboard.app')
@section('content')
    <h2 style="font-family: Andalus">Dashboard</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Social Login</li>

        </ol>
    </nav>

    <div class="tile mb-4">
        <form action="{{route('dashboard.settings.store') }}" method="post">
            @csrf
            @include('dashboard.pariales.error')

            @php
            $social=['facebook' , 'gmail']
            @endphp

            @foreach($social as $social)



                <div class="form-group">
                    <label>{{ ucfirst($social) }} Client Id :</label>
                    <input type="text" name="{{ $social}}_client_id"  value="{{setting($social.'_client_id')  }}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label>{{ ucfirst($social)  }} Client Secret :</label>
                    <input type="text" name="{{$social}}_client_secret"  value="{{setting($social.'_client_secret')  }}"
                           class="form-control">
                </div>


                <div class="form-group">
                    <label>{{ucfirst($social)}} Redirect Url :</label>
                    <input type="text" name="{{$social}}_redirect_url"  value="{{setting( $social.'_redirect_url')  }}"
                           class="form-control">
                </div>


            @endforeach
            <h4></h4>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus">ADD</i></button>
            </div>
        </form>
    </div>




@endsection