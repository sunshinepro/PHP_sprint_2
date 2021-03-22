
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
    <header style="color: black;">
    <a href="./index.php">Employees</a>
    <a href="./projects.php">Projects</a>
    </header>
<?php
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
// else print "Connected successfully";

//create table with Employees data

$sql_e = "SELECT emploees.id, emploees.f_name, emploees.l_name, projects.p_name FROM emploees 
LEFT JOIN emploees_projects ON emploees.id = emploees_projects.id_emploees
LEFT JOIN projects ON projects.id_projects = emploees_projects.id_projects";

$result_e = mysqli_query($conn, $sql_e);

print "<table >

<tr>
    <th>Row Number</th>
    <th>Fitrst name</th>
    <th>Last name</th>
    <th>Project name</th>
    <th>Action</th>
</tr>";

$counter=1; 
while($row_e = mysqli_fetch_array($result_e))

{  print (
'<tr><td>' . $counter . '</td>
     <td>' . $row_e['f_name'] . '</td>
     <td>' . $row_e['l_name'] . '</td>
     <td>' . $row_e['p_name'] . '</td>             
     <td>' 
     . '<a href="?action=delete&id=' . $row_e['id'] . '">
     <button onclick="return confirm(\'Delete?\')" >Delete employee</button></a>' 
     . '<a href="?action=edit_e&id=' . $row_e['id'] . '">
     <button>Edit employee</button></a>' . '</td></tr>'); 

 $counter++;
}
print "</table>";

//Create employee

if(isset($_GET['create_empl'])){
     if ( $_GET['f_name'] == '' || $_GET['l_name'] == '') {
         print 'Name and surname can not be empty. Please enter valid name!';
    } else {
        $stmt = $conn->prepare("INSERT INTO emploees (f_name, l_name) VALUES (?, ?)");
        $stmt->bind_param("ss", $f_name, $l_name);
        $f_name = $_GET['f_name'];
        $l_name = $_GET['l_name'];
        $stmt->execute();
        $stmt->close();
        header('Location: '. strtok($_SERVER['REQUEST_URI'], '?'));
        die;
    }
}

//Delete employee logic
if (isset($_GET['action']) and $_GET['action'] === 'delete') {
    $sql_e = 'DELETE FROM emploees WHERE id = ?';
    $stmt = $conn->prepare($sql_e);
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $stmt->close();
    header('Location: '. strtok($_SERVER['REQUEST_URI'], '?'));
    die;
}

//Edit employee
if(isset($_GET['action']) and $_GET['action'] === 'edit_e'){
    print '<div style="background-color: linen;">
    <form action="" method="GET">
        <h4>Edit your employee\'s data:</h4>
        <label for="f_name">Edit the first name: </label><br>
        <input type="text" placeholder="' . $_GET['f_name']. '" name="f_name"><br>
        <label for="l_name">Edit the last name: </label><br>
        <input type="text" placeholder="' . $row_e['l_name']. '" name="l_name"><br>
        <label for="p_name"> Assign other project to this employee: </label><br>
        <select placeholder="' . $row_e['p_name']. '"id="p_name" name="p_name"><br>
        <input type="submit" name="edit_e" value="Edit this employee"><br>
    </form>';
   


        
            while($row_p = mysqli_fetch_array($result_p)) {
                var_dump($result_p);
                print 
                '<option  value="' . $row_p["p_name"] . '">' . 
                $row_p["p_name"] . '</option>';
            }
        
        print '</select>
    </div>';
             
    }


//     if ( $_GET['f_name'] == '' || $_GET['l_name'] == '') {
//         print 'Name and surname can not be empty. Please enter valid name!';
//    } else {
//        $stmt = $conn->prepare("UPDATE emploees SET (f_name, l_name) VALUES (?, ?)");
//        $stmt->bind_param("ss", $f_name, $l_name);
//        $f_name = $_GET['f_name'];
//        $l_name = $_GET['l_name'];
//        $stmt->execute();
//        $stmt->close();
//     //   header('Location: '. $_SERVER['REQUEST_URI']);
//         die;
//    }


      mysqli_close($conn);
?>

<div>
<br>
<br>
 <h3p>Create new employee:</h3p>
<form action="" method="GET">
    <label for="f_name">First name: </label><br>
    <input type="text" id="f_name" name="f_name"><br>
    <label for="l_name">Last name: </label><br>
    <input type="text" id="l_name" name="l_name" ><br><br>
    <input type="submit" name="create_empl" value="Create new employee">
</form>

</div>       
</body>
</html>

