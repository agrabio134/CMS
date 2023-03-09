<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<?php
  // Check if the user is already logged in
  if (isset($_SESSION['id'])) {
    header('Location: ./Dashboard/index.php');
    exit;
  }
?>


<h1>Log in</h1>

<?php if (isset($error)): ?>
  <p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<form action="/cms/authenticate" method="post">
  <label for="username">Username:</label><br>
  <input type="text" name="username" id="username"><br>
  <label for="password">Password:</label><br>
  <input type="password" name="password" id="password"><br><br>
  <input type="submit" value="Login">
</form>
  
</body>
</html>
