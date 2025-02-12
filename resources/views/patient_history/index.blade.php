@extends('layouts.app-layout')

@section('content')
<h1>History</h1>

    <!-- Form for filtering records by identity and date range -->
    <form method="GET" action="{{ route('patient_history.index') }}">
        <label for="identity">Identity:</label>
        <select name="identity" id="identity">
            <option value="">All Identities</option>
            <option value="Student" {{ $identityFilter == 'Student' ? 'selected' : '' }}>Student</option>
            <option value="Faculty" {{ $identityFilter == 'Faculty' ? 'selected' : '' }}>Faculty</option>
            <option value="Admin" {{ $identityFilter == 'Admin' ? 'selected' : '' }}>Admin</option>
        </select>

        <label for="month">Filter by Month:</label>
        <select name="month" id="month">
            <option value="">All Months</option>
            @foreach($months as $month)
                <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                    {{ $month }}
                </option>
            @endforeach
        </select>

        <button type="submit">Filter</button>
    </form>

    <h2>Records</h2>

    @if($records->isEmpty())
        <p>No Records Found</p>
    @else
        <!-- Display the filtered records in a table -->
        <table border="3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Identity</th>
                    <th>Start Date</th>
                    <th>Discharge Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{ $record->patient_name }}</td>
                        <td>{{ $record->status }}</td>
                        <td>{{ $record->Identity }}</td>
                        <td>{{ $record->start_date }}</td>
                        <td>{{ $record->discharge_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
