@extends('admin.template.main')
@section('title', 'Dashboard')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <select id="bulanFilter" class="form-control mb-3" style="width: 200px;">
            <option value="0">Januari</option>
            <option value="1">Februari</option>
            <option value="2">Maret</option>
            <option value="3">April</option>
            <option value="4">Mei</option>
            <option value="5">Juni</option>
            <option value="6">Juli</option>
            <option value="7">Agustus</option>
            <option value="8">September</option>
            <option value="9">Oktober</option>
            <option value="10">November</option>
            <option value="11">Desember</option>
        </select>
        <br>

        <canvas id="grafikTransaksi" height="100"></canvas>

    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
<script>
    var data = @json($data);
    console.log(data);
    let chart;

    function renderChart(month) {
        const year = 2025;
        const daysInMonth = new Date(year, month + 1, 0).getDate(); // Total hari di bulan tsb

        const dailyTotals = {};

        // Inisialisasi semua hari di bulan tersebut
        for (let day = 1; day <= daysInMonth; day++) {
            const dateKey = new Date(year, month, day).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
            dailyTotals[dateKey] = 0;
        }

        // Isi data transaksi sesuai tanggal
        data.forEach(item => {
            const date = new Date(item.tanggal_pesanan);
            if (date.getFullYear() === year && date.getMonth() === month) {
                const key = date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
                dailyTotals[key] += parseInt(item.total_bayar);
            }
        });

        const labels = Object.keys(dailyTotals);
        const totals = Object.values(dailyTotals);

        if (chart) {
            chart.destroy();
        }

        const ctx = document.getElementById('grafikTransaksi').getContext('2d');
        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Transaksi/Bulan',
                    data: totals,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true, 
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }

    // Set default selected value ke bulan sekarang
    const bulanSekarang = new Date().getMonth(); // 0 = Januari, 1 = Februari, dst
    document.getElementById('bulanFilter').value = bulanSekarang;

    // Jalankan grafik pertama kali sesuai bulan sekarang
    renderChart(bulanSekarang);

    // Ganti bulan dari dropdown
    document.getElementById('bulanFilter').addEventListener('change', function () {
        const selectedMonth = parseInt(this.value);
        renderChart(selectedMonth);
    });
</script>

@endsection
