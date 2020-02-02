<?php

include 'dbConnect.php';
session_start();

if (isset($_POST['submit'])) {
    echo "da";
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = 'organization';

    //add to users table
    $query = "insert into
              users (`username`, `password`, `type`)
              values ('" . $username . "', '" . $password . "', '" . $type . "' )";

    if (mysqli_query($conn, $query)) {

        //get user id added user
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND type='$type' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        while ($i = mysqli_fetch_array($result)) {
            $user_id = $i['id'];
        } 

        //Add to organization_details table
        $query = "INSERT into
        organization_details (`user_id`, `name`, `address`, `email`, `phone`)
        values ('" . $user_id . "', '" . $name . "', '" . $address . "', '" . $email . "', '" . $phone . "' )";

        if (mysqli_query($conn, $query)) {
            // echo "New record created successfully";
            header("Location: http://localhost/blood_donation/admin/organization-list.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

session_write_close();
