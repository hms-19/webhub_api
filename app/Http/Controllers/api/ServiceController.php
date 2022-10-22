<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ServiceResource::collection(Service::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service();

        $service->name = $request->name;
        $service->description = $request->description ?? null;
        $service->category_id = $request->category_id;

        if($request->hasFile('logo')){
            $logo = $request->logo;
            $name = $logo->hashName();
            $logo->storeAs('images',$name);
        }

        $service->logo = $name ?? null;


        if($request->hasFile('image')){
            $image = $request->image;
            $filename = $image->hashName();
            $image->storeAs('images',$filename);
        }

        $service->image = $filename ?? null;

        $service->save();

        return new ServiceResource($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ServiceResource(Service::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        $service->name = $request->name ?? $service->name;
        $service->description = $request->description ?? $service->description;
        $service->category_id = $request->category_id ?? $service->category_id;

        if($request->hasFile('logo')){

            if(file_exists(public_path('images/'.$service->logo))){
                unlink(public_path('images/'.$service->logo));
            }

            $logo = $request->logo;
            $name = $logo->hashName();
            $logo->storeAs('images',$name);
        }

        $service->logo = $name ?? $service->logo;


        if($request->hasFile('image')){

            if(file_exists(public_path('images/'.$service->image))){
                unlink(public_path('images/'.$service->image));
            }

            $image = $request->image;
            $filename = $image->hashName();
            $image->storeAs('images',$filename);
        }

        $service->image = $filename ?? $service->image;

        $service->save();

        return new ServiceResource($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if(file_exists(public_path('images/'.$service->logo))){
            unlink(public_path('images/'.$service->logo));
        }

        if(file_exists(public_path('images/'.$service->image))){
            unlink(public_path('images/'.$service->image));
        }

        $service->delete();

        return response()->json([
            'message' => 'Deleted Successfully',
        ]);
    }
}
