<?php
session_start();
//if($_SERVER['QUERY_STRING']==='noname')
echo $_SESSION['client_address'];
$name = $_SESSION['name'] ?? 'GUSET';
$conn = mysqli_connect('localhost','root','','test');
if(!$conn):
    echo 'connection failed!'. mysqli_connect_error();
else:
    $query = "SELECT username,email,id FROM users ORDER BY joined_at";
    $result = mysqli_query($conn,$query);
    $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
    //print_r($users);
    endif;
?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users' Info</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/user-styles.css">
</head>
<body>
<div class="p-2 d-flex justify-content-around">
    <a href="index.php" class="h4" >SUBMIT</a>
    <a href="enterName.php" class="h4">ENTER YOUR NAME</a>
    <p class="text-muted smaller float-right">Hi <?php echo "$name!" ?></p>
</div>
<div class="text-center p-2 m-3 text-muted rounded-lg h4">
    HERE IS USERS' INFO:
</div>

<div class="container border border-primary py-2 rounded-lg d-flex flex-wrap" id="users-list">
    <?php foreach ($users as $user): ?>
    <div class="col-12 col-md-6 col-lg-4 border text-center my-3">
        <h4><?php echo $user['username']; ?></h4>
        <p class="text-muted"><?php echo $user['email']; ?></p>
        <a class="" href="details.php?id=<?php echo $user['id']?>">more info</a>
    </div>
    <?php endforeach; ?>
</div>

</body>
</html>