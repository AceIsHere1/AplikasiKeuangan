<?php
session_start();
include 'db.php';


$pesan = ""; 

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
       
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $pesan = "<p style='color: #f87171; text-align: center; margin-bottom: 10px; font-weight: bold;'>Password salah!</p>";
        }
    } else {
        $pesan = "<p style='color: #f87171; text-align: center; margin-bottom: 10px; font-weight: bold;'>Username tidak ditemukan!</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login - Finance OS</title>
    <style>
        body {
            margin: 0; height: 100vh; display: flex; align-items: center; justify-content: center;
            background: #0f172a; 
            font-family: 'Segoe UI', sans-serif;
            overflow: hidden; 
            position: relative;
        }

       
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
        /* ------------------------------- */

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
        input:focus { outline: none; border-color: #38bdf8; background: rgba(0,0,0,0.4); }
        button {
            width: 100%; padding: 12px; margin-top: 15px; background: #38bdf8;
            border: none; border-radius: 8px; color: #0f172a; font-weight: bold; cursor: pointer;
            transition: 0.3s;
        }
        button:hover { background: #7dd3fc; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(56, 189, 248, 0.4); }
        .link-bawah { text-align: center; margin-top: 15px; font-size: 0.9rem; }
        .link-bawah a { color: #38bdf8; text-decoration: none; font-weight: bold; }
        .link-bawah a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>

    <div class="login-card">
        <h2>Finance OS</h2>
        
        <?php echo $pesan; ?>

        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">LOGIN</button>
        </form>

        <div class="link-bawah">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </div>
    </div>
</body>
</html>