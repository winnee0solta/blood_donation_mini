<?php 
  include 'dbConnect.php';
  session_start();

  if(isset($_POST['submit'])) {
    $dCitizenshipID = $_POST['dCitizenshipID'];
    $dname = $_POST['dName'];
    $dPhone = $_POST['dPhone'];
    $dType = $_POST['dType'];
    $dVol = $_POST['dVol'];
    $dGender = $_POST['dGender'];
    $date = $_POST['date'];
    $oid = $_POST['oid'];

    $query = "insert into 
              donationrecord (`citizenshipID`, `donorName`, `donorContactNumber`, `donatedBloodGroup`, `donatedVolume`, `donorGender`, `donationDate`, `organizationID`) 
              values ('" . $dCitizenshipID . "', '" . $dname . "', '" . $dPhone . "', '" . $dType . "', '" . $dVol . "', '" . $dGender . "', '" . $date . "', '" . $oid . "')";
    
    if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
        header ("Location: http://localhost/blood_donation/organization/home.php");
    } 
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
  }

  session_write_close();
?>