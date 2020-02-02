<?php
  session_start();

  if(isset($_POST['logout'])) {
    //CLEARING SESSION  
    session_destroy();

    session_write_close();

    header ("Location: http://localhost/blood_donation/admin");
  }
?>