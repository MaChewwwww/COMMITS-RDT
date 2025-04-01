<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Medical Services Report</title>
</head>
<body>
    {{-- header --}}
    <table>
        <tbody>
            <tr>
                <td style="height: 100px;">
                </td>
            </tr>
            <tr>
                <td>Republic of the Philippines</td>
            </tr>
            <tr>
                <td>POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</td>
            </tr>
            <tr>
                <td>Commonwealth, Quezon City</td>
            </tr>
            <tr>
                <td>{{ $title ?? 'Medical Services Report' }}</td>
            </tr>
            <tr>
                <td>{{ $fromDate ?? '' }} {{ $toDate ?? '' }}</td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th>Name of Physician:</th>
                <th></th>
                <th></th>
                <th></th>
                <th>Date of Submission:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $physicianName ?? '' }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $submissionDate ?? '' }}</td>
            </tr>
        </tbody>
    </table>    
    <!-- main table -->
    <table>
        <thead>
            <tr>
                <th>Medical Services Rendered</th>
                <th>Students</th>
                <th>Faculty</th>
                <th>Administrative</th>
                <th>Dependents</th>
                <th>Visitors</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tableDatas as $tableData)
                <tr>
                    <td>
                        {{ $tableData['name'] }}
                    </td>
                    @foreach ($tableData['data'] ?? [] as $key => $data)
                        <td class="text-center">
                            @if ($key == count($tableData['data'] ?? []) - 1)
                                {{ $data ?? '' }}
                            @else
                                {{ $data }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- summary table -->
    <table style="width: 60%; margin-top: 20px;">
        <tbody>
            <tr>
                <td class="pl-5">Total F2F Consults</td>
                <td class="text-center amber-bg">M = {{ $f2fConsultMale ?? 0 }}</td>
                <td class="text-center amber-bg">F = {{ $f2fConsultFemale ?? 0 }}</td>
                <td class="text-center amber-bg">{{ $f2fConsultTotal ?? 0 }}</td>
            </tr>
            <tr>
                <td class="pl-5">Total Online Consults</td>
                <td class="text-center amber-bg">M = {{ $onlineConsultMale ?? 0 }}</td>
                <td class="text-center amber-bg">F = {{ $onlineConsultFemale ?? 0 }}</td>
                <td class="text-center amber-bg">{{ $onlineConsultTotal ?? 0 }}</td>
            </tr>
            <tr>
                <td class="pl-5">Grand Total</td>
                <td class="text-center green-bg">M = {{ $grandTotalMale ?? 0 }}</td>
                <td class="text-center green-bg">F = {{ $grandTotalFemale ?? 0 }}</td>
                <td class="text-center green-bg">{{ $grandTotal ?? 0 }}</td>
            </tr>
        </tbody>
    </table>
    {{-- footer --}}
    <table>
        <thead>
            <tr>
                <td>{{ $campusPhysician ?? '' }}</td>
                <td>{{ $campusNurse ?? '' }}</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Campus Physician</th>
                <th>Campus Nurse</th>
            </tr>
        </tbody>
    </table>
</body>
</html>