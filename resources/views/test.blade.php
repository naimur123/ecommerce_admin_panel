{{-- <html>
<head>
    <title>Daily Visitors Report</title>
</head>
<body>
    <h1>Daily Visitors Report</h1>
    <table>
        <tr>
            <th>Date</th>
            <th>Visitors</th>
            <th>Pageviews</th>
        </tr>
        @foreach ($data as $date => $metrics)
            <tr>
                <td>{{ $metrics['date'] }}</td>
                <td>{{ $metrics['activeUsers'] }}</td>
                <td>{{ $metrics['screenPageViews'] }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <title>Analytics Chart</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<body>
    <canvas id="analyticsChart"></canvas>
    <script>
        const dates = @json($data->pluck('date'));
        const visitors = @json($data->pluck('activeUsers'));

        const ctx = document.getElementById('analyticsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Active Users',
                    data: visitors,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>

