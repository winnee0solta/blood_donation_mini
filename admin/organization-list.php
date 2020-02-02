<html>

<head>
    <title>Admin | Home</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css">

</head>

<body>

    <!-- topnav -->
    <?php 
   include './topnav.php';
  ?>
    <!--ENDS topnav -->

    <div class="container-fluid my-3">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add Organization
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="addneworgmodel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addneworgmodel">Add New Organization</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="./dbAddOrganization.php" method="POST">
                        <div class="modal-body">
                            <!-- Organization Name -->
                            <div class="form-group">
                                <label>Organization Name</label>
                                <input name="name" type="text" class="form-control"
                                    placeholder="Enter Organization Name" required>
                            </div>
                            <!-- Organization Address -->
                            <div class="form-group">
                                <label>Organization Address</label>
                                <input name="address" type="text" class="form-control"
                                    placeholder="Enter Organization Address" required>
                            </div>
                            <!-- Organization Email -->
                            <div class="form-group">
                                <label>Email address</label>
                                <input name="email" type="email" class="form-control" placeholder="Enter email"
                                    required>
                            </div>
                            <!-- Organization Phone -->
                            <div class="form-group">
                                <label>Organization Phone no</label>
                                <input name="phone" type="text" class="form-control"
                                    placeholder="Enter Organization Phone no" required>
                            </div>
                            <!-- Organization Username -->
                            <div class="form-group">
                                <label>Username</label>
                                <input name="username" type="text" class="form-control" placeholder="Enter Username"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control" placeholder="Enter Password"
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


        <!-- Organization list  -->
        <div class="container mt-4">
            <div class="card">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                include 'dbConnect.php';

                            //fetch all organization list
                            $sql = "SELECT * FROM organization_details  INNER JOIN users ON organization_details.user_id=users.id";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                    <tr>
                                        <th scope="row">'. $row["id"].'</th>
                                        <td>'. $row["name"]. '</td>
                                        <td>'. $row["address"]. '</td>
                                        <td>'. $row["email"]. '</td>
                                        <td>'. $row["phone"]. '</td>
                                        <td>'. $row["username"]. '</td>
                                    </tr> ';
                                   
                                }
                            } else {
                                echo "0 results";
                            }
                            mysqli_close($conn);

                        ?>  
                    </tbody>
                </table>
            </div>
        </div>
        <!--Ends Organization list  -->


    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>