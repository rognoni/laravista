<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::latest()->whereNull('report')->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $statuses
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $validated['content_ip'] = $request->ip();

        $status = Status::create($validated);

        return response()->json([
            'success' => true,
            'data' => $status
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        return response()->json([
            'success' => true,
            'data' => $status
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        $validated = $request->validate([
            'report'  => 'required|string',
        ]);

        $validated['report_ip'] = $request->ip();

        $status->update($validated);

        return response()->json([
            'success' => true,
            'data' => $status
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        /* $status->delete();

        return response()->json([
            'success' => true,
            'message' => 'Record successfully deleted.'
        ], 200); */

        return response()->json([
            'success' => false,
            'message' => 'You can not delete records.'
        ], 403);
    }
}
