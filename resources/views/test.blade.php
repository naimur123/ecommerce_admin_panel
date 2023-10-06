<!DOCTYPE html>
<html>
<head>
    <title>Google Analytics Data</title>
</head>
<body>
    <div>
        <canvas id="analyticsChart" width="400" height="200"></canvas>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('analyticsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [{
                    label: 'Page Views',
                    data: <?= json_encode($pageViews) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Customize the colors as needed
                    borderColor: 'rgba(75, 192, 192, 1)', // Customize the colors as needed
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    
</body>
</html>
