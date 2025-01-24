<?php

class signup
{
    private $error = "";

    public function evaluate($data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $this->error .= $key . " is empty!<br>";
            }

            //validation
            if ($key == "email") 
            {
                if (!preg_match("/^[\w\-]+@[\w\-]+\.[\w\-]+$/",$value))
                {
                    $this-> error =  $this->error . "invalid email address!<br>";
                }
            }

            if ($key == "first_name") 
            {
                if (is_numeric($value) || strstr($value, " "))
                {
                    $this-> error =  $this->error . "first name can't be a number!<br>";
                }
                if (strstr($value, " "))
                {
                    $this-> error =  $this->error . "first name can't have space<br>";
                }
            }

            if ($key == "last_name") 
            {
                if (is_numeric($value))
                {
                    $this-> error =  $this->error . "last namee can't be a number!<br>";
                }
                if (strstr($value, " "))
                {
                    $this-> error =  $this->error . " name can't have space<br>";
                }
            }

        }

        if ($data['password'] !== $data['password2']) {
            $this->error .= "Passwords do not match!<br>";
        }

        if ($this->error == "") {
            // No errors
            $this->create_user($data);
        } else {
            return $this->error;
        }
    }
 
    public function create_user($data)
{
    $first_name = ucfirst($data['first_name']);
    $last_name = ucfirst($data['last_name']);
    $gender = $data['gender'];
    $email = $data['email'];
    $password = $data['password']; // Secure password
    $url_address = strtolower($first_name) . "." . strtolower($last_name);
    $userid = $this->create_userid();

    // Corrected INSERT query
    $query = "INSERT INTO users (first_name, last_name, gender, email, password, url_address, userid) 
              VALUES ('$first_name', '$last_name', '$gender', '$email', '$password', '$url_address', '$userid')";

    $DB = new database();
    $DB->save($query);
}



  /*    public function create_user($data)
    {
        $first_name = ucfirst($data['first_name']);
        $last_name = ucfirst($data['last_name']);
        $gender = $data['gender'];
        $email = $data['email'];
        $password = $data['password']; // Secure password hashing
        
        $url_address = strtolower($first_name) . "." . strtolower($last_name);
        $userid = $this->create_userid();


        $query = "insert into  users (first_name, last_name, gender, email, password , url_address.userid) 
                  values ('$first_name', '$last_name', '$gender', '$email', '$password',' $url_address','$userid')";

        //$params = ['$first_name', '$last_name', '$gender', '$email', '$password',' $url_address'];

        $DB = new database();
        $DB->save($query);
    }*/

    private function create_userid()
    {
        $length = rand(4,19);
        $number = " ";
        for($i=0; $i < $length; $i++)
        {
            $new_rand = rand(0,9);

            $number = $number . $new_rand;
        }
        return $number;
    }
}
?>
