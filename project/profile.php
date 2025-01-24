<?php

        session_start();
        // print_r($_SESSION);
        //$_SESSION['dproject_userid'] =="";
        //unset($_SESSION['dproject_userid']);

        include("class/connect.php");
        include("class/login.php");
        include("class/user.php");
        include("class/post.php");

        
        //check if user is logged in
        if(isset($_SESSION['dproject_userid'])&& is_numeric($_SESSION['dproject_userid']))
        {
                $id = $_SESSION['dproject_userid'] ;
                $login = new Login();
                $result = $login-> check_login($id);


                if($result)
                {

                        // user data
                        $user = new user();

                        $user_data = $user ->get_data($id);

                        if(!$user_data)
                        {
                                header("Location: login.php");
                                die;
                        }
                      
                }else
                {
                        header("Location: login.php");
                        die;
                }
        }
        else
        {
                header("Location: login.php");
                die;
        }

        // posting

        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
                $post = new Post();
                $id = $_SESSION['dproject_userid'];
                $result = $post->create_post($id, $_POST);

                if($result == "")
                {
                        header("Location: profile.php");
                        die;
                }else
                {
                        echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
                        echo "The following errors occurred:<br>";
                        echo $result;
                        echo "</div>";
                }
        }

        //collect post

        $post = new Post();
        $id = $_SESSION['dproject_userid'];
        $posts = $post->get_posts($id);



        
               
?>



<html>
<head>
        <title> profile|Mybook</title>
</head>    
<style type="text/css">

        #blue_bar{

                height: 50px;
                background-color: #405d9b;
                color: #d9dfeb;
        }

        #search_box{

                width: 400px;
                height: 20px;
                border-radius: 5px;
                border: none;
                padding: 4px;
                font-size: 14px;
                background-image: url(search.png);
                background-repeat: no-repeat;
                background-position: right;
        }

        #profile_pic{
                width: 150px;
                margin-top: -140px;
                border-radius: 50%;
                border: solid 2px white;


        }
        #menu_button{

                width: 100px;
                display: inline-block;
                margin: 2px;

        }

        #books_img{

                width: 75px;
                float: left;
                margin: 8px;

        }
        #books_bar{

                        background-color: white;
                        min-height: 500px;
                        margin-top: 20px;
                        color: #aaa;
                        padding: 8px;

        }
        #books{
                clear: both;
                font-size: 12px;
                font-weight: bold;
                color: #405d9b;

        }
        textarea{

                width: 100%;
                border: none;
                font-family: tahoma;
                height: 100px;
        }
        #post_button{

                float: right;
                background-color: #405d9b;
                border: none;
                color: white;
                padding:4px ;
                font-size: 14px;
                border-radius: 2px;
                width: 50px;
        }
        #post_bar{

                margin-top: 20px;
                background-color: white;
                padding: 10px;

        }
        #post{

                padding: 4px;
                font-size: 13px;
                display:flex ;
                margin-bottom: 20px; ;

        }

</style>
<body style="font-family:tahoma;background-color:#d0d8e4 ">
        <br>
        <!--top bar-->
     <div id="blue_bar">
        <div style="width: 800px; margin:auto;font-size:30px;">

             Mybook &nbsp &nbsp<input type="text" id="search_box" placeholder="Search for Pepole">
             
             <img src="img.jpg" style="width:50px;float:right;">

             <a href="logout.php">
             <span style="font-size: 11px;float:right;margin: 10px;color:white;">Logout</span>
             </a>

        </div>      
     </div>
        <!--cover area-->
        <div style=" width: 800px;margin:auto;min-height: 400px;">

                <div style="background-color:white;text-align:center;color:#405d9b">

                        <img src="mountain.jpg" style="width: 100%;">
                        <img id="profile_pic"src="img.jpg">
                        <br>
                        <div style="font-size:20px">Shafin Ahmed</div> 
                        <br>
                       <div id="menu_button">Timeline</div> 
                       <div  id="menu_button">About</div>
                       <div id="menu_button"> Friends</div>
                       <div id="menu_button"> photo</div>
                       <div id="menu_button">Settings</div>
                        
                </div>
                <!--below cover area-->
                <div style="display: flex;">
                        <!--friends area-->
                        <div style="min-height: 400px;flex:1;">
                                <div id="books_bar">

                                Books<br>

                                <div id="books">
                                        <img  id="books_img"src="book1.png">
                                        <br>
                                        Firth Book
                                </div>

                                <div id="books">
                                        <img  id="books_img"src="book2.png">
                                        <br>
                                        Second Book
                                </div>
                                <div id="books">
                                        <img  id="books_img"src="book3.png">
                                        <br>
                                        Third Book
                                </div>
                                <div id="books">
                                        <img  id="books_img"src="book4.png">
                                        <br>
                                        Forth Book
                                </div>
                                </div>
                        </div>

                        <!--post area-->
                        <div style="min-height: 400px; flex:2.5; padding:20px;padding: right 0px;">

                                <div style="border:solid thin #aaa;padding: 10px;background-color:white;">


                                        <form method="post">

                                                <textarea name="post" placeholder="What is on Your mind"></textarea> <br>      
                                                <input id="post_button"type="submit" value="post">
                                                <br>
                                        </form>
                                </div>
                         <!--post-->
                         <div id="post_bar">

                         <?php
                                if($posts)
                                {
                                        foreach($posts as $ROW)
                                        {
                                                $user = new User();
                                                $ROW_USER= $user->get_user($ROW['userid']);

                                                include("post.php");
                                        }
                                }
                                

                         ?>
                               




                         </div>


                        </div>
                </div>
        </div>
</body>
</html>