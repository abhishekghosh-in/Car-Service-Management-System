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
    <img src="bgpic2_truck.PNG">
    <a href="http://localhost/seproject/"><button type="button" class="btn btn-outline-light home-btn btn-lg">Home</button></a>
    <div class="main-container">
      <h1>Car Service Management System</h1><br>
      <h4>Sorted List of Mechanics, with their Manager and Location</h4>
      <?php
        // condition
        if(true) {
          $servername = "localhost";
          $username = "root";
          $password = "";
          $database = "car_service";
          // making connection to database
          $conn = mysqli_connect($servername, $username, $password, $database);
          // die on connection failure
          if (!$conn){
              die("Sorry we failed to connect: ". mysqli_connect_error());
          }
          // SQL query
          $sql = "SELECT *, mechanic.fname AS mechanicfname, mechanic.lname AS mechaniclname FROM mechanic, manager, car_service_station WHERE mechanic.manager_id=manager.manager_id AND manager.station_id=car_service_station.station_id ORDER BY mechanic.rating DESC;";
          $result = mysqli_query($conn, $sql);
          // number of records returned
          $num = mysqli_num_rows($result);

          // Display the rows returned by the sql query
          if($num> 0){
            echo "Showing $num records <br><br>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Mechanic ID</th>";
            echo "<th>Rating</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Manager ID</th>";
            echo "<th>Manager Name</th>";
            echo "<th>Station ID</th>";
            echo "<th>Location</th>";
            echo "</tr>";
            while($row = mysqli_fetch_assoc($result)){
              echo "<tr>";
              echo "<td>". $row['mechanic_id']. "</td>";
              echo "<td>". $row['rating']. "</td>";
              echo "<td>". $row['mechanicfname']. "</td>";
              echo "<td>". $row['mechaniclname']. "</td>";
              echo "<td>". $row['manager_id']. "</td>";
              echo "<td>". $row['fname']." ". $row['lname']. "</td>";
              echo "<td>". $row['station_id']. "</td>";
              echo "<td>". $row['location']. "</td>";
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