<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Cliente;
use App\Models\Telefono;
use Illuminate\Http\Request;

class TelefonoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Listar telefono')->only('index');
        $this->middleware('can:Editar telefono')->only('edit', 'update');
        $this->middleware('can:Crear telefono')->only('create', 'store');
        $this->middleware('can:Eliminar telefono')->only('destroy');
    }
    public function index()
    {
        return view('telefono.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('telefono.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'telefono' => 'required|string',
        ]);
    
        Telefono::create([
            'cliente_id' => $request->cliente_id,
            'telefono' => $request->telefono,
        ]);
    
        $bitacora = new Bitacora();
        $bitacora->accion = '+++CREAR TELEFONO';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();
    
        return redirect()->route('telefono.index')->with('info', 'Teléfono creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Telefono $telefono)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Telefono $telefono)
    {
        $clientes = Cliente::all();
        return view('telefono.edit', compact('telefono', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Telefono $telefono)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'telefono' => 'required|string',
        ]);
    
        $telefono->update([
            'cliente_id' => $request->cliente_id,
            'telefono' => $request->telefono,
        ]);
    
        $bitacora = new Bitacora();
        $bitacora->accion = '***ACTUALIZAR TELEFONO';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();
    
        return redirect()->route('telefono.index')->with('info', 'Teléfono actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Telefono $telefono)
    {
        $telefono->delete();

        $bitacora = new Bitacora();
        $bitacora->accion = 'XXX ELIMINAR TELEFONO';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

        return redirect()->route('telefono.index')->with('info', 'TELEFONO eliminado exitosamente!!');
    }
}
