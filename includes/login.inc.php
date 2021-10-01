<?php

if(isset($_POST['login-submit'])){
    require_once($_SERVER['DOCUMENT_ROOT']."/includes/dbh.inc.php");

    $mailuid = $_POST["mailuid"];
    $password = $_POST["pwd"];

    if(empty($mailuid) || empty($password)){
        header("Location: ../login/login.php?error=emptyfields");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE user_name=? OR user_email=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../login/login.php?error=sqlerror");
            exit();
        }else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['user_pwd']);
                if($pwdCheck == false){
                    header("Location: ../login/login.php?error=wrongpassword");
                    exit();
                }elseif($pwdCheck == true){
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['user_name'] = $row['user_name'];

                    header('Location: ../login/index.php?login=success');
                    exit();
                }else{
                    header('Location: ../login/login.php?error=wrongpassword');
                    exit();
                }
            }else{
                header("Location: ../login/login.php?error=nouser");
                exit();
            }
        }
    }

}else {
    header("Location: ../login/login.php");
    exit();
}