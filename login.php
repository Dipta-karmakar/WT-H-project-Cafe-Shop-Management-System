<?php
session_start();

?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div id="main">

        <!-- <legend>Log In</legend> -->

        <form action="login.php" method="POST">
            <h1>Log In</h1>
            <div id="username">
                <label for="username" name="username" id="username">Username</label>
                <input type="text" name="username">

            </div>
            <div id="password">
                <label for="password" name="password" id="password">Password</label>
                <input type="password" name="password">

            </div>
            <input type="submit" id="submit" name="submit" value="login">
            <p>Dont have an account? Register</p>

            <?php

if(isset($_SERVER["REQUEST_METHOD"])=="POST"){

        if(isset($_POST["submit"])){

            if(empty($_POST["username"])||empty($_POST["password"])){
                echo "username or password is empty";
            }
                else{
                     $username=$_POST["username"];
                    $password=$_POST["password"];

                    $_SESSION["username"]=$username;
                    $_SESSION["password"]=$password;


                if($username=="admin" &&$password=="admin123"){
                header("Location:homepage.php");
                 }

                }
        }


}


?>

        </form>


    </div>



    </form>

</body>

</html>