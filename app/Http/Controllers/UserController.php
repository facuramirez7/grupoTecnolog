<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required|string|min:5'
        ]);
        $update = $request->all();
        $user->update($update);
        $this->alert('success', 'Usuario editado con éxito!', [
            'position' =>  'top',
        ]);
        return redirect()->route('users.index');
    }
}
