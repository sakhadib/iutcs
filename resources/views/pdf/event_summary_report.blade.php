<!DOCTYPE html>
<html>
<head>
    <title>Event Summary Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .logo { width: 100px; }
        .summary-box { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        ul { margin: 0; padding-left: 16px; }
        .lead { font-weight: bold; text-decoration: underline; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <div style="display: flex; align-items: center; justify-content: space-between;">
        <img src="{{ public_path('/rsx/logo.png') }}" class="logo">
        <div>
            <h2>IUT Computer Society</h2>
            <h3>Event Registration Summary Report</h3>
            <h4>{{ $fest->title ?? 'Fest' }} - {{ $event->title }}</h4>
            <p><strong>Medium:</strong> {{ $event->medium }}</p>
        </div>
    </div>

    <div class="summary-box">
        <p><strong>Total Teams Registered:</strong> {{ $totalTeams }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Team ID</th>
                <th>Team Name</th>
                <th>Member Count</th>
                <th>Members</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teams as $team)
            <tr>
                <td>{{ $team['id'] }}</td>
                <td>{{ $team['name'] }}</td>
                <td>{{ $team['member_count'] }}</td>
                <td>
                    <ul>
                        @foreach($team['members'] as $member)
                            <li class="{{ $member['role'] === 'team-lead' ? 'lead' : '' }}">
                                {{ $member['name'] }} ({{ $member['role'] }})
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ ucfirst($team['status']) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
<!-- This is a Blade template for generating an event summary report in PDF format. -->