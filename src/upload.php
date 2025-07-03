<?php
require_once 'config.php';
require_once 'db.php';
require_once 'auth.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit();
}

$uploadError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['fileToUpload']['tmp_name'];
        $fileName = $_FILES['fileToUpload']['name'];
        $fileSize = $_FILES['fileToUpload']['size'];
        $fileType = $_FILES['fileToUpload']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Validate file type and size
        $allowedfileExtensions = ['jpg', 'gif', 'png', 'pdf', 'doc', 'docx', 'txt', 'php'];
        if (in_array($fileExtension, $allowedfileExtensions) && $fileSize < 5000000) {
            $uploadFileDir = './files/';
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $uploadError = 'File is successfully uploaded.';
            } else {
                $uploadError = 'There was an error moving the uploaded file.';
            }
        } else {
            $uploadError = 'Upload failed. Allowed file types: ' . implode(', ', $allowedfileExtensions) . ' and max size: 5MB.';
        }
    } else {
        $uploadError = 'No file uploaded or there was an upload error.';
    }
}

include 'templates/header.php';
?>

<div class="container">
    <h2>Upload File</h2>
    <?php if ($uploadError): ?>
        <div class="alert alert-info"><?php echo $uploadError; ?></div>
    <?php endif; ?>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fileToUpload">Choose file to upload:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    <a href="files.php" class="btn btn-secondary mt-3">Back to File List</a>
</div>

<?php include 'templates/footer.php'; ?>
