@props(['headers'])

<thead class="text-xs text-gray-700 uppercase bg-gray-100">
    <tr>
        @foreach ($headers as $header)
            <th scope="col" class="px-6 py-3">{{ $header }}</th>
        @endforeach
    </tr>
</thead>
