<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CoordinatorController extends Controller
{
    public function index()
    {
        $coordinators = User::where('role', 'coordinator')->get();
        return view('manage-coordinator', compact('coordinators'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'department' => 'required|string',
            'contact' => 'nullable|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'coordinator',
            'department' => $request->department,
            'contact' => $request->contact
        ]);

        return response()->json(['success' => true, 'message' => 'Coordinator created successfully']);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'department' => 'required|string',
            'contact' => 'nullable|string'
        ]);

        $coordinator = User::findOrFail($id);
        $coordinator->update([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'contact' => $request->contact
        ]);

        return response()->json(['success' => true, 'message' => 'Coordinator updated successfully']);
    }
}
