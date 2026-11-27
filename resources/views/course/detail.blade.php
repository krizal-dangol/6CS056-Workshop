<!DOCTYPE html>
<html>
<head>
    <title>Course Detail</title>
</head>
<body>
    <h1>Course Detail</h1>
    <p><strong>ID:</strong> {{ $course->id }}</p>
    <p><strong>Name:</strong> {{ $course->name }}</p>
    <p><strong>Description:</strong> {{ $course->description }}</p>
    <p><strong>Duration (Weeks):</strong> {{ $course->duration }}</p>
    <p><strong>Fee:</strong> {{ $course->fee }}</p>
    <p><strong>Difficulty:</strong> {{ $course->difficulty }}</p>
    <p><strong>Active:</strong> {{ $course->is_active ? 'Yes' : 'No' }}</p>

    <a href="/courses/{{ $course->id }}/edit">Edit</a>
    <br>
    <a href="/workshop1">Back to Workshop 1</a>
</body>
</html>
