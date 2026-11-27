<!DOCTYPE html>
<html>
<head>
    <title>Add New Course</title>
</head>
<body>
    <h1>Add New Course</h1>

    @if($errors->any())
        <div>
            <h3>Please fix the following errors:</h3>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/courses" method="POST">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
        </div>
        <br>
        <div>
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="{{ old('description') }}">
        </div>
        <br>
        <div>
            <label for="duration">Duration (Weeks)</label>
            <input type="number" id="duration" name="duration" value="{{ old('duration') }}">
        </div>
        <br>
        <div>
            <label for="fee">Fee</label>
            <input type="number" step="0.01" id="fee" name="fee" value="{{ old('fee') }}">
        </div>
        <br>
        <div>
            <label for="difficulty">Difficulty</label>
            <select id="difficulty" name="difficulty">
                <option value="Easy" {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>Easy</option>
                <option value="Medium" {{ old('difficulty') == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Hard" {{ old('difficulty') == 'Hard' ? 'selected' : '' }}>Hard</option>
            </select>
        </div>
        <br>
        <div>
            <label for="is_active">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                Active
            </label>
        </div>
        <br>
        <button type="submit">Add New Course</button>
    </form>
    <br>
    <a href="/workshop1">Back to Workshop 1</a>
</body>
</html>
