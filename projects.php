
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css"> 
    <title>Employees - Projects binder</title>
</head>
<body>
    <header>
    <a href="./index.php">Employees</a>
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
// else echo "Connected successfully";


$sql_p = "SELECT projects.id_projects, projects.p_name, emploees.f_name, emploees.l_name FROM projects
LEFT JOIN emploees_projects ON projects.id_projects = emploees_projects.id_projects
LEFT JOIN emploees ON emploees.id = emploees_projects.id_emploees";

$result_p = mysqli_query($conn_p, $sql_p);

print "<table >

<tr>
    <th>Row Number</th>
    <th>Project name</th>
    <th>Employee</th>
    <th>Action</th>
</tr>";

$c=1;

while($row_p = mysqli_fetch_array($result_p))
{
    print( '<tr>
     <td>' . $c .'</td>
     <td>' . $row_p['p_name'] . '</td>;
     <td>' . $row_p['f_name'] . ' ' . $row_p['l_name'] .'</td>;
     <td>
     ' . '<a href="?action=delete&id_projects=' . $row_p['id_projects'] . '">
     <button onclick="return confirm(\'Delete?\')" >Delete project</button></a>' 
     . '<a href="?action=edit_e&id=' . $row_e['id'] . '">
     <button>Edit project</button></a>' . 
     '</td></tr>');
    
  $c++;

}

echo "</table>";

//Create project

if(isset($_GET['create_proj'])){
    if ( $_GET['create_proj'] == '') {
        print 'Name can not be empty. Please enter valid project name!';
    } else {
    $stmt = $conn_p->prepare("INSERT INTO projects (p_name) VALUES (?)");
    $stmt->bind_param("s", $p_name);
    $p_name = $_GET['p_name'];
    $stmt->execute();
    $stmt->close();
    // header('Location: '. strtok($_SERVER['REQUEST_URI'], '?'));
    }
}

 //Delete project logic

 
 if (isset($_GET['action']) and $_GET['action'] === 'delete') {
     $sql_p = 'DELETE FROM projects WHERE id_projects = ?';
     $stmt = $conn->prepare($sql_p);
     $stmt->bind_param("i", $_GET['id_projects']);
     $stmt->execute();
     $stmt->close();
    //  header('Location: '. strtok($_SERVER['REQUEST_URI'], '?'));
     die;
   }


mysqli_close($conn_p);

?>

<form action="" method="GET">
        <label for="p_name">Project name: </label><br>
        <input type="text" id="p_name" name="p_name"><br>
        <input type="submit" name="create_proj" value="Create new project">
    </form>
<body>
</html>


