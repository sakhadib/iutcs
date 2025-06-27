<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 40px; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #1a1a1a;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .logo {
            width: 70px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 14px;
            color: #333;
        }

        .event-info {
            margin-bottom: 30px;
        }

        .event-info .row {
            margin-bottom: 6px;
        }

        .team-section {
            page-break-before: always;
        }

        .team-box {
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 20px;
        }

        .team-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .status-badge {
            background: #444;
            color: #fff;
            padding: 2px 10px;
            border-radius: 10px;
            font-size: 0.85em;
            margin-left: 8px;
        }

        .info-table, .qa-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .info-table th, .info-table td,
        .qa-table th, .qa-table td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }

        .info-table th, .qa-table th {
            background: #efefef;
        }

        .section-heading {
            margin-top: 20px;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 13px;
        }

    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('rsx/logo.png') }}" class="logo">
        <div class="title">IUT Computer Society</div>
        <div class="subtitle">{{ $fest->title ?? 'Fest' }} - {{ $event->title }}</div>
    </div>

    <div class="event-info">
        <div class="row"><strong>Medium:</strong> {{ ucfirst($event->medium) }}</div>
        <div class="row"><strong>Location:</strong> {{ $event->location }}</div>
        <div class="row"><strong>Schedule:</strong> {{ $event->start_date }} to {{ $event->end_date ?? 'N/A' }}</div>
    </div>

    @foreach ($teamData as $entry)
    <div class="team-section">
        <div class="team-box">
            <div class="team-title">
                {{ $entry['team']->name }}
                <span class="status-badge">{{ ucfirst($entry['team']->status) }}</span>
            </div>

            <div class="section-heading">Team Details</div>
            <table class="info-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Student ID</th>
                        <th>University</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entry['members'] as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->phone }}</td>
                        <td>{{ $member->student_id }}</td>
                        <td>{{ $member->university }}</td>
                        <td>{{ ucfirst($member->role) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if (count($entry['answers']) > 0)
            <div class="section-heading">Registration Questionnaire Responses</div>
            <table class="qa-table">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entry['answers'] as $ans)
                    <tr>
                        <td>{{ $ans->question }}</td>
                        <td>{{ $ans->answer }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
    @endforeach
</body>
</html>