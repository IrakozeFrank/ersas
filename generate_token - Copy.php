<?php

include_once 'connection.php';
include_once 'session.php';

$error = "";

if (isset($_POST['submit'])) {

    if(!isset($_POST['gtoken'])){

        $error = " <div class='alert alert-danger alert-dismissable text-center'>
        <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
        <strong>Error ! </strong> Please fill all the fields
        </div>";

    }else{

        $exam_id = secure_inputs($_POST['gtoken']);
        $sql     = "SELECT * FROM tbl_student WHERE exam = 0 OR token = 0";
        $res     = mysqli_query($conn, $sql); 
        $count   = mysqli_num_rows($res);

        if ($count) {

            $sql     = "SELECT * FROM tbl_student";
            $res     = mysqli_query($conn, $sql);
            $row     = mysqli_fetch_array($res);
            $id      = $row['stu_id'];

            for ($i = 0; $i <= $count; $i++) { 

                $id      = $id + 1;
                $token   = mt_rand(10000, 99999)." - ".$id;
                $query   = "UPDATE tbl_student SET token = '$token' WHERE exam = $exam_id";
                $result  = mysqli_query($conn, $query);

                if($result){

                    $error = " <div class='alert alert-success alert-dismissable text-center'>

                    <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
                    Success
                    </div>";

                    echo "<script>window.location = 'generate_token'</script>";

                }else{

                    $error = "<div class='alert alert-danger alert-dismissable text-center'>

                    <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
                    An error occured. Try again.
                    </div>";
                }
            }

        }else{

            $error = " <div class='alert alert-danger alert-dismissable text-center'>
            <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
            <strong>Error ! </strong> Tokens already generated.
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
                            <li class="">
                                <a aria-expanded="false" role="button" href="admin"> Main Dashboard</a>
                            </li>

                            <li class="">
                                <a aria-expanded="false" role="button" href="allot_room"> Allot room</a>
                            </li>

                            <li class="active">
                                <a aria-expanded="false" role="button" href="generate_token"> Generate tokens</a>
                            </li>

                            <li class="">
                                <a aria-expanded="false" role="button" href="register_room"> Register a room</a>
                            </li>

                            <li>
                                <a aria-expanded="false" role="button" href="create_exam"> Create Exam</a>
                            </li>

                            <li class="">
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

            <!------------------------------------------------->
            <!--                  MAIN PAGE                  -->
            <!------------------------------------------------->

            <div class="wrapper wrapper-content">
                <div class="container">

                    <div class="row col-lg-10">
                        <div class="ibox-title">
                            <h5>Generate exam tokens</h5> 
                        </div>

                        <div class="ibox-content">
                            <form class="form-horizontal" method="POST" action="generate_token">

                                <?php echo $error; ?>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Choose allocation</label>
                                    <div class="col-lg-7">
                                        <select class="form-control" name="gtoken">
                                            <option selected="" disabled=""> Select...</option>
                                            <
                                            <?php

                                            $sql = "SELECT * FROM tbl_allot";
                                            $res = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_array($res)) { 

                                                $exam_id = $row['exam'];
                                                $room_id = $row['room']; 

                                                $sql1  = "SELECT * FROM tbl_room WHERE room_id = $room_id";
                                                $res1  = mysqli_query($conn, $sql1);
                                                $row1  = mysqli_fetch_array($res1);
                                                $room  = $row1['room_no']." ".$row1['location'];

                                                $sql2  = "SELECT * FROM tbl_exam WHERE exam_id = $exam_id";
                                                $res2  = mysqli_query($conn, $sql2);
                                                $row2  = mysqli_fetch_array($res2);
                                                $exam  = $row2['course']." [".$row2['dept']."-0".$row2['year']."]";
                                                ?>

                                                <option value="<?php echo $row['exam'] ?>">
                                                    <?php echo $room ." &mdash; ".$exam?>
                                                </option>

                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <button class="btn btn-block btn-md btn-success" name="submit" type="submit">Generate</button>
                                    </div>
                                </div>  
                            </form>
                        </div>
                    </div>

                    <div class="row m-t col-lg-10">
                        <h4>Query</h4>

                        <?php 

                            $query  = "SELECT * FROM tbl_student WHERE exam = 1";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($result)) {
                                
                                $firstname = $row['firstname'];
                                $lastname  = $row['lastname'];
                                echo "Names: $firstname ($lastname) <br />";
                            }
                        ?>
                    </div>

                    <!------------------------------------------------->
                    <!--               EXAM TOKEN LIST               -->
                    <!------------------------------------------------->
                    <div class="row col-lg-12 m-t-lg"> 
                        <div class="ibox float-e-margins"> 

                            <div class="ibox-title">
                                <h5>Exam Tokens</h5>
                            </div>

                            <div class="ibox-content">
                                <div class="table-responsive"> 

                                    <input type="text" class="form-control input-md m-b" id="filter" placeholder="Search..."> 

                                    <table class="footable table table-bordered" data-page-size="10" data-filter=#filter>

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

                                                ?>

                                                <tr> 
                                                    <td><?php echo $regno; ?></td>
                                                    <td><?php echo $names; ?></td>
                                                    <td><?php echo $class; ?></td>
                                                    <td><?php echo $token; ?></td>
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

                <!----------------------------------------->
                <!--               FOOTER                -->
                <!----------------------------------------->

                <?php include_once 'footer.php'; ?>
