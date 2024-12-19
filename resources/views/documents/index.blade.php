@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Documents</h1>

    <!-- Dropdown filter -->
    <form method="GET" action="{{ route('documents.index') }}" class="mb-3" style="text-align: right;">
        <div class="form-group" style="display: inline-block; width: auto;">
            <select name="document_type" id="document_type" class="form-select" onchange="this.form.submit()" style="width: auto; max-width: 250px;">
                <option value="" {{ request('document_type') == '' ? 'selected' : '' }}>All Document Types</option>
                @foreach ($typeOptions as $type)
                    <option value="{{ $type }}" {{ request('document_type') == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
    


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Document ID</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
                <tr>
                    <td>{{ $document->id }}</td>
                    <td>{{ $document->document_type }}</td>
                    <td>
                        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('documents.view', $document->id) }}" class="btn btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
