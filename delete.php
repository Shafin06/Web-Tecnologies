<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "labwork";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the book title from the query parameter
if (isset($_GET['title'])) {
    $bookTitle = urldecode($_GET['title']);
    
    // Delete the book
    $sql = "DELETE FROM users WHERE book_title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bookTitle);

    if ($stmt->execute()) {
        echo "Book deleted successfully!";
        header("Location: index.php"); // Redirect to the main page
        exit;
    } else {
        echo "Error deleting book: " . $conn->error;
    }
} else {
    echo "No book selected.";
}

$conn->close();
?>
