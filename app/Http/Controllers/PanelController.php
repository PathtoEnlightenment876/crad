<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panel;

class PanelController extends Controller
{
    public function store(Request $request) {
        $availability = json_decode($request->availability, true) ?? [];
        $expertise = $request->expertise === 'Others' && $request->others_expertise ? $request->others_expertise : $request->expertise;
        
        Panel::create([
            'department' => $request->department,
            'name' => $request->name,
            'expertise' => $expertise,
            'availability' => $availability,
            'role' => $request->role
        ]);
        return back()->with('success', 'Panel member added successfully.');
    }

    public function update(Request $request, $id)
    {
        $panel = Panel::findOrFail($id);
        
        $expertise = $request->expertise === 'Others' && $request->others_expertise ? $request->others_expertise : $request->expertise;
        
        $panel->department = $request->department;
        $panel->name = $request->name;
        $panel->expertise = $expertise;
        $panel->availability = $request->availability ? json_decode($request->availability, true) : [];
        $panel->role = $request->role;
        $panel->save();
    
        return redirect()->route('panel-adviser.index')->with('success', 'Panel member updated successfully.');
    }

    public function destroy(Panel $panel)
    {
        try {
            $panel->delete();
            return response()->json([
                'success' => true,
                'message' => 'Panel member deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete panel member: ' . $e->getMessage()
            ], 500);
        }
    }

    public function archived()
    {
        $archivedPanels = Panel::onlyTrashed()->get();
        return response()->json($archivedPanels);
    }

    public function restore($id)
    {
        try {
            $panel = Panel::onlyTrashed()->findOrFail($id);
            $panel->restore();
            return response()->json([
                'success' => true,
                'message' => 'Panel member restored successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to restore panel member: ' . $e->getMessage()
            ], 500);
        }
    }

    public function forceDelete($id)
    {
        try {
            $panel = Panel::onlyTrashed()->findOrFail($id);
            $panel->forceDelete();
            return response()->json([
                'success' => true,
                'message' => 'Panel member permanently deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to permanently delete panel member: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getPanelsByCluster($clusterId)
{
    $panels = Panel::with('cluster')->get(); 
    return $panels->first()->cluster->name ?? null; }
}
