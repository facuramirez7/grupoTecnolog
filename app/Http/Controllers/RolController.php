<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function show(Rol $rol)
    {
        return view('admin.rol.show', compact('rol'));
    }
}
