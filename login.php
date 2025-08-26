<?php
session_start();
?>
<?php


// $errors=[];
// $username=$password="";
$password="";
$success=false;

$errors = $_SESSION['errors'] ?? [];   // Load errors from session if any
$username = $_SESSION['old_username'] ?? "";
unset($_SESSION['errors'], $_SESSION['old_username']); // Clear after showing



    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //validating username
        if(empty($_POST["username"])){
            $errors["username"]="Username is required";
        }else{
            $username=sanitizeInput($_POST["username"]);
            if(strlen($username)<5){
                $errors["username"]="username must be 5 character long";
            }elseif(!preg_match("/^[a-zA-Z0-9._-]+$/",$username)){
                $errors["username"]="Username can only contain letters, numbers, periods, dashes, or underscores";
            };
        }

        //validating password
        if(empty($_POST["password"])){
            $errors["password"]="Password is required";
        }else{
            $password=sanitizeInput($_POST["password"]);
            if(strlen($password)<8){
                $errors["password"]="password must be at least 8 character long";
            }else if(!preg_match("/[@#$%]/",$password)){
                $errors["password"]="password must contain at least one special character";
            }
        }

        if(empty($errors)){
            $success=true;
             $_SESSION["username"]=$username;
          header("Location:homepage.php");
          exit();
        }
        else {
        // Store errors + old input in session, then redirect
        $_SESSION['errors'] = $errors;
        $_SESSION['old_username'] = $username;
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }


}
function sanitizeInput($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;

}
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

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div id="logo"> <img id="cafeicon" src="./icon/cafe.png" alt="">
                <p id="yourcafe"><i>Cozy Cafe</i></p>
            </div>
            <h1>Log In</h1>

            <div id="username">
                <label for="username" name="username">Username</label>
                <input type="text" name="username" value="<?php echo $username;?>">
                <?php if(isset($errors["username"])): ?> <span class="error"><?php echo $errors["username"]; ?></span>
                <?php endif; ?>

            </div>
            <div id="password">
                <label for="password" name="password">Password</label>
                <input type="password" name="password">
                <?php if (isset($errors["password"])): ?>
                <span class="error"><?php echo $errors["password"]; ?></span>
                <?php endif; ?>

            </div>
            <input type="submit" id="submit" name="submit" value="Log In">
            <p id="registerLink">Dont haves an account? <a href="signup.php ">Register</a> </p>
        </form>
    </div>
</body>

</html>