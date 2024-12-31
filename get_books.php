<?php
include 'config.php';

$query = "SELECT * FROM books";
$result = $conn->query($query);

$books = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['image'] = 'uploads/' . $row['image']; 
        $books[] = $row;
    }
}

echo json_encode($books);

$conn->close();
?>
