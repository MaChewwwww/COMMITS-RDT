@props([
    'headers' => [],
    'rows' => [],
])

<div class="overflow-x-auto">
    <table class="min-w-full table-auto border-collapse">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">{{ $header }}</th>
                @endforeach
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">Actions</th> <!-- The last column for actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr class="border-b">
                    @foreach ($row as $column)
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $column }}</td>
                    @endforeach
                    <td class="px-4 py-2 text-sm text-gray-800">
                        <!-- Action buttons: Edit and Delete -->
                        <a href="{{ route('edit.route', $row['id']) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                        <form action="{{ route('delete.route', $row['id']) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- 
    
    <x-data-table 
    :headers="['ID', 'Name', 'Email']" 
    :rows="[
        ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
        ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
    ]"

/> --}}