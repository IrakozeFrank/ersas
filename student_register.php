<?php

include_once 'connection.php';

$error = "";

if (isset($_POST['submit'])) {

    $firstname = secure_inputs($_POST['firstname']);
    $lastname  = secure_inputs($_POST['lastname']);
    $regno     = secure_inputs($_POST['regno']); 

    if(empty($firstname) || empty($lastname) || empty($regno) || !isset($_POST['dept']) || !isset($_POST['year']) || !isset($_POST['exam'])){

        $error = "<div class='alert alert-danger alert-dismissable text-center'>
            <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
            <strong>Error ! </strong> Please fill all the fields
        </div>";

    }else{

        $dept    = secure_inputs($_POST['dept']);
        $year    = secure_inputs($_POST['year']);
        $exam    = secure_inputs($_POST['exam']);

        $sql = "SELECT * FROM tbl_student WHERE regno = '$regno' AND exam = '$exam'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) >= 1) {

            $error = " <div class='alert alert-warning alert-dismissable text-center'>

            <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
            <strong>Error ! </strong> Already Registered.
            </div>";

        }else{

            $query   = "INSERT INTO tbl_student (firstname, lastname, regno, dept, year, exam) VALUES ('$firstname','$lastname', '$regno', '$dept', '$year', '$exam')";
            $result  = mysqli_query($conn, $query);

            if($result){

                $error = " <div class='alert alert-success alert-dismissable text-center'>

                <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
                Success
                </div>";

                echo "<script>window.location = 'index'</script>";

            }else{

                $error = "<div class='alert alert-danger alert-dismissable text-center'>

                <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
                An error occured. Try again.
                </div>";

            }
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

    <div class="loginColumns animated fadeInDown" style="margin-top: -60px;">
        <div class="row">

            <div class="col-md-12">
                <h1 class="font-bold">Register</h1> 

            </div>

            <div class="col-md-12 m-t-lg">
                <div class="ibox-content">

                    <form class="form-horizontal m-t" role="form" action="student_register" method="POST">

                        <?php echo $error ?>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Firstname</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="firstname" name="firstname" class="form-control"> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Lastname</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="lastname" name="lastname" class="form-control"> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Registration No</label>
                            <div class="col-lg-9">
                                <input type="number" placeholder="regno" name="regno" class="form-control"> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Department</label>
                            <div class="col-lg-9">
                                <select class="form-control m-b" name="dept">
                                    <option selected="" disabled=""> Select Department...</option>
                                    <option value="IS">Information System - IS</option>
                                    <option value="IT">Information Technology - IT</option>
                                    <option value="CS">Computer Science - CS</option>
                                </select>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Year</label>
                            <div class="col-lg-9">
                                <select class="form-control m-b" name="year">
                                    <option selected="" disabled=""> Select Year...</option>
                                    <option value="1">Year 01</option>
                                    <option value="2">Year 02</option>
                                    <option value="3">Year 03</option>
                                    <option value="4">Year 04</option>
                                </select>
                            </div> 
                        </div>

                        <hr>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Exam</label>
                            <div class="col-lg-9">
                                <select class="form-control m-b" name="exam">
                                    <option selected="" disabled=""> Select Exam...</option>
                                    <
                                    <?php

                                    $sql = "SELECT * FROM tbl_exam";
                                    $res = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_array($res)) { 

                                        $exam = $row['course']." &nbsp; [".$row['dept']." year ".$row['year']."]";

                                        ?>

                                        <option value="<?php echo $row['exam_id'] ?>">
                                            <?php echo $exam; ?>
                                        </option>

                                    <?php } ?>
                                </select>
                            </div> 
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-6">
                                <button class="btn btn-block btn-md btn-success" name="submit" type="submit">Register</button>
                            </div>
                        </div>

                        <div class="row col-lg-4 m-t-lg"> 
                            <p class="text-muted text-center m-t">
                                <a href="index"><small>Back home</small></a>
                            </p>
                        </div>

                        <div class="clearfix"></div>

                    </form> 
                </div>
            </div>
        </div>  

    </div>

    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

    <script type="text/javascript">

        window.setTimeout(function() {

            $(".alert").fadeTo(500, 0).slideUp(500, function(){

                $(this).remove();
            });

        }, 8000);

    </script>

</body>

</html>
