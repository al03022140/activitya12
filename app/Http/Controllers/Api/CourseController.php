<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Return every course with its relationships.
     */
    public function index(): JsonResponse
    {
        $courses = Course::with(['roboticsKit', 'users'])->get();

        return response()->json(['data' => $courses]);
    }

    /**
     * Persist a new course record.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('courses', 'public');
            $data['attachment_path'] = $path;
            $data['attachment_original_name'] = $request->file('attachment')->getClientOriginalName();
        }

        $course = Course::create($data)->load(['roboticsKit', 'users']);

        return response()->json([
            'message' => 'Course created successfully.',
            'data' => $course,
        ], 201);
    }

    /**
     * Show a single course with relations.
     */
    public function show(int $id): JsonResponse
    {
        $course = Course::with(['roboticsKit', 'users'])->findOrFail($id);

        return response()->json(['data' => $course]);
    }

    /**
     * Update a stored course.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $course = Course::findOrFail($id);
        $data = $this->validatedData($request, $course);

        if ($request->hasFile('attachment')) {
            if ($course->attachment_path) {
                Storage::disk('public')->delete($course->attachment_path);
            }

            $path = $request->file('attachment')->store('courses', 'public');
            $data['attachment_path'] = $path;
            $data['attachment_original_name'] = $request->file('attachment')->getClientOriginalName();
        }

        $course->update($data);

        return response()->json([
            'message' => 'Course updated successfully.',
            'data' => $course->fresh()->load(['roboticsKit', 'users']),
        ]);
    }

    /**
     * Delete a course and any stored attachment.
     */
    public function destroy(int $id): JsonResponse
    {
        $course = Course::findOrFail($id);

        if ($course->attachment_path) {
            Storage::disk('public')->delete($course->attachment_path);
        }

        $course->delete();

        return response()->json(['message' => 'Course deleted successfully.']);
    }

    /**
     * Centralized validation rules for storing and updating courses.
     */
    private function validatedData(Request $request, ?Course $course = null): array
    {
        return $request->validate([
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('courses', 'code')->ignore($course?->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'credits' => ['required', 'integer', 'min:1', 'max:255'],
            'semester' => ['required', 'string', 'max:255'],
            'robotics_kit_id' => ['nullable', 'integer', 'exists:robotics_kits,id'],
            'attachment' => ['nullable', 'file', 'max:20480', 'mimes:pdf,doc,docx,ppt,pptx,zip,rar,7z,jpg,jpeg,png,gif'],
        ]);
    }
}
