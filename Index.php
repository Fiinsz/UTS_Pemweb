<?php
// filepath: c:\laragon\www\UTS_pemweb\index.php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once 'includes/db.php';

class Article {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getArticles() {
        $query = "SELECT * FROM article";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Koneksi ke database
$database = new Database();
$db = $database->connect();

// Ambil data artikel
$article = new Article($db);
$articles = $article->getArticles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Artikel</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Website Artikel</h1>
        <a href="logout.php" class="logout">Logout</a>
    </header>
    <main>
        <?php foreach ($articles as $article): ?>
        <article>
            <h2><?= htmlspecialchars($article['title']); ?></h2>
            <img src="images/<?= htmlspecialchars($article['picture']); ?>" alt="<?= htmlspecialchars($article['title']); ?>">
            <p><?= substr(strip_tags($article['content']), 0, 200); ?>...</p>
            <a href="article.php?id=<?= $article['id']; ?>">Baca Selengkapnya</a>
        </article>
        <?php endforeach; ?>
    </main>
    <footer>
        <p>&copy; 2025 Website Artikel</p>
    </footer>
</body>
</html>