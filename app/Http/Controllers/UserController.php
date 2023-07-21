<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:Listar usuarios')->only('index');
        $this->middleware('can:Editar usuarios')->only('edit', 'update', 'rol');
    }
    public function index()
    {
        return view('users.index');
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            // Agrega aquí todas las validaciones necesarias para los otros campos
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        $bitacora = new Bitacora();
        $bitacora->accion = '+++CREAR USUARIO';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

        return redirect()->route('admin.users.index')->with('info', 'El nuevo USUARIO se creo satisfactoriamente!');
    }
    public function rol(User $user)
    {
        $roles = Role::all();
        return view('users.rol', compact('user', 'roles'));
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function updateRol(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        //return redirect()->route('admin.users.rol', $user);
        $bitacora = new Bitacora();
        $bitacora->accion = 'QQQ ASIGNACION DE ROLES';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();
        return redirect()->route('admin.users.index', $user)->with('info', 'ASIGNACION DE ROLES.');
       
    }
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            // Agrega aquí todas las validaciones necesarias para los otros campos
        ]);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        $bitacora = new Bitacora();
        $bitacora->accion = '***ACTUALIZAR USUARIO';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

        return redirect()->route('admin.users.index')->with('info', 'USUARIO actualizado exitosamente.');
    }
    public function destroy(User $user)
    {
        $user->delete();

        $bitacora = new Bitacora();
        $bitacora->accion = 'XXX ELIMINAR USUARIO';
        $bitacora->fecha_hora = now();
        $bitacora->fecha = now()->format('Y-m-d');
        $bitacora->user_id = auth()->id();
        $bitacora->save();

        return redirect()->route('admin.users.index')->with('info', 'Usuario eliminado exitosamente.');
    }
}
