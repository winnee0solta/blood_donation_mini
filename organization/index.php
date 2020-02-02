<?php
    include './dbConnect.php';

    //starting session
    session_start();
    
    if(isset( $_SESSION['user_id'])) {
        header ("Location: http://localhost/blood_donation/admin/home.php");
    }
?>

<html>
    <head>
        <title>  Login</title>

        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body id="grad">
        <div class="center-align">
            <div class="shadow-lg p-3 mb-5 bg-white rounded" style="padding: 50px !important">
                <h3 align="center" style="padding-bottom: 50px">Organization Login</h3>
                <!-- FORM PROCESSED IN LOGIN.PHP --> 
                <form action="./login.php" method="POST">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <input type="text" name="oname" class="form-control form-control-lg" placeholder="Username" required autocomplete="off">
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                             <i class="fas fa-lock"></i>
                            </div>
                        </div>                    
                        <input type="password" name="pwd" class="form-control form-control-lg" placeholder="Password" required><br>
                    </div>
                    <?php  
                    //displaying error       
                    if(isset($_SESSION['error'])) {
                        echo "<p class='error'>" . $_SESSION['error'] . "</p>";
                        unset($_SESSION["error"]);
                    }
                    else {
                        echo "<br>";
                    }
                    ?>
                    <input type="submit" name="submit" value="Login" class="form-control form-control-lg">
                </form>             
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>

<?php
    session_write_close();
?>