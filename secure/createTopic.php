<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/dbh.inc.php");

// return id
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