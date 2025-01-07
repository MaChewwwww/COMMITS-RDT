@extends('layouts.frontend')

@section('content')

    <div class="container">
        <h3>Report</h3>
        <a href="{{ route('report.create') }}" class="btn btn-success float-end ms-3">+ Add</a>
        <div class="dropdown">
            <button class="btn btn-warning dropdown-toggle float-end" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Filter
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{ route('report.index') }}">All</a></li>
                <li><a class="dropdown-item" href="{{ route('report.index', ['type' => 'weekly']) }}">Week</a></li>
                <li><a class="dropdown-item" href="{{ route('report.index', ['type' => 'monthly']) }}">Month</a></li>
                <li><a class="dropdown-item" href="{{ route('report.index', ['type' => 'yearly']) }}">Year</a></li>
            </ul>
        </div>
        <div>
            <h6 class="mt-4">Recents</h6>
            @foreach ( $reports as $report )
                <div class="mb-2 card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{ $report->title }}</h3>
                                <p class="mb-0">{{ $report->created_at->format('m / d / Y g:i A') }}</p>
                            </div>
                            <form action="{{ route('report.destroy', $report->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

