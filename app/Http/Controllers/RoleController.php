<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        // $user = auth()->user();

        $records = Role::all();

        return view('role.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        $this->validate($request, [
            'permissions' => 'required|array',
            'name' => 'required|'
        ]);
        $record = Role::create($request->all());
        $record->syncPermissions($request->input('permissions', []));


        // $record = new Role;
        // $record->name = $request->name;
        // $record->save();
        // $gov = Governorate::create(['name' => $request->name,]); //another way no  need for save since it automatically saves
        // $city = City::create($request->all()); another way
        flash("successfully added <strong> $record->name</strong>")->success();
        return redirect(route('role.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //    $model= Governorate::where('id',$id)->get();
        //    $model= Governorate::where('id',$id)->first();
        $model = Role::findOrFail($id);
      

        return view('role.edit', compact('model',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'permissions' => 'required|array',
            'name' => 'required|unique:roles,name,'.$id,
        ]);
        $model = Role::findOrFail($id);
        //     $model->name=$request->name;
        //   $model->save();

        $model->update($request->all());
        $model->syncPermissions($request->input('permissions', []));

        flash("successfully updated <strong> $model->name</strong>")->success();
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Role::findOrFail($id);
        $model->delete();
        flash("successfully deleted <strong> $model->name</strong>")->success();
        return back();
    }
}
