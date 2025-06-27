<!DOCTYPE html>
<html>
<head>
    <title>Event-wise Batch Count Report</title>
    <style>
        @page { margin: 40px 30px 60px 30px; }
        body { font-family: 'DejaVu Sans', Arial, sans-serif; font-size: 12px; color: #222; background: #fff; }
        .header {
            display: block;
            border-bottom: 2px solid #bbb;
            padding-bottom: 10px;
            margin-bottom: 18px;
            text-align: left;
        }
        .logo {
            width: 70px;
            margin-bottom: 8px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            padding: 8px 10px;
            border-bottom: 1px solid #e0e0e0;
            text-align: left;
        }
        th {
            background: #eee;
            font-weight: 600;
        }
        tr:nth-child(even) td { background: #f5f5f5; }
        .total-row {
            font-weight: bold;
            background: #ddd;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="{{ public_path('/rsx/logo.png') }}" class="logo">
    <div class="org-title">IUT Computer Society</div>
    <div class="report-title">Event-wise Batch Count Report</div>
    <div class="event-title">{{ $fest->title }}</div>
</div>

<table>
    <thead>
        <tr>
            <th>Event</th>
            @foreach ($batches as $batch)
                <th>Batch {{ $batch }}</th>
            @endforeach
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reportData as $row)
            <tr>
                <td>{{ $row['event'] }}</td>
                @foreach ($batches as $batch)
                    <td>{{ $row['counts'][$batch] ?? 0 }}</td>
                @endforeach
                <td>{{ $row['total'] }}</td>
            </tr>
        @endforeach
        <tr class="total-row">
            <td>Total</td>
            @foreach ($batches as $batch)
                <td>{{ $totals[$batch] ?? 0 }}</td>
            @endforeach
            <td>{{ $grandTotal }}</td>
        </tr>
    </tbody>
</table>
</body>
</html>