<?php
include 'db.php'; 
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 1. Cek dulu apakah username sudah ada di database
    $cek_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $cek_stmt->bind_param("s", $username);
    $cek_stmt->execute();
    $cek_stmt->store_result();

    if ($cek_stmt->num_rows > 0) {
        $pesan = "<p style='color: #f87171; text-align: center; margin-bottom: 10px; font-weight: bold;'>Username sudah dipakai!</p>";
    } else {
        // 2. Kalau aman, Hash password-nya
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // 3. Masukkan ke database
        $insert_stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $insert_stmt->bind_param("ss", $username, $hashed_password);

        if ($insert_stmt->execute()) {
            echo "<script>
                    alert('Registrasi berhasil! Silakan login.');
                    window.location.href = 'login.php';
                  </script>";
            exit();
        } else {
            $pesan = "<p style='color: #f87171; text-align: center;'>Error: " . $conn->error . "</p>";
        }
        $insert_stmt->close();
    }
    $cek_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Register - Finance OS</title>
    <style>
        body {
            margin: 0; height: 100vh; display: flex; align-items: center; justify-content: center;
            background: #0f172a; 
            font-family: 'Segoe UI', sans-serif;
            overflow: hidden; 
            position: relative;
        }

        /* --- EFEK BACKGROUND ANIMASI --- */
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px); 
            z-index: 0;
            animation: float 10s infinite alternate ease-in-out;
        }
        .shape-1 {
            width: 400px; height: 400px;
            background: #38bdf8; 
            top: -100px; left: -100px;
        }
        .shape-2 {
            width: 500px; height: 500px;
            background: #2dd4bf; 
            bottom: -150px; right: -100px;
            animation-delay: -5s; 
        }
        .shape-3 {
            width: 300px; height: 300px;
            background: #818cf8; 
            bottom: 20%; left: 30%;
            animation-duration: 15s;
        }

        @keyframes float {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-80px) scale(1.1); }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05); padding: 40px; border-radius: 20px;
            backdrop-filter: blur(20px); 
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 300px; color: white; box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            z-index: 1; 
        }
        h2 { text-align: center; margin-bottom: 25px; color: white; letter-spacing: 1px; }
        input {
            width: 100%; padding: 12px; margin: 10px 0; background: rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; box-sizing: border-box;
        }
        input:focus { outline: none; border-color: #4ade80; background: rgba(0,0,0,0.4); }
        
        /* Tombol daftar saya kasih warna hijau biar beda dari tombol login */
        button {
            width: 100%; padding: 12px; margin-top: 15px; background: #4ade80; 
            border: none; border-radius: 8px; color: #0f172a; font-weight: bold; cursor: pointer;
            transition: 0.3s;
        }
        button:hover { background: #86efac; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(74, 222, 128, 0.4); }
        .link-bawah { text-align: center; margin-top: 15px; font-size: 0.9rem; }
        .link-bawah a { color: #4ade80; text-decoration: none; font-weight: bold; }
        .link-bawah a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>

    <div class="login-card">
        <h2>Buat Akun</h2>
        
        <?php echo $pesan; ?>

        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username Baru" required>
            <input type="password" name="password" placeholder="Password Baru" required>
            <button type="submit">DAFTAR</button>
        </form>

        <div class="link-bawah">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </div>
    </div>
</body>
</html>