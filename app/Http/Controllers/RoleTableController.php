<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleTableController extends Controller
{
    public function __construct()  
    {  
     $this->middleware('role.owner')->only(['edit', 'show', 'update', 'destroy']);  
    }  
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = $request->user()->roles()->paginate(2);
        return Inertia::render('RoleCRUD/Index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('RoleCRUD/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request)
    {
        $validated = $request->validated();
        $request->user()->roles()->create($validated);

        return redirect()->route('roles-table.index')
        ->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $rolesCRUD)
    {
        return Inertia::render('RoleCRUD/Show')->with('role', $rolesCRUD);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $rolesCRUD)
    {
        return Inertia::render('RoleCRUD/Edit',[
            'role' => $rolesCRUD
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, Role $rolesCRUD)
    {
        $validated =$request->validated();
        $rolesCRUD->update($validated);
      
        return redirect()->route('roles-table.index') ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $rolesCRUD)
    {
        
        $rolesCRUD->delete();

        return redirect()->route('roles-table.index')
        ->with('success', 'Role deleted successfully');
    }
}
