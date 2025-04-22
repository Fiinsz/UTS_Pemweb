<?php
// filepath: c:\laragon\www\UTS_pemweb\article.php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once 'includes/db.php';

$database = new Database();
$db = $database->connect();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM article WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$article) {
        die("Artikel tidak ditemukan.");
    }
} else {
    die("ID artikel tidak diberikan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($article['title']); ?></h1>
    </header>
    <main>
        <img src="images/<?= htmlspecialchars($article['picture']); ?>" alt="<?= htmlspecialchars($article['title']); ?>">
        <p><?= nl2br(htmlspecialchars($article['content'])); ?></p>
    </main>
    <footer>
        <p>&copy; 2025 Website Artikel</p>
    </footer>
</body>
</html>