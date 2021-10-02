<?php
if(!isset($_GET["q"])){
    header("Location: /");
    exit();
}
require "head.php";
require "header.php";

require_once("config.php");

$search_query = $_GET['q'];
require_once($_SERVER['DOCUMENT_ROOT']."/includes/dbh.inc.php");
require_once($_SERVER['DOCUMENT_ROOT']."/.topic/jsonPhp.php");

$result = mysqli_query($conn, "INSERT INTO search_log(`query`, `datetime`) VALUES ('".$search_query."', '".date("Y-m-d H:i:s")."');");
while (mysqli_next_result($conn));

$title_match_rows = [];
$description_match_rows = [];
if($search_query == "#recommendations"){
    $title_match_rows = getArray_fromMysql("all_topics", $orderedBy = "popularity", $limit = 10);
}else{
    $result = mysqli_query($conn, "SELECT * FROM `all_topics` where `topic_title` like '%".$search_query."%' ORDER BY `last_edit` DESC;");
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $title_match_rows[] = $row;
    }
    
    $result = mysqli_query($conn, "SELECT * FROM `all_topics` where `description` like '%".$search_query."%' ORDER BY `last_edit` DESC;");
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $description_match_rows[] = $row;
    }
}


$fuzzyResultsNum = count($description_match_rows) - count($title_match_rows);
if($fuzzyResultsNum < 0) $fuzzyResultsNum = 0;


?>

<link rel="stylesheet" type="text/css" href="/css/main.css"/>
<script src="/js/searchBar.js" type="text/javascript"></script>
<script src="/js/searchPage.js" type="text/javascript"></script>

<script src="https://kit.fontawesome.com/1a1c0507f3.js" crossorigin="anonymous"></script>

<div id="background" style="background-color: rgb(226, 226, 226); width:100%;">
<div class="centerDiv" style="min-height: 100vh;">
    <div class="box-margin">
        <div class="searchHeader">
            <div>
                <h5 class="h-small">💠 Search Results</h5>
                <div class="input-wrap mainSearch-wrap">
                    <input type="text" id="mainSearch" class="input-text input-wrapped mainSearch" autocomplete="off"/>
                    <script>
                        window.addEventListener("load", () => {
                            document.getElementById("mainSearch").value = "<?php echo $search_query; ?>";
                        }, true);
                    </script>
                    <div style="display: flex;">
                        <button id="clearSearchInput" class="btn btn-icon mainSearch-go"><i class="fas fa-times"></i></button>
                        <button onclick="redirectSearch();" class="btn btn-icon mainSearch-go"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; justify-content: flex-end;">
                <!-- TODO:::::: TODO -->
                <!-- <a class="remarks" style="float: right; margin-bottom: 4px;" href="">Refine-search</a> -->
                <p style="font-size: 13px; margin: 0px;"><?php echo count($title_match_rows); ?> search results, <?php echo $fuzzyResultsNum; ?> fuzzy results</p>
            </div>
        </div>

        <div class="searchResults">
            <div class="searchResults-list">


                <?php
                if(count($title_match_rows) <= 0){
                    echo '
                    
                    <div class="box item resultItem" style="border: none; margin-top: 46px; margin-bottom: 38px;">
                        <div class="item-margin" style="height: 190px; background: url(\'/src/dna_loading.gif\'); display: flex; align-items: center; background-size: contain; background-position: center; justify-content: center; background-repeat: no-repeat;">
                        <!-- <img src="/src/dna_loading.gif" height="190" style="width: unset"></img> -->
                            <h4 style="line-height: 28px; background: #808080eb; padding: 11px 20px; color: white; display: inline-block; width: unset; height: unset; text-align: center;">
                                Sorry!! We still don\'t have relevant content for your <br/>search. Please try again in a couple months. 😖
                            </h4>
                        </div>
                    </div>
                    
                    <div class="box item resultItem" style="margin-bottom: 20px">
                        <div class="item-margin">

                            <div class="divider" style="margin-top: -13px; height: 8px;"></div>
                            <p class="" style="color: darkgrey; font-size: 12px; text-align: center; margin: 0px; font-family: sans-serif;"> This site is very new, and still in development.
                            In fact, it has only been up for <br/><span style="text-decoration: underline;" id="serverTimeSince" onload="this.innerText=timeSince(new Date(\'10-1-2021\'));"></span></p>
                            <div class="spacer small"></div>
                        </div>
                    </div>
                    <div class="spacer small"></div>
                    <div class="separator"></div>
                    <h3 style="text-align: center;">In the meantime, you can check out our <br/> more popular web aggregates 👇</h3>
                    <div class="separator"></div>

                    ';

                    $title_match_rows = getArray_fromMysql("all_topics", $orderedBy = "popularity", $limit = 4);
                }
                foreach($title_match_rows as &$item){
                    echo '
                    <div class="box item resultItem hover-grey" onclick="window.location.href=\'http://selfstudywiki.com/topic/\'+\''.$item["topicname"].'\'.replace(/([a-z])([A-Z])/g, \'$1-$2\').trim();">
                        <div class="item-margin">
                            <div>
                                <h3 style="margin: 0px;">'.$item["topic_title"].'</h3>
                                <p class="small">
                                    <!-- <span class="tag">coding</span><span class="tag">languages</span> -->
                                    '.$item["topicname"].'
                                    <span class="remarks">'.$item["popularity"].'% popular</span>
                                </p>
                            </div>
                            <div class="separator"></div>
                            <p class="sub">
                                '.$item["description"].'
                            </p>';
                            
                            $linksArr = getTypeJson($item["topicname"], "general", "compiled_rating", 3);
                            if(count($linksArr) < 2) $linksArr = array_merge($linksArr, getTypeJson($item["topicname"], "tutorial", "compiled_rating", 3));
                            if(count($linksArr) < 2) $linksArr = array_merge($linksArr, getTypeJson($item["topicname"], "fun", "compiled_rating", 3));
                            if(count($linksArr) < 2) $linksArr = array_merge($linksArr, getTypeJson($item["topicname"], "deepDive", "compiled_rating", 3));
                            if(count($linksArr) < 2) $linksArr = array_merge($linksArr, getTypeJson($item["topicname"], "toolbox", "compiled_rating", 3));
                            
                            $editCount = getTableRowCount($item["topicname"], "editHistory") + 1;
                            
                            if(count($linksArr) > 0){
                                echo '<h6 class="blue minor-heading" style="margin-top: 17px; ">Top links:</h6>
                                <ul class="pure main-urlList" style="margin-bottom: 16px;">';
                                foreach($linksArr as &$listItem){
                                    $className = "hover-blue";
                                    if($listItem["main_link"] && $listItem["main_link"] != "NULL" && $listItem["main_link"] != "") {
                                        $listItem["main_link"] = 'href="'.$listItem["main_link"].'"';
                                    }else{
                                        $listItem["main_link"] = "";
                                        $className = "";
                                    }
                                    echo '<li class="'.$className.'"><span class="tag tag-count grey">'.($listItem["positive_rating"]-$listItem["negative_rating"]).' votes</span> <a class="text-cut times-new-romans" style="width: 70%;" '.$listItem["main_link"].'>'.$listItem["title"].'</a></li>';
                                }
                                echo '      <li class="sub times-new-romans">&nbsp;and more...</li>
                                        </ul>';
                            }

                        echo '<div class="remarks">
                                '.$editCount.' edits . updated: <span id="date" class="js_change_date">'.$item["last_edit"].'</span>
                            </div>
                        </div>
                    </div>';
                }
                
                ?>

            </div>
            <div class="box searchResult-intellisense">
                <div class="box-image intellisense-img" style="background: url('/src/java-script.jpg'); background: #ddbcdf;"></div>
                <div class="box-margin">
                    <h3 style="margin: 0px" class="thin">Intellisense Recommendations</h3>
                    <p  style="margin: 0px" class="sub">Generated at 00 Apr 0000, 0.0 second</p>
                    <div class="separator"></div>
                    <div class="spacer small"></div>

                    <h4 style="margin: 0px; text-align: right;" class="thin">Coming Soon !</h4>
                    <!--
                    <h6 class="blue minor-heading" style="">General:</h6>
                    <ol>
                        <li class="hover-grey"><span class="tag">Start</span>: <a href="">speedstor.net/coding</a></li>
                        <li class="hover-grey"><span class="tag">Deep-dive</span>: <a href="">speedstor.net/coding</a></li>
                        <li class="hover-grey"><span class="tag">Desert</span>: <a href="">speedstor.net/coding</a></li>
                    </ol>

                    <div class="spacer small"></div>
                    <h6 class="blue minor-heading" style="">General:</h6>
                    <ol>
                        <li class="hover-grey"><span class="tag">Start</span>: <a href="">speedstor.net/coding</a></li>
                        <li class="hover-grey"><span class="tag">Deep-dive</span>: <a href="">speedstor.net/coding</a></li>
                        <li class="hover-grey"><span class="tag">Desert</span>: <a href="">speedstor.net/coding</a></li>
                    </ol>-->

                    <div class="spacer small"></div>
                    <h6 class="blue minor-heading" style="">Message:</h6> 
                    <p class="code-space" style="padding-left: 2px;">
        
    Stay tuned!

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php
require "footer.php";
?>