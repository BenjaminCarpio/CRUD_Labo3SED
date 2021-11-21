<?php
require_once "config.php";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "error";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "error.";
    } else{
        $name = $input_name;
    }
    
    $input_autor = trim($_POST["autor"]);
    if(empty($input_autor)){
        $autor_err = "error.";     
    } else{
        $autor = $input_autor;
    }
    if(empty($name_err) && empty($autor_err)){
        $sql = "UPDATE table SET name=?, autor=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_autor, $param_id);
            
            $param_name = $name;
            $param_autor = $autor;

            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                header("index");
                exit();
            } 
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
} 
?>
 