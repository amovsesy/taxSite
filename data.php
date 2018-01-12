<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

require_once('config.php');
require_once('database.php');

function login($email, $password)
{
  global $db;
  
  $loginEmailCheck = $db->query("SELECT * FROM user WHERE (email = '" . $email . "')");
  $login = $db->query("SELECT * FROM user WHERE (email = '" . $email . "') and (password = '" . $password . "')");
  
  if($db->num_rows($loginEmailCheck) != 1)
  {
    $_SESSION['error'] = "No users exists with email: " . $email;
    $routePage = "index.php";
  }
  else if($db->num_rows($login) != 1)
  {
    $_SESSION['error'] = "Your email and password did not match our records in the database";
    $routePage = "index.php";
  }
  else
  {
    while($row = $db->getRows($login))
    {
      $_SESSION['userid'] = $row['id'];
    }
    $routePage = "home.php";
  }

  header('Location: ' . $routePage);
}

function doesUserExist($email)
{
  global $db;
  
  $findIfUserExists = "SELECT * FROM user WHERE email = '";

  $res = $db->query($findIfUserExists . $db->escape_value($email) . "'");
  return !($db->num_rows($res) == 0);
}

function addUser($firstname, $lastname, $email, $password)
{
  global $db;
  //TODO: add user to db
}

?>