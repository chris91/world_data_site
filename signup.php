<?php
/**
 * Authentication from Scratch with PHP and MySQL
 *
 * @author   Dave Hollingworth
 * @link     http://www.udemy.com/u/davehollingworth/
 * @version  3 - Login and Logout
 */

include_once 'Security.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $error_message = Security::instance()->signup($_POST['email'], $_POST['password'], $_POST['password_confirmation']);

  if (is_null($error_message))
  {
    header('Location: success.php');  // redirect to the signup success page
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>Sign up</title>
  </head>
  <body>
    <h1>Sign up</h1>

    <!-- Display error message if one is set. -->
    <?php if (isset($error_message)): ?><div class="error"><?php echo $error_message; ?></div><?php endif; ?>

    <form method="post">
      <label for="email">email address</label>
      <input id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" /><br />

      <label for="password">Password</label>
      <input type="password" id="password" name="password" /><br />

      <label for="password_confirmation">Repeat password</label>
      <input type="password" id="password_confirmation" name="password_confirmation" /><br />

      <input type="submit" class="button" value="Sign up" />
    </form>

  </body>
</html>
