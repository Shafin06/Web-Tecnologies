<?php
class user 
{
    public function get_data($id)
    {
        $query = "select * from users where userid = '$id' limit 1 ";

        $DB = new database();
        $result = $DB->read($query);

        if($result)
        {
            $row = $result[0];
            return $row;
        }else
        {
            return false;
        }
    }

    public function get_user($id)
    {
        $query = "select * from users where userid = '$id' limit 1";
        $DB= new database();
        $result = $DB-> read($query);

        if ($result)
        {
            return $result[0];
        }else
        {
            return false;
        }
    }
}