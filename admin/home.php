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
    <title>Blood Donation Record | Home</title>

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <div class="header">
      <div class="float-left">
        <p style="font-family: 'Brush Script MT', Times, serif; color:white; font-size: 30px;">Blood Donation Records</p>
      </div>
      <div class="float-right">
        <form action="./logout.php" method="POST" style="margin:0px">
          <button type="submit" name="logout"><i class="fas fa-power-off w3-xlarge"></i></button>
        </form>
      </div>
    </div>

    <div class="shadow-lg p-3 mb-5 bg-white rounded overflow-auto col-md-8 inner" style="margin:auto; height: 70vh;">
      <table class="table">
        <thead class="grad" style="color:white;" align="center">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Donor Name</th>
            <th scope="col">Contact Number</th>
            <th scope="col">Blood Group</th>
            <th scope="col">Volume of Blood Donated <br>(in ml)</th>
            <th scope="col">Gender</th>
            <th scope="col">Organization</th>
            <th scope="col">Donation Date</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if (mysqli_num_rows($result) > 0){
              $i = 0;
              while($row = mysqli_fetch_assoc($result)) { 
                $i++;
          ?>
                <tr>
                  <td scope="row"><b><?php echo $i ?></b></td>
                  <td><?php echo $row['donorName'] ?></td>
                  <td><?php echo $row['donorContactNumber'] ?></td>
                  <td><?php echo strtoupper($row['donatedBloodGroup']) ?></td>
                  <td align="center"><?php echo $row['donatedVolume'] ?></td>
                  <td><?php echo $row['donorGender'] ?></td>
                  <td><?php echo $row['organizationName'] ?></td>
                  <td><?php echo $row['donationDate'] ?></td>
                </tr>
          <?php
              }
            }
            else {
          ?>
            <tr>
              <th>No Data</th>
            </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

<?php
  mysqli_close($conn);
  session_write_close();
?>