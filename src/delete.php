<?php
if(isset($_POST["id"]) && !empty($_POST["id"])){
    require_once "config.php";

    $sql = "DELETE FROM table WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_POST["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            header("index");
            exit();
        }
    }
    mysqli_stmt_close($stmt);
    
    mysqli_close($link);
}
?>
