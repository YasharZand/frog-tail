<?php

namespace App\Http\Controllers;

use App\Models\Simulation;
use App\Http\Resources\SimulationResource;
use App\Models\Frog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SimulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return SimulationResource::collection(
            auth()->user()->simulations()->simplePaginate($request->input('paginate') ?? 15)
        )->additional([
                'meta' => [
                    'success' => true,
                    'message' => "Simulations Loaded",
            ]
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'count' => 'required|int'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        try {
            $simulation = new Simulation();
            $simulation->name = $request->name;
            if (auth()->user()->simulations()->save($simulation)) {
                //Create all frogs needed to run Simulation
                for ($cnt = 0; $cnt < $request->count; $cnt+=1) {
                    $tempFrog = new Frog();
                    Log::channel('stderr')->info($tempFrog);
                    $simulation->frogs()->save($tempFrog);
                }
                return (new SimulationResource($simulation))
                    ->additional([
                        'meta' => [
                          'success' => true,
                          'message' => "Simulation created"
                        ]
                    ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Simulation failed to create'
                ], 500);
            }
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            return response()->json($ex->getMessage(), 409);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Simulation  $simulation
     * @return \Illuminate\Http\Response
     */
    public function show(Simulation $simulation)
    {
        return (new SimulationResource($reservation))
        ->additional([
            'meta' => [
                'success' => true,
                'message' => "Reservation found"
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Simulation  $simulation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Simulation $simulation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Simulation  $simulation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Simulation $simulation)
    {
        try {
            $simulation->delete();
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            return response()->json($ex->getMessage(), 409);
        }
    
        return response()->json('Simulation has been deleted', 200);
    }
}
