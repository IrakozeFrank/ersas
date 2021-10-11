<?php include_once 'connection.php'; ?>

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
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="css/plugins/textSpinners/spinners.css" rel="stylesheet">
    <link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <h2 class="font-bold">Welcome to Exam Registration & Seating Arrangement System</h2> 

                <p class="m-t">
                    The Exam Registration & Seating Arrangement System is web based application designed to help students to register for exams and college registrars to monitor and manage exam seating arrangement within the school of ICT.
                </p> 
            </div> 

            <?php 

                $query  = "SELECT * FROM tbl_registration";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_array($result)) { 

                    $status = $row['status'];

                    if ($status == 1) { ?>

                        <div class="col-md-12 m-t">
                            <div class="widget style1 navy-bg">
                                <div class="row"> 
                                    <div class="text-center">
                                        <h2 class="font-bold"><i class=""></i>REGISTRATION OPEN!</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }else{ ?> 

                        <div class="col-md-12 m-t <?php if(isset($_POST['submit'])) echo $hidden; ?>">
                            <div class="widget style1 red-bg">
                                <div class="row"> 
                                    <div class="text-center">
                                        <h2 class="font-bold">
                                            <i class="fa fa-exclamation-triangle"></i> 
                                            &nbsp; REGISTRATION CLOSED &nbsp;
                                            <i class="fa fa-exclamation-triangle"></i> 
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                <div class="col-md-12 m-t-lg <?php if(isset($_POST['submit'])) echo $hidden; ?>">
                    <div class="ibox-content">

                        <form class="m-t" role="form" action="index" method="POST">

                            <div class="form-group m-t-lg">

                                <div class="col-lg-12"> 
                                    <div class="input-group">
                                        <input type="number" name="regno" class="form-control input-lg" placeholder="Enter registration number"> 
                                        <span class="input-group-btn"> 
                                            <?php

                                                if ($status == 1) {

                                                    $disable = "disabled";

                                                }else{

                                                    $disable = "";
                                                }
                                            ?>
                                            <button <?php echo $disable; ?> name="submit" type="submit" class="btn btn-lg btn-primary">Search</button> 

                                        </span>
                                    </div>
                                </div>
                            </div> 

                            <div class="col-lg-4 m-t-lg">

                                <?php 

                                if ($status == 1) { ?>

                                    <p class="text-muted text-left m-t-lg">
                                        <small>No yet registered?</small>
                                    </p>

                                    <a class="btn btn-sm btn-success btn-block" href="student_register">Register</a>

                                <?php } } ?>

                                <p class="text-muted text-left m-t-lg">
                                    <a href="search" class="text-success">Invigilator Search</a>
                                </p>

                                <p class="text-muted text-left m-t-md">
                                    <a href="login" class="text-success">Administrator Login</a>
                                </p>
                            </div>  

                            <div class="clearfix"></div>
                        </form> 
                    </div>
                </div>

                <div class="col-md-12 m-t-lg"> 

                    <?php

                    if (isset($_POST['submit'])) {

                        $hidden = "hidden";

                        $regno = $_POST['regno']; ?>

                        <p class="text-muted text-left">
                            <a href="index" class="text-success">Back home</a>
                        </p>

                        <!------------------------------------------------->
                        <!--               EXAM TOKEN LIST               -->
                        <!------------------------------------------------->

                        <div class="ibox float-e-margins"> 

                            <div class="ibox-title">
                                <h5>My Exams</h5>
                            </div>

                            <div class="ibox-content">
                                <div class="table-responsive"> 

                                    <table class="table table-bordered table-hover dataTables-example">

                                        <thead>
                                            <tr>
                                                <th>Regno</th>
                                                <th>Names</th>
                                                <th>Token</th>
                                                <th>Exam</th>
                                                <th>Room</th>
                                                <th>Invigilator</th>
                                            </tr>
                                        </thead>

                                        <tbody>  

                                            <?php

                                            $query  = "SELECT * FROM tbl_student WHERE regno = $regno";
                                            $result = mysqli_query($conn, $query);

                                            while ($row = mysqli_fetch_array($result)) { 

                                                $regno = $row['regno'];
                                                $names = $row['firstname']." ".$row['lastname'];
                                                $token = $row['token'];
                                                $exam  = $row['exam'];
                                                $class = $row['dept']."-0".$row['year'];

                                                $sql1  = "SELECT * FROM tbl_allot WHERE exam = $exam";
                                                $res1  = mysqli_query($conn, $sql1);
                                                $row1  = mysqli_fetch_array($res1);
                                                $room  = $row1['room'];
                                                $invig = $row1['invig'];

                                                $tok   = $exam."-".$token

                                                ?>

                                                <tr> 
                                                    <td><?php echo $regno; ?></td>
                                                    <td><?php echo $names; ?></td>
                                                    <td><?php echo $tok; ?></td>
                                                    <td>
                                                        <?php 

                                                        $sql  = "SELECT * FROM tbl_exam WHERE exam_id = $exam";
                                                        $res  = mysqli_query($conn, $sql);
                                                        $rows = mysqli_fetch_array($res);
                                                        echo $rows['course']." [".$rows['dept']."-0".$rows['year']."]";

                                                        ?>                                                   
                                                    </td> 

                                                    <td>
                                                        <?php 

                                                        $sql2 = "SELECT * FROM tbl_room WHERE room_id = $room";
                                                        $res2 = mysqli_query($conn, $sql2);
                                                        $row2 = mysqli_fetch_array($res2);
                                                        echo $row2['room_no']." ".$row2['location'];

                                                        ?>                                                   
                                                    </td> 

                                                    <td>
                                                        <?php 

                                                        $sql3 = "SELECT * FROM tbl_invigilator WHERE invig_id = $invig";
                                                        $res3 = mysqli_query($conn, $sql3);
                                                        $row3 = mysqli_fetch_array($res3);
                                                        echo $row3['firstname']." ".$row3['lastname'];

                                                        ?>                                                   
                                                    </td> 
                                                </tr>

                                            <?php } ?>

                                        </tbody> 

                                    </table>
                                </div>
                            </div>
                        </div> 
                    <?php } ?>
                </div>

            </div>   
        </div>

        <!-- Mainly scripts -->
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="js/inspinia.js"></script>
        <script src="js/plugins/pace/pace.min.js"></script>
        <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script> 

        <!-- jQuery UI -->
        <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

        <!-- FooTable -->
        <script src="js/plugins/footable/footable.all.min.js"></script>

        <!-- Data Tables -->
        <script src="js/plugins/dataTables/datatables.min.js"></script>

        <script>

            $(document).ready(function() {

                $('.dataTables-example').DataTable({
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [

                    {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('primary-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                    }
                }
                ]
            });  
            });
        </script>
    </body>
    </html>
