<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoboticsKit;
use Illuminate\Validation\Rule;

class RoboticsKitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kits = RoboticsKit::all();
        return view('robotics.index', compact('kits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->ensureManagementAccess();

        return view('robotics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->ensureManagementAccess();

        $validated = $this->validatedData($request);

        RoboticsKit::create($validated);

        return redirect()->route('robotics.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kit = RoboticsKit::with('courses')->findOrFail($id);
        return view('robotics.show', compact('kit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->ensureManagementAccess();

        $kit = RoboticsKit::findOrFail($id);
        return view('robotics.edit', compact('kit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->ensureManagementAccess();

        $kit = RoboticsKit::findOrFail($id);
        $kit->update($this->validatedData($request, $kit));

        return redirect()->route('robotics.show', $kit->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->ensureManagementAccess();

        $kit = RoboticsKit::findOrFail($id);
        $kit->delete();
        return redirect()->route('robotics.index');
    }

    private function validatedData(Request $request, ?RoboticsKit $kit = null): array
    {
        return $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('robotics_kits', 'name')->ignore($kit?->id),
            ],
        ]);
    }

    private function ensureManagementAccess(): void
    {
        if (!auth()->check() || auth()->user()->role === 'Student') {
            abort(403, "You're not authorized to perform this action.");
        }
    }
}
