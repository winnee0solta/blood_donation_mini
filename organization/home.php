<?php
    include './dbConnect.php';
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
        $oname = $i['name']; 
    } 
?>
<html>
  <head>
    <title>Blood Donation Record | Home</title> 
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

  <!-- add record  -->
      <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add New Record
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="addneworgmodel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addneworgmodel">Add New Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="./dbRecord.php" method="POST">
                        <div class="modal-body">
                            <!--   Citizen No -->
                            <div class="form-group">
                                <label>Donor Citizen Id No</label>
                                <input name="citizen_id_no" type="text" class="form-control"
                                    placeholder="Enter Donor Citizen Id No" required>
                            </div>
                            <!--   Name -->
                            <div class="form-group">
                                <label>Donor Name</label>
                                <input name="name" type="text" class="form-control"
                                    placeholder="Enter Donor Name" required>
                            </div>
                            <!--   Age -->
                            <div class="form-group">
                                <label>Donor Age</label>
                                <input name="age" type="number" class="form-control"
                                    placeholder="Enter Donor Age" required>
                            </div>
                            <!-- Gender  -->
                            <div class="form-group">
                                <label>Donor Gender</label>
                                <input name="gender" type="text" class="form-control" placeholder="Enter Donor Gender"
                                    required>
                            </div>
                            <!--   Address -->
                            <div class="form-group">
                                <label>Donor Address</label>
                                <input name="address" type="text" class="form-control"
                                    placeholder="Enter Donor Address" required>
                            </div>
                            <!--   Phone -->
                            <div class="form-group">
                                <label>Donor Phone no</label>
                                <input name="phone" type="text" class="form-control"
                                    placeholder="Enter Donor Phone no" required>
                            </div>
                            <!-- Blood Group -->
                            <div class="form-group">
                                <label>Donor Blood Group</label>
                                <input name="blood_group" type="text" class="form-control" placeholder="Enter Blood Group"
                                    required>
                            </div>
                            <!--   Volume -->
                            <div class="form-group">
                                <label>Volume Of Blood Donated (in ml)</label>
                                <input name="volume" type="number" class="form-control" placeholder="Enter Volume in ml"
                                    required>
                            </div>
                            

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
  <!--Ends add record  -->


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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        //get organization id  using user_id
                          $sql = "SELECT * FROM organization_details WHERE user_id='$user_id'   LIMIT 1";
                          $result = mysqli_query($conn, $sql);
                          while ($i = mysqli_fetch_array($result)) {
                              $org_id = $i['id'];
                          }
 
                            //fetch all organization list
                            $sql = "SELECT * FROM donation_records WHERE org_id='$org_id'  ";
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
                                        <td>'. $row["citizen_id_no"]. '</td>
                                        <td> 
                                    <form action="./removeRecord.php" method="POST">
                                    <input name="record_id" value="'. $row["id"]. '" style="display:none;">
                                        <button name="submit" type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                        </td> 
                                    </tr> ';
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