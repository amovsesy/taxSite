<?php 
// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

require_once('config.php');

if(empty($_SESSION['lang']))
{
  require_once ('locale/en.php');
}
else
{
  require_once ('locale/' + $_SESSION['lang'] + '.php');
}


if (!isset($_SESSION['id']))
{
  header('Location: index.php');
}

?>