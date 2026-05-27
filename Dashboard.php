<?php
session_start();
include 'db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_transaction'])) {
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $date = $_POST['transaction_date'];

    $stmt = $conn->prepare("INSERT INTO transactions (user_id, amount, type, category, transaction_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("idsss", $user_id, $amount, $type, $category, $date);
    $stmt->execute();
    $stmt->close();
}


$res_inc = $conn->query("SELECT SUM(amount) as total FROM transactions WHERE user_id = $user_id AND type = 'income'");
$income = $res_inc->fetch_assoc()['total'] ?? 0;

$res_exp = $conn->query("SELECT SUM(amount) as total FROM transactions WHERE user_id = $user_id AND type = 'expense'");
$expense = $res_exp->fetch_assoc()['total'] ?? 0;
$balance = $income - $expense;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Finance Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #0f172a; color: white; margin: 0; padding: 20px; }
        .navbar { display: flex; justify-content: space-between; padding-bottom: 20px; border-bottom: 1px solid #334155; }
        .card-container { display: flex; gap: 20px; margin: 20px 0; }
        .card { background: rgba(255,255,255,0.05); padding: 20px; border-radius: 12px; flex: 1; border: 1px solid #334155; }
        input, select, button { padding: 10px; border-radius: 6px; border: 1px solid #334155; background: #1e293b; color: white; }
        table { width: 100%; border-collapse: collapse; background: #1e293b; border-radius: 10px; overflow: hidden; margin-top: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #334155; }
        .delete-btn { color: #f87171; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="navbar">
    <h2>Dashboard Keuangan</h2>
    <a href="logout.php" style="color: #f87171;">Logout</a>
</div>

<div class="card-container">
    <div class="card">
        <h3>Saldo Total</h3>
        <h2>Rp <?php echo number_format($balance, 0, ',', '.'); ?></h2>
    </div>
    <div class="card" style="flex: 2;">
        <h3>Grafik Ringkasan</h3>
        <canvas id="financeChart" style="max-height: 150px;"></canvas>
    </div>
</div>

<div class="card" style="margin-bottom: 20px;">
    <h3>Tambah Transaksi</h3>
    <form method="POST">
        <input type="number" name="amount" placeholder="Jumlah" required>
        <select name="type">
            <option value="income">Pemasukan</option>
            <option value="expense">Pengeluaran</option>
        </select>
        <input type="text" name="category" placeholder="Kategori" required>
        <input type="date" name="transaction_date" required>
        <button type="submit" name="add_transaction">Simpan</button>
    </form>
</div>

<table>
    <tr><th>Tanggal</th><th>Kategori</th><th>Tipe</th><th>Jumlah</th><th>Aksi</th></tr>
    <?php
    $res = $conn->query("SELECT * FROM transactions WHERE user_id = $user_id ORDER BY transaction_date DESC");
    while($row = $res->fetch_assoc()) {
        echo "<tr>
            <td>{$row['transaction_date']}</td>
            <td>{$row['category']}</td>
            <td style='color: " . ($row['type'] == 'income' ? '#4ade80' : '#f87171') . "'>{$row['type']}</td>
            <td>Rp " . number_format($row['amount'], 0, ',', '.') . "</td>
            <td><a href='delete.php?id={$row['id']}' class='delete-btn' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a></td>
        </tr>";
    }
    ?>
</table>

<script>

    const ctx = document.getElementById('financeChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pemasukan', 'Pengeluaran'],
            datasets: [{
                label: 'Jumlah (Rp)',
                data: [<?php echo $income; ?>, <?php echo $expense; ?>],
                backgroundColor: ['#4ade80', '#f87171'],
                borderRadius: 5
            }]
        },
        options: {
            indexAxis: 'y',
            scales: { x: { grid: { color: '#334155' } }, y: { grid: { display: false } } },
            plugins: { legend: { display: false } }
        }
    });
</script>

</body>
</html>