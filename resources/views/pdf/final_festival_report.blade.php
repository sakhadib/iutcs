<!DOCTYPE html>
<html>
<head>
    <title>Festival Summary Report</title>
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
<div class="section-break">
    <div class="header">
        <div class="heading-group">
            <div class="org-title">IUT Computer Society</div>
            <div class="report-title">Festival Summary Report</div>
            <div class="event-title">{{ $fest->title }}</div>
        </div>
        <img src="{{ public_path('/rsx/logo.png') }}" class="logo">
    </div>

    <h4>Event-wise Team and Participant Count</h4>
    <table>
        <thead>
            <tr>
                <th>Event</th>
                <th>Team Count</th>
                <th>Participant Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $section)
                <tr>
                    <td>{{ $section['event']->title }}</td>
                    <td>{{ $section['teamCount'] }}</td>
                    <td>{{ $section['participantCount'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="section-break">
    <div class="header">
        <div class="heading-group">
            <div class="org-title">IUT Computer Society</div>
            <div class="report-title">Event-wise Cash Breakdown</div>
            <div class="event-title">{{ $fest->title }}</div>
        </div>
        <img src="{{ public_path('/rsx/logo.png') }}" class="logo">
    </div>

    <table>
        <thead>
            <tr>
                <th>Event</th>
                <th>Fee (BDT)</th>
                <th>Total Teams</th>
                <th>Credit (BDT)</th>
                <th>Charge (1.8%)</th>
                <th>Net Credit (BDT)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $section)
                <tr>
                    <td>{{ $section['event']->title }}</td>
                    <td>{{ $section['registration_fee'] }}</td>
                    <td>{{ $section['teamCount'] }}</td>
                    <td>{{ number_format($section['total_collected'], 2) }}</td>
                    <td>{{ number_format($section['charge'], 2) }}</td>
                    <td>{{ number_format($section['net_collected'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="section-break">
    <div class="header">
        <div class="heading-group">
            <div class="org-title">IUT Computer Society</div>
            <div class="report-title">Event-wise Gender Count</div>
            <div class="event-title">{{ $fest->title }}</div>
        </div>
        <img src="{{ public_path('/rsx/logo.png') }}" class="logo">
    </div>

    <table>
        <thead>
            <tr>
                <th>Event</th>
                <th>Girl</th>
                <th>Boy</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genderCounts as $row)
                <tr>
                    <td>{{ $row['event'] }}</td>
                    <td>{{ $row['girl'] }}</td>
                    <td>{{ $row['boy'] }}</td>
                </tr>
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
