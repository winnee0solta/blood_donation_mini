<?php
include 'dbConnect.php';
session_start();

//check if authenticated
if (!(isset($_SESSION['user_id']))) {
    header("Location: http://localhost/blood_donation/organization");
}
$user_id = $_SESSION['user_id'];
//fetch organization data
$sql = "SELECT * FROM organization_details WHERE user_id='$user_id'  LIMIT 1";
$result = mysqli_query($conn, $sql);
while ($i = mysqli_fetch_array($result)) {
    $org_id = $i['id'];
}

if (isset($_POST['submit'])) {
    $record_id = $_POST['record_id']; 

    $query = "DELETE FROM donation_records  WHERE id='$record_id'";

    if (mysqli_query($conn, $query)) {
        echo "Record deleted successfully"; 
        header("Location: http://localhost/blood_donation/organization/home.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

session_write_close();
