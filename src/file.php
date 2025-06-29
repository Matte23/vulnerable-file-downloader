<?php
$file = basename($_GET['file']);
$filePath = __DIR__ . '/files/' . $file;

$sha256sum = null;
$output = [];
exec("sha256sum " . $filePath, $output);
if (!empty($output)) {
    $sha256sum = explode(' ', $output[0])[0];
}
?>
<?php include 'templates/header.php'; ?>
<div class="container">
    <h2>Your file is downloading...</h2>
    <?php if ($sha256sum): ?>
        <p><strong>SHA-256 checksum:</strong> <code><?php echo htmlspecialchars($sha256sum); ?></code></p>
    <?php endif; ?>
    <p>If the download does not start automatically, <a id="downloadLink" href="download.php?file=<?php echo urlencode($file); ?>">click here</a>.</p>
</div>
<script>
    // Start download after page loads
    window.onload = function() {
        window.location.href = "download.php?file=<?php echo urlencode($file); ?>";
    };
</script>
<?php include 'templates/footer.php'; ?>