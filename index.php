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

//TODO: add box to change language and pick correct 

?>

<!DOCTYPE html>
<html>
  <head>
    <title><?php echo IDX_TITLE; ?></title>
    <meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/jquery.validate.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/index.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/jquery.validation.function.js"></script>
    <script type="text/javascript">
      /* <![CDATA[ */
      jQuery(function(){
        jQuery("#login #email").validate({
          expression: 'var re = /^(([^<>()[\\]\\\\.,;:\\s@\\"]+(\\.[^<>()[\\]\\\\.,;:\\s@\\"]+)*)|(\\".+\\"))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$/; return (VAL && re.test(VAL));',
          message: "<?php echo VALIDEMAIL; ?>"
        });
        jQuery("#login #password").validate({
          expression: 'return (VAL);',
          message: "<?php echo ENTERPASS; ?>"
        });
        jQuery("#signup #emailSignup").validate({
          expression: 'var re = /^(([^<>()[\\]\\\\.,;:\\s@\\"]+(\\.[^<>()[\\]\\\\.,;:\\s@\\"]+)*)|(\\".+\\"))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$/; return (VAL && re.test(VAL));',
          message: "<?php echo VALIDEMAIL; ?>"
        });
        jQuery("#signup #firstname").validate({
          expression: 'return (VAL);',
          message: "<?php echo ENTERFIRST; ?>"
        });
        jQuery("#signup #lastname").validate({
          expression: 'return (VAL);',
          message: "<?php echo ENTERLAST; ?>"
        });
        jQuery("#signup #passwordSignup").validate({
          expression: 'return (VAL);',
          message: "<?php echo ENTERPASS; ?>"
        });
        jQuery("#signup #passwordConfirm").validate({
          expression: 'return (VAL && VAL == jQuery(\'#signup #passwordSignup\').val());',
          message: "<?php echo PASSMATCH; ?>"
        });
      });
      /* ]]> */
    </script>
  </head>
  
  <body>
    <div id="content">
      <?php
        if(isset($_SESSION['error']))
        {
          echo '<p class="error">', $_SESSION['error'], '<p>';
          unset($_SESSION['error']);
        } 
      ?>
      <div id="mainPanel">
        <div id="login">
          <p><?php echo RET_USR; ?></p>
          <form method="POST" action="loginSubmit.php" id="loginForm">
            <label for="email"><?php echo EMAIL; ?>:</label>
            <input type="email" id="email" name="email" autocomplete="off" />
            <label for="password"><?php echo PASS; ?>:</label>
            <input type="password" id="password" name="password" autocomplete="off" />
            <input type="submit" class="action" value="<?php echo LOGIN; ?>" formnovalidate="formnovalidate" />
          </form>
        </div>
        <div id="signup">
          <p><?php echo NEW_USR; ?></p>
          <form method="POST" action="signupSubmit.php" id="signupForm">
            <label for="firstname"><?php echo FIRST; ?>:</label>
            <input type="text" id="firstname" name="firstname" autocomplete="off" />
            <label for="lastname"><?php echo LAST; ?>:</label>
            <input type="text" id="lastname" name="lastname" autocomplete="off" />
            <label for="email"><?php echo EMAIL; ?>:</label>
            <input type="email" id="emailSignup" name="email" autocomplete="off" />
            <label for="password"><?php echo PASS; ?>:</label>
            <input type="password" id="passwordSignup" name="password" autocomplete="off" />
            <label for="passwordConfirm"><?php echo PASS_CONF; ?>:</label>
            <input type="password" id="passwordConfirm" name="passwordConfirm" autocomplete="off" />
            <input type="submit" class="action" value="<?php echo SIGNUP; ?>" formnovalidate="formnovalidate" />
          </form>
        </div>
      </div>
    </div>
  </body>
</html>