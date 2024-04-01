<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $link = Link::all();

        return response()->json($link);
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link'=>'required|string|max:255',
           
        ]);
        $link = new Link();
        $link->title =  Purifier::clean($request->input('title'));
        $link->link =Purifier::clean($request->input('link'));
       
        $link->save();
        $response = [
            'status' => 'success',
            'message' => 'link is created successfully',
            'data' => [
                'link' => $link,
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
    public function update(Request $request, Link $link)
    {
        $result = Purifier::clean( $request->validate([
            'title' => 'string|max:255',
            'link'=>'string|max:255',
           
            ])); 

        $link->title = $request->input('title');
        $link->link = $request->input('link');
        

        $link->update($result);
        $response = [
            'status' => 'success',
            'message' => 'link is updated successfully',
            'data' => [
                'link' => $link,
            ],
        ];
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return response()->json(['statue'=>'success',
        'messege'=>'link deleted successfully'],202);
    }
    
}
