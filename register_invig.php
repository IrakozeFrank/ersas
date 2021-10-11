<?php

include_once 'connection.php';
include_once 'session.php';

$error = "";

if (isset($_REQUEST['delete'])) {

    $invig_id = $_REQUEST['delete'];
    $query    = "DELETE FROM tbl_invigilator WHERE invig_id = $invig_id";
    $result   = mysqli_query($conn, $query);

    if ($result) {

        $error = "<div class='alert alert-success alert-dismissable'>
        <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
        Site Deleted Successfully.
        </div>";

        echo "<script>window.location = 'register_invig'</script>";

    }else{

        $error = "<div class='alert alert-danger alert-dismissable text-center'>
        <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
        An error has occured. Please try again!
        </div>";
    }
}

if (isset($_POST['submit'])) {

    $firstname = secure_inputs($_POST['firstname']);
    $lastname  = secure_inputs($_POST['lastname']);

    if(empty($firstname) || empty($lastname) || !isset($_POST['dept'])){

        $error = " <div class='alert alert-danger alert-dismissable text-center'>
            <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
            <strong>Error ! </strong> Please fill all the fields
        </div>";

    }else{

        $dept    = secure_inputs($_POST['dept']);
        $query   = "INSERT INTO tbl_invigilator (firstname, lastname, dept) VALUES ('$firstname','$lastname', '$dept')";
        $result  = mysqli_query($conn, $query);

        if($result){

            $error = " <div class='alert alert-success alert-dismissable text-center'>

            <button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>
            Success
            </div>";

            echo "<script>window.location = 'register_invig'</script>";

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

                            <li>
                                <a aria-expanded="false" role="button" href="create_exam"> Create Exam</a>
                            </li>

                            <li class="active">
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
                            <h5>Create New Exam Invigilator</h5> 
                        </div>

                        <div class="ibox-content">
                            <form class="form-horizontal" method="POST" action="register_invig">

                                <?php echo $error; ?>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Firstname</label>
                                    <div class="col-lg-10">
                                        <input type="text" placeholder="firstname" name="firstname" class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Lastname</label>
                                    <div class="col-lg-10">
                                        <input type="text" placeholder="lastname" name="lastname" class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Department</label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-b" name="dept">
                                            <option selected="" disabled=""> Select Department...</option>
                                            <option value="IS">Information System - IS</option>
                                            <option value="IT">Information Technology - IT</option>
                                            <option value="CS">Computer Science - CS</option>
                                        </select>
                                    </div> 
                                </div>

                                <div class="form-group m-t-lg">
                                    <div class="col-lg-offset-2 col-lg-4">
                                        <button class="btn btn-block btn-md btn-success" name="submit" type="submit">Add Invigilator</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!------------------------------------------------->
                    <!--              INVIGILATOR LIST               -->
                    <!------------------------------------------------->
                    <div class="row col-lg-10 m-t-lg">
                            <div class="ibox float-e-margins"> 

                                <div class="ibox-title">
                                    <h5>Invigilator List</h5>
                                </div>

                                <div class="ibox-content">
                                    <div class="table-responsive"> 

                                        <input type="text" class="form-control input-md m-b" id="filter" placeholder="Search..."> 

                                        <table class="footable table table-bordered dataTables-example" data-page-size="10" data-filter=#filter>

                                            <thead>
                                                <tr>
                                                    <th>Firstname</th>
                                                    <th>Lastname</th>
                                                    <th>Dept</th> 
                                                </tr>
                                            </thead>

                                            <tbody>  

                                                <?php

                                                $query  = "SELECT * FROM tbl_invigilator";
                                                $result = mysqli_query($conn, $query);

                                                while ($row = mysqli_fetch_array($result)) {

                                                    $firstname = $row['firstname'];
                                                    $lastname  = $row['lastname'];
                                                    $dept      = $row['dept']; 

                                                    ?>

                                                    <tr>
                                                        <td><?php echo $firstname; ?></td>
                                                        <td><?php echo $lastname; ?></td>
                                                        <td><?php echo $dept; ?></td> 
                                                        <td>
                                                            <a class="btn btn-xs btn-danger" href="register_invig?delete=<?php echo $row['invig_id']; ?>">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                        </td>
                                                    </tr>

                                                <?php } ?>

                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">
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
