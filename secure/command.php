<?php
//before anything check for login
session_start();

function kick(){
    http_response_code(401);
    exit();
}

if(empty($_SESSION['userId']) || empty($_SESSION['user_name'])){
    kick();
}

$_POST = json_decode(file_get_contents("php://input"), true);
require_once($_SERVER['DOCUMENT_ROOT']."/includes/dbh.inc.php");
//TODO: have to have a special login header;

$result = mysqli_query($conn, "SELECT * FROM authority WHERE user_id=".$_SESSION['userId']);
if(!$result) kick();
$result = mysqli_fetch_array($result);
$user_access_level = $result["access_level"];
if($user_access_level != 44) kick();

if(!isset($_POST["query"]) || !isset($_POST["secret4356"])){
    http_response_code(400);
    exit();
}

$commands = explode(";", str_replace("\n", "", $_POST["query"]));

require_once($_SERVER['DOCUMENT_ROOT']."/requires/db.php");

$topicname = "";
$topicId;
foreach($commands as &$command){
    $command = trim($command);
    $params = explode("\t", $command);

    echo strtolower($params[1]);

    switch(strtolower($params[0])){
    case "createtopicsuite":
        require_once($_SERVER['DOCUMENT_ROOT']."/secure/createTopic.php");
        $topicname = createTopicSuite($params[1], $params[2]);
        echo $topicname."_".$topicId;
        break;
    case "insertdb":
        switch(strtolower($params[1])){
        default:
            if($params[2] == "*last_inserted_topicname") {
                $params[2] = $topicname;
                if($topicname == false) continue 3;
            }
        case "tutorial":
            echo insertDB_tutorial($params[2], $params[3], $params[4], $params[5]);
            break;
        case "tips":
            insertDB_tips($params[2], $params[3], $params[4]);
            break;
        case "fun":
            insertDB_fun($params[2], $params[3], $params[4]);
            break;
        case "toolbox":
            insertDB_toolbox($params[2], $params[3], $params[4]);
            break;
        case "general":
            insertDB_general($params[2], $params[3], $params[4], $params[5], $params[6], $params[7]);
            break;
        case "deepdive":
            insertDB_deepDive($params[2], $params[3], $params[4], $params[5], $params[6], $params[7]);
            break;
        }
        break;
    case "editinsert":
        $editType = "insert";
    case "edit":
        require_once($_SERVER['DOCUMENT_ROOT']."/secure/editItems.php");
        $editType = "edit";
        switch(strtolower($params[1])){
        case "tutorial":
            echo edit_tutorial($editType, $params[2], $params[3], $params[4], $params[5], $params[6]);
            break;
        case "tips":
            edit_tips($editType, $params[2], $params[3], $params[4], $params[5]);
            break;
        case "fun":
            edit_fun($editType, $params[2], $params[3], $params[4], $params[5]);
            break;
        case "toolbox":
            edit_toolbox($editType, $params[2], $params[3], $params[4], $params[5]);
            break;
        case "general":
            echo edit_general($editType, $params[2], $params[3], $params[4], $params[5], $params[6], $params[7], $params[8]);
            break;
        case "deepdive":
            edit_deepDive($editType, $params[2], $params[3], $params[4], $params[5], $params[6], $params[7], $params[8]);
            break;
        }
        break;
    }
    echo "\n";
}