<?php
$filename = 'comments.txt';

// Obsługa zapisywania komentarzy
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $comment = [
        'name' => $name,
        'email' => $email,
        'message' => $message,
        'created_at' => date('Y-m-d H:i:s')
    ];

    $comments = [];
    if (file_exists($filename)) {
        $file_content = file_get_contents($filename);
        if ($file_content === false) {
            echo "<p>Błąd podczas odczytu pliku z komentarzami.</p>";
        } else {
            $comments = json_decode($file_content, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $comments = []; // Zresetuj komentarze, jeśli JSON jest niepoprawny
            }
        }
    }

    $comments[] = $comment;

    if (file_put_contents($filename, json_encode($comments, JSON_PRETTY_PRINT)) === false) {
        echo "<p>Błąd podczas zapisu komentarza do pliku.</p>";
    } 
}

// Obsługa odczytu komentarzy
$comments = [];
if (file_exists($filename)) {
    $file_content = file_get_contents($filename);
    if ($file_content === false) {
        echo "<p>Błąd podczas odczytu pliku z komentarzami.</p>";
    } else {
        $comments = json_decode($file_content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $comments = []; // Zresetuj komentarze, jeśli JSON jest niepoprawny
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt - Kulinaria Świata</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Kontakt</h1>
        <nav>
            <ul>
                <li><a href="index.html">Strona Główna</a></li>
                <li><a href="wloska.html">Kuchnia Włoska</a></li>
                <li><a href="azjatycka.html">Kuchnia Azjatycka</a></li>
                <li><a href="meksykanska.html">Kuchnia Meksykańska</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Skontaktuj się z nami</h2>
            <form action="kontakt.php" method="post">
                <label for="name">Imię:</label>
                <input type="text" style="width: 300px;" id="name" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" style="width: 300px;" id="email" name="email" required>
                
                <label for="message">Wiadomość:</label>
                <textarea id="message" style="width: 1200px; height: 200px;" name="message" required></textarea>
                
                <button type="submit">Wyślij</button>
            </form>
        </section>
        <section>
            <h2>Księga Gości</h2>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <p><strong><?php echo htmlspecialchars($comment['name']); ?></strong> napisał:</p>
                        <p><?php echo htmlspecialchars($comment['message']); ?></p>
                        <p><small><?php echo htmlspecialchars($comment['created_at']); ?></small></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Brak komentarzy.</p>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <div id="current-time"></div>
        <p>&copy; 2024 Kulinaria Świata</p>
    </footer>
</body>
</html>
