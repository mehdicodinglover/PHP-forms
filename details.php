<?php



$conn = mysqli_connect('localhost','root','','test');


if(!$conn):
    echo 'connection failed!'. mysqli_connect_error();
else:
    if(isset($_GET['id'])) {
        $query = "SELECT * FROM users WHERE id = $_GET[id]";
        $result = mysqli_query($conn, $query);
        $selected = mysqli_fetch_assoc($result);
    }
    if(isset($_POST['delete'])){
        $query = "DELETE FROM users WHERE id = $_GET[id]";
        $delete = mysqli_query($conn,$query);
        if($delete)header('Location:userInfo.php');
        else echo mysqli_error();
        //mysqli_close($conn);

    }
    //print_r($selected);
endif;



?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<a href="userInfo.php" class="h4">HOME</a>
<?php if($selected): ?>
    <div class="container text-center border border-danger rounded-lg p-3">
        <h2 class="mb-4"><?php echo $selected['username'] ?></h2>
        <p><span>with email address : </span><span class="text-muted"><?php echo $selected['email'] ?></span></p>
        <p><span>and phone number : </span><span class="text-muted"><?php echo $selected['phoneNumber'] ?></span></p>
        <p><span>who joined at : </span><span class="text-muted"><?php echo $selected['joined_at'] ?></span></p>
        <p>to our community by by our developer Mehdi Kheiri</p>
    </div>
<?php else: ?>
    <h4 class="text-center text-muted">there is not such a user!</h4>
<?php endif;?>

<form action="details.php?id=<?php echo $selected['id']?>" method="post">
    <button name="delete" type="submit">delete</button>
</form>

</body>
</html>
