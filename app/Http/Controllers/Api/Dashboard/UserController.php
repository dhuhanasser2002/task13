<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        return response()->json($user);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         /* $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number'=>'required|string|min:10',
            'image'=>'image|Mimes:jpeg,png,jpg,gif|max:2048',
            'bio'=>'required',
            'address' => 'required',
        ]);
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->bio = $request->input('bio');
        $user->address = $request->input('address');
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $user->image = $image_name;}

        $user->save();
        $response = [
            'status' => 'success',
            'message' => 'user is created successfully',
            'data' => [
                'user' => $user,
            ],
        ];
        return response()->json($response,200);*/
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
    public function update(Request $request, User $user)
    {
       /* $user->email = $request->input('email');

        $user->update();
        $response = [
            'status' => 'success',
            'message' => 'user information is updated successfully',
            'data' => $user,
        ];
        return response()->json($response,200);*/
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy(User $user)
     {
         $user->delete();
         return response()->json(['statue'=>'success',
         'messege'=>'user deleted successfully'],202);
     }
    
    
}
