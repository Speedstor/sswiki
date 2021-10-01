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

if($result["access_level"] != 44) kick();

print_r($_POST);

if(!isset($_POST["query"]) || !isset($_POST["secret4356"])){
    http_response_code(400);
    exit();
}

$commands = explode(";", str_replace("\n", "", $_POST["query"]));

require_once($_SERVER['DOCUMENT_ROOT']."/requires/db.php");

$topicname = "";
$topicId;
echo $commands;
foreach($commands as &$command){
    $command = trim($command);
    $params = explode("\t", $command);

    switch(strtolower($params[0])){
    case "createtopicsuite":
        $topicname = createTopicSuite($params[1], $params[2]);
        echo $topicname."_".$topicId;
        break;
        case "insertdb":
            switch(strtolower($params[1])){
                case "tutorial":
                if($params[2] == "*last_inserted_topicname") {
                    $params[2] = $topicname;
                    if($topicname == false) continue 3;
                    echo "replaced name!!!\n\n";
                }
                echo insertDB_tutorial($params[2], $params[3], $params[4], $params[5]);
                break;
            case "tips":
                if($params[2] == "*last_inserted_topicname") {
                    $params[2] = $topicname;
                    if($topicname == false) continue 3;
                    echo "replaced name!!!\n\n";
                }
                echo insertDB_tips($params[2], $params[3], $params[4]);
                break;
            case "fun":
                if($params[2] == "*last_inserted_topicname") {
                    $params[2] = $topicname;
                    if($topicname == false) continue 3;
                    echo "replaced name!!!\n\n";
                }
                echo insertDB_fun($params[2], $params[3], $params[4]);
                break;
            case "toolbox":
                if($params[2] == "*last_inserted_topicname") {
                    $params[2] = $topicname;
                    if($topicname == false) continue 3;
                    echo "replaced name!!!\n\n";
                }
                echo insertDB_toolbox($params[2], $params[3], $params[4]);
                break;
            case "general":
                if($params[2] == "*last_inserted_topicname") {
                    $params[2] = $topicname;
                    if($topicname == false) continue 3;
                    echo "replaced name!!!\n\n";
                }
                echo insertDB_general($params[2], $params[3], $params[4], $params[5], $params[6], $params[7]);
                break;
            case "deepdive":
                if($params[2] == "*last_inserted_topicname") {
                    $params[2] = $topicname;
                    if($topicname == false) continue 3;
                    echo "replaced name!!!\n\n";
                }
                echo insertDB_deepDive($params[2], $params[3], $params[4], $params[5], $params[6], $params[7]);
                break;
            // case "edithistory":

        }
        break;
    }
    echo "\n";
}