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
      <?php
        // condition
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
          // setting variables
          $fname = $_POST['fname'];
          $lname = $_POST['lname'];
          $dob = $_POST['dob'];
          $address = $_POST['address'];
          $station_id = $_POST['station_id'];

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
          $sql = "INSERT INTO `customer` (`fname`, `lname`, `dob`, `address`, `station_id`) VALUES ('$fname', '$lname', '$dob', '$address', '$station_id');";
          $result = mysqli_query($conn, $sql);
          
          if ($result) {
            echo "<br>Successfully added<br>";
            $sql = "select max(cust_id) as last from customer;";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $latest_id = $row['last'];
            echo $latest_id;
          } else {
            echo "<br>Failed<br>";
          }
          $conn->close();
        }
      ?>
      <div class="container mt-3">
        <h4>Enter the customer details</h4>

        <script>
          function pastDate(idate){
              var today = new Date().getTime(),
                  idate = idate.split("/");

              idate = new Date(idate[2], idate[1] - 1, idate[0]).getTime();
              return (today - idate) > 0;
          }

          function checkDate(){
              var idate = document.getElementById("dob"),
                  resultDiv = document.getElementById("datewarn"),
                  dateReg = /(19[0-9][0-9]|200[0-3])[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/;

              if(!dateReg.test(idate.value)){
                  resultDiv.innerHTML = "Invalid date!";
                  resultDiv.style.color = "red";
                  return;            
              } 

              if(pastDate(idate.value)){
                  resultDiv.innerHTML = "Entered date is a future date";
                  resultDiv.style.color = "red";
              } else {
                  resultDiv.innerHTML = "Valid date";
                  resultDiv.style.color = "green";
              }
          }

        </script>



        <form action="/seproject/dir/q3.php" method="post">
          <div class="input-group mb-3">
            <span class="input-group-text">First Name</span>
            <input type="text" name="fname" class="form-control">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Last Name</span>
            <input type="text" name="lname" class="form-control">
          </div>

          <div class="input-group mb-3">
            <span class="input-group-text">DOB</span>
            <input type="text" name="dob" id="dob" class="form-control" placeholder="YYYY-MM-DD" id="date" onkeyup="checkDate()">
          </div>
          <div id="datewarn"></div> 

          <div class="input-group mb-3">
            <span class="input-group-text">Address</span>
            <input type="text" name="address" class="form-control">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Station ID</span>
            <select class="form-control" name="station_id">
            <option>Select station ID</option>
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
              $sql = "SELECT * FROM `car_service_station`";
              $result = mysqli_query($conn, $sql);
              // number of rows
              $num = mysqli_num_rows($result);
    
              // Display the rows returned by the sql query
              if($num > 0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<option>";
                  echo $row['station_id'];
                  echo " - ";
                  echo $row['location'];
                  echo "</option>";
                }
              } else {
                echo "No stations in the database";
              }
              $conn->close();
            ?>
          </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>