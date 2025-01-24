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
    $book_title = urldecode($_GET['title']);
    
    // Fetch the book details
    $sql = "SELECT * FROM users WHERE book_title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $book_title);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Book not found.";
        exit;
    }
} else {
    echo "No book selected.";
    exit;
}

// Update the book details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updatedTitle = $_POST['book_title'];
    $isbn = $_POST['isbn'];
    $category = $_POST['category'];
    $Count = $_POST['Count'];

    $updateSql = "UPDATE users SET book_title = ?, isbn = ?, category = ?, count = ? WHERE book_title = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sssis", $updatedTitle, $isbn, $category, $Count, $book_title);

    if ($updateStmt->execute()) {
        echo "Book updated successfully!";
        header("Location: index.php"); // Redirect to the main page
        exit;
    } else {
        echo "Error updating book: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
</head>
<body>
    <h2>Update Book</h2>
    <form action="" method="POST">
        <label for="bookt_title">Book Title:</label>
        <input type="text" id="bookt_title" name="book_title" value="<?php echo htmlspecialchars($book['book_title']); ?>" required><br>

        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($book['isbn']); ?>" required><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($book['category']); ?>" required><br>

        <label for="copyCount">Count:</label>
        <input type="number" id="copyCount" name="Count" value="<?php echo htmlspecialchars($book['count']); ?>" required><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
