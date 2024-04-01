<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class ServiceController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service = Service::all();
        return response()->json($service);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'service_name' => 'required|string|max:255',
            'technique'=>'required|string|max:255',
            'description'=>'required',
           
        ]);
        $service = new Service();
        $service->service_name = Purifier::clean($request->input( 'service_name'));
        $service->technique = Purifier::clean($request->input('technique'));
        $service->description =  Purifier::clean($request->input('description'));

        $service->save();
        $response = [
            'status' => 'success',
            'message' => 'service is created successfully',
            'data' => [
                'service' => $service,
            ],
        ];
        return response()->json($response,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return response()->json($service,200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
       $request= Purifier::clean($request->validate([
        'service_name' => 'string|max:255',
        'technique'=>'string|max:255',
        'description'=>'string',
       
    ]));

        $service->update($request);
        $response = [
            'status' => 'success',
            'message' => 'service  is updated successfully',
            'data' => [
                'service' => $service,
            ],
        ];
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(['statue'=>'success',
        'messege'=>'service deleted successfully'],202);
    }
}
