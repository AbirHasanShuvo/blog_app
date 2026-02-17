<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), rules : [
            'user_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'nullable|image|max:2048'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'Failed',
                'message' => $validator->errors()
            ]);
        }

        //check it is logged in user or not because if it is not then anyone can give anyone id to post 

        $loggedInUser = Auth::user();

        if($loggedInUser->id != $request->user_id){
            return response()->json([
                'status' => 'Failed',
                'message' => 'Un-authorised access'
            ], 403);
        }

        $category = Category::find($request->category_id);

        if(!$category){
            return response()->json([
                'status' => 'Failed',
                'message' => 'No category found'
            ]);
        }

        //uploading image 

        if($request->hasFile('thumbnail')){
            $file = $request->
        }





    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
