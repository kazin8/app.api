<?php

namespace App\Http\Controllers;

use App\Maker;
use App\Vehicle;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVehicleRequest;

class MakerVehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $maker = Maker::find($id);

        if (!$maker){
            return response()->json(['message'=>'This maker does not exists', 'code'=>404], 404);
        }

        return response()->json(['data'=>$maker->vehicle], 200);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVehicleRequest $request, $makerId)
    {
        //

        $maker = Maker::find($makerId);

        if (!$maker){
            return response()->json(['message'=>'This maker does not exists', 'code'=>404], 404);
        }


        $values = $request->all();

        $maker->vehicle()->create($values);

        return response()->json(['message'=>'The vehicles associated was created'], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $vehicle_id)
    {
        //
        //
        $maker = Maker::find($id);

        if (!$maker){
            return response()->json(['message'=>'This maker does not exists', 'code'=>404], 404);
        }

        $vehicle = $maker->vehicle->find($vehicle_id);

        if (!$vehicle){
            return response()->json(['message'=>'This vehicle does not exists', 'code'=>404], 404);
        }

        return response()->json(['data'=>$vehicle], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateVehicleRequest $request, $makerId, $vehicleId)
    {
        $maker = Maker::find($makerId);

        if (!$maker){
            return response()->json(['message'=>'This maker does not exists', 'code'=>404], 404);
        }

        $vehicle = $maker->vehicle->find($vehicleId);

        if (!$vehicle){
            return response()->json(['message'=>'This vehicle does not exists', 'code'=>404], 404);
        }

        $color = $request->get('color');
        $power = $request->get('power');
        $capacity = $request->get('capacity');
        $speed = $request->get('speed');

        $vehicle->color = $color;
        $vehicle->power = $power;
        $vehicle->capacity = $capacity;
        $vehicle->speed = $speed;

        $vehicle->save();

        return response()->json(['message'=>'The vehicle has been updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $makerId
     * @param int $vehicleId
     * @return \Illuminate\Http\Response
     */
    public function destroy($makerId, $vehicleId)
    {
        //
        $maker = Maker::find($makerId);

        if (!$maker){
            return response()->json(['message'=>'This maker does not exists', 'code'=>404], 404);
        }

        $vehicle = $maker->vehicle->find($vehicleId);

        if (!$vehicle){
            return response()->json(['message'=>'This vehicle does not exists', 'code'=>404], 404);
        }

        $vehicle->delete();

        return response()->json(['message'=>'The vehicle has been deleted'], 200);
    }
}
