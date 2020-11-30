<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Elevator;
use Illuminate\Http\Request;

class ElevatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elevators = Elevator::with('Building')->get();
        return view('elevators.index', compact('elevators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buildings = Building::all();
        return view('elevators.create', compact('buildings'));
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
            'index' => 'required',
            'building_id' => 'required',
        ]);

        $elevator = new Elevator;
        $elevator->name = $request->name;
        $elevator->index = $request->index;
        $elevator->building_id = $request->building_id;
        $elevator->save();
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
        $elevator = Elevator::with('Building')->findOrFail($id);
        return view('elevators.show', compact('elevator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $elevator = Elevator::findOrFail($id);
        $buildings = Building::all();
        return view('elevators.edit', compact('elevator', 'buildings'));
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
            'index' => 'required | min: 0',
            'building_id' => 'required',
        ]);

        $elevator = Elevator::findOrFail($id);
        $elevator->name = $request->name;
        $elevator->index = $request->index;
        $elevator->building_id = $request->building_id;
        $elevator->save();
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
        $elevator = Elevator::findOrFail($id);
        $elevator->delete();
        return 'success';
    }
}
