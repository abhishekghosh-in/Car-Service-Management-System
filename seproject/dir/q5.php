<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <img src="bgpic.PNG">
    <a href="http://localhost/seproject/"><button type="button" class="btn btn-outline-light home-btn btn-lg">Home</button></a>
    <div class="main-container">
      <h1>Car Service Management System</h1><br>

      <h4>Select the customer</h4>

      <form action="/seproject/dir/q5.php" method="post">
        <div class="input-group mb-3">
          <span class="input-group-text">Customer</span>
          <select class="form-control" name="cust_id">
            <option>Select customer ID:</option>
            <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $database = "car_service";
              // making connection to database
              $conn = mysqli_connect($servername, $username, $password, $database);
              if (!$conn){
                  die("Sorry we failed to connect: ". mysqli_connect_error());
              }
              // SQL query
              $sql = "SELECT * FROM customer";
              $result = mysqli_query($conn, $sql);
              // number of rows
              $num = mysqli_num_rows($result);
    
              // Display the rows returned by the sql query
              if($num > 0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<option>";
                  echo $row['cust_id'];
                  echo " - ";
                  echo $row['fname'];
                  echo "</option>";
                }
              } else {
                echo "No customers in the database";
              }
              $conn->close();
            ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>



      <?php
        // condition
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
          // setting variables
          $cust_id = $_POST['cust_id'];

          $servername = "localhost";
          $username = "root";
          $password = "";
          $database = "car_service";
          // making connection to database
          $conn = mysqli_connect($servername, $username, $password, $database);
          if (!$conn){
              die("Sorry we failed to connect: ". mysqli_connect_error());
          }
          // SQL query
          $sql = "SELECT * FROM customer WHERE `customer`.`cust_id` = '$cust_id'";
          $result = mysqli_query($conn, $sql);
          $num = mysqli_num_rows($result);
          if($num > 0){
            $row = mysqli_fetch_assoc($result);

            echo '
              <div class="container mt-3">
                <form action="/seproject/dir/q5_update.php" method="post">

                  <input type = "hidden" name = "cust_id" value = "'. $cust_id .'" />

                  <div class="input-group mb-3">
                    <span class="input-group-text">First Name</span>
                    <input type="text" name="fname" class="form-control" value='.$row["fname"].'>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Last Name</span>
                    <input type="text" name="lname" class="form-control" value='.$row["lname"].'>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Address</span>
                    <input type="text" name="address" class="form-control" value="'.$row["address"].'">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
            ';
          } else {
            echo "<br>No such customer $cust_id exists<br>";
          }
          
          $conn->close();
        }
      ?>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>