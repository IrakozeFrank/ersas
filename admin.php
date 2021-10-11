<?php 

include_once 'connection.php';
include_once 'session.php';

?>
<!DOCTYPE html>
<html>

<?php include_once 'head.php'; ?>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top" role="navigation">

                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="admin" class="navbar-brand">ERSAS</a>
                    </div>

                    <div class="navbar-collapse collapse" id="navbar">

                        <ul class="nav navbar-nav">
                            <li class="active">
                                <a aria-expanded="false" role="button" href="admin"> Main Dashboard</a>
                            </li>

                            <li>
                                <a aria-expanded="false" role="button" href="allot_room"> Allot room</a>
                            </li>

                            <li>
                                <a aria-expanded="false" role="button" href="generate_token"> Generate tokens</a>
                            </li>

                            <li>
                                <a aria-expanded="false" role="button" href="register_room"> Register a room</a>
                            </li>

                            <li>
                                <a aria-expanded="false" role="button" href="create_exam"> Create Exam</a>
                            </li>

                            <li>
                                <a aria-expanded="false" role="button" href="register_invig"> Register Invigilator</a>
                            </li>
                        </ul>

                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="logout">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="wrapper wrapper-content">
                <div class="container"> 

                    <div class="row">

                        <!-- IT Students -->
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right">
                                        IT
                                    </span>
                                    <h5>Information Technology</h5>
                                </div> 

                                <?php 

                                $sql      = "SELECT * FROM tbl_student WHERE dept = 'IT'"; 
                                if ($sres = mysqli_query($conn, $sql));
                                $stot     = mysqli_num_rows($sres);

                                $sql      = "SELECT * FROM tbl_exam WHERE dept = 'IT'"; 
                                if ($eres = mysqli_query($conn, $sql));
                                $etot     = mysqli_num_rows($eres);

                                ?>

                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h1 class="no-margins"><?php echo $stot; ?></h1> 
                                            <small>Students</small>
                                        </div>

                                        <div class="col-lg-6">
                                            <h1 class="no-margins"><?php echo $etot; ?></h1> 
                                            <small>Exams</small>
                                        </div>
                                    </div>
                                    
                                </div>  

                            </div>
                        </div>

                        <!-- IS Students -->
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-success pull-right">
                                        IS
                                    </span>
                                    <h5>Information Systems</h5>
                                </div> 

                                <?php 

                                $sql      = "SELECT * FROM tbl_student WHERE dept = 'IS'"; 
                                if ($sres = mysqli_query($conn, $sql));
                                $stot     = mysqli_num_rows($sres);

                                $sql      = "SELECT * FROM tbl_exam WHERE dept = 'IS'"; 
                                if ($eres = mysqli_query($conn, $sql));
                                $etot     = mysqli_num_rows($eres);

                                ?>

                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h1 class="no-margins"><?php echo $stot; ?></h1> 
                                            <small>Students</small>
                                        </div>

                                        <div class="col-lg-6">
                                            <h1 class="no-margins"><?php echo $etot; ?></h1> 
                                            <small>Exams</small>
                                        </div>
                                    </div>
                                    
                                </div>  

                            </div>
                        </div>

                        <!-- CS Students -->
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-warning pull-right">
                                        CS
                                    </span>
                                    <h5>Computer Science</h5>
                                </div> 

                                <?php 

                                $sql      = "SELECT * FROM tbl_student WHERE dept = 'CS'"; 
                                if ($sres = mysqli_query($conn, $sql));
                                $stot     = mysqli_num_rows($sres);

                                $sql      = "SELECT * FROM tbl_exam WHERE dept = 'CS'"; 
                                if ($eres = mysqli_query($conn, $sql));
                                $etot     = mysqli_num_rows($eres);

                                ?>

                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h1 class="no-margins"><?php echo $stot; ?></h1> 
                                            <small>Students</small>
                                        </div>

                                        <div class="col-lg-6">
                                            <h1 class="no-margins"><?php echo $etot; ?></h1> 
                                            <small>Exams</small>
                                        </div>
                                    </div>
                                    
                                </div>  

                            </div>
                        </div>
                    </div> 


                    <!------------------------------------------------->
                    <!--                 REG PERIOD                  -->
                    <!------------------------------------------------->

                    <!-- <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox-title">
                                <h5>Registration</h5> 
                            </div>

                            <div class="ibox-content">
                                 
                            </div>
                        </div>
                    </div> -->

                    <!------------------------------------------------->
                    <!--               EXAM TOKEN LIST               -->
                    <!-------------------------------------------------> 
                    <div class="row m-t-lg"> 
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins"> 

                                <div class="ibox-title">
                                    <h5>Exam Tokens</h5>
                                </div>

                                <div class="ibox-content">
                                    <div class="table-responsive"> 

                                        <input type="text" class="form-control input-md m-b" id="filter" placeholder="Search..."> 

                                        <table class="footable table table-bordered dataTables-example" data-page-size="10" data-filter=#filter>

                                            <thead>
                                                <tr>
                                                    <th>Regno</th>
                                                    <th>Names</th>
                                                    <th>Class</th>
                                                    <th>Token</th>
                                                    <th>Exam</th>
                                                    <th>Room</th>
                                                    <th>Invigilator</th>
                                                </tr>
                                            </thead>

                                            <tbody>  

                                                <?php

                                                $query  = "SELECT * FROM tbl_student WHERE token != 0 ORDER BY exam";
                                                $result = mysqli_query($conn, $query);

                                                while ($row = mysqli_fetch_array($result)) { 

                                                    $regno  = $row['regno'];
                                                    $names  = $row['firstname']." ".$row['lastname'];
                                                    $token  = $row['token'];
                                                    $exam   = $row['exam'];
                                                    $class  = $row['dept']."-0".$row['year'];

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
                                                        <td><?php echo $class; ?></td>
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

                                            <tfoot>
                                                <tr>
                                                    <td colspan="7">
                                                        <ul class="pagination pull-right"></ul>
                                                    </td>
                                                </tr>
                                            </tfoot>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!----------------------------------------->
                <!--               FOOTER                -->
                <!----------------------------------------->

                <?php include_once 'footer.php'; ?>
