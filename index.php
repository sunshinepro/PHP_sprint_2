
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
     <td>' . $row_e['id'] . '</td>             
     <td>
        <form class="actions" action="" method="POST">
            <button type="submit" name="delete_e" value="' . $row_e['id'] . '" onclick="return confirm(\'Delete?\')">Delete emploee</button>
         </form> 
       
        <form class="actions" action="" method="POST">
            <button type="submit" name="update_e" value="' . $row_e['id'] . '">Edit e.name</button>
        </form> 
      </td></tr>'); 
    $counter++;
}
print "</table>";

// <form class="actions" action="" method="POST">
//             <button type="submit" name="delete_e" value="' . $row_e['id'] . '" onclick="return confirm(\'Delete?\')">Delete emploee</button>
//         </form> 

    //Create emploee

           if(isset($_POST['create_empl'])){
                $stmt = $conn->prepare("INSERT INTO emploees (f_name, l_name) VALUES (?, ?)");
                $stmt->bind_param("ss", $f_name, $l_name);
                $f_name = $_POST['f_name'];
                $l_name = $_POST['l_name'];
                $stmt->execute();
                $stmt->close();
                header('Location: '.$_SERVER['PHP_SELF']);
                die;
            }

            //Delete emploee logic

            var_dump($id);

            if (isset($_POST['delete_e'])) {
                $id = $_POST['id'];
                $_POST['id'] = $row_e['id'];
                $stmt = $conn->prepare("DELETE FROM sprint2.emploees WHERE sprint2.emploees.id = $id");
                $stmt->bind_param("i", $id);
                $id = $_POST['id'];
                $stmt->execute();

              }

            //Update emploee logic  

            //   UPDATE <db>.<table>
            //     SET
            //     `f_name` = <{f_name: }>,
            //     `l_name` = <{l_name: }>,
            //      WHERE `id` = <{expr}>;

            mysqli_close($conn);
     ?>

    <form action="" method="POST">
            <label for="f_name">First name: </label><br>
            <input type="text" id="f_name" name="f_name"><br>
            <label for="l_name">Last name: </label><br>
            <input type="text" id="l_name" name="l_name" ><br><br>
            <input type="submit" name="create_empl" value="Create new emploee">
        </form>

        
</body>
</html>

<!-- DELETE nustatyti id tos eilutes, kurios mygtuką spaudžiam -->