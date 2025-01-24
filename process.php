<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "labwork";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


/*
$errors = [];
$jsonFile = 'token.json';


//JSON
$AvailableToken = [];
$UsedToken = [];

if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $data = json_decode($jsonData, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        die('Error decoding JSON: ' . json_last_error_msg());
    }

    $AvailableToken = $data['AvailableToken'] ?? [];
    $UsedToken = $data['UsedToken'] ?? [];
} else {
    die("Token file not found!");
}

if (!empty($token)) {
    if (in_array($token, $AvailableToken)) {
        $AvailableToken = array_diff($AvailableToken, [$token]);
        $UsedToken[] = $token;
        $updatedData = [
            'AvailableToken' => array_values($AvailableToken), 
            'UsedToken' => $UsedToken
        ];
        file_put_contents($jsonFile, json_encode($updatedData, JSON_PRETTY_PRINT));
    } else {
        $errors[] = "The token you entered is invalid or already used.";
    }
}
*/





// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $Username = $_POST['Username'];
    $ID = $_POST['ID'];
    $Email = $_POST['E-mail'];
    $Booktitle = $_POST['Booktitle'];
    $borrowdate = $_POST['borrowdate'];
    $returndate = $_POST['returndate'];
    $token = $_POST['token'];
    $Fees = $_POST['Fees'];
    $paid = $_POST['paid'];

    // Load JSON data
    $jsonData = file_get_contents('token.json');
    $data = json_decode($jsonData, true);

    // Check if the token is valid (exists in unused tokens)
    if (in_array($token, $data['tokens'])) {
        // Token is valid, move it to used tokens
        $data['tokens'] = array_diff($data['tokens'], [$token]);
        $data['used_tokens'][] = $token;

        // Save the updated token data to the JSON file
        file_put_contents('token.json', json_encode($data, JSON_PRETTY_PRINT));

        // Insert the borrow details into the database
        // Corrected SQL query
    //$sql = "INSERT INTO users (Username, Id, Booktitle, borrowdate, returndate, token, Fees, paid)
    //VALUES ('$Username', '$ID', '$Booktitle', '$borrowdate', '$returndate', '$token', '$Fees', '$paid')";
    $sql = "INSERT INTO users (book_title)
    VALUES ('$book_title')";

        if ($conn->query($sql) === TRUE) {
            echo "Borrow record added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Token is invalid
        echo "Invalid or already used token.<br>";
    }
}

// Close the connection
$conn->close();




//validation
 if (preg_match("/[a-zA-Z]/", $_POST['Username'])) { //pattern recognition
   echo $_POST['Username'];
}
else {
   echo"Please write Correct Name";
}
 ?><br>
   <?php
    if (preg_match("/[1-9]+\-+[0-9]+\-+[1-9]/", $_POST['ID'])) { //pattern recognition
      echo $_POST['ID'];
   }
   else {
      echo "Write Correct Data";
   }
   ?><br>
    <?php
    if (preg_match("/@+(student)+\.(aiub)+\.(edu)/", $_POST['E-mail'])) { //pattern recognition
      echo $_POST['E-mail'];
   }
   else {
      echo "Write Correct Data";
   }
   ?><br>

   <?php
  # echo $_POST['token'];
   if (preg_match("/[0-9]/", $_POST['token'])) { 
      echo  $_POST['token'];
  }
  else {
      echo "Please write Valid token";
  }
   ?><br>

<?php
 if($_POST['borrowdate'] && $_POST['returndate']){
        $borrowdate=$_POST['borrowdate'];
        $returndate=$_POST['returndate'];
     $borrowTimeStamp=strtotime($borrowdate);
     $returnTimeStamp=strtotime($returndate);
     
     $daysDiff=($returnTimeStamp-$borrowTimeStamp)/(60*60*24);
     if( $daysDiff<0)
     {
        echo "returndate must be same or grater than borrowdata";
     }
     else if($daysDiff>10)
     {
        echo "Please Take Token";
     }
     else{
        echo "borrow date: .$_POST[borrowdate].<br>"; 
        echo "return date: .$_POST[returndate].<br>";
     }
    }
    else{
        echo"enter borrowdate and returndate";
        echo "<br>";
    }
    ?><br>
   <?php
   if (preg_match("/[0-9]/", $_POST['Fees'])) { 
      echo  $_POST['Fees'];
  }
  else {
      echo "Enter Number";
  }
   ?><br> 
   
<?php
$cookie_name=$_POST['Booktitle'];
$cookie_value=$_POST['Username'];

setcookie($cookie_name, $cookie_value, time() + 150, "/");

if(isset($_POST['Booktitle'])) 
{
    $cookie_value = $_POST['Booktitle'];
    if(isset($_POST["submit"])) 
    {
       // setcookie($cookie_name, $cookie_value);
    }
} 
if(count($_COOKIE)>0)
{
    echo $_COOKIE[$cookie_name];
    echo "This Book is not Available";
}
else
{
    echo $_COOKIE[$cookie_value];
    echo "This book is  Available";
}






    ?>





   



   