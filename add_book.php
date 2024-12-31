<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $review = $_POST['review'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
           
            $stmt = $conn->prepare("INSERT INTO books (name, author, genre, review, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssss', $name, $author, $genre, $review, $imageName);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Book added successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload the image.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Image upload error.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>
