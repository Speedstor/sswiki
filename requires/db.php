<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/dbh.inc.php");
// $conn
// echo "<pre>";
// print_r(createTopicSuite("another test 2", "to teach, to leanr, is to fly"));


// echo "</pre>";

// return id, and maybe object
function createTopicSuite($topic_title, $description){
    global $conn;
    $returnObject = new stdClass();
    
    // generate unique topicname
    $topicname = preg_replace("/(^A-Za-z0-9])/", "", str_replace("_", "", str_replace(" ", "", ucwords(strtolower($topic_title)))));
    if(strlen($topicname) > 41){
        return false;
    }
    
    // check if the topicname is already there
    $sql = "SELECT topicname FROM all_topics WHERE BINARY topicname=?"; //? is a placeholder
    $stmt = mysqli_stmt_init($conn); //statement
    if(!mysqli_stmt_prepare($stmt, $sql)) return mysqli_error($conn);

    mysqli_stmt_bind_param($stmt, "s", $topicname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    if($resultCheck > 0){
        return false;
    }

    $sql = "INSERT INTO all_topics(topicname, topic_title, last_edit, description) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))  return mysqli_error($conn);

    mysqli_stmt_bind_param($stmt, "ssss", $topicname, $topic_title, date("Y-m-d H:i:s"), $description);
    mysqli_stmt_execute($stmt);

    
    $sql = generateSql_allTopicTables($topicname);
    mysqli_multi_query($conn, $sql);
    
    while (mysqli_next_result($conn));
    return $topicname;
}


function generateSql_allTopicTables($topicname){
    return generateSql_createTopicTable($topicname, "tutorial", false)."; \n".
    generateSql_createTopicTable($topicname, "tips", false)."; \n".
    generateSql_createTopicTable($topicname, "fun", false)."; \n".
    generateSql_createTopicTable($topicname, "toolbox", false)."; \n".
    generateSql_createTopicTable($topicname, "general", false)."; \n".
    generateSql_createTopicTable($topicname, "deepDive", false)."; \n".
    generateSql_createTopicTable($topicname, "editHistory", false)."; \n".
    generateSql_createTopicTable($topicname, "editPending", false)."; \n".
    generateSql_createTopicTable($topicname, "rateHistory", false).";";
}

// echo "<pre>";
// // $result = insertDB_tutorial("TEST", "this is second test", null);

// if($result == null){
//     echo "null!!!";
// }else{
//     print_r($result);
// }
// echo "</pre>";

function insertDB_tutorial($topicname, $title, $link, $order){
    return insertDB_common_orderTable($topicname, "tutorial", $title, $link, $order);
}
function insertDB_tips($topicname, $title, $link){
    return insertDB_common_linksTable($topicname, "tips", $title, $link);
}
function insertDB_fun($topicname, $title, $link){
    return insertDB_common_linksTable($topicname, "fun", $title, $link);
}
function insertDB_toolbox($topicname, $title, $link){
    return insertDB_common_linksTable($topicname, "toolbox", $title, $link);
}

function insertDB_general($topicname, $title, $mainlink, $picturelink, $siteMapJson, $is_book){
    return insertDB_common_siteTable($topicname, "general", $title, $mainlink, $picturelink, $siteMapJson, $is_book);
}
function insertDB_deepDive($topicname, $title, $mainlink, $picturelink, $siteMapJson, $is_book){
    return insertDB_common_siteTable($topicname, "deepDive", $title, $mainlink, $picturelink, $siteMapJson, $is_book);
}



function insertDB_editHistory($whatId, $from, $to){

}
function insertDB_editPending(){

}
function insertDB_rateHistory(){

}

function insertDB_common_orderTable($topicname, $type, $title, $link, $order){
    global $conn;
    $whatId_firstPart = $topicname."_".$type;


    $sql = "INSERT INTO all_rating(whatId, title, last_edit) VALUES (\"".$whatId_firstPart."\", \"".$title."\", \"".date("Y-m-d H:i:s")."\");";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))  return mysqli_error($conn);

    // mysqli_stmt_bind_param($stmt, "sss", $whatId_firstPart, $title, date("Y-m-d H:i:s"));
    mysqli_stmt_execute($stmt);
    
    $rating_id = mysql_last_insert_id();
    if($rating_id == null) return mysqli_error($conn);

    if($link == null) $link = "NULL";
    else $link = '"'.$link.'"';

    $sql = 'INSERT INTO '.$topicname.'_'.$type.'(title, whatId, link, rating_id, `order`) VALUES ("'.$title.'", "'.$whatId_firstPart.'", '.$link.', '.$rating_id.', '.$order.');';

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))  return mysqli_error($conn);

    mysqli_stmt_execute($stmt);

    $returnId = mysql_last_insert_id();
    if($returnId == null) return mysqli_error($conn);
    $whatId = $whatId_firstPart."_".$returnId;

    $sql = "UPDATE ".$topicname."_".$type."
            SET 
                whatId = \"".$whatId."\"
            WHERE 
                id = ".$returnId.";";
    $sql .= "UPDATE all_rating
            SET 
                whatId = \"".$whatId."\"
            WHERE 
                id = ".$rating_id.";";
    if(!mysqli_multi_query($conn, $sql)) return mysqli_error($conn);

    while (mysqli_next_result($conn));
    return [$returnId, $rating_id];

}

function insertDB_common_linksTable($topicname, $type, $title, $link){
    global $conn;
    $whatId_firstPart = $topicname."_".$type;


    $sql = "INSERT INTO all_rating(whatId, title, last_edit) VALUES (\"".$whatId_firstPart."\", \"".$title."\", \"".date("Y-m-d H:i:s")."\");";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))  return mysqli_error($conn);

    // mysqli_stmt_bind_param($stmt, "sss", $whatId_firstPart, $title, date("Y-m-d H:i:s"));
    mysqli_stmt_execute($stmt);
    
    $rating_id = mysql_last_insert_id();
    if($rating_id == null) return mysqli_error($conn);

    if($link == null) $link = "NULL";
    else $link = '"'.$link.'"';

    $sql = 'INSERT INTO '.$topicname.'_'.$type.'(title, whatId, link, rating_id) VALUES ("'.$title.'", "'.$whatId_firstPart.'", '.$link.', '.$rating_id.');';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))  return mysqli_error($conn);

    mysqli_stmt_execute($stmt);

    $returnId = mysql_last_insert_id();
    if($returnId == null) return mysqli_error($conn);
    $whatId = $whatId_firstPart."_".$returnId;

    $sql = "UPDATE ".$topicname."_".$type."
            SET 
                whatId = \"".$whatId."\"
            WHERE 
                id = ".$returnId.";";
    $sql .= "UPDATE all_rating
            SET 
                whatId = \"".$whatId."\"
            WHERE 
                id = ".$rating_id.";";
    if(!mysqli_multi_query($conn, $sql)) return mysqli_error($conn);
    while (mysqli_next_result($conn));
    return [$returnId, $rating_id];
}


function insertDB_common_siteTable($topicname, $type, $title, $mainlink, $picturelink, $siteMapJson, $is_book){
    global $conn;
    $whatId_firstPart = $topicname."_".$type;


    $sql = "INSERT INTO all_rating(whatId, title, last_edit) VALUES (\"".$whatId_firstPart."\", \"".$title."\", \"".date("Y-m-d H:i:s")."\");";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))  return mysqli_error($conn);

    // mysqli_stmt_bind_param($stmt, "sss", $whatId_firstPart, $title, date("Y-m-d H:i:s"));
    mysqli_stmt_execute($stmt);
    
    $rating_id = mysql_last_insert_id();
    if($rating_id == null) return mysqli_error($conn);

    if($link == null) $link = "NULL";
    else $link = '"'.$link.'"';
    if($picturelink == null) $picturelink = "NULL";
    else $picturelink = '"'.$picturelink.'"';

    if($is_book) $is_book = "TRUE";
    else $is_book = "FALSE";

    $sql = 'INSERT INTO '.$topicname.'_'.$type.'(title, whatId, main_link, picture_link, sitemap_json, is_book, rating_id) VALUES 
                                                ("'.$title.'", "'.$whatId_firstPart.'", "'.$mainlink.'", '.$picturelink.', "'.str_replace("\"", "\\\"", $siteMapJson).'", '.$is_book.', '.$rating_id.');';
    echo "\n";
    echo $sql;
    echo "\n";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))  return mysqli_error($conn);

    mysqli_stmt_execute($stmt);

    $returnId = mysql_last_insert_id();
    if($returnId == null) return mysqli_error($conn);
    $whatId = $whatId_firstPart."_".$returnId;

    $sql = "UPDATE ".$topicname."_".$type."
            SET 
                whatId = \"".$whatId."\"
            WHERE 
                id = ".$returnId.";";
    $sql .= "UPDATE all_rating
            SET 
                whatId = \"".$whatId."\"
            WHERE 
                id = ".$rating_id.";";
    if(!mysqli_multi_query($conn, $sql)) return mysqli_error($conn);

    while (mysqli_next_result($conn));
    return [$returnId, $rating_id];
}



//TODO: make the create table strings a global variable or from a config file !!!!
function generateSql_createTopicTable($topicname, $type, $ifErrorNull = true){
    switch($type){
    case "tutorial":
        return "CREATE TABLE `".$topicname."_".$type."` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` tinytext NOT NULL,
            `whatId` tinytext NOT NULL,
            `edit_increment` int NOT NULL DEFAULT 0,
            `link` text,
            `order` int,
            `compiled_rating` tinyint NOT NULL DEFAULT 10,
            `positive_rating` int NOT NULL DEFAULT 0,
            `negative_rating` int NOT NULL DEFAULT 0,
            `rating_id` tinytext NOT NULL,
            PRIMARY KEY (`id`)
        )";
        break;
    case "tips":
    case "fun":
    case "toolbox":
        return "CREATE TABLE `".$topicname."_".$type."` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` tinytext NOT NULL,
            `whatId` tinytext NOT NULL,
            `edit_increment` int NOT NULL DEFAULT 0,
            `link` text,
            `compiled_rating` tinyint NOT NULL DEFAULT 10,
            `positive_rating` int NOT NULL DEFAULT 0,
            `negative_rating` int NOT NULL DEFAULT 0,
            `rating_id` tinytext NOT NULL,
            PRIMARY KEY (`id`)
        )";
        break;

    case "general":
    case "deepDive":
        return "CREATE TABLE `".$topicname."_".$type."` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` tinytext NOT NULL,
            `whatId` tinytext NOT NULL,
            `edit_increment` int NOT NULL DEFAULT 0,
            `main_link` text,
            `picture_link` text,
            `sitemap_json` text,
            `is_book` bool NOT NULL,
            `compiled_rating` tinyint NOT NULL DEFAULT 10,
            `positive_rating` int NOT NULL DEFAULT 0,
            `negative_rating` int NOT NULL DEFAULT 0,
            `rating_id` tinytext NOT NULL,
            PRIMARY KEY (`id`)
        )";
        break;

    case "editHistory":
        return "CREATE TABLE `".$topicname."_".$type."` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int NOT NULL,
            `whatId` tinytext NOT NULL,
            `from` text,
            `to` text,
            `edit_increment` int NOT NULL,
            PRIMARY KEY (`id`)
        )";
        break;

    case "editPending":
        return "CREATE TABLE `".$topicname."_".$type."` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int NOT NULL,
            `whatId` tinytext NOT NULL,
            `from` text,
            `to` text,
            `approvalStatus` int NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`)
        )";
        break;
    
    case "rateHistory":
        return "CREATE TABLE `".$topicname."_".$type."` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user` tinytext NOT NULL,
            `rating_id` tinytext NOT NULL,
            `if_positive` bool NOT NULL,
            `date` datetime,
            `significance` tinyint NOT NULL,
            PRIMARY KEY (`id`)
        )";
        break;
    
    default:
        if($ifErrorNull) return null;
        else return "";
    }
}

function mysql_last_insert_id() {
    global $conn;
    
    $sql = "SELECT LAST_INSERT_ID();";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))  return mysqli_error($conn);
    mysqli_stmt_execute($stmt);

    // get id from all_topics
    $mysql_return = mysqli_stmt_get_result($stmt);
    $returnId = -1;
    if($returnId = mysqli_fetch_assoc($mysql_return)){
        return $returnId['LAST_INSERT_ID()'];
    }
    return null;
}


// 
function log_rating($whatId, $user, $if_positive, $actionType, $anonymous){

}

//
// function 

/* // return structure
function createTopicTable($topic, $type){

} */