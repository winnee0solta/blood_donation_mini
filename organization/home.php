<?php
    include './dbConnect.php';
    session_start();

    $query = "select * from donationrecord where organizationID=" . $_SESSION['user_id'];
    $result = mysqli_query($conn,$query);

    if(!(isset( $_SESSION['user_id']))) {
      header ("Location: http://localhost/blood_donation/organization");
  }
?>
<html>
  <head>
    <title>Blood Donation Record | Home</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body>  
    <form action="./logout.php" method="POST">
      <input type="submit" name="logout" value="logout"> 
    </form>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Donor Name</th>
          <th scope="col">Contact Number</th>
          <th scope="col">Blood Group</th>
          <th scope="col">Volume of Blood Donated (in ml)</th>
          <th scope="col">Gender</th>
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
                <th scope="row"><?php echo $i ?></th>
                <td><?php echo $row['donorName'] ?></td>
                <td><?php echo $row['donorContactNumber'] ?></td>
                <td><?php echo strtoupper($row['donatedBloodGroup']) ?></td>
                <td><?php echo $row['donatedVolume'] ?></td>
                <td><?php echo $row['donorGender'] ?></td>
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

    <form action="./addRecord.php" method="POST">
      Donor Citizenship ID: <input type="text" name="dCitizenshipID" required><br>
      Donor Name: <input type="text" name="dName" required><br>
      Donor Contact Number: <input type="number" name="dPhone" required><br>
      Blood Group: <select name="dType">
                    <option value="O+">O+</option>
                    <option value="O+">O-</option>
                    <option value="O+">A+</option>
                    <option value="O+">A-</option>
                    <option value="O+">B+</option>
                    <option value="O+">B-</option>
                    <option value="O+">AB+</option>
                    <option value="O+">AB-</option>
                  </select><br>
      Volume of Blood Donated: <input type="text" name="dVol" required><br>
      Donor's Gender: <input type="radio" name="dGender" value="M" required>Male
                      <input type="radio" name="dGender" value="F" required>Female
                      <input type="radio" name="dGender" value="O" required>Others<br>
      <input type="hidden" name="oid" value =<?php echo $_SESSION['user_id'] ?>>
      <input type="hidden" name="date" value =<?php echo date("Y-m-d") ?>>
      <input type="submit" name="submit" id="submit">
    </form>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

<?php
  mysqli_close($conn);
  session_write_close();
?>