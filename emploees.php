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