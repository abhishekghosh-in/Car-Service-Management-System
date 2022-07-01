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
    <img src="bgpic3_tyre.PNG">
    <a href="http://localhost/seproject/"><button type="button" class="btn btn-outline-light home-btn btn-lg">Home</button></a>
    <div class="main-container">
      <h1>Car Service Management System</h1><br>
      <div class="container mt-3">
        <h4>Items supplied by a particular vendor</h4>
        
        <form action="/seproject/dir/q7.php" method="post">
          <div class="input-group mb-3">
            <span class="input-group-text">Vendor</span>
            <!-- <input type="text" name="vendor_id" class="form-control"> -->
            <select class="form-control" name="vendor_id">
              <option>Select vendor ID:</option>
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
                $sql = "SELECT * FROM vendor";
                $result = mysqli_query($conn, $sql);
                // number of rows
                $num = mysqli_num_rows($result);
      
                // Display the rows returned by the sql query
                if($num > 0){
                  while($row = mysqli_fetch_assoc($result)){
                    echo "<option>";
                    echo $row['vendor_id'];
                    echo " - ";
                    echo $row['name'];
                    echo "</option>";
                  }
                } else {
                  echo "No vendors in the database";
                }
                $conn->close();
              ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>

      <?php
        // condition
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
          // setting variables
          $vendor_id = $_POST['vendor_id'];

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
          $sql = "SELECT * FROM items INNER JOIN supplied_by ON items.item_id=supplied_by.item_id WHERE supplied_by.vendor_id='$vendor_id';";
          $result = mysqli_query($conn, $sql);
          // number of rows
          $num = mysqli_num_rows($result);

          // Display the rows returned by the sql query
          if($num> 0){
            echo "Showing $num records <br><br>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Item ID</th>";
            echo "<th>Item Name</th>";
            echo "<th>Price</th>";
            echo "<th>Station ID</th>";
            echo "</tr>";
            while($row = mysqli_fetch_assoc($result)){
              echo "<tr>";
              echo "<td>". $row['item_id']. "</td>";
              echo "<td>". $row['item_name']. "</td>";
              echo "<td>". $row['price']. "</td>";
              echo "<td>". $row['station_id']. "</td>";
              echo "</tr>";
            }
            echo "</table><br>";
          } else {
            echo "<br>No records found in database<br>";
          }
          $conn->close();
        }
      ?>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>