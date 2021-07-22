<?php

echo $_SERVER['REMOTE_ADDR'];

session_start();
if(isset($_POST['submit'])) {
    $_SESSION['client_address'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['name'] = $_POST['Name'];
    header('Location:index.php');
}

if(isset($_POST['logOut'])){
    unset($_SESSION['name']);
    header('Location:index.php');
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="text" name="Name" placeholder="Enter Your Name">
    <button type="submit" name="submit">Submit</button>
    <button type="submit" name="logOut">Log Out</button>
</form>
</body>
</html>