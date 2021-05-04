<?php
include("php/dbconnect.php");
include("php/checklogin.php");

$error = '';
if(isset($_POST['save']))
{
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $sql = "select * from user where emailid='$email' OR username='$username'";
    $q = $conn->query($sql);
    if($q->num_rows<=0) {
        $sqli = "INSERT INTO `user`(`emailid`, `password`, `username`, `lastlogin`) VALUES ('$email','".md5($password)."','$username','".time()."')";
        $q = $conn->query($sqli);
        echo '<script type="text/javascript">window.location="add_user.php?act=1"; </script>';
    }
    else{
        echo '<script type="text/javascript">window.location="add_user.php?act=2"; </script>';
    }
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Egnion Yomi ESP-MS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- BOOTSTRAP STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!--CUSTOM BASIC STYLES-->
    <link href="css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>

</head>
<?php
include("php/header.php");
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Add User</h1>
                <?php
                if(isset($_REQUEST['act']) &&  @$_REQUEST['act']=='1') {
                    echo '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> User Added Successfully.
                    </div>';
                }
                if(isset($_REQUEST['act']) &&  @$_REQUEST['act']=='2') {
                    echo '<div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failure!</strong> User Not added another user exists with same Email or User-name.
                    </div>';
                }
                echo $error;
                ?>
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Add New User
                    </div>
                    <form action="add_user.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="Old">User Name</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="username" name="username" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="Old">Email</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="email" name="email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="Password">Password</label>
                                <div class="col-sm-5">
                                    <input class="form-control" name="password" id="password" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="Confirm">Confirm Password</label>
                                <div class="col-sm-5">
                                    <input class="form-control" name="confirmpassword" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-4">
                                    <button type="submit" name="save" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- BOOTSTRAP SCRIPTS -->
<script src="js/bootstrap.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="js/custom1.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    $("#signupForm1").validate({
        rules: {
            username: "required",
            email: "required",
            oldpassword: "required",
            password: {
                required: true,
                minlength: 6
            },
            confirmpassword: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            }
        },
        messages: {
            username: {
                required: "Please provide a User-name.",
            },
            email: {
                required: "Please provide an email for the user",
            },
            confirmpassword: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long",
                equalTo: "Please enter the same password as above"
            }
        },
        errorElement: "em",
        errorPlacement: function(error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents(".col-sm-5").addClass("has-feedback");
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.parent("label"));
            } else {
                error.insertAfter(element);
            }
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if (!element.next("span")[0]) {
                $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>")
                    .insertAfter(element);
            }
        },
        success: function(label, element) {
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if (!$(element).next("span")[0]) {
                $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter(
                    $(element));
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
            $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
            $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
        }
    });
});
</script>


</body>

</html>