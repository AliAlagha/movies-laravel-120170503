<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Movie;
class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_movies'])->only('index');
        $this->middleware(['permission:create_movies'])->only('create');
        $this->middleware(['permission:delete_movies'])->only('destroy');
        $this->middleware(['permission:update_movies'])->only('edit');

    }

    public function index()
    {
        $movies=movie::paginate(5);
        return view('dashboard.movies.index' , compact('movies'));
    }


    public function create()
    {
        return view('dashboard.movies.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:movies,name' ,
            'persmissions'=>'required|array|min:1'
        ]);

        $movie= movie::create($request->all());
        $movie->attachPermissions($request->persmissions);
        session()->flash('Added','Data Added Successfully');
        return redirect()->route('dashboard.movies.index');
    }

    public function show(Movie $movie)
    {
        //
    }


    public function edit(Movie $movie)
    {
        return view('dashboard.movies.edit',compact('movie'));
    }


    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'name'=>'required|unique:movies,name,'.$movie->id,
            'persmissions'=>'required|array|min:1'
        ]);

        $movie->update($request->all());
        $movie->syncPermissions($request->persmissions);

        session()->flash('Added','Data Updated Successfully');
        return redirect()->route('dashboard.movies.index');

    }


    public function destroy(Movie $movie)
    {
        $movie->delete();
        session()->flash('Added','Data Removed Successfully');
        return redirect()->back();

    }
}
