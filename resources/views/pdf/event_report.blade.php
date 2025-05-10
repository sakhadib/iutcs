<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }

        .logo {
            width: 80px;
            margin-bottom: 10px;
        }

        .section {
            margin: 25px 0;
            padding: 15px;
            /* border: 1px solid #aaa; */
            border-radius: 4px;
        }

        .section-title {
            border-bottom: 1px solid #000;
            padding-bottom: 8px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .team-box {
            margin-bottom: 20px;
            /* border: 1px solid #444; */
            border-radius: 4px;
            padding: 15px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .team-header {
            font-weight: bold;
            margin-bottom: 12px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-item {
            padding: 8px;
            border-radius: 3px;
            /* border: 1px solid #ccc; */
        }

        .qa-table {
            width: 100%;
            margin: 10px 0;
            border-collapse: collapse;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .qa-table th, .qa-table td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        .qa-table th {
            background: #eee;
            font-weight: bold;
        }

        .member-list {
            margin: 10px 0;
            padding-left: 15px;
        }

        .member-list li {
            margin-bottom: 6px;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.9em;
            margin-left: 10px;
            background: #444;
            color: #fff;
        }

        .answer-section {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #aaa;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('rsx/logo.png') }}" class="logo">
        <h2 style="margin: 5px 0;">IUT Computer Society</h2>
        <h3 style="margin: 0;">{{ $fest->title ?? 'Fest' }} - {{ $event->title }}</h3>
    </div>

    <div class="section">
        <h4 class="section-title">Event Information</h4>
        <div class="detail-grid">
            <div class="detail-item">
                <strong>Medium:</strong><br>
                {{ $event->medium }}
            </div>
            <div class="detail-item">
                <strong>Location:</strong><br>
                {{ $event->location }}
            </div>
            <div class="detail-item">
                <strong>Date:</strong><br>
                {{ $event->start_date }} - {{ $event->end_date }}
            </div>
        </div>
    </div>

    <div class="section">
        <h4 class="section-title">Participating Teams</h4>

        @foreach ($teamData as $entry)
            <div class="team-box">
                <h5 class="team-header">
                    {{ $entry['team']->name }}
                    <span class="status-badge">{{ $entry['team']->status }}</span>
                </h5>

                <div class="member-section">
                    <strong>Team Members:</strong>
                    <ul class="member-list">
                        @foreach ($entry['members'] as $member)
                            <li>
                                <strong>{{ $member->name }}</strong> ({{ $member->role }})<br>
                                <span>{{ $member->university }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="answer-section">
                    <strong>Questionnaire Responses:</strong>
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
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
