<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response([ 'users' => UserResource::collection($users), 'message' => 'Users Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_user = $request->all();

        $validatedData = Validator::make($data_user, [
            'firstName' => 'string|max:25',
            'lastName' => 'string|max:25',
            'username' => 'string|max:10|unique:users',
            'phoneNumber' => 'string|max:20',
            'address' => 'max:255',
            'email' => 'email|unique:users',
            'password' => 'confirmed|min:6',
        ]);

        if($validatedData->fails()){
            return response(['error' => $validatedData->errors(), 'Validation Error']);
        }

        $user = User::create($data_user);

        return response([ 'user' => new UserResource($user), 'message' => 'User Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(is_null($user)) {
            return response()->json(["message" => "User not found !"], 404);
        }
        return response([ 'user' => new UserResource($user), 'message' => 'User Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return response([ 'product' => new UserResource($user), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
