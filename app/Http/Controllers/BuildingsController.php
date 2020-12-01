<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Manager;
use App\Models\ManagerBuildingRelation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BuildingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Building::with(['Elevators', 'Managers'])->get();
//        dd($buildings);
//        dd($buildings[1]->Elevators->first()->name);
        return view('buildings.index', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buildings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'floors' => 'required',
            'address' => 'required',
            'contactNumber' => 'required',
        ]);

        $building = new Building;
        $building->name = $request->name;
        $building->floors = $request->floors;
        $building->address = $request->address;
        $building->contactNumber = $request->contactNumber;
        $building->save();
        return response('success');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $building = Building::with(['Elevators', 'Managers'])->findOrFail($id);
        return view('buildings.show', compact('building'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $building = Building::findOrFail($id);
        return view('buildings.edit', compact('building'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required | max: 250',
            'floors' => 'required | min: 1',
            'address' => 'required | max: 250',
            'contactNumber' => 'required | max: 150',
        ]);

        $building = Building::findOrFail($id);
        $building->name = $request->name;
        $building->floors = $request->floors;
        $building->address = $request->address;
        $building->contactNumber = $request->contactNumber;
        $building->save();
        return response('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $building = Building::findOrFail($id);
        $elevators = $building->Elevators;
        foreach ($elevators as $elevator) {
            $elevator->delete();
        }
        $building->delete();
        return response('success');
    }

    public function buildingRelations($id)
    {
        $building = Building::with('managers')->findOrFail($id);
        $selectedManagers = $building->managers;
        $managers_id = [];
        foreach ($selectedManagers as $i => $b) {
            $managers_id[$i] = $b->id;
        }
        $managers = Manager::all();
        return view('buildings.buildingRelations', compact('building', 'managers', 'managers_id'));
    }

    public function saveRelations(Request $request, $id)
    {

        $relations = ManagerBuildingRelation::where('building_id', '=', $id)->get();

        foreach ($relations as $relation) {
            $relation->delete();
        }

        for ($i = 0; $i < count($request->body); $i++) {
            $r = new ManagerBuildingRelation;
            $r->manager_id = $request->body[$i];
            $r->building_id = $id;
            $r->save();
        }
        return response('success');
    }

}
