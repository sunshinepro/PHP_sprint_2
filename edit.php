<?php
// include "index.php";

$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sprint2";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else echo "Connected successfully";

//create table with data

$sql_e = "SELECT id, f_name, l_name FROM emploees";
$result_e = mysqli_query($conn, $sql_e);

var_dump($result_e);

// $sql_p = "SELECT id_projects, p_name FROM projects";
// $result_p = mysqli_query($conn, $sql_p);

// var_dump($result_p);

//Edit emploee

if(isset($_GET['edit_emploee'])){
    if ( $_GET['f_name'] == '' || $_GET['l_name'] == '') {
        print 'Name and surname can not be empty. Please enter valid name!';
   } else {
       $stmt = $conn->prepare("UPDATE emploees SET `f_name` = ?, `l_name` = ?");
       $stmt->bind_param("ss", $f_name, $l_name);
       $f_name = $_GET['f_name'];
       $l_name = $_GET['l_name'];
       $stmt->execute();
       $stmt->close();
       header('location: index.php');
       die;
   }
}
// $stmt = $conn->prepare("UPDATE emploees SET `firstname`=?, `lastname`=?, `pid`=? WHERE `id`=?");
//       $stmt->bind_param("ssii", $firstname, $lastname, $pid, $eid);
//       $firstname = $_POST['firstname'];
//       $lastname = $_POST['lastname'];
//       $pid = $_POST['project-id'] === '' ? null : $_POST['project-id'];
//       $eid = $_POST['employee-id'];
//       $stmt->execute();
// ?>

<h3>Update Data</h3>

<form method="POST">
  <input type="text" name="f_name" value="<?php echo $row_e['f_name'] ?>" placeholder="Enter new Name" Required>
  <input type="text" name="l_name" value="<?php echo $row_e['l_name'] ?>" placeholder="Enter new Surnameame" Required>
  <input type="submit" name="edit_emploee" value="Update">
</form>


