<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Exit Cover Letter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .m-logo {
            width: 220px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 200px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        td {
            padding: 8px;
            vertical-align: top;
        }

        .signature {
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <img class="m-logo" src="logos/maliks.png" alt="">

    <h2>Employee History at Our Company</h2>

    <table>
        <tr>
            <td><strong>Name of Employee:</strong></td>
            <td>{{ $employee->name }}</td>
        </tr>
        <tr>
            <td><strong>Employment Date:</strong></td>
            <td>{{ \Carbon\Carbon::parse($employee->date_hired)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td><strong>Leaving Date:</strong></td>
            <td>{{ \Carbon\Carbon::parse($employee->left_date)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td><strong>Time:</strong></td>
            <td>
                @php
                    $employmentDate = \Carbon\Carbon::parse($employee->date_hired);
                    $leavingDate = \Carbon\Carbon::parse($employee->left_date);
                    $diff = $employmentDate->diff($leavingDate);
                    echo "{$diff->y} year(s), {$diff->m} month(s), and {$diff->d} day(s)";
                @endphp
            </td>
        </tr>

        <tr>
            <td><strong>Branches worked in:</strong></td>
            <td>{{ $employee->branch->branch_name }}</td>
        </tr>
        <tr>
            <td><strong>Jobs known:</strong></td>
            <td>{{ $employee->jobRelation->name }}</td>
        </tr>
        <tr>
            <td><strong>Gave proper notice:</strong></td>
            <td>{{ $employee->give_notice ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <td><strong>Good performer:</strong></td>
            <td>{{ $employee->is_good_performer ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <td><strong>Positive person:</strong></td>
            <td>{{ $employee->is_positive_person ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <td><strong>Reasons left:</strong></td>
            <td>{{ $employee->left_reason }}</td>
        </tr>
        <tr>
            <td><strong>Exit Interview:</strong></td>
            <td>{{ $employee->exit_interview_remarks }}</td>
        </tr>
        <tr>
            <td><strong>Recommended again:</strong></td>
            <td>{{ $employee->is_recommended_to_back ? 'Yes' : 'No' }}</td>
        </tr>
    </table>

    <div class="signature">
        <p><strong>Filled by:</strong> HR Team</p>
        <p><strong>Date:</strong> {{ now()->format('d/m/Y') }}</p>
        <p><strong>HR Manager Signature:</strong></p>
        <img style="width: 150px" src="signatures/tania-signature.png" alt="">
    </div>
</body>

</html>
