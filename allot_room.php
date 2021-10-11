<?php

include_once 'connection.php';
include_once 'session.php';

$error = "";

if (isset($_REQUEST['delete'])) {

    $allot_id = $_REQUEST['delete'];
    $query    = "DELETE FROM tbl_allot WHERE allot_id = $allot_id";
    $result   = mysqli_query($conn, $query);

    if ($result) {

        $error = "<div class='alert alert-success alert-dismissable'>
        <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
        Site Deleted Successfully.
        </div>";

        echo "<script>window.location = 'allot_room'</script>";

    }else{

        $error = "<div class='alert alert-danger alert-dismissable text-center'>
        <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
        An error has occured. Please try again!
        </div>";
    }
}

if (isset($_POST['submit'])) {

    if(!isset($_POST['exam']) || !isset($_POST['room']) || !isset($_POST['invig'])){

        $error = " <div class='alert alert-danger alert-dismissable text-center'>
        <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
        <strong>Error ! </strong> Please fill all the fields
        </div>";

    }else{

        $exam    = secure_inputs($_POST['exam']);
        $room    = secure_inputs($_POST['room']);
        $invig   = secure_inputs($_POST['invig']);

        $query   = "INSERT INTO tbl_allot (exam, room, invig) VALUES ('$exam','$room', '$invig')";
        $result  = mysqli_query($conn, $query);

        if($result){

            $error = " <div class='alert alert-success alert-dismissable text-center'>

            <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
            Success
            </div>";

            echo "<script>window.location = 'allot_room'</script>";

        }else{

            $error = "<div class='alert alert-danger alert-dismissable text-center'>

            <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
            An error occured. Try again.
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

                            <li class="active">
                                <a aria-expanded="false" role="button" href="allot_room"> Allot room</a>
                            </li>

                            <li>
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
                            <h5>New Exam Room Allocation</h5> 
                        </div>

                        <div class="ibox-content">
                            <form class="form-horizontal" method="POST" action="allot_room">

                                <?php echo $error; ?>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Course Exam</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" name="exam">
                                            <option selected="" disabled=""> Select Exam...</option>
                                            <
                                            <?php

                                            $sql = "SELECT * FROM tbl_exam";
                                            $res = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_array($res)) { 

                                                $exam = $row['course']." &nbsp; [ ".$row['dept']." year ".$row['year']." ]";

                                                ?>

                                                <option value="<?php echo $row['exam_id'] ?>">
                                                    <?php echo $exam; ?>
                                                </option>

                                            <?php } ?>
                                        </select>
                                    </div> 
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Room</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" name="room">
                                            <option selected="" disabled=""> Select Room...</option>
                                            <
                                            <?php

                                            $sql = "SELECT * FROM tbl_room";
                                            $res = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_array($res)) { 

                                                $room = $row['location']." &nbsp; [ ".$row['room_no']." ]";

                                                ?>

                                                <option value="<?php echo $row['room_id'] ?>">
                                                    <?php echo $room; ?>
                                                </option>

                                            <?php } ?>

                                        </select>
                                    </div> 
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Invigilator</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" name="invig">
                                            <option selected="" disabled=""> Select invigilator...</option>
                                            <
                                            <?php

                                            $sql = "SELECT * FROM tbl_invigilator";
                                            $res = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_array($res)) { 

                                                $invigilator = $row['firstname']." ".$row['lastname']." [ ".$row['dept']. " ]";

                                                ?>

                                                <option value="<?php echo $row['invig_id'] ?>">
                                                    <?php echo $invigilator; ?>
                                                </option>

                                            <?php } ?>
                                        </select>
                                    </div> 
                                </div>

                                <div class="form-group m-t-lg">
                                    <div class="col-lg-offset-2 col-lg-4">
                                        <button class="btn btn-block btn-md btn-success" name="submit" type="submit">Allocate</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!------------------------------------------------->
                    <!--            ROOM ALLOCATION LIST             -->
                    <!------------------------------------------------->
                    <div class="row col-lg-10 m-t-lg">
                        <div class="ibox float-e-margins"> 

                            <div class="ibox-title">
                                <h5>Room Allocation List</h5>
                            </div>

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <input type="text" class="form-control input-md m-b" id="filter" placeholder="Search..."> 

                                    <table class="footable table table-bordered dataTables-example" data-page-size="10" data-filter=#filter>

                                        <thead>
                                            <tr>
                                                <th>Exam</th>
                                                <th>Room</th>
                                                <th>Invigilator</th> 
                                            </tr>
                                        </thead>

                                        <tbody>  

                                            <?php

                                            $query  = "SELECT * FROM tbl_allot";
                                            $result = mysqli_query($conn, $query);

                                            while ($row = mysqli_fetch_array($result)) { 

                                                $exam  = $row['exam'];
                                                $room  = $row['room'];
                                                $invig = $row['invig'];

                                                ?>

                                                <tr> 
                                                    <td>
                                                        <?php 

                                                        $sql  = "SELECT * FROM tbl_exam WHERE exam_id = $exam;";
                                                        $res  = mysqli_query($conn, $sql);
                                                        $rows = mysqli_fetch_array($res);
                                                        echo $rows['course'];

                                                        ?>                                                   
                                                    </td>

                                                    <td>
                                                        <?php 

                                                        $sql  = "SELECT * FROM tbl_room WHERE room_id = $room;";
                                                        $res  = mysqli_query($conn, $sql);
                                                        $rows = mysqli_fetch_array($res);
                                                        echo $rows['location']." [ ".$rows['room_no']." ]";

                                                        ?>                                                   
                                                    </td>

                                                    <td>
                                                        <?php 

                                                        $sql  = "SELECT * FROM tbl_invigilator WHERE invig_id = $invig;";
                                                        $res  = mysqli_query($conn, $sql);
                                                        $rows = mysqli_fetch_array($res);
                                                        echo $rows['firstname']." ".$rows['lastname']." [ ".$rows['dept']." ]";

                                                        ?>                                                   
                                                    </td> 
                                                </tr>

                                            <?php } ?>

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
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
