<?php


$name = $_POST['book_title'];
$author = $_POST['aname']; 
$isbn = $_POST['isbn'];  
$count = $_POST['count'];
$category = $_POST['category']; 






/*$name = "MYBOOK1";
$author = "VIRTUAL AUTHOR";
$isbn = 123; 
$count = 5;
$category = "FICTION";*/

$con = mysqli_connect("localhost", "root", "", "labwork");
$sql = "INSERT INTO users (book_title, isbn, category, count) VALUES ('$name', '$isbn', '$category', '$count')";


if(mysqli_query($con, $sql)) {
    echo "INSERTED";
}
else {die("ERROR");}


?>