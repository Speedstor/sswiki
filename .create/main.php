<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/.topic/helpers.php");
?>

<script src="/.create/js/create-buttons.js" type="text/javascript"></script>
<script src="/.create/js/create-elems.js" type="text/javascript"></script>

<div id="background" style="background-color: rgb(226, 226, 226); width:100%;">
<div class="centerDiv" style="min-height: 100vh; margin-left: 120px; width: 90%; max-width: 1500px;">
    <div class="box-margin">
        <div class="searchHeader">
            <div style="display: flex;">
                <h1 class="thin no-margin">
                    <small>Topic: </small>
                    <input 
                        type="text"
                        oninput="this.size = this.value.length;" 
                        class="<?php if(isset($data)) echo "existed_item"; ?>"
                        <?php 
                            if(isset($data)) 
                            echo "value='".$data["info"]["topic_title"]."' data-original='".$data["info"]["topic_title"]."'"; 
                        ?> 
                        id="input_topic_title" 
                        style="font-size: 20px;"/>
                </h1>
                <label style="color: red; margin-top: 20px; margin-left: 9px;"><i class="fas fa-star-of-life"></i> Required</label>
            </div>
            <div style="display: flex; flex-direction: column; justify-content: flex-end;">
                <p style="font-size: 13px; margin: 0px;">Thank you for contributing</p>
            </div>
        </div>

        <div class="searchResults">
            <div class="div-list" style="flex-grow: 3; max-width: 814px; border-color: #cecece;">
                <?php
                    include $_SERVER['DOCUMENT_ROOT']."/.create/general.php";
                ?>

                
                <?php
                    include $_SERVER['DOCUMENT_ROOT']."/.create/tutorial.php";
                ?>


                <?php
                    include $_SERVER['DOCUMENT_ROOT']."/.create/tips.php";
                ?>
                

                <?php
                    include $_SERVER['DOCUMENT_ROOT']."/.create/deepDive.php";
                ?>

                
                <?php
                    include $_SERVER['DOCUMENT_ROOT']."/.create/fun.php";
                ?>


            </div>
            
            
            
            
            <div style="flex-grow: 2;"></div>
            <div>
                <div class="box" style="width: 321px;">
                    <div class="box-margin">
                        <!-- <a style="margin: 0px" class="remarks" href="">filter</a> -->
                        <div>
                            <h4 style="margin: 0px; display: inline-block;" class="thin">Brief Description</h4>
                            <label style="color: red; margin-left: 9px;"><i class="fas fa-star-of-life"></i> Required</label>
                        </div>
            
                        <div class="separator"></div>
                        <div class="spacer tiny"></div>
                        
                        <textarea id="textarea_topic_description" style="width: 100%; min-height: 120px;" data-original="<?php echo $data["info"]["description"];?>"><?php echo $data["info"]["description"];?></textarea>
                        
                        
                    </div>
                </div>
                
                
                <?php
                    include $_SERVER['DOCUMENT_ROOT']."/.create/toolbox.php";
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


    <div id="urlModel" class="modal">
        <!-- Modal content -->
        <div class="modal-content box">
            <div class="box-content">
                <button class="close" onclick="escapeUrlModel()" style="margin-top: -11px; position:relative; float:right;">&times;</button>
                <div style="padding-left: 20px; padding-bottom: 10px;">
                    <h3>Set the url:</h3>
                    <input id="url_input" type="url" value="" data-setting-for=""/>
                </div>
                <div style="display: inline; float: right; position: relative;">
                    <button class="btn b-red" style="margin-bottom: 7px; margin-right: 13px;" onclick="escapeUrlModel()">Cancel</button>
                    <button class="btn b-blue" style="margin-bottom: 7px; margin-right: 13px;" onclick="setEmptyFromModel()">Empty</button>
                    <button class="btn b-green" style="margin-bottom: 7px; margin-right: 13px;" onclick="setUrlFromModel()">Set</button>
                </div>
            </div>
        </div>
    </div>
    <div id="previewModel" class="modal" style="padding: 0px;">
        <!-- Modal content -->
        
        <h1 class="btn" style="position: absolute; background: #00ff00; float: left; left: 14px; top: 0; border: black 2px solid; padding: 14px; font-size: 19px; color: black; border-radius: 15px;">Preview</h1>
        <div class="box" style="width: 95%;  height: 95vh; margin: auto; margin-top: 10px;">
            <div class="box-content">
            <form target="myIframe" style="display: none;" id="iframeForm" action="http://selfstudywiki.speedstor.net/topic/" method="post">
                <input id="givenJsonParam" type="text" name="givenJson" value="" />
            </form>

            <iframe id="previewIframe" src="" name="myIframe" style="width:100%; height: 95vh;"></iframe>

            </div>
        </div>
        <button class="btn" onclick="confirmSubmit()" style="background: #32bd32; position: relative; float: right; right: 14px; bottom: 0; border: white 2px solid; padding: 14px; font-size: 19px; color: white; margin-top: -29px; border-radius: 15px;">Confirm</button>
        <button class="btn" onclick="escPreview()" style="background: #3780de; margin-right: 14px; position: relative; float: right; right: 14px; bottom: 0; border: white 2px solid; padding: 14px; font-size: 19px; color: white; margin-top: -29px; border-radius: 15px;">Back to Edit (still not saved)</button>
    </div>
    <style>
    /* The Modal (background) */
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    max-width: 613px;
    }

    /* The Close Button */
    .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
    }
    </style>
    
    <?php
        // include $_SERVER['DOCUMENT_ROOT']."/.create/otherTopics.php";
    ?>
</div>