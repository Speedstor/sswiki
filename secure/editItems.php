<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/dbh.inc.php");
require_once($_SERVER['DOCUMENT_ROOT']."/api/jsonPhp.php");


function edit_containerLists($category, $topicname, $id, $title, $mainlink, $picturelink, $siteMapJson, $is_book){
    $whatId = $topicname."_".$category."_".$id;
    $original_row = getItem($whatId);
    $from;
    $to;

    $table_types = ["title", "main_link", "picture_link", "sitemap_json", "is_book"];
    $possibly_new_values = [$title, $mainlink, $picturelink, $siteMapJson, $is_book];

    for($i = 0; i < count($table_types); $i++){
        if($original_row[$table_types[$i]] == $possibly_new_values[$i]){
            $from[$table_types[$focusedType]] = $original_row[$table_types[$i]];
            $to[$table_types[$focusedType]] = $possibly_new_values[$i];
        }
    }

    if($from != null){
        $from["editType"] = $editType;
        $to["editType"] = $editType;
        insert_editPendingTable($topicname, $whatId, $from, $to);
    }
}

function edit_linkLists($category, $topicname, $id, $title, $link){
    $whatId = $topicname."_".$category."_".$id;
    $original_row = getItem($whatId);
    $from;
    $to;

    $table_types = ["title", "link"];
    $possibly_new_values = [$title, $link];

    for($i = 0; i < count($table_types); $i++){
        if($original_row[$table_types[$i]] == $possibly_new_values[$i]){
            $from[$table_types[$i]] = $original_row[$table_types[$i]];
            $to[$table_types[$i]] = $possibly_new_values[$i];
        }
    }
    
    if($changed != null){
        $from["editType"] = $editType;
        $to["editType"] = $editType;
        insert_editPendingTable($topicname, $whatId, $from, $to);
    }
}


function insert_editPendingTable($topicname, $whatId, $from, $to){
    global $conn;

    $from_json = json_encode($from);
    $to_json = json_encode($to);

    $sql = 'INSERT INTO '.$topicname.'_editPending(whatId, from, to) VALUES ("'.$whatId.'", "'.$whatId_firstPart.'", "'.$link.'");';
    if(!mysqli_query($conn, $sql)) return mysqli_error($conn);
    while (mysqli_next_result($conn));
}





// ------------------------------------
function edit_tutorial($editType, $topicname, $id, $title, $link){
    edit_linkLists($editType, "tutorial", $topicname, $id, $title, $link);
}

function edit_tips($editType, $topicname, $id, $title, $link){
    edit_linkLists($editType, "tips", $topicname, $id, $title, $link);
}

function edit_fun($editType, $topicname, $id, $title, $link){
    edit_linkLists($editType, "fun", $topicname, $id, $title, $link);
}

function edit_toolbox($editType, $topicname, $id, $title, $link){
    edit_linkLists($editType, "toolbox", $topicname, $id, $title, $link);
}

function edit_general($editType, $topicname, $id, $title, $mainlink, $picturelink, $siteMapJson, $is_book){
    edit_containerLists($editType, "general", $topicname, $id, $title, $mainlink, $picturelink, $siteMapJson, $is_book);
}

function edit_deepDive($editType, $topicname, $id, $title, $mainlink, $picturelink, $siteMapJson, $is_book){
    edit_containerLists($editType, "deepDive", $topicname, $id, $title, $mainlink, $picturelink, $siteMapJson, $is_book);
}