
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css"> 
    <title>Emploees - Projects binder</title>
</head>
<body>
    <header>
    <a href="./index.php">Emploees</a>
    <a href="./projects.php">Projects</a>
    </header>
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sprint2";

// Create connection
$conn_p = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn_p) {
    die("Connection failed: " . mysqli_connect_error());
}
else echo "Connected successfully";


$sql_p = "SELECT id_projects, p_name FROM projects";

$result_p = mysqli_query($conn_p, $sql_p);

var_dump($result_p);

print "<table >

<tr>
    <th>Row Number</th>
    <th>Project name</th>
    <th>Emploee</th>
    <th>Action</th>
</tr>";

$c=1;

while($row_p = mysqli_fetch_array($result_p))
{
    print( '<tr>
     <td>' . $c .'</td>
     <td>' . $row_p['p_name'] . '</td>;
     <td>' . $row_e['id'] . '</td>;
     <td>
     <form class="actions" action="" method="POST">
        <input type="hidden" name="id" value="' . $row_p['id_projects'] . '">
        <button type="submit" name="delete" value="' . $row_p['id_projects'] . '">Delete project</button>
        <button type="submit" name="update" value="">Edit project name</button>
     </form> 
     </td>;
     </tr>');
  $c++;

}

echo "</table>";

//Create project

if(isset($_POST['create_proj'])){
    $stmt = $conn_p->prepare("INSERT INTO projects (p_name) VALUES (?)");
    $stmt->bind_param("s", $p_name);
    $p_name = $_POST['p_name'];
    // $l_name = $_POST['l_name'];
    $stmt->execute();
    $stmt->close();
    header('Location: '.$_SERVER['PHP_SELF']);
    die;
}

mysqli_close($conn_p);

?>

<form action="" method="POST">
        <label for="p_name">Project name: </label><br>
        <input type="text" id="p_name" name="p_name"><br>
        <input type="submit" name="create_proj" value="Create new project">
    </form>
<body>
</html>

<!-- ADD - kodel neveikia cia? -->
