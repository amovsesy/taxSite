<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

require_once('config.php');
require_once('database.php');
require_once('data.php');

$em = $db->escape_value($_POST['email']);

if(doesUserExist($em))
{
  $_SESSION['error'] = "A user with that email already exists";
  header('Location: signup.php');
}

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$confirm = md5($_POST['passwordConfirm']);

if($password != $confirm)
{
  $_SESSION['error'] = "Password mismatch. Please try again.";
  header('Location: signup.php');
}

if(empty($fname) || empty($lname) || empty($email) || empty($password))
{
  $_SESSION['error'] = "First name, last name, email, and password are required. Please fill in at minimum these fields and resubmit.";
  header('Location: signup.php');
}

addUser($fname, $lname, $email, $password);

$email = $_POST['email'];
$password = md5($_POST['password']);

login($email, $password);

?>