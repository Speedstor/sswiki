<?php
require_once("config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/.topic/jsonPhp.php");

$page = $_GET["q"];
$pageParams = explode("/", $page);

$data = false;
if(count($pageParams) > 2 && $pageParams[2] != ""){
    $topicname = preg_replace("/(^A-Za-z0-9])/", "", str_replace(" ", "", ucwords(preg_replace("/([_-])/", " ", $pageParams[2]))));
    $data = getTopicJson($topicname);
}else{
    if(isset($_GET["givenJson"])){
        $data = json_decode($_GET["givenJson"], true);
    }elseif(isset($_POST["givenJson"])){
        $data = json_decode($_POST["givenJson"], true);
    }
}

if(count($pageParams) > 3 && $pageParams[3] == "json"){
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}

require "head.php";
require "header.php";
?>

<link rel="stylesheet" type="text/css" href="/css/main.css"/>
<script src="https://kit.fontawesome.com/1a1c0507f3.js" crossorigin="anonymous"></script>

<?php 
    require $_SERVER['DOCUMENT_ROOT']."/.topic/imports.php"; 

    if($data == false || !isset($data) || $data == null) echo "<div style='display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: calc(100vh - 500px);'><h1 style='text-align:center;'>Sorry!! this topic does not exist</h1><p style='text-align: center'>and this page have not been designed properly yet</div>";
    else include $_SERVER['DOCUMENT_ROOT']."/.topic/main.php";
?>



</div>
</div>


<?php
require "footer.php";
?>