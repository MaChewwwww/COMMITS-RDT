@extends('layouts.app-layout')

@section('content')
<div class="container">
    <h5 class="text-4xl font-bold">Reports</h5>

    <div class="flex justify-between items-center mb-4 w-full gap-x-px">
    <!-- Add Button -->
    <button class="bg-green-500 text-white px-3 py-2 rounded-md hover:bg-green-600 ml-auto h-13" data-bs-toggle="modal" data-bs-target="#addReportModal">Add Report</button>

    <!-- Filter Dropdown -->
    <div class="dropdown h-13 m-3 ml-2">
        <button class="bg-yellow-500 text-white px-3 py-2 rounded-md hover:bg-yellow-600 dropdown-toggle h-full" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Filter by Category
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="{{ route('report.index') }}">All</a></li>
            <li><a class="dropdown-item" href="{{ route('report.index', ['category' => 'students']) }}">Students</a></li>
            <li><a class="dropdown-item" href="{{ route('report.index', ['category' => 'faculty']) }}">Faculty</a></li>
            <li><a class="dropdown-item" href="{{ route('report.index', ['category' => 'admin']) }}">Admin</a></li>
            <li><a class="dropdown-item" href="{{ route('report.index', ['category' => 'visitors']) }}">Visitors</a></li>
        </ul>
    </div>
</div>

    <!-- List Reports -->
    <div class="mt-4">
    @foreach ($reports as $report)
        <div class="card mb-3">
            <div class="card-body">
                <!-- Container for title and date -->
                <div class="flex justify-between items-center">
                    <div>
                        <h5 class="text-lg font-semibold">{{ $report->title }}</h5>
                        <p class="text-sm text-gray-500">{{ $report->created_at->format('m/d/Y h:i A') }}</p>
                    </div>

                    <!-- Container for View and Delete buttons -->
                    <div class="flex gap-x-2">
                        <a href="{{ route('report.show', $report->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center justify-center h-12">View</a>

                        <form action="{{ route('report.destroy', $report->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 flex items-center justify-center h-12">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


<!-- Add Report Modal -->
<div class="modal fade" id="addReportModal" tabindex="-1" aria-labelledby="addReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReportModalLabel">Add New Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('report.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="contents" class="form-label">Contents</label>
                        <textarea class="form-control" id="contents" name="contents" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="students">Students</option>
                            <option value="faculty">Faculty</option>
                            <option value="admin">Admin</option>
                            <option value="visitors">Visitors</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
