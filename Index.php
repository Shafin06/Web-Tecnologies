<!DOCTYPE html>
<html lang="en">
 
 
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 1</title>
</head>
<body>
    <div class='left'><img src="Id.jpg" alt="p1"width="200"height="150" > </div>   
    <div class="fbox">
        <div class = "box1">
        <!--<form action="show.php" method="post">
        <input type="submit" value="show all books">
        </form>-->
        <h2>Book List</h2>
        <table>
            <thead>
                
                    <th>BookTitle</th>
                    <th>ID</th>
                    <th>ISBN</th>
                    <th>Category </th>
                    <th>Count </th>

                
            </thead>
            <tbody>
                <?php

                $servername = "localhost"; 
                $username = "root"; 
                $password = ""; 
                $database = "labwork"; 

                //$conn = new mysqli($servername, $username, $password, $dbname);


                $conn = mysqli_connect("localhost", "root", "", "labwork");
               // $sql = "INSERT INTO users (book_title, isbn, category, count) VALUES ('$name', '$isbn', '$category', '$count')";

                //$sql = "SELECT book_title, isbn, category, count FROM borrowed_books";
                //$result = $conn->query($sql);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT book_title,id, isbn, category, count FROM users";
                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['book_title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['isbn']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['count']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No borrowed books found in the database.</td></tr>";
                }

                $conn->close();

                ?>
            </tbody>
        </table>    
        </div>



        <div class = "box1">
        <!--<form action="edit.php" method="post">
            <input type="submit" value="update">
        </form>
        <form action="delete.php" method="post">
            <input type="submit" value="delete">
        </form>-->

        <table>
            <thead>
                
                <th>BookTitle</th>
                <th>ID</th>
                <th>ISBN</th>
                <th>Category</th>
                <th>Count</th>
            
            </thead>
            <tbody>
                <?php
                 $servername = "localhost"; 
                 $username = "root"; 
                 $password = ""; 
                 $database = "labwork"; 
 
                 //$conn = new mysqli($servername, $username, $password, $dbname);
 
 
                 $conn = mysqli_connect("localhost", "root", "", "labwork");
 
                 if ($conn->connect_error) {
                     die("Connection failed: " . $conn->connect_error);
                 }
 
                 $sql = "SELECT book_title,id, isbn, category, count FROM users";
                 $result = $conn->query($sql);


                 if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['book_title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['isbn']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['count']) . "</td>";
                        echo "<td>";
                        echo "<a href='update.php?title=" . urlencode($row['book_title']) . "'>Update</a> | ";
                        echo "<a href='delete.php?title=" . urlencode($row['book_title']) . "' onclick=\"return confirm('Are you sure you want to delete this book?');\">Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No books found in the database.</td></tr>";
                }
    
                // Close the connection
                $conn->close();


                ?>
            </tbody>
        </table>
        </div>
    </div>
    <div class = "tbox3">
    <!--<div class="box5" id="availableTokens">-->
        <div class="box5">
            <h3>AvailableToken</h3>
            <?php
            // Load JSON data
            $jsonData = file_get_contents('token.json');
            $data = json_decode($jsonData, true);

            // Display unused tokens
            if (isset($data['tokens']) && count($data['tokens']) > 0) {
                echo '<ul>';
                foreach ($data['tokens'] as $token) {
                    echo '<li>' . htmlspecialchars($token) . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>No unused tokens available</p>';
            }
            ?>
        </div>

        <div class="box5">
            <h3>UsedToken</h3>
            <?php
            // Display used tokens
            if (isset($data['used_tokens']) && count($data['used_tokens']) > 0) {
                echo '<ul>';
                foreach ($data['used_tokens'] as $token) {
                    echo '<li>' . htmlspecialchars($token) . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>No used tokens available</p>';
            }
            ?>
        </div>



    </div>





               <!-- <div class="box5" id="availableTokens">
                    <strong>Available Tokens:</strong>
                    <ul>
                        <?php
                        foreach ($availableTokens as $token) {
                            echo '<li>' . htmlspecialchars($token) . '</li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="box5" id="usedTokens">
                    <strong>Used Tokens:</strong>
                    <ul>
                        <?php
                        foreach ($usedTokens as $token) {
                            echo '<li>' . htmlspecialchars($token) . '</li>';
                        }
                        ?>
                    </ul>
                </div>-->


        </div>

 
  
    <div class="tbox">
 
        <div class="box2"><img src="book2.png" alt="p2"width="120"height="100" ></div>
        <div class="box2"><img src="book3.png" alt="p3"width="120"height="100" ></div>
        <div class="box2"><img src="book4.png" alt="p4"width="120"height="100" ></div>
 
    </div>
 
 
    <div class="tbox2">
 
        <div class="box3">
        <form action="process.php" method="post">
            <input type="text" class="input" placeholder="Enter the student name" name="Username"><br>
            <input type="text" class="input" placeholder="Enter the student ID" name="ID"><br>
            <input type="text" class="input" placeholder="Enter the Aiub E-mail" name="E-mail"><br>
            <!--input type="text" class="input" placeholder="Book Title" name="Booktitle"><br-->
            <label>Choose a Book:</label>
            <select name="Booktitle">
                <option value="Programming">Programming</option>
                <option value="Networking">Networking</option>
               <!-- <option value="Operating System Concepts">Operating_System_Concepts</option>
                <option value="Artificial Intelligence">Artificial_Intelligence</option>
                <option value="Artificial Intelligence: A Modern Approach">Artificial_Intelligence:_A_Modern_Approach</option>
                <option value="Database System Concepts">Database_System_Concepts</option>-->
              </select><br>
            <label for="borrowdate">Borrow Date:</label><br>
            <input type="date" name="borrowdate"><br>
            <input type="number" class="input" placeholder="Token" name="token"><br>
            <label for="returndate">Return Date:</label><br>
            <input type="date" name="returndate"><br>
            <input type="number" class="input" placeholder="Fees" name="Fees"><br>
            <p class="paidtext">Paid:</p>
            <input type="radio"name="paid" value="Yes">
            <label for="yes">Yes</label>
            <input type="radio"name="paid" value="No">
            <label for="no">No</label><br>
            <input type="submit" value="Submit" name="submit">
          </form>
      
      </div>
        <div class="box4"><form action="insert.php"method="post">
            <input type="text" class="input" placeholder="Enter the Book Name" name="book_title"><br>
            <input type="text" class="input" placeholder="Enter the Author Name" name="aname"><br>
            <input type="text" class="input" placeholder="Enter the ISBN Number" name="isbn"><br>
            <input type="number" class="input" placeholder="Count" name="count"><br>
            <input type="text" class="input" placeholder="Enter the Catagory" name="category"><br>
            <!-- <option value="">Stuart Russell and Peter Norvig</option>-->
              <!----  <option value="Computer Organization and Design">Computer Organization and Design</option>-->
            <input type="submit" value="Submit" name="submit">
          </form></div>
       
 
    </div>
 
</body>
</html>