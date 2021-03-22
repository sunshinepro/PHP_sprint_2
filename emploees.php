<form class="actions" action="" method="POST">
            <input type="hidden" name="delete" >
            <button type="submit" name="delete" value="' . $row_e['id'] . '">Delete emploee</button>
        </form> 
        <form class="actions" action="" method="POST">
            <input type="hidden" name="update" >
            <button type="submit" name="update" value="' . $row_e['id'] . '">Edit e.name</button>
        </form> 

        // <form class="actions" action="" method="POST">
// <button type="submit" name="delete_e" value="' . $row_e['id'] . '" onclick="return confirm(\'Delete?\')">Delete emploee</button>
// </form> 
// <form class="actions" action="" method="POST">
//             <button type="submit" name="update_e" value="' . $row_e['id'] . '">Edit e.name</button>
//         </form> 
// onclick="return confirm(\'Delete?\')"

// update
if(isset($_GET['action']) and $_GET['action'] == 'update'){
    echo '<div style="background-color: grey;">
        <form action="" method="POST">
            <p>Update your employee!</p>
            <label for="employee_name">Enter a new employee name: </label>
            <input type="text" name="employee_name">
            <label for="project_name"> Assign project for an employee: </label>
            <select id="project_name" name="project_name">';
            
            
            
            $sql = "SELECT name FROM Projects;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo 
        '<option  value="' . $row["name"] . '">' . 
        $row["name"] . '</option>';
    }
}

            echo '</select>
            <input type="submit" name ="update-empl" value="Update">
        </form>
    </div>';


}
if(isset($_POST['update-empl'])) {


    $updated_employee_name = $_POST['employee_name'];
    $updated_project_name = $_POST['project_name'];

        
            $sql = "UPDATE Employees SET employee_name = ?, project_name = ? WHERE id = ?";
            $stmt = $conn->prepare($sql); 

            $stmt->bind_param('ssi', $updated_employee_name, $updated_project_name, $_GET['id'] );
            var_dump($stmt);
            $res = $stmt->execute();
            var_dump($res);
        
            $stmt->close();
            mysqli_close($conn);
        
            header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
            die();
        
    }