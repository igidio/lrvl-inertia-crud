<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Service/Index', [
            'services' => Service::all()->map(function ($modelo) {
                return [
                    'id' => $modelo->id,
                    'nombre' => $modelo->nombre,
                    'descripcion' => $modelo->descripcion,
                    'duracion' => $modelo->duracion,
                    'precio' => $modelo->precio,

                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Service/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'duracion' => 'required',
            'precio' => 'required',
        ]);

        try {
            $service = new Service($validatedData);
            $service->save();
            return redirect()->route('service.index')->with('status', 'Servicio guardado con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
        $service = Service::findOrFail($id);
        return Inertia::render('Service/Edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'duracion' => 'required',
            'precio' => 'required',
        ]);

        try {
            //$service = new Service($validatedData);
            $service->update($validatedData);
            return redirect()->route('service.index')->with('status', 'Servicio actualizado con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return redirect()->route('service.index')->with('status', 'Servicio eliminado con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
