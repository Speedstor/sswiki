<?php
if(!isset($_SESSION['userBid'])){
}


$stmt = mysqli_stmt_init($conn);
        
if(empty($tableName)){
    header("Location: ../createWebAnalyis.php?error=emptyfields");
    exit();
}elseif(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../cerateWebAnalyis.php?error=mysqlerror");
    exit();
}else {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $repeatCheck = mysqli_stmt_num_rows($stmt);
    if($repeatCheck > 0){
        header("Location: ../createWebAnalyis.php?error=nametaken");
        exit();
    }elseif($result){
        header("Location: ../createWebAnalyis.php?error=nametaken");
        exit();
    }else{
        $sql = "CREATE TABLE `".$overallName."` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `date` tinytext,
            `page` tinytext,
            `browser` tinytext,
            `browserVersion` bigint(20) DEFAULT NULL,
            `os` tinytext,
            `device` longtext,
            `pointer` tinytext,
            `ipUsers` tinytext,
            `requestTime` bigint(20) DEFAULT NULL,
            `hostname` tinytext,
            `cityUsers` tinytext,
            `region` tinytext,
            `country` tinytext,
            `loc` tinytext,
            `postal` mediumint(9) DEFAULT NULL,
            `internetProvider` tinytext,
            PRIMARY KEY (`id`)
        ) 
        ";
        if($conn->query($sql) === FALSE){
            header("Location: ../createWebAnalyis.php?error=sqlerror");
            exit();
        }else {
            header("Location: ../createWebAnalyis.php?create=success");
            exit();
        }
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);



$result = mysqli_query($conn, "SELECT * FROM ".$username."_overall");

$tempNum = 0;
while($row = mysqli_fetch_array($result)){
$subjects[$tempNum] = $row[1];
$teachers[$tempNum] = $row[2];
$overall[$tempNum] = $row[3];
$tempNum++;
}





if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

$sql = "SELECT * FROM users WHERE mbpUid=?;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../mbp.php?error=sqlerror");
    exit();
}else {
    mysqli_stmt_bind_param($stmt, "s", $mbpUid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)){
            $_SESSION['mbpUid'] = $row['mbpUid'];
            $_SESSION['userBid'] = $row['username'];
            $_SESSION['pwd'] = $row['pwdUsers'];

        //onLogin($row['mbpUid']);
        header('Location: ../mbp.php?autologin=success');
        exit();
    }else{
        header("Location: ../mbp.php?error=nouser");
        exit();
    }

}

$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../login.php?error=sqlerror");
    exit();
}else {
    mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)){
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        if($pwdCheck == false){
            header("Location: ../login.php?error=wrongpassword");
            exit();
        }elseif($pwdCheck == true){
            session_start();
            $_SESSION['userId'] = $row['idUsers'];
            $_SESSION['userUid'] = $row['uidUsers'];

            header('Location: ../index.php?login=success');
            exit();
        }else{
            header('Location: ../login.php?error=wrongpassword');
            exit();
        }
    }else{
        header("Location: ../login.php?error=nouser");
        exit();
    }
}


$sql = "SELECT uidUsers FROM users WHERE uidUsers=?"; //? is a placeholder
$stmt = mysqli_stmt_init($conn); //statement

if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../signup.php?error=sqlerror");
    exit();
} else{
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    if($resultCheck > 0){
        header("Loaction: ../signup.php?error=usernametaken&mail=".$email);
        exit();
    }else {
        $sql = "INSERT INTO users(uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }else {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
            mysqli_stmt_execute($stmt);
            header("Location: ../login.php?signup=success");
            exit();
        }
    }
}

mysqli_close($conn);


CREATE TABLE users (
    
	idUsers int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    uidUsers TINYTEXT NOT NULL,
    emailUsers TINYTEXT NOT NULL,
    pwdUsers LONGTEXT NOT NULL

);


CREATE TABLE feedback ( feedbackId int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, nameSubmit TINYTEXT NOT NULL, emailSubmit TINYTEXT NOT NULL, message LONGTEXT NOT NULL );


CREATE TABLE users (
    
	idOrder int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    customerName TINYTEXT NOT NULL,
    customerMail TINYTEXT NOT NULL,
    budget int NOT NULL,
    phone int NOT NULL,
    request LONGTEXT NOT NULL

);