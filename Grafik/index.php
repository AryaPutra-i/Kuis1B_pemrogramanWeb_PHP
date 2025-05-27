
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grafik Dinamis</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <style>
        body{
            min-height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #f7f7f7;
        }
    </style>
    <h2>Data Grafik</h2>
    <form id="dataForm" onsubmit="return addData();">
        <input type="text" id="nama" placeholder="Nama" required>
        <input type="number" id="value" placeholder="Value" required>
        <button type="submit">Add</button>
    </form>
    <canvas id="myChart" width="700" height="400"></canvas>

    <script>
        // Data awal kosong
        let labels = ["January", "February", "March", "April", "May"];
        let dataValues = [10, 20, 15, 25, 30];

        // Inisialisasi Chart.js
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nilai',
                    data: dataValues,
                    borderColor: 'rgb(0, 68, 255)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                responsive: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Fungsi untuk menambah data ke grafik
        function addData() {
            const nama = document.getElementById('nama').value;
            const value = parseFloat(document.getElementById('value').value);

            if (nama && !isNaN(value)) {
                labels.push(nama);
                dataValues.push(value);
                myChart.update();
                document.getElementById('dataForm').reset();
            }
            return false; // Mencegah reload form
        }
    </script>
</body>
</html>