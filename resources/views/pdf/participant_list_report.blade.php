<!DOCTYPE html>
<html>
<head>
    <title>Participant List</title>
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
            font-size: 16px;
            color: #444;
        }
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
        .stat:last-child {
            border-right: none;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 0;
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
        tr:last-child td {
            border-bottom: 1px solid gray;
        }
        /* tr:nth-child(even) td {
            background: #f5f5f5;
        } */
        td {
            vertical-align: top;
        }
        .status {
            font-weight: 600;
            color: #222;
        }
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
    <div class="header">
        <img src="{{ public_path('/rsx/logo.png') }}" class="logo">
        <div class="heading-group">
            <div class="org-title">IUT Computer Society</div>
            <div class="report-title">Participant List Report</div>
            <div class="event-title">{{ $fest->title }} &mdash; {{ $event->title }}</div>
        </div>
        
    </div>

    <div class="stats-bar">
        <div class="stat"><strong>Total Teams:</strong> {{ $totalTeams }}</div>
        <div class="stat"><strong>Total Participants:</strong> {{ $totalParticipants }}</div>
        <div class="stat"><strong>Report Date:</strong> {{ $generatedAt }}</div>
        <div class="stat"><strong>Event Medium:</strong> {{ ucfirst($event->medium) }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 18%;">Team Name</th>
                <th style="width: 20%;">Member Name</th>
                <th style="width: 13%;">Student ID</th>
                <th style="width: 22%;">Phone</th>
                <th style="width: 15%;">Registration Date</th>
            </tr>
        </thead>
        <tbody style="page-break-inside: avoid;">
            @foreach ($teamsData as $team)
                @foreach ($team['members'] as $index => $member)
                    <tr>
                        @if ($index === 0)
                            <td rowspan="{{ count($team['members']) }}"><strong>{{ $team['team_name'] }}</strong></td>
                        @endif
                        <td>{{ $member['name'] }}</td>
                        <td>{{ $member['student_id'] }}</td>
                        <td>{{ $member['phone'] }}</td>
                        @if ($index === 0)
                            <td rowspan="{{ count($team['members']) }}">{{ $team['registration_date'] }}</td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    
</body>
</html>