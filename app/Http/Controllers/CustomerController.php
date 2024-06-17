<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        return Inertia::render('Customer', [
            'customers' => Customer::all()->map(function ($modelo) {
                return [
                    'id' => $modelo->id,
                    'nombre' => getFullName($modelo->nombres, $modelo->apellidos),
                    'ci' => $modelo->ci,
                    'email' => $modelo->email,
                    'telefono' => $modelo->telefono,
                    'direccion' => $modelo->direccion,
                    'fecha_nacimiento' => getTraditionalDate($modelo->fecha_nacimiento),
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Customer/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['fecha_nacimiento'] = transformToValidDate($data['fecha_nacimiento']);
        $data['nombres'] = capitalizeWords($data['nombres']);
        $data['apellidos'] = capitalizeWords($data['apellidos']);
        $request->merge(['fecha_nacimiento' => $data['fecha_nacimiento']]);
        $request->merge(['nombres' => $data['nombres']]);
        $request->merge(['apellidos' => $data['apellidos']]);

        $validatedData = $request->validate([
            // TODO:  validar datos, ej. 255
            'nombres' => 'required',
            'apellidos' => 'required',
            'ci' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'fecha_nacimiento' => 'required',
        ]);

        //Customer::create($validatedData);
        try {
            $customer = new Customer($validatedData);
            $customer->save();
            return redirect()->route('customer.index')->with('message', 'Cliente guardado con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $appointments = $customer->appointments;

        return Inertia::render('Customer/Show', [
            'customer' => $customer,
            'appointments' => $appointments->map(function ($modelo) {
                return [
                    'id_servicio' => $modelo->servicio->id,
                    'titulo' => $modelo->servicio->nombre,
                    'fecha' => $modelo->fecha,
                    'hora' => $modelo->hora,
                    'notas' => $modelo->notas,
                ];
            })
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return Inertia::render('Customer/Edit', compact('customer'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $data = $request->all();
        $data['fecha_nacimiento'] = transformToValidDate($data['fecha_nacimiento']);
        $data['nombres'] = capitalizeWords($data['nombres']);
        $data['apellidos'] = capitalizeWords($data['apellidos']);
        $request->merge(['fecha_nacimiento' => $data['fecha_nacimiento']]);
        $request->merge(['nombres' => $data['nombres']]);
        $request->merge(['apellidos' => $data['apellidos']]);

        $validatedData = $request->validate([
            // TODO:  validar datos, ej. 255
            'nombres' => 'required',
            'apellidos' => 'required',
            'ci' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'fecha_nacimiento' => 'required',
        ]);

        //Customer::create($validatedData);
        try {
            $customer->update($validatedData);
            return redirect()->route('customer.index')->with('status', 'Cliente actualizado con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return redirect()->route('customer.index')->with('status', 'Cliente eliminado con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
