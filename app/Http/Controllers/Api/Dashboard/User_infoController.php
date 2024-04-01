<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User_info;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class User_infoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_info = User_info::all();

        return response()->json($user_info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number'=>'required|string|min:10',
            'image'=>'image|Mimes:jpeg,png,jpg,gif|max:2048',
            'bio'=>'required',
            'address' => 'required',
        ]);
        $user_info = new User_info();
        $user_info->first_name = Purifier::clean($request->input('first_name'));
        $user_info->last_name = Purifier::clean($request->input('last_name'));
        $user_info->phone_number = Purifier::clean($request->input( 'phone_number'));
        $user_info->bio = Purifier::clean($request->input('bio'));
        $user_info->address = Purifier::clean($request->input('address'));
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $user_info->image = $image_name;}

        $user_info->save();
        $response = [
            'status' => 'success',
            'message' => 'user_info is created successfully',
            'data' => [
                'user_info' => $user_info,
            ],
        ];
        return response()->json($response,200);
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
    public function update(Request $request, User_info $user_info)
    {
       $request= Purifier::clean( $request->validate([
        'first_name' => 'string|max:255',
        'last_name' => 'string|max:255',
        'phone_number'=>'string|min:10',
        'image'=>'image|Mimes:jpeg,png,jpg,gif|max:2048',
        'bio'=>'string',
        'address' => 'string',
       ]));

        $user_info->update($request);
        $response = [
            'status' => 'success',
            'message' => 'user_info is updated successfully',
            'data' => [
                'user_info' => $user_info,
            ],
        ];
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( User_info $user_info)
    {
        $user_info->delete();
        return response()->json(['statue'=>'success',
        'messege'=>'user_info deleted successfully'],202);
    }
}
