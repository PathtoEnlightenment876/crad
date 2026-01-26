<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Adviser;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CoordinatorController extends Controller
{
    public function index()
    {
        $coordinators = User::where('role', 'coordinator')->whereNull('deleted_at')->get();
        return view('manage-coordinator', compact('coordinators'));
    }

    public function archivesData()
    {
        $coordinators = User::where('role', 'coordinator')->onlyTrashed()->get();
        return response()->json(['coordinators' => $coordinators]);
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
        return response()->json(['success' => true, 'message' => 'Coordinator archived successfully']);
    }

    public function restore($id)
    {
        User::withTrashed()->findOrFail($id)->restore();
        return response()->json(['success' => true, 'message' => 'Coordinator restored successfully']);
    }

    public function update(Request $request, $id)
    {
        $coordinator = User::findOrFail($id);
        
        // Check if password reset is requested
        if ($request->has('password')) {
            $request->validate([
                'password' => 'required|min:8|confirmed'
            ]);
            
            $coordinator->update([
                'password' => Hash::make($request->password)
            ]);
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'department' => 'required|string',
                'contact' => 'nullable|string'
            ]);
            
            $coordinator->update([
                'name' => $request->name,
                'email' => $request->email,
                'department' => $request->department,
                'contact' => $request->contact
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Coordinator updated successfully']);
    }

    public function manageAdviser()
    {
        $coordinator = Auth::user();
        $advisers = Adviser::where('department', $coordinator->department)->whereNull('deleted_at')->get();
        $assignments = Assignment::where('department', $coordinator->department)->get();
        return view('coordinator-manage-adviser', compact('advisers', 'assignments'));
    }
}
