<?php
    include './dbConnect.php';

    session_start();

   if(isset($_POST['submit'])) {
     $oname = $_POST['oname'];
     $pwd = $_POST['pwd'];

      $type = 'organization';

    $query = "select * from users
            where username = '" . $oname . "'
            AND 
            password = '" . $pwd . "' 
            AND 
            type = '" . $type . "'";

     
     $result = mysqli_query($conn, $query);

     if (mysqli_num_rows($result) > 0) {
         echo "Login Success";

         $_SESSION['user_id'] = mysqli_fetch_assoc($result)['id'];

         header ("Location: http://localhost/blood_donation/organization/home.php");
     }
     else {
         //setting error
         $_SESSION['error'] = "Invalid Credentials.";
         
         header ("Location: http://localhost/blood_donation/organization");
     }
   }
   mysqli_close($conn);
   session_write_close();
?>