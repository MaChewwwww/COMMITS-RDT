<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Medical Services Report</title>
</head>
<body>
    {{-- header table--}}
    <table>
        <tbody>
            <tr>
                <td style="height: 100px;">
                </td>
            </tr>
            <tr>
                <td>POLYTECHNIC UNIVERSITY OF THE PHILIPPINES</td>
            </tr>
            <tr>
                <td>Medical Services Department</td>
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
    {{-- header table 2--}}
    <table>
        <tbody>
            <tr>
                <th>Name of Physician:</th>
                <th>{{ $physicianName ?? '' }}</th>
                <th></th>
                <th></th>
                <th>Date of Submission:</th>
                <th>{{ $submissionDate ?? '' }}</th>
            </tr>
            <tr>
                <td>Position:</td>
                <td>{{ $position ?? '' }}</td>
                <td></td>
                <td></td>
                <td>Unit / Department:</td>
                <td>{{ $unitDepartment ?? '' }}</td>
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
    {{-- bulletin table --}}
    <table>
        <tr>
            <td>VII. BULLETIN UPDATES</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colsplan="5">{{ $bulletinUpdates ?? '' }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <!-- summary tables -->
    <table>
        <tbody>
            <tr>
                <td>TOTAL</td>
                <td class="text-center">{{ $totals['students'] ?? 0 }}</td>
                <td class="text-center">{{ $totals['faculty'] ?? 0 }}</td>
                <td class="text-center">{{ $totals['administrative'] ?? 0 }}</td>
                <td class="text-center">{{ $totals['dependents'] ?? 0 }}</td>
                <td class="text-center">{{ $totals['visitors'] ?? 0 }}</td>
                <td class="text-center">{{ $totals['overall'] ?? 0 }}</td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th>GAD Consultation Census</th>
                <th>Students</th>
                <th>Faculty</th>
                <th>Administrative</th>
                <th>Dependents</th>
                <th>Visitors</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Female</td>
                <td>{{ $female['Student']   ?? 0 }}</td>
                <td>{{ $female['Faculty']   ?? 0 }}</td>
                <td>{{ $female['Admin']     ?? 0 }}</td>
                <td>{{ $female['Dependent'] ?? 0 }}</td>
                <td>{{ $female['Visitor']   ?? 0 }}</td>
                <td>{{ $female['Total']     ?? 0 }}</td>
            </tr>
            <tr>
                <td>Male</td>
                <td>{{ $male['Student']   ?? 0 }}</td>
                <td>{{ $male['Faculty']   ?? 0 }}</td>
                <td>{{ $male['Admin']     ?? 0 }}</td>
                <td>{{ $male['Dependent'] ?? 0 }}</td>
                <td>{{ $male['Visitor']   ?? 0 }}</td>
                <td>{{ $male['Total']     ?? 0 }}</td>
            </tr>
            <tr>
                <td>PWD</td>
                <td>{{ $pwd['Student']   ?? 0 }}</td>
                <td>{{ $pwd['Faculty']   ?? 0 }}</td>
                <td>{{ $pwd['Admin']     ?? 0 }}</td>
                <td>{{ $pwd['Dependent'] ?? 0 }}</td>
                <td>{{ $pwd['Visitor']   ?? 0 }}</td>
                <td>{{ $pwd['Total']     ?? 0 }}</td>
            </tr>
            <tr>
                <td>Senior Citizen</td>
                <td>{{ $seniorCitizen['Student']   ?? 0 }}</td>
                <td>{{ $seniorCitizen['Faculty']   ?? 0 }}</td>
                <td>{{ $seniorCitizen['Admin']     ?? 0 }}</td>
                <td>{{ $seniorCitizen['Dependent'] ?? 0 }}</td>
                <td>{{ $seniorCitizen['Visitor']   ?? 0 }}</td>
                <td>{{ $seniorCitizen['Total']     ?? 0 }}</td>
            </tr>
            <tr>
                <td>TOTAL</td>
                <td>{{ $total['Student']   ?? 0 }}</td>
                <td>{{ $total['Faculty']   ?? 0 }}</td>
                <td>{{ $total['Admin']     ?? 0 }}</td>
                <td>{{ $total['Dependent'] ?? 0 }}</td>
                <td>{{ $total['Visitor']   ?? 0 }}</td>
                <td>{{ $total['Overall']     ?? 0 }}</td>
            </tr>
        </tbody>
    </table>
    
    {{-- approval section --}}
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