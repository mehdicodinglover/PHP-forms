<?php

    session_start();
    $name = $_SESSION['name']??'Guest';

    $errors = ['username'=>'','email'=>'','phoneNum'=>''];
    $info = ['username'=>'','email'=>'','phoneNum'=>''];

    if(isset($_GET['submit'])){
        if(!empty($_GET['username'])){
            $info['username'] = $_GET['username'];
            if(!preg_match('/^[a-z0-9_@.-]{3,}$/',$info['username']))
                $errors['username']='username is not valid!';
        }else $errors['username']='username field cannot be empty';

        if(!empty($_GET['email'])){
            $info['email'] = $_GET['email'];
            if(!filter_var($_GET['email'],FILTER_VALIDATE_EMAIL))
                $errors['email']='email is not valid!';
        }else $errors['email']='email field cannot be empty';

        if(!empty($_GET['phoneNum'])){
            $info['phoneNum'] = $_GET['phoneNum'];
            if(!preg_match('/^[0-9]{11}$/',$_GET['phoneNum']))
                $errors['phoneNum']='number is not valid!';
        }else $errors['phoneNum']='phone number field cannot be empty';

        $flag = 1;
        foreach ($errors as $error){
            if($error) $flag=0;
        }

        //$dummy = 'blahblah';

        if($flag){

            $conn = mysqli_connect('localhost','root','','test');
            if(!$conn):
                echo 'connection failed!'. mysqli_connect_error();
            else:
                $query = "INSERT INTO users(username,email,phoneNumber) 
                VALUES ('$info[username]','$info[email]','$info[phoneNum]')";
                mysqli_query($conn,$query);
            endif;
            header('Location: userInfo.php');
        }


        //print_r($errors);
        //print_r($info);
    }



    //$errors['username'] = 'mahdi';


?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Document</title>
</head>
<body>
    <div class="p-2 d-flex justify-content-around">
        <a href="userInfo.php" class="h4 rounded-lg" >HOME</a>
        <a href="enterName.php" class="h4 rounded-lg">ENTER YOUR NAME</a>
        <p class="text-muted smaller float-right">Hi <?php echo "$name!" ?></p>
    </div>
    <div class="myForm container bg-secondary p-3 text-center text-light col-12 col-sm-6 col-lg-4 rounded-lg">
        <form action="index.php" method="get" >
            <div class="my-2 input-group">
            <label for="username">User Name:</label>
            <input type="text" id="username" name="username" class="rounded-lg form-control"
                   value="<?php echo htmlspecialchars($info['username'])  ?>">
            </div>
            <div class="err"><?php echo $errors['username'] ?></div>
            <div class="my-2 input-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" class="rounded-lg form-control"
                   value="<?php echo htmlspecialchars($info['email'])  ?>">
            </div>
            <div class="err"><?php echo $errors['email'] ?></div>
            <div class="my-2 input-group">
            <label for="phoneNum">Phone Number:</label>
            <input type="text" id="phoneNum" name="phoneNum" class="rounded-lg form-control"
                   value="<?php echo htmlspecialchars($info['phoneNum'])  ?>">
            </div>
            <div class="err"><?php echo $errors['phoneNum'] ?></div>
            <div class="my-2 mx-auto buttonWrapper">
            <button type="submit" name="submit" class="btn-danger btn-lg rounded-lg text-light">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
