<?php
require_once 'config.php';
require_once 'db.php';
require_once 'auth.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit();
}

$files = array_diff(scandir(__DIR__ . '/files'), ['..', '.']);

include 'templates/header.php';
?>

<div class="container">
    <h2>Available Files for Download</h2>
    <ul class="list-group">
        <?php foreach ($files as $file): ?>
            <li class="list-group-item">
                <a href="file.php?file=<?php echo urlencode($file); ?>"><?php echo htmlspecialchars($file); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include 'templates/footer.php'; ?>