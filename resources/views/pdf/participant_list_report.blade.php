<!DOCTYPE html>
<html>
<head>
    <title>Participant List</title>
    <style>
        @page { margin: 40px 30px 60px 30px; }
        body { font-family: 'DejaVu Sans', Arial, sans-serif; font-size: 12px; color: #222; }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #005792;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        .logo { width: 70px; }
        .org-title {
            color: #005792;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .report-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 2px;
        }
        .event-title {
            font-size: 13px;
            color: #666;
        }
        .summary-box {
            background: #f7fafd;
            border: 1px solid #e3eaf1;
            border-radius: 6px;
            padding: 12px 18px;
            margin-bottom: 25px;
            display: flex;
            gap: 30px;
            font-size: 13px;
        }
        .summary-box p {
            margin: 0;
            font-weight: 500;
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
            border-bottom: 1px solid #e3eaf1;
        }
        th {
            background: #005792;
            color: #fff;
            font-weight: 600;
            text-align: left;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:nth-child(even) td {
            background: #f7fafd;
        }
        td {
            vertical-align: top;
        }
        .status {
            font-weight: 600;
            color: #00796b;
        }
        .footer {
            position: fixed;
            bottom: 18px;
            left: 0;
            right: 0;
            text-align: right;
            font-size: 11px;
            color: #888;
            border-top: 1px solid #e3eaf1;
            padding-top: 6px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('/rsx/logo.png') }}" class="logo">
        <div style="text-align: right;">
            <div class="org-title">IUT Computer Society</div>
            <div class="report-title">Participant List Report</div>
            <div class="event-title">{{ $fest->title }} &mdash; {{ $event->title }}</div>
        </div>
    </div>

    <div class="summary-box">
        <p><strong>Total Teams:</strong> {{ $totalTeams }}</p>
        <p><strong>Total Participants:</strong> {{ $totalParticipants }}</p>
        <p><strong>Report Date:</strong> {{ $generatedAt }}</p>
        <p><strong>Event Medium:</strong> {{ ucfirst($event->medium) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 18%;">Team Name</th>
                <th style="width: 20%;">Member Name</th>
                <th style="width: 13%;">Student ID</th>
                <th style="width: 22%;">Email</th>
                <th style="width: 12%;">Status</th>
                <th style="width: 15%;">Registration Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teamsData as $team)
                @foreach ($team['members'] as $index => $member)
                    <tr>
                        @if ($index === 0)
                            <td rowspan="{{ count($team['members']) }}"><strong>{{ $team['team_name'] }}</strong></td>
                        @endif
                        <td>{{ $member['name'] }}</td>
                        <td>{{ $member['student_id'] }}</td>
                        <td>{{ $member['email'] }}</td>
                        @if ($index === 0)
                            <td rowspan="{{ count($team['members']) }}" class="status">{{ ucfirst($team['status']) }}</td>
                            <td rowspan="{{ count($team['members']) }}">{{ $team['registration_date'] }}</td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Page <span class="pagenum"></span>
    </div>
    <script>
        // For PDF generators that support JS page numbers (like dompdf)
        var pageSpans = document.getElementsByClassName('pagenum');
        for (var i = 0; i < pageSpans.length; i++) {
            pageSpans[i].textContent = (typeof this.pageNumber !== 'undefined') ? this.pageNumber : '';
        }
    </script>
</body>
</html>
