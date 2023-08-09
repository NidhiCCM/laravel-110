<?php

namespace App\Http\Controllers;


use App\Models\Role;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()  
    {  
       // $this->middleware('role.owner')->only(['store', 'show', 'update', 'destroy']);  
    }  
    public function index(Request $request)
    {
        $roles = $request->user()->roles()->paginate();
        return Inertia::render('Roles/Index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request):RedirectResponse
    {
        $validated = $request->validated();
        $request->user()->roles()->create($validated);
        return redirect()->to('/roles');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, Role $role):RedirectResponse
    {
        $validated =$request->validated();
        $role->update($validated);
        return redirect()->to('/roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->to('/roles');
    }
}
