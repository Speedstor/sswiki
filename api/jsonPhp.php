<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/dbh.inc.php");

//accesses -----------------------------------------------------------------
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
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        return $row;
    }
    return false;
}

function getItem($whatId){
    global $conn;
    $id_parts = explode("_", $whatId);
    $query = "SELECT * FROM ".$id_parts[0]."_".$id_parts[1];
    if ($id_parts[2] != "null") {
        $query = $query." WHERE id=".$id_parts[2];
    }
    echo $query;
    // $result = mysqli_query($conn, $query);
    // if(!$result) return false;
    // while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    //     return $row;
    // }
    // return false;
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