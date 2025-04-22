<?php
// filepath: c:\laragon\www\UTS_pemweb\login.php
require_once 'includes/db.php';
require_once 'includes/auth.php';

session_start();

$database = new Database();
$db = $database->connect();
$auth = new Auth($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];

    $user = $auth->login($nickname, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <main>
        <form method="POST" action="">
            <label for="nickname">Nickname:</label>
            <input type="text" id="nickname" name="nickname" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </main>
</body>
</html>