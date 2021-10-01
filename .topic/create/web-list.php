<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/.topic/helpers.php");
    if(!$web_list_title_str) $web_list_title_str = "🌐/📖 Websites and Books";
    // $web_list_list_type  REQUIRED!!
?>

<h3 class="thin no-margin"> <?php echo $web_list_title_str ?> &nbsp;&nbsp;<remarks style="font-weight: normal;">Sites/Books</remarks></h3>
<ol class="pure links-div">



<li class="web_list_container <?php echo $web_list_list_type ?>_container bottom_input" id="<?php echo $web_list_list_type ?>_container_0" data-type="<?php echo $web_list_list_type ?>_container" data-id="0"><div class="box intrude horizontal" style="flex: auto; align-items: strech; max-height: 198px;">
    <div style="display: flex; flex-direction: column; align-items: center; background: #dadada; box-shadow: inset -1px 1px 5px 1px rgba(125, 125, 125, 0.29);">
        <button class="btn btn-icon" style="padding: 0px 3px; height: 18px; margin-bottom: 2px; margin-top: 8px; color: red;"><i class="fas fa-trash"></i></button>
    </div>
    <div class="box-margin-thin">
        <div class="sub no-margin">
            <label><input type="radio" checked id="<?php echo $web_list_list_type ?>_website_0" data-id='0' name="<?php echo $web_list_list_type ?>_is_book_0" value="website">Website</label>
            <label><input type="radio"  id="<?php echo $web_list_list_type ?>_book_0" data-id='0' name="<?php echo $web_list_list_type ?>_is_book_0" value="book">Book</label>
        </div>
        <div class="indent">
            <h3 class="thin no-margin"><input type="text" id="<?php echo $web_list_list_type; ?>_title_0" data-id='0' class="check_empty"/><button id="<?php echo $web_list_list_type ?>_mainlink_0" data-id='0' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_mainlink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></h3>
            <ul class="plain" style="columns: 2; padding-top: 8px;">
                <li class="topic-sublink"><input id="<?php echo $web_list_list_type ?>_subtitle_0_0" data-id='0' class="<?php echo $web_list_list_type; ?>_subtitle check_empty" type="text"/> <button id="<?php echo $web_list_list_type ?>_sublink_0_0" data-id='0' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_sublink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                <li class="topic-sublink"><input id="<?php echo $web_list_list_type ?>_subtitle_0_1" data-id='0' class="<?php echo $web_list_list_type; ?>_subtitle check_empty" type="text"/> <button id="<?php echo $web_list_list_type ?>_sublink_0_1" data-id='0' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_sublink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                <li class="topic-sublink"><input id="<?php echo $web_list_list_type ?>_subtitle_0_2" data-id='0' class="<?php echo $web_list_list_type; ?>_subtitle check_empty" type="text"/> <button id="<?php echo $web_list_list_type ?>_sublink_0_2" data-id='0' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_sublink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                <li class="topic-sublink"><input id="<?php echo $web_list_list_type ?>_subtitle_0_3" data-id='0' class="<?php echo $web_list_list_type; ?>_subtitle check_empty" type="text"/> <button id="<?php echo $web_list_list_type ?>_sublink_0_3" data-id='0' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_sublink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                <li class="topic-sublink"><input id="<?php echo $web_list_list_type ?>_subtitle_0_4" data-id='0' class="<?php echo $web_list_list_type; ?>_subtitle check_empty" type="text"/> <button id="<?php echo $web_list_list_type ?>_sublink_0_4" data-id='0' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_sublink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                <li class="topic-sublink"><input id="<?php echo $web_list_list_type ?>_subtitle_0_5" data-id='0' class="<?php echo $web_list_list_type; ?>_subtitle check_empty" type="text"/> <button id="<?php echo $web_list_list_type ?>_sublink_0_5" data-id='0' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_sublink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
            </ul>
        </div>
    </div>
    <div class="" style="display: flex; align-content: center; justify-content: center; flex-direction: column; height: 198px; width: 258px; border: 1px solid grey; padding: 15px; box-sizing: border-box;">
        <div style="display: flex;"><i class="fas fa-link" style="margin-right: 4px; color: rgb(49, 133, 189);"></i><input type="text" id="<?php echo $web_list_list_type ?>_picturelink_0" data-id='0' class="check_empty"/></div>
        <p style="text-align: center;">~ or ~</p>
        <button class="btn btn-green">Upload <i class="fas fa-upload"></i></button>
    </div>
</div></li>

    <!-- <li class="remarks"><button class="btn b-green" style="font-size: 14px;">Add <i class="fas fa-plus"></i></li> -->
                </ol>
