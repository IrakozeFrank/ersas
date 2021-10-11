<?php

include_once 'connection.php';
include_once 'session.php';

$error = "";

if (isset($_REQUEST['delete'])) {

    $exam_id = $_REQUEST['delete'];
    $query   = "DELETE FROM tbl_exam WHERE exam_id = $exam_id";
    $result  = mysqli_query($conn, $query);

    if ($result) {

        $error = "<div class='alert alert-success alert-dismissable'>
        <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
        Site Deleted Successfully.
        </div>";

        echo "<script>window.location = 'create_exam'</script>";

    }else{

        $error = "<div class='alert alert-danger alert-dismissable text-center'>
        <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
        An error has occured. Please try again!
        </div>";
    }
}

if (isset($_POST['submit'])) {

    $course   = secure_inputs($_POST['course']);
    $edate    = secure_inputs($_POST['edate']);
    $etime    = secure_inputs($_POST['etime']); 

    if(empty($course) || empty($edate) || empty($etime) || !isset($_POST['dept']) || !isset($_POST['year'])){

        $error = "
        <div class='alert alert-danger alert-dismissable text-center'>
        <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
        <strong>Error ! </strong> Please fill all the fields
        </div>";

    }else{

        $dept    = secure_inputs($_POST['dept']);
        $year    = secure_inputs($_POST['year']);
        $query   = "INSERT INTO tbl_exam (course, dept, year, edate, etime) VALUES ('$course','$dept', '$year', '$edate', '$etime')";
        $result  = mysqli_query($conn, $query);

        if($result){

            $error = " <div class='alert alert-success alert-dismissable text-center'>

            <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
            Success
            </div>";

            echo "<script>window.location = 'create_exam'</script>";

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

                            <li>
                                <a aria-expanded="false" role="button" href="allot_room"> Allot room</a>
                            </li>

                            <li>
                                <a aria-expanded="false" role="button" href="generate_token"> Generate token</a>
                            </li>

                            <li class="">
                                <a aria-expanded="false" role="button" href="register_room"> Register a room</a>
                            </li>

                            <li class="active">
                                <a aria-expanded="false" role="button" href="create_exam"> Create exam</a>
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

            <!------------------------------------------------->
            <!--                  MAIN PAGE                  -->
            <!------------------------------------------------->

            <div class="wrapper wrapper-content">
                <div class="container">

                    <div class="row col-lg-10">
                        <div class="ibox-title">
                            <h5>Create New Exam</h5> 
                        </div>

                        <div class="ibox-content">
                            <form class="form-horizontal" method="POST" action="create_exam">

                                <?php echo $error; ?>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Course</label>
                                    <div class="col-lg-10">
                                        <input type="text" placeholder="Course name" name="course" class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Department</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" name="dept">
                                            <option selected="" disabled=""> Select Department...</option>
                                            <option value="IS">Information System - IS</option>
                                            <option value="IT">Information Technology - IT</option>
                                            <option value="CS">Computer Science - CS</option>
                                        </select>
                                    </div> 
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Year</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" name="year">
                                            <option selected="" disabled=""> Select Year...</option>
                                            <option value="1">Year 01</option>
                                            <option value="2">Year 02</option>
                                            <option value="3">Year 03</option>
                                            <option value="4">Year 04</option>
                                        </select>
                                    </div> 
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Date</label>
                                    <div class="col-lg-10">
                                        <input type="Date" placeholder="Exam date" name="edate" class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Time</label>
                                    <div class="col-lg-10">
                                        <input type="Time" placeholder="Time of the exam" name="etime" class="form-control"> 
                                    </div>
                                </div> 

                                <div class="form-group m-t-lg">
                                    <div class="col-lg-offset-2 col-lg-4">
                                        <button class="btn btn-block btn-md btn-success" name="submit" type="submit">Add Exam</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!------------------------------------------------->
                    <!--                  EXAMS LIST                 -->
                    <!------------------------------------------------->
                    <div class="row col-lg-10 m-t-lg">
                        <div class="ibox float-e-margins"> 

                            <div class="ibox-title">
                                <h5>Exams List</h5>
                            </div>

                            <div class="ibox-content">
                                <div class="table-responsive">

                                    <input type="text" class="form-control input-md m-b" id="filter" placeholder="Search..."> 

                                    <table class="footable table table-bordered dataTables-example" data-page-size="10" data-filter=#filter>

                                        <thead>
                                            <tr>
                                                <th>Course</th>
                                                <th>Department</th>
                                                <th>Year</th> 
                                                <th>Date</th> 
                                                <th>Time</th> 
                                            </tr>
                                        </thead>

                                        <tbody>  

                                            <?php

                                            $query  = "SELECT * FROM tbl_exam";
                                            $result = mysqli_query($conn, $query);

                                            while ($row = mysqli_fetch_array($result)) {

                                                $course = $row['course'];
                                                $dept   = $row['dept'];
                                                $year   = $row['year']; 
                                                $date   = $row['edate']; 
                                                $time   = $row['etime']; 

                                                ?>

                                                <tr>
                                                    <td><?php echo $course; ?></td>
                                                    <td><?php echo $dept; ?></td>
                                                    <td><?php echo $year; ?></td> 
                                                    <td><?php echo $date; ?></td> 
                                                    <td><?php echo $time; ?></td> 
                                                    <td>
                                                        <a class="btn btn-xs btn-danger" href="create_exam?delete=<?php echo $row['exam_id']; ?>">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </a>
                                                    </td>
                                                </tr>

                                            <?php } ?>

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="5">
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
