<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Check access users permission
        if (auth()->user()->can('access users')) {
            $users = User::latest()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Fetch users success',
                'data' => UserResource::collection($users),
            ]);
        } else {
            //Only show own posts when don't have access
            $users = User::where('creator', auth()->user()->id)->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Fetch users success',
                'data' => UserResource::collection($users),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Check create users permission
        if (auth()->user()->cannot('create users')) {
            return response()->json([
                'status' => 'error',
                'message' => 'You don\'t have authorize to create a user.',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:155',
            'content' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ]);
        }

        $user = User::create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'status' => $request->get('status'),
            'slug' => Str::slug($request->get('title')),
            'creator' => $request->get('creator'),
        ]);

        return response()->json([
            'status' => 'success',
            'data' => new UserResource($user),
            'message' => 'User created successfully.',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data user not found',
            ]);
        }

        //Check access users permission
        if (auth()->user()->can('access users')) {
            return response()->json([
                'status' => 'success',
                'data' => new UserResource($user),
                'message' => 'Data user found',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You don\'t have authorize to view this user.',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data user not found',
            ]);
        }

        if (auth()->user()->can('update users')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:155',
                'content' => 'required',
                'creator' => 'required',
                'status' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ]);
            }

            $user->update([
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'status' => $request->get('status'),
                'slug' => Str::slug($request->get('title')),
                'creator' => $request->get('creator'),
            ]);

            return response()->json([
                'status' => 'success',
                'data' => new UserResource($user),
                'message' => 'User updated successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You don\'t have authorize to update this user.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data user not found',
            ]);
        }

        if (auth()->user()->can('delete users')) {
            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You don\'t have authorize to delete this user.',
            ]);
        }
    }
}
