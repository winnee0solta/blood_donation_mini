<?php
    include './dbConnect.php';
    session_start();

    $query = "select 
              donationrecord.donorName, donationrecord.donorContactNumber, donationrecord.donatedBloodGroup, donationrecord.donatedVolume, donationrecord.donorGender, donationrecord.donationDate, users.organizationName 
              from donationrecord 
              inner join users on donationrecord.organizationID=users.id ";
    $result = mysqli_query($conn,$query);

    if(!(isset( $_SESSION['user_id']))) {
      header ("Location: http://localhost/blood_donation/admin");
  }
?>
<html>
  <head>
    <title>Admin | Home</title> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
 
  </head>
  <body>

  <!-- topnav -->
  <?php 
   include './topnav.php';
  ?>
  <!--ENDS topnav --> 

  <div class="container-fluid my-3">
    <div class="flex">
      <div>
        <a href="/blood_donation/admin/organization-list.php" class="btn btn-danger">Organization List</a>
      </div> 
    </div>
  </div>

    <!-- table  -->

          <div class="container mt-4">
            <div class="card">
                <div class="table-responsive">
                  <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#S.N</th>
                            <th scope="col">Date</th>
                            <th scope="col">Name</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Blood Group</th>
                            <th scope="col">Volume (in ml)</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Citizen Id</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            //fetch all organization list
                            $sql = "SELECT * FROM donation_records  ";
                            $result = mysqli_query($conn, $sql); 
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                $count = 1;
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                    <tr>
                                        <th scope="row">'. $count.'</th>
                                        <td>'. $row["record_date"]. '</td>
                                        <td class="text-capitalize">'. $row["name"]. '</td>
                                        <td>'. $row["age"]. '</td>
                                        <td class="text-capitalize">'. $row["gender"]. '</td>
                                        <td>'. $row["blood_group"]. '</td>
                                        <td>'. $row["volume"]. '</td>
                                        <td class="text-capitalize">'. $row["address"]. '</td>
                                        <td>'. $row["phone"]. '</td>
                                        <td>'. $row["citizen_id_no"]. '</td> ';
                                   $count++;

                                }
                            } else {
                                echo "0 results";
                            } 

                        ?>  
                        <!-- <form action="./removeRecord.php" method="POST">
                        <input name="record_id" value="text" style="display:none;">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form> -->
                    </tbody>
                </table>
                </div>
            </div>
        </div>

  <!--Ends table  -->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

<?php
  mysqli_close($conn);
  session_write_close();
?>