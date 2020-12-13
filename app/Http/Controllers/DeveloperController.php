<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $developer = Developer::paginate(5);
        return Inertia::render('developers/Index', ['data' => $developer]);
    }
    public function paginatedDeveloper()
    {
        //
        $developer = Developer::paginate(5);
        return response()->json(['data' => $developer], '200');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('developers/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required | email | unique:developers,email',
            'address' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = Str::slug($request->input('first_name')).'_'.time();
            $filePath = $name. '.' . $image->getClientOriginalExtension();
            $path = $request->file('avatar')->storeAs('public/avatar',$filePath);
        }
        
        $developer = new Developer();
        $developer->first_name = $request->first_name;
        $developer->last_name = $request->last_name;
        $developer->email = $request->email;
        $developer->phone = $request->phone;
        $developer->address = $request->address;
        $developer->avatar = "avatar/".$filePath;
        $developer->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function show(Developer $developer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function edit(Developer $developer)
    {
        return Inertia::render('developers/Edit', ['data' => $developer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Developer $developer)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required | email',
            'address' => 'required',
        ]);

        $developer->first_name = $request->first_name;
        $developer->last_name = $request->last_name;
        $developer->email = $request->email;
        $developer->phone = $request->phone;
        $developer->address = $request->address;
        $developer->update();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Developer $developer)
    {
        Storage::delete($developer->avatar);
        $developer->delete();
        return response()->json(['message' => 'Developer record deleted successfully'], '200');
    }

    public function home()
    {
        //
        return Inertia::render('developers/home');
    }
}
