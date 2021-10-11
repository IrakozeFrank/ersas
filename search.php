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
    <!-- Datatables -->
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <!-- Text spinners style -->
    <link href="css/plugins/textSpinners/spinners.css" rel="stylesheet">

    <!-- Jasny -->
    <link href="css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <h2 class="font-bold">Invigilator search</h2> 
            </div>

            <div class="col-md-12 m-t-lg <?php if(isset($_POST['submit'])) echo $hidden; ?>">
                <div class="ibox-content">

                    <form class="m-t" role="form" action="search" method="POST">

                        <div class="form-group m-t-lg">

                            <div class="col-lg-12"> 
                                <div class="input-group">
                                    <input type="text" name="lastname" class="form-control input-lg" placeholder="Enter lastname"> 
                                    <span class="input-group-btn"> 
                                        <button name="submit" type="submit" class="btn btn-lg btn-primary">Search</button> 
                                    </span>
                                </div>
                            </div>
                        </div> 

                        <div class="col-lg-4 m-t-lg">

                            <p class="text-muted text-left m-t-lg">
                                <a href="index" class="text-success">Back home</a>
                            </p> 
                        </div>  

                        <div class="clearfix"></div>
                    </form> 
                </div>
            </div>

            <div class="col-md-12 m-t-lg"> 

                <?php

                if (isset($_POST['submit'])) {

                    $hidden   = "hidden";
                    $lastname = $_POST['lastname']; ?>

                    <p class="text-muted text-left">
                        <a href="search" class="text-success">Back to search</a>
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
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Exam</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Room</th> 
                                        </tr>
                                    </thead>

                                    <tbody>  

                                        <?php

                                        $query  = "SELECT * FROM tbl_invigilator WHERE lastname = '$lastname'";
                                        $result = mysqli_query($conn, $query);

                                        while ($row = mysqli_fetch_array($result)) { 

                                            $firstname = $row['firstname'];
                                            $lastname  = $row['lastname'];
                                            $invig_id  = $row['invig_id'];

                                            $sql1  = "SELECT * FROM tbl_allot WHERE invig = $invig_id";
                                            $res1  = mysqli_query($conn, $sql1);

                                            while ($row1 = mysqli_fetch_array($res1)){

                                                $exam = $row1['exam'];
                                                $room = $row1['room']; 

                                                ?>

                                                <tr> 
                                                    <td><?php echo $firstname; ?></td> 
                                                    <td><?php echo $lastname; ?></td> 
                                                    <td>
                                                        <?php 

                                                        $sql3 = "SELECT * FROM tbl_exam WHERE exam_id = $exam";
                                                        $res3 = mysqli_query($conn, $sql3);
                                                        $row3 = mysqli_fetch_array($res3);
                                                        echo $row3['course']." [".$row3['dept']." ".$row3['year']."]";

                                                        ?>                                                   
                                                    </td>
                                                    <td><?php echo $row3['edate']; ?></td>
                                                    <td><?php echo $row3['etime']; ?></td>
                                                    <td>
                                                        <?php 

                                                        $sql2 = "SELECT * FROM tbl_room WHERE room_id = $room";
                                                        $res2 = mysqli_query($conn, $sql2);
                                                        $row2 = mysqli_fetch_array($res2);
                                                        echo $row2['room_no']." ".$row2['location'];

                                                        ?>                                                   
                                                    </td>
                                                </tr>

                                            <?php } } ?>

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
