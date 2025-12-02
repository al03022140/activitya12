<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Return every registered user with their enrolled courses.
     */
    public function index(): JsonResponse
    {
        $users = User::with('courses')->get();

        return response()->json(['data' => $users]);
    }

    /**
     * Store a new user.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $this->validatedData($request);
        $data['password'] = Hash::make($data['password']);
        $data['role'] = $data['role'] ?? 'Student';

        $user = User::create($data)->load('courses');

        return response()->json([
            'message' => 'User created successfully.',
            'data' => $user,
        ], 201);
    }

    /**
     * Display a specific user.
     */
    public function show(int $id): JsonResponse
    {
        $user = User::with('courses')->findOrFail($id);

        return response()->json(['data' => $user]);
    }

    /**
     * Update an existing user.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $data = $this->validatedData($request, $user);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if (!isset($data['role'])) {
            unset($data['role']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'User updated successfully.',
            'data' => $user->fresh()->load('courses'),
        ]);
    }

    /**
     * Delete a user record.
     */
    public function destroy(int $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }

    private function validatedData(Request $request, ?User $user = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user?->id),
            ],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:8'],
            'role' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
