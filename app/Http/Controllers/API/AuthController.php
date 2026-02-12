<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // custom function by me

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

      if ($validator->fails()) {
        return response()->json([
        'status' => 'Failed',
        'errors' => $validator->errors()
        
       ], 422);
        }

    //in the above function giving me every type of error including duplcitated error and everything 




      $data = [
    'name' => $request->name,
    'email' => $request->email,
    'password' => bcrypt($request->password),
    'role' => $request->role ? $request->role : 'reader'
     ];


        User::create($data);

        return response()->json([
            'status'=> 'Success',
            'message'=> 'User created succesfuly',
            'data' => $data
        ]);


    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(
                [
                    'status' => 'failed',
                    'errors' => $validator->errors()
                ], status : 400
            );
        }

        if(!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            return response()->json([
                'status' => 'Failed',
                'message' => 'Invalid email or password' 
            ], 400);
            
        }

        $user = Auth::user();

        //for the sanctum token

      $token = $user->createToken('Blog-App')->plainTextToken;


        return response()->json([
            'status' => 'Success',
            'message' => 'Logged in successfully',
            'token' => $token,
            'user' => $user

        ]);


    }

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
