<?php
$is_invalid = false;
if($_SERVER["REQUEST_METHOD"]==="POST"){

    $mysqli = require __DIR__ . "/connect.php";

    $sql = sprintf("SELECT * FROM user 
        WHERE email = '%s' " , $mysqli->real_escape_string($_POST["email"]));

    $res = $mysqli->query($sql);

    $user = $res->fetch_assoc();

    if($user){
        if(password_verify($_POST["psswd"], $user["password_hash"])){
            die("login successful");
        }
    }
    $is_invalid = true;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div class="title">Login</div>
        <?php if($is_invalid): ?>
            <em>Invalid login</em>
        <?php endif;?>
        <form  method="post">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="psswd" placeholder="Enter your password" required>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>

</body>

</html>