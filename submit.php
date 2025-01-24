<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "labwork"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['book_title'];
    $author = $_POST['aname']; 
    $isbn = $_POST['isbn'];  
    $count = $_POST['count'];
    $category = $_POST['category']; 
    
    $sql = "INSERT INTO booksinfo (book_title, Aname, ISBN, Count, Category) VALUES ('$book_title','$aname','$isbn', '$count','$category')";

    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssds", $book_title, $aname, $isbn, $count, $category);

    
    if ($stmt->execute()) {
        echo "New record created successfully";
        echo "<meta http-equiv='refresh' content='3;url=index.php'>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
    $stmt->close();
}

$conn->close();
?>





















