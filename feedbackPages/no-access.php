<?php
if(isset($noAccessType) && $noAccessType == "contributePrivilege"){
    header("Location: /contribute.php?triedAccess=true");
    exit();
}


require_once($_SERVER['DOCUMENT_ROOT']."/head.php");
require_once($_SERVER['DOCUMENT_ROOT']."/header.php");
?>

<div style="display: flex; justify-content: center; align-items: center; flex-direction: column; height: 450px;">
    <h1 style="text-align: center;">404 - No Access</h1>
    <p style="text-align: center;">You don't have the permission to edit or contribute. We do this to ensure the quality of the pages :)</br>
    please learn how to register to contribute here: <a href="/contribute.php">https://selfstudywiki.speedstor.net/contribute.php</a><br/><br/>

    If you do have access and haven't logged in, please login below</p>
</div>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/login/login.php";
?>


<?php
require_once($_SERVER['DOCUMENT_ROOT']."/footer.php");
?>

