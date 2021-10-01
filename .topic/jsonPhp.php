<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/dbh.inc.php");

function getTopicJson($topicname){
    $returnObject;

    $returnObject["info"] = getTopicInfo($topicname);
    if($returnObject["info"] == false) return false;
    $returnObject["tutorial"]  = getTypeJson($topicname, "tutorial", "compiled_rating");
    $returnObject["tips"]  = getTypeJson($topicname, "tips", "compiled_rating");
    $returnObject["fun"]  = getTypeJson($topicname, "fun", "compiled_rating");
    $returnObject["toolbox"]  = getTypeJson($topicname, "toolbox", "compiled_rating");
    $returnObject["general"]  = getTypeJson($topicname, "general", "compiled_rating");
    $returnObject["deepDive"]  = getTypeJson($topicname, "deepDive", "compiled_rating");
    $returnObject["editHistory"]  = getTypeJson($topicname, "editHistory", "id", 20);
    $returnObject["editPending"]  = getTypeJson($topicname, "editPending", "id", 20);
    $returnObject["rateHistory"]  = getTypeJson($topicname, "rateHistory", "id", 20);

    return $returnObject;
}

function getTableRowCount($topicname, $type){
    global $conn;
    $result = mysqli_query($conn, "SELECT COUNT(*) FROM `".$topicname."_".$type."`");
    $count = -1;
    if($count = mysqli_fetch_assoc($result)){
        return $count['COUNT(*)'];
    }
}

// echo "<pre>";
// print_r(getTopicJson("TheBestTopic"));
// print_r(getTopicInfo_id(2));
// $testObj  = getTypeJson("TEST", "tutorial", "compiled_rating");
// $testJson =  json_encode(getTopicJson("TheBestTopic"));
// print_r(array_keys($testObj[9]));
// echo $testJson;
// print_r(getTypeJson("TEST", "tutorial"));
// echo "</pre>";


function getTypeJson($topicname, $type, $orderedBy = "id", $limit = 40, $if_desc = true){
    return getArray_fromMysql($topicname."_".$type, $orderedBy, $limit, $if_desc);
}

function getArray_fromMysql($tablename, $orderedBy = "id", $limit = 40, $if_desc = true){
    global $conn;
    if($if_desc) $if_desc = "DESC";
    else $if_desc = "ASC";

    $query = "SELECT * FROM ".$tablename." ORDER BY ".$orderedBy." ".$if_desc." LIMIT ".$limit."";
    $result = mysqli_query($conn, $query);
    if(!$result){
        return mysqli_error($conn);
    }
    $returnObject = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $returnObject[$row["id"]] = $row;
    }
    return $returnObject;
}

function getTopicInfo($topicname){
    return getTopicInfo_topicname($topicname);
}

function getTopicInfo_topicname($topicname){
    global $conn;
    $query = "SELECT * FROM all_topics WHERE BINARY topicname='".$topicname."';";
    $result = mysqli_query($conn, $query);
    if(!$result){
        return mysqli_error($conn);
    }
    $returnObject;
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        return $row;
    }
    return false;
}


function getTopicInfo_id($id){
    global $conn;
    $query = "SELECT * FROM all_topics WHERE id=".$id;
    $result = mysqli_query($conn, $query);
    if(!$result){
        return mysqli_error($conn);
    }
    $returnObject;
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        return $row;
    }
    return false;
}