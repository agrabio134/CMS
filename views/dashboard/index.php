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
// Check if the user is logged in
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: /cms/login');
    exit;
}

echo 'Welcome ' . $_SESSION['username'];

//add logout
echo '<a href="/cms/logout">Logout</a>';
// echo 'Welcome ' . $_SESSION['email'];
// echo 'Welcome ' . $_SESSION['id'];
?>

<table>
    <tr>
        <th>ID</th>
        <th>username</th>
        <th>Email</th>
        <th>password</th>
    </tr>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['password']; ?></td>

        </tr>
    <?php endforeach; ?>

</table>
    
</body>
</html>
