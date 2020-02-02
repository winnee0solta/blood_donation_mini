<?php 
  include 'dbConnect.php';
  session_start();

    //check if authenticated
    if(!(isset( $_SESSION['user_id']))) {
      header ("Location: http://localhost/blood_donation/organization");
    }
    $user_id = $_SESSION['user_id'];
    //fetch organization data
    $sql = "SELECT * FROM organization_details WHERE user_id='$user_id'  LIMIT 1";
    $result = mysqli_query($conn, $sql);
    while ($i = mysqli_fetch_array($result)) {
        $user_id = $i['id']; 
    } 

  if(isset($_POST['submit'])) {
    $citizen_id_no = $_POST['citizen_id_no'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $blood_group = $_POST['blood_group'];
    $volume = $_POST['volume']; 

    $query = "INSERT into 
              donation_records (`org_id`, `citizen_id_no`, `name`,`age`, `gender`, `address`, `phone`, `blood_group`, `volume`) 
              values ('" . $user_id . "', '" . $citizen_id_no . "', '" . $name . "','" . $age . "', '" . $gender . "', '" . $address . "',
               '" . $phone . "', '" . $blood_group . "', '" . $volume . "')";
    
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