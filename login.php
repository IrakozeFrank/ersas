<?php

include_once 'connection.php';

$error = ""; 

if(isset($_POST["submit"])){

    $email    = secure_inputs($_POST['email']);
    $password = secure_inputs($_POST['password']); 

    if(empty($email) || empty($password)){

        $error  = "<div class='alert alert-danger alert-dismissable'>

        <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
        Please fill all the fields.

        </div>";

    }else{

        $email    = $_POST['email'];
        $password = $_POST['password'];
        $query    = "SELECT * FROM tbl_admin WHERE email='$email' and password='$password'";
        $result   = mysqli_query($conn,$query);
        $row      = mysqli_fetch_array($result,MYSQLI_ASSOC);

        if(mysqli_num_rows($result) == 1){

            session_start();
            $_SESSION['email'] = $email;  

            echo "<script>window.location = 'admin'</script>";

        }else{

            $error  = "<div class='alert alert-danger alert-dismissable'>

            <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
            Invalid credentials.

            </div>";
        }
    }
}

function secure_inputs($data){

    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ERSAS</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">.</h1>

            </div>
            <h3>ERSAS ADMINSTRATOR LOGIN</h3> 

            <form class="m-t-lg" role="form" action="login.php" method="POST">

                <?php echo $error; ?>

                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Username" name="email">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>

                <button type="submit" name="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="index"><small>Back to home</small></a>
            </form>

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

    <script type="text/javascript">

        window.setTimeout(function() {

            $(".alert").fadeTo(500, 0).slideUp(500, function(){

                $(this).remove();
            });

        }, 10000);

    </script>

</body>

</html>
