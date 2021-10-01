<?php
    if($data == false) echo "<h1>topic does not exist</h1>";
?>

<div id="background" style="background-color: rgb(226, 226, 226); width:100%;">
<div class="centerDiv" style="min-height: 100vh; margin-left: 120px; width: 90%; max-width: 1500px;">
    <div class="box-margin">
        <div class="searchHeader">
            <div>
                <h1 class="thin no-margin"><small>Topic: </small><?php echo $data["info"]["topic_title"]?></h1>
            </div>
            <div style="display: flex; flex-direction: column; justify-content: flex-end;">
                <a class="remarks" style="float: right; margin-bottom: 4px;" href="">contribute</a>
                <p style="font-size: 13px; margin: 0px;">Last manual input: <span id="last_input_date"><?php echo $data["info"]["last_edit"]; ?></span></p>
            </div>
        </div>

        <div class="searchResults">
            <div class="div-list" style="flex-grow: 3; max-width: 814px; border-color: #cecece;">
                <?php
                    if($data["general"] === false){
                        echo "<h2>Site error!! Sorry for the inconvinence</h2>";
                    }else{
                        if(count($data["general"]) > 0){
                            include $_SERVER['DOCUMENT_ROOT']."/.topic/modules/general.php";
                            echo '<div class="divider"></div>';
                        }
                    }
                ?>

                
                <?php
                    if(count($data["tutorial"]) > 0){
                        include $_SERVER['DOCUMENT_ROOT']."/.topic/modules/tutorial.php";
                        echo '<div class="divider"></div>';
                    }
                ?>


                <?php
                    if(count($data["tips"]) > 0){
                        include $_SERVER['DOCUMENT_ROOT']."/.topic/modules/tips.php";
                        echo '<div class="divider"></div>';
                    }
                ?>
                

                <?php
                    if(count($data["deepDive"]) > 0){
                        include $_SERVER['DOCUMENT_ROOT']."/.topic/modules/deepDive.php";
                        echo '<div class="divider"></div>';
                    }
                ?>

                
                <?php
                    if(count($data["fun"]) > 0){
                        include $_SERVER['DOCUMENT_ROOT']."/.topic/modules/fun.php";
                        echo '<div class="divider"></div>';
                    }
                ?>


            </div>
            
            
            
            
            <div style="flex-grow: 2;"></div>
            <div>
                <div class="box" style="width: 321px;">
                    <div class="box-margin">
                        <a style="margin: 0px" class="remarks" href="">filter</a>
                        <h4 style="margin: 0px" class="thin">Brief Description</h4>
                        <div class="separator"></div>
                        <div class="spacer tiny"></div>
                        <p class="sub">
                            <?php
                                echo $data["info"]["description"];
                            ?>
                        </p>
                        
                        
                        <div class="spacer big"></div>
                        
                        <h4 style="margin: 0px" class="thin">Context</h4>
                        <div class="separator"></div>
                        <div class="spacer tiny"></div>
                        <ol style="padding-left: 10px;">
                                <li><a href="">General</a>
                                <ol>
                                    <?php
                                        if(count($data["general"]) >= 2){
                                            $count = 0;
                                            foreach($data["general"] as &$item){
                                                if($item["main_link"]) echo '<li><a href="'.$item["main_link"].'">'.$item["title"].'</a></li>';
                                                else echo '<li>'.$item["title"].'</li>';
                                                $count++;
                                                if($count >= 2) break;
                                            }
                                        }else{
                                            foreach($data["general"] as &$item){
                                                if($item["main_link"]) echo '<li><a href="'.$item["main_link"].'">'.$item["title"].'</a></li>';
                                                else echo '<li>'.$item["title"].'</li>';
                                            }
                                        }
                                    ?>
                                </ol>
                            </li>
                            <li><a href="">Getting-started</a></li>
                            <li><a href="">Supplimentary</a></li>
                            <li><a href="">Deep-dive</a>
                                <ol>
                                    <?php
                                        if(count($data["deepDive"]) >= 2){
                                            $count = 0;
                                            foreach($data["deepDive"] as &$item){
                                                if($item["main_link"]) echo '<li><a href="'.$item["main_link"].'">'.$item["title"].'</a></li>';
                                                else echo '<li>'.$item["title"].'</li>';
                                                $count++;
                                                if($count >= 2) break;
                                            }
                                        }else{
                                            foreach($data["deepDive"] as &$item){
                                                echo '<li><a href="'.$item["main_link"].'">'.$item["title"].'</a></li>';
                                            }
                                        }
                                    ?>
                                </ol>
                            </li>
                            <li><a href="">Fun things/facts</a></li>
                        </ol>
                    </div>
                </div>
                
                
                <?php
                    if(count($data["toolbox"]) > 0){
                        include $_SERVER['DOCUMENT_ROOT']."/.topic/modules/toolbox.php";
                    }
                ?>
                

                <div class="box" style="margin-top: 20px; width: 321px;">
                    <div class="box-margin">
                        <h4 style="margin: 0px" class="thin">Branches (origins/sub-branches)</h4>
                        <div class="spacer small"></div>
                        
                        <p class="sub no-margin">
                            Under the bigger topics of:
                        </p>
                        <div class="separator"></div>
                        <div class="spacer tiny"></div>
                        
                        <div class="" style="display: flex; flex-direction: row; margin-bottom: 21px; padding-left: 2px;">
                            <span class="tag" style="color: white">Not implemented Yet</span>
                            <span class="tag" style="color: white">...</span>
                        </div>


                        <p class="sub no-margin">
                            Has the sub-topics of:
                        </p>
                        <div class="separator"></div>
                        <div class="spacer tiny"></div>
                        
                        <div class="" style="display: flex; flex-direction: row; margin-bottom: 10px; padding-left: 2px;">
                            <span class="tag" style="color: white">Not implemented Yet</span>
                            <span class="tag" style="color: white">...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
        // include $_SERVER['DOCUMENT_ROOT']."/.topic/modules/otherTopics.php";
    ?>
</div>