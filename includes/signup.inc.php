<?php 
if(isset($_POST["signup-submit"])){

    require_once($_SERVER['DOCUMENT_ROOT']."/includes/dbh.inc.php"); //link Database

    $username = $_POST["username"];
    $email = $_POST["mail"];
    $password = $_POST["pwd"];
    
    if(empty($username)||empty($email)||empty($password)){
        header("Location: ../login/signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)|| !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../login/signup.php?error=invalidmailuid");
        exit();
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../login/signup.php?error=invalidmail&uid=".$username);
        exit();
    }elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../login/signup.php?error=invaliduid&mail=".$email);
        exit();
    }else{
        $sql = "SELECT user_name FROM users WHERE user_name=?"; //? is a placeholder
        $stmt = mysqli_stmt_init($conn); //statement

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../login/signup.php?error=sqlerror1");
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../login/signup.php?error=usernametaken&mail=".$email);
                exit();
            }else {
                $sql = "INSERT INTO users(user_name, user_email, user_pwd) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../login/signup.php?error=sqlerror2");
                    exit();
                }else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../login/login.php?signup=success");
                    exit();
                }
            }
        }
    }
    // mysqli_stmt_close($stmt);
    mysqli_close($conn);
}else {
    header("Location: ../login/signup.php");
    exit();
}




?>