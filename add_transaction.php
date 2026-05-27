<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $date = $_POST['transaction_date'];

    $stmt = $conn->prepare("INSERT INTO transactions (user_id, amount, type, category, transaction_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("idsss", $user_id, $amount, $type, $category, $date);

    if ($stmt->execute()) {
        header("Location: dashboard.php"); 
    } else {
        echo "Gagal menyimpan: " . $stmt->error;
    }
    $stmt->close();
}
?>