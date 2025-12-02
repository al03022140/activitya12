<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RoboticsKit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoboticsKitController extends Controller
{
    /**
     * List every robotics kit with its courses.
     */
    public function index(): JsonResponse
    {
        $kits = RoboticsKit::with('courses')->get();

        return response()->json(['data' => $kits]);
    }

    /**
     * Store a new robotics kit.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $this->validatedData($request);
        $kit = RoboticsKit::create($data)->load('courses');

        return response()->json([
            'message' => 'Robotics kit created successfully.',
            'data' => $kit,
        ], 201);
    }

    /**
     * Display a specific robotics kit.
     */
    public function show(int $id): JsonResponse
    {
        $kit = RoboticsKit::with('courses')->findOrFail($id);

        return response()->json(['data' => $kit]);
    }

    /**
     * Update an existing robotics kit.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $kit = RoboticsKit::findOrFail($id);
        $kit->update($this->validatedData($request, $kit));

        return response()->json([
            'message' => 'Robotics kit updated successfully.',
            'data' => $kit->fresh()->load('courses'),
        ]);
    }

    /**
     * Remove the specified robotics kit.
     */
    public function destroy(int $id): JsonResponse
    {
        $kit = RoboticsKit::findOrFail($id);
        $kit->delete();

        return response()->json(['message' => 'Robotics kit deleted successfully.']);
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
}
