<!DOCTYPE html>
<html>
<head>
    <title>Festival Final Report</title>
    <style>
        @page { margin: 40px 30px 60px 30px; }
        body { font-family: 'DejaVu Sans', Arial, sans-serif; font-size: 12px; color: #222; background: #fff; }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #bbb;
            padding-bottom: 10px;
            margin-bottom: 18px;
        }
        .logo { width: 70px; }
        .heading-group {
            text-align: left;
        }
        .org-title {
            color: #111;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .report-title {
            font-size: 16px;
            font-weight: 600;
            color: #222;
            margin-bottom: 2px;
        }
        .event-title {
            font-size: 13px;
            color: #444;
        }
        .section-break { page-break-before: always; }
        .stats-bar {
            display: flex;
            gap: 0;
            margin-bottom: 22px;
            border: 1px solid #ccc;
            border-radius: 6px;
            overflow: hidden;
            background: #f8f8f8;
        }
        .stat {
            flex: 1;
            padding: 10px 0 10px 18px;
            border-right: 1px solid #e0e0e0;
            font-size: 13px;
            font-weight: 500;
        }
        .stat:last-child { border-right: none; }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 12px;
        }
        th, td {
            padding: 8px 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background: #eee;
            color: #111;
            font-weight: 600;
            text-align: left;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }
        tr:nth-child(even) td { background: #f5f5f5; }
        .footer {
            position: fixed;
            bottom: 18px;
            left: 0;
            right: 0;
            text-align: right;
            font-size: 11px;
            color: #888;
            border-top: 1px solid #e0e0e0;
            padding-top: 6px;
        }
    </style>
</head>
<body>
@foreach ($reportData as $section)
<div class="section-break">
    <div class="header">
        <div class="heading-group">
            <div class="org-title">IUT Computer Society</div>
            <div class="report-title">Event Report: {{ $section['event']->title }}</div>
            <div class="event-title">{{ $fest->title }}</div>
        </div>
        <img src="{{ public_path('/rsx/logo.png') }}" class="logo">
    </div>

    <div class="stats-bar">
        <div class="stat"><strong>Total Teams:</strong> {{ $section['teamCount'] }}</div>
        <div class="stat"><strong>Total Participants:</strong> {{ $section['participantCount'] }}</div>
        <div class="stat"><strong>Registration Fee:</strong> {{ $section['registration_fee'] }} BDT</div>
        <div class="stat"><strong>Total Collected:</strong> {{ number_format($section['total_collected'], 2) }} BDT</div>
        <div class="stat"><strong>Charge (1.8%):</strong> {{ number_format($section['charge'], 2) }} BDT</div>
        <div class="stat"><strong>Net Collected:</strong> {{ number_format($section['net_collected'], 2) }} BDT</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Team Name</th>
                <th>Member Name</th>
                <th>Student ID</th>
                <th>Email</th>
                <th>University</th>
                <th>Batch</th>
                <th>Registration Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($section['teamsData'] as $team)
                @foreach ($team['members'] as $index => $member)
                    <tr>
                        @if ($index === 0)
                            <td rowspan="{{ count($team['members']) }}"><strong>{{ $team['team_name'] }}</strong></td>
                        @endif
                        <td>{{ $member['name'] }}</td>
                        <td>{{ $member['student_id'] }}</td>
                        <td>{{ $member['email'] }}</td>
                        <td>{{ $member['university'] }}</td>
                        <td>{{ $member['batch'] }}</td>
                        @if ($index === 0)
                            <td rowspan="{{ count($team['members']) }}">{{ $team['registration_date'] }}</td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endforeach

<div class="section-break">
    <div class="header">
        <div class="heading-group">
            <div class="org-title">IUT Computer Society</div>
            <div class="report-title">General Festival Statistics</div>
            <div class="event-title">{{ $fest->title }}</div>
        </div>
        <img src="{{ public_path('/rsx/logo.png') }}" class="logo">
    </div>

    <div class="stats-bar">
        <div class="stat"><strong>Total Registered Users:</strong> {{ $totalUsers }}</div>
        <div class="stat"><strong>Report Generated At:</strong> {{ $generatedAt }}</div>
    </div>

    <h4>Participants by University</h4>
    <table>
        <thead><tr><th>University</th><th>Count</th></tr></thead>
        <tbody>
            @foreach ($universities as $uni => $users)
                <tr><td>{{ $uni ?? 'N/A' }}</td><td>{{ count($users) }}</td></tr>
            @endforeach
        </tbody>
    </table>

    <h4>Participants by Batch</h4>
    <table>
        <thead><tr><th>Batch</th><th>Count</th></tr></thead>
        <tbody>
            @foreach ($batches as $batch => $users)
                <tr><td>{{ $batch ?? 'N/A' }}</td><td>{{ count($users) }}</td></tr>
            @endforeach
        </tbody>
    </table>

    <h4>Participants by Gender</h4>
    <table>
        <thead><tr><th>Gender</th><th>Count</th></tr></thead>
        <tbody>
            @foreach ($genders as $gender => $group)
                <tr><td>{{ ucfirst($gender) ?? 'N/A' }}</td><td>{{ count($group) }}</td></tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="footer">
    Page <span class="pagenum"></span>
</div>
<script>
    var pageSpans = document.getElementsByClassName('pagenum');
    for (var i = 0; i < pageSpans.length; i++) {
        pageSpans[i].textContent = (typeof this.pageNumber !== 'undefined') ? this.pageNumber : '';
    }
</script>
</body>
</html>
