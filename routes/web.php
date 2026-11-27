<?php

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

Route::get('/', function () {
    return redirect('/workshop1');
});

Route::get('/workshop1', function () {
    return view('workshop1', [
        'students' => Student::all(),
        'courses' => Course::all(),
    ]);
})->name('workshop1.index');

// Student CRUD
Route::get('/students', function () {
    return view('student.list', ['students' => Student::all()]);
})->name('students.index');

Route::get('/students/create', function () {
    return view('student.create');
});

Route::post('/students', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:students,email',
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    $student = Student::create($validated);

    return redirect('/workshop1')
        ->with('success', "Student {$student->name} created successfully!");
});

Route::get('/students/{id}', function ($id) {
    $student = Student::findOrFail($id);
    return view('student.detail', ['student' => $student]);
});

Route::get('/students/{id}/edit', function ($id) {
    $student = Student::findOrFail($id);
    return view('student.edit', ['student' => $student]);
});

Route::put('/students/{id}', function (Request $request, $id) {
    $student = Student::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => ['required', 'email', 'max:255', Rule::unique('students')->ignore($student->id)],
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    $student->update($validated);

    return redirect('/workshop1')
        ->with('success', 'Student updated successfully!');
});

Route::delete('/students/{id}', function ($id) {
    $student = Student::findOrFail($id);
    $student->delete();

    return redirect('/workshop1')
        ->with('success', 'Student deleted successfully!');
});

// Course CRUD
Route::get('/courses', function () {
    return view('course.list', ['courses' => Course::all()]);
})->name('courses.index');

Route::get('/courses/create', function () {
    return view('course.create');
});

Route::post('/courses', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'duration' => 'required|integer|min:1',
        'fee' => 'required|numeric|min:0',
        'difficulty' => 'required|in:Easy,Medium,Hard',
    ]);

    $validated['is_active'] = $request->has('is_active');

    $course = Course::create($validated);

    return redirect('/workshop1')
        ->with('success', "Course {$course->name} created successfully!");
});

Route::get('/courses/{id}', function ($id) {
    $course = Course::findOrFail($id);
    return view('course.detail', ['course' => $course]);
});

Route::get('/courses/{id}/edit', function ($id) {
    $course = Course::findOrFail($id);
    return view('course.edit', ['course' => $course]);
});

Route::put('/courses/{id}', function (Request $request, $id) {
    $course = Course::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'duration' => 'required|integer|min:1',
        'fee' => 'required|numeric|min:0',
        'difficulty' => 'required|in:Easy,Medium,Hard',
    ]);

    $validated['is_active'] = $request->has('is_active');

    $course->update($validated);

    return redirect('/workshop1')
        ->with('success', 'Course updated successfully!');
});

Route::delete('/courses/{id}', function ($id) {
    $course = Course::findOrFail($id);
    $course->delete();

    return redirect('/workshop1')
        ->with('success', 'Course deleted successfully!');
});
