<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class BlogController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::all();
        return response()->json($blog, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Validation = Validator::make($request->all(), [
            'name' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($Validation->fails()) {
            return response()->json($Validation->errors(), 202);
        }

        $request->user_id = Auth::user();

        $blog = $request->all();
        $blog = Blog::create($blog);

        return response()->json('data stored ', 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $blog  = BLog::all();

        return response()->json($blog, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Blog $blog)
    {


        $blog->update($request->all());
        // $blog->name = $request->name;
        // $blog->tags = $request->tags;
        // $blog->description = $request->description;
        // $result = $blog->save();

        if ($blog) {
            return ['blog' => 'blog updated'];
        } else {
            return ['blog' => 'blog not  updated'];

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json('deleted successfully', 200);
    }
}
