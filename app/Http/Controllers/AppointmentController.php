<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Appointment/Index', [
            'appointments' => Appointment::all()->map(function ($modelo) {
                return [
                    'id' => $modelo->id,
                    'title' => $modelo->servicio->nombre,
                    'start' => cutHour($modelo->fecha . ' ' . $modelo->hora),
                    //'end' => $modelo->fecha . ' ' . $modelo->hora,
                    'end' => cutHour($modelo->fecha . ' ' . sumHours($modelo->hora, $modelo->servicio->duracion)),
                    'cliente' => $modelo->cliente,
                    'servicio' => $modelo->servicio,
                    'fecha' => $modelo->fecha,
                    'hora' => $modelo->hora,
                    'notas' => $modelo->notas,
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Appointment/Create', [
            'clientes' => Customer::all(),
            'servicios' => Service::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['fecha'] = transformToValidDate($data['fecha']);
        $request->merge(['fecha' => $data['fecha']]);

        $validatedData = $request->validate([
            'id_cliente' => 'required',
            'id_servicio' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
            'notas' => 'nullable',
        ]);

        try {
            $appointment = new Appointment($validatedData);
            $appointment->save();
            return redirect()->route('appointment.index')->with('status', 'Cita creada con éxito');
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
        $cita = Appointment::findOrFail($id);
        return Inertia::render('Appointment/Edit', [
            'clientes' => Customer::all(),
            'servicios' => Service::all(),
            'cita' => $cita
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    { {
            $data = $request->all();
            $data['fecha'] = transformToValidDate($data['fecha']);
            $request->merge(['fecha' => $data['fecha']]);

            $validatedData = $request->validate([
                'id_cliente' => 'required',
                'id_servicio' => 'required',
                'fecha' => 'required',
                'hora' => 'required',
                'notas' => 'nullable',
            ]);

            try {
                $appointment->update($validatedData);
                return redirect()->route('appointment.index')->with('status', 'Cita actualizada con éxito');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }

    public function moveAndUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            //'fecha' => 'required',
            'hora' => 'required',
        ]);

        try {
            $recurso = Appointment::findOrFail($id);
            $recurso->fecha = $request->input('fecha');
            $recurso->hora = $request->input('hora');
            $recurso->save();
            //            $appointment->update($validatedData);
            //return redirect()->route('appointment.index')->with('status', 'Cita actualizada con éxito');
            return redirect()->route('appointment.index')->with('status', $validatedData);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        try {
            $appointment->delete();
            return redirect()->route('appointment.index')->with('status', 'Cita eliminada con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
