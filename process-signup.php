<?php

$fname = $_POST["fname"];
$uname = $_POST["uname"];
$email = $_POST["email"];
$num = $_POST["number"];
$gender = $_POST["gender"];


if (strlen($_POST["psswd"]) < 8) {
    die("Password must be at least 8 characters.");
}

if (!preg_match("/[a-z]/i", $_POST["psswd"])) {
    die("password must contain at least one letter.");
}

if (!preg_match("/[0-9]/", $_POST["psswd"])) {
    die("password must contain at least one number.");
}

if ($_POST["psswd"] !== $_POST["psswd_c"]) {
    die("passwords must match");
}

$pass_hash = password_hash($_POST["psswd"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/connect.php";

$sql = "INSERT INTO user (`full name`,`user name`,email,`phone number`,password_hash,gender)
        VALUES(?,?,?,?,?,?)";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error :" . $mysqli->error);
}

$stmt->bind_param("sssiss", $fname, $uname, $email, $num, $pass_hash, $gender);

if($stmt->execute()){
    header("Location: signup_success.html");

}else{
    die($mysqli->error . " " . $mysqli->errno);
}

?>