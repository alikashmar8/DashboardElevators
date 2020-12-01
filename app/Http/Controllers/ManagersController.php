<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Manager;
use App\Models\ManagerBuildingRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Sodium\add;

class ManagersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = Manager::with('Buildings')->get();
        return view('managers.index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('managers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | max:250',
            'address' => 'required | max:250',
            'phoneNumber' => 'required | max:150',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $manager = new Manager;
        $manager->name = $request->name;
        $manager->address = $request->address;
        $manager->phoneNumber = $request->phoneNumber;

        if (isset($request->image)) {
            // Get filename with the extension
            $filenameWithExt = $request->image->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->image->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->image->storeAs('public/profile_images', $fileNameToStore);
            $manager->profilePicture = $fileNameToStore;

        } else {
            $manager->profilePicture = "noImage.jpg";
        }

        $manager->save();
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
        $manager = Manager::with('buildings')->findOrFail($id);
        return view('managers.show', compact('manager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manager = Manager::findOrFail($id);
        return view('managers.edit')->with('manager', $manager);
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
        $this->validate($request, [
            'name' => 'required | max:250',
            'address' => 'required | max:250',
            'phoneNumber' => 'required | max:150',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $manager = Manager::findOrFail($id);
        $manager->name = $request->name;
        $manager->address = $request->address;
        $manager->phoneNumber = $request->phoneNumber;


        if (isset($request->image)) {
            if ($request->image != $manager->profilePicture) {
                // Get filename with the extension
                $filenameWithExt = $request->image->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->image->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                // Upload Image
                $path = $request->image->storeAs('public/profile_images', $fileNameToStore);
                $manager->profilePicture = $fileNameToStore;
            }
        } else {
            $manager->profilePicture = "noImage.jpg";
        }
        $manager->save();
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
        $manager = Manager::findOrFail($id);
        if ($manager->profilePicture != 'noImage.jpg') {
            Storage::delete('public/profile_images/' . $manager->profilePicture);
        }
        $manager->delete();
        return response('success');
    }

    public function managerRelations($id)
    {
        $manager = Manager::with('buildings')->findOrFail($id);
        $selectedBuildings = $manager->buildings;
        $buildings_id = [];
        foreach ($selectedBuildings as $i => $b) {
            $buildings_id[$i] = $b->id;
        }
        $buildings = Building::all();
        return view('managers.managerRelations', compact('manager', 'buildings', 'buildings_id'));
    }

    public function saveRelations(Request $request, $id)
    {

        $relations = ManagerBuildingRelation::where('manager_id', '=', $id)->get();

        foreach ($relations as $relation) {
            $relation->delete();
        }

        for ($i = 0; $i < count($request->body); $i++) {
            $r = new ManagerBuildingRelation;
            $r->manager_id = $id;
            $r->building_id = $request->body[$i];
            $r->save();
        }
        return response('success');
    }
}
