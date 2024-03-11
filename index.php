<?php 
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task1</title>
    <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/select.dataTables.min.css">
</head>
<?php 
include('config.php');
?>
<style>
    .error{
      color: red;
    }
</style>
<body>
    <div class="container my-5">
        <form id="myForm">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name"><b>Name</b></label>
                    <input type="text" class="form-control form-control-sm border-secondary" id="name" name="name" required placeholder="Enter Name">
                </div>
                <div class="col-md-6">
                    <label for="surname"><b>Surname</b></label>
                    <input type="text" class="form-control form-control-sm border-secondary" id="surname" name="surname" required placeholder="Enter Surname">
                </div>
                <div class="col-md-6">
                    <label for="phone"><b>Phone Number</b></label>
                    <input type="number" class="form-control form-control-sm border-secondary" id="phone" name="phone" required placeholder="Enter Phone Number">
                </div>
                <div class="col-md-6">
                    <label for="email"><b>Email Address</b></label>
                    <input type="email" class="form-control form-control-sm border-secondary" id="email" name="email" required placeholder="Enter Email Address">
                </div>
                <div class="col-md-6">
                    <label for="address"><b>Address</b></label>
                    <textarea class="form-control form-control-sm border-secondary" rows="5" id="address" name="address" required placeholder="Enter Address"></textarea>
                </div>

                <div class="col-md-6">
                    <div>
                        <label for="country"><b>Select Country</b></label>
                        <select class="form-select border-secondary" id="country" name="country" required>
                            <option value="">Choose Country</option>
                            <?php
                            $query="SELECT * FROM `country`";
                            $result=mysqli_query($conn,$query);
                            while($row=mysqli_fetch_array($result)){ ?>
                            <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                            <?php }  
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="state" class="mt-3"><b>Select State</b></label>
                        <select class="form-select border-secondary" id="state" name="state" required>
                            <option value="">Choose State</option>
                            
                        </select>
                    </div>
                </div>
                <div class="col-md-12 text-center mt-5">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

   
    <div class="container my-5">
        <h4 class="text-center">All List</h4>
        <div class="table-responsive ">
            <table class="table align-middle table-striped table-hover table-bordered dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody id="table_body">
                    <?php
                        $i=1;
                        $table_query="SELECT * FROM `form_data`";
                        $result_table=mysqli_query($conn,$table_query);
                         while($rows=mysqli_fetch_array($result_table))
                         { 
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $rows['name'];?></td>
                        <td><?php echo $rows['surname'];?></td>
                        <td><?php echo $rows['phone'];?></td>
                        <td><?php echo $rows['email'];?></td>
                        <td><?php echo $rows['address'];?></td>
                        <td><?php echo $rows['country'];?></td>
                        <td><?php echo $rows['state'];?></td>
                    </tr>
                    <?php
                    $i++; 
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendors/jquery/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="vendors/js/jquery.validate.js"></script>
    <script src="vendors/js/validation.js"></script>
    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="vendors/js/dataTables.select.min.js"></script>
    <script>
      $('#country').change(function(){
            let country = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'state_filter.php',
                data: { country: country },
                success: function(response){
                    $('#state').html(response);
                }
            });
        });

// -------------Form Submit--------------
$(document).on('submit', '#myForm', function (e) {
    e.preventDefault();
    $.ajax({
        method: "POST",
        url: "save_form.php",
        data: $(this).serialize(),

        success: function (data) {
            alert("Successfully inserted");
            $("#myForm")[0].reset();
             window.location.reload();
        }
    });

});

//---------------Get Table Data--------------
$(document).ready(function () {
    $.ajax({
        method: "POST",
        url: "get_table_data.php",
        success: function (response) {
            $('#table_body').html(response);
        },
        error: function (error) {
            // Handle errors if necessary
            console.log(error);
        }
    });
});

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
        $('.dataTable').DataTable();
      });
    </script>
</body>
</html>
