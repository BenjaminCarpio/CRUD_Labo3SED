<?php
require_once "config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "No name";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "no match";
    } else{
        $name = $input_name;
    }
        $input_autor = trim($_POST["autor"]);
    if(empty($input_autor)){
        $autor_err = "Please enter an autor.";     
    } else{
        $autor = $input_autor;
    }

    
    if(empty($name_err) && empty($autor_err)){
 
        $sql = "INSERT INTO table (name, autor) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_autor);
            
            $param_name = $name;
            $param_autor = $autor;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            }
        }

        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
}
?>
 