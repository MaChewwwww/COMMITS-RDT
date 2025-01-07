@extends('layouts.frontend')

@section('content')
<div class="container">
    <h3>{{ $report->title }}</h3>
    <p><strong>Created At:</strong> {{ $report->created_at->format('m/d/Y h:i A') }}</p>
    <p><strong>Category:</strong> {{ $report->category }}</p>
    <p><strong>Contents:</strong> {{ $report->contents }}</p>
    <a href="{{ route('report.index') }}" class="btn btn-secondary">Back to Reports</a>
</div>
@endsection
