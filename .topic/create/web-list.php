<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/.topic/helpers.php");
    if(!$web_list_title_str) $web_list_title_str = "🌐/📖 Websites and Books";
    // $web_list_list_type  REQUIRED!!
?>

<h3 class="thin no-margin"> <?php echo $web_list_title_str ?> &nbsp;&nbsp;<remarks style="font-weight: normal;">Sites/Books</remarks></h3>
<ol class="pure links-div">


<?php
    if(isset($data)  && isset($data["info"]) && $data != false && $data != null){
        $set_values_javascript = "window.addEventListener('load', (event) => {\n";
    
        $index = 0;
        foreach($data[$web_list_list_type] as &$item){
            $book_checked_str = "";
            $website_checked_str = "";
            
            if($item['is_book'] == 1) {
                $set_values_javascript = $set_values_javascript."document.getElementById('".$web_list_list_type.'_book_'.$index."').checked = true;";
            }else{
                $set_values_javascript = $set_values_javascript."document.getElementById('".$web_list_list_type.'_website_'.$index."').checked = true;";
            }
            
            $main_link_css = "field_filled";
            if($item["main_link"] == "NULL" || $item["main_link"] == null ||  $item["main_link"] == false){
                $item["main_link"] = "";
                $main_link_css = "field_empty";
            }
            if($item["picture_link"] == "NULL" || $item["picture_link"] == null ||  $item["picture_link"] == false) {
                $item["picture_link"] = "";
                $main_link_css = "field_empty";
            }
    
    
            echo '
            <li class="web_list_container '.$web_list_list_type.'_container bottom_input existed_item" id="'.$web_list_list_type.'_container_'.$index.'" data-type="'.$web_list_list_type.'_container" data-id="'.$index.'"><div class="box intrude horizontal" style="flex: auto; align-items: strech; max-height: 198px;">
                <div style="display: flex; flex-direction: column; align-items: center; background: #dadada; box-shadow: inset -1px 1px 5px 1px rgba(125, 125, 125, 0.29);">
                    <button class="btn btn-icon" style="padding: 0px 3px; height: 18px; margin-bottom: 2px; margin-top: 8px; color: red;"><i class="fas fa-trash"></i></button>
                </div>
                <div class="box-margin-thin">
                    <div class="sub no-margin">
                        <label><input type="radio" id="'.$web_list_list_type.'_website_'.$index.'" data-id="'.$index.'" name="'.$web_list_list_type.'_is_book_'.$index.'" value="website"/>Website</label>
                        <label><input type="radio" id="'.$web_list_list_type.'_book_'.$index.'" data-id="'.$index.'" name="'.$web_list_list_type.'_is_book_'.$index.'" value="book"/>Book</label>
                    </div>
                    <div class="indent">
                        <h3 class="thin no-margin"><input type="text" id="'.$web_list_list_type.'_title_'.$index.'" data-id="'.$index.'" value="'.$item["title"].'" class="existed_item"/><button id="'.$web_list_list_type.'_mainlink_'.$index.'" data-id="'.$index.'" original-data="'.$item["main_link"].'"  data-link="'.$item["main_link"].'" class="btn btn-icon store_link_btn '.$web_list_list_type.'_mainlink '.getLinkCssClass($item["main_link"]).'" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></h3>
                        <ul class="plain" style="columns: 2; padding-top: 8px;">';
    
                        
    
                $index_sitemap = 0;
                if($item["sitemap_json"] != null){
                    $subCateg = json_decode($item["sitemap_json"]);
                    foreach($subCateg as &$subSite){
                        if($subSite->link == "false") $subSite->link = "";
    
                        echo '<li class="topic-sublink"><input id="'.$web_list_list_type.'_subtitle_'.$index.'_'.$index_sitemap.'" value="'.$subSite->title.'" data-original="'.$subSite->title.'" data-id='.$index.' class="'.$web_list_list_type.'_subtitle existed_item" type="text"/> <button id="'.$web_list_list_type.'_sublink_'.$index.'_'.$index_sitemap.'" data-id="'.$index.'" data-original="'.$subSite->link.'" data-link="'.$subSite->link.'" class="btn btn-icon store_link_btn '.$web_list_list_type.'_sublink existed_item '.getLinkCssClass($subSite->link).'" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>';
                        $index_sitemap++;
                    }
                }
                while($index_sitemap < 6){
                    echo '<li class="topic-sublink"><input id="'.$web_list_list_type.'_subtitle_'.$index.'_'.$index_sitemap.'" value="" data-original="" data-id='.$index.' class="'.$web_list_list_type.'_subtitle existed_item" type="text"/> <button id="'.$web_list_list_type.'_sublink_'.$index.'_'.$index_sitemap.'" data-id="'.$index.'" data-original="" data-link="" class="btn btn-icon store_link_btn '.$web_list_list_type.'_sublink existed_item field_empty" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>';
                    $index_sitemap++;
                }
    
                
                echo '        </ul>
                </div>
                </div>
                <div class="" style="display: flex; align-content: center; justify-content: center; flex-direction: column; height: 198px; width: 258px; border: 1px solid grey; padding: 15px; box-sizing: border-box;">
                <div style="display: flex;"><i class="fas fa-link" style="margin-right: 4px; color: rgb(49, 133, 189);"></i><input type="text" id="'.$web_list_list_type.'_picturelink_'.$index.'" value="'.$item["picture_link"].'" data-id="'.$index.'" class="existed_item"/></div>
                <p style="text-align: center;">~ or ~</p>
                <button class="btn btn-green">Upload <i class="fas fa-upload"></i></button>
                </div>
                </div></li>';
                
                $index++;
        }
    
        $set_values_javascript = $set_values_javascript."});";
    
    
        echo "<script>".$set_values_javascript."</script>";
    }

?>


<li class="web_list_container <?php echo $web_list_list_type ?>_container bottom_input" id="<?php echo $web_list_list_type ?>_container_<?php echo $index;?>" data-type="<?php echo $web_list_list_type ?>_container" data-id="<?php echo $index;?>"><div class="box intrude horizontal" style="flex: auto; align-items: strech; max-height: 198px;">
    <div style="display: flex; flex-direction: column; align-items: center; background: #dadada; box-shadow: inset -1px 1px 5px 1px rgba(125, 125, 125, 0.29);">
        <button class="btn btn-icon" style="padding: 0px 3px; height: 18px; margin-bottom: 2px; margin-top: 8px; color: red;"><i class="fas fa-trash"></i></button>
    </div>
    <div class="box-margin-thin">
        <div class="sub no-margin">
            <label><input type="radio" checked id="<?php echo $web_list_list_type ?>_website_<?php echo $index;?>" data-id='<?php echo $index;?>' name="<?php echo $web_list_list_type ?>_is_book_<?php echo $index;?>" value="website">Website</label>
            <label><input type="radio"  id="<?php echo $web_list_list_type ?>_book_<?php echo $index;?>" data-id='<?php echo $index;?>' name="<?php echo $web_list_list_type ?>_is_book_<?php echo $index;?>" value="book">Book</label>
        </div>
        <div class="indent">
            <h3 class="thin no-margin"><input type="text" id="<?php echo $web_list_list_type; ?>_title_<?php echo $index;?>" data-id='<?php echo $index;?>' class="check_empty"/><button id="<?php echo $web_list_list_type ?>_mainlink_<?php echo $index;?>" data-id='<?php echo $index;?>' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_mainlink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></h3>
            <ul class="plain" style="columns: 2; padding-top: 8px;">
                <li class="topic-sublink"><input id="<?php echo $web_list_list_type ?>_subtitle_<?php echo $index;?>_0" data-id='<?php echo $index;?>' class="<?php echo $web_list_list_type; ?>_subtitle check_empty" type="text"/> <button id="<?php echo $web_list_list_type ?>_sublink_<?php echo $index;?>_0" data-id='<?php echo $index;?>' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_sublink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                <li class="topic-sublink"><input id="<?php echo $web_list_list_type ?>_subtitle_<?php echo $index;?>_1" data-id='<?php echo $index;?>' class="<?php echo $web_list_list_type; ?>_subtitle check_empty" type="text"/> <button id="<?php echo $web_list_list_type ?>_sublink_<?php echo $index;?>_1" data-id='<?php echo $index;?>' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_sublink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                <li class="topic-sublink"><input id="<?php echo $web_list_list_type ?>_subtitle_<?php echo $index;?>_2" data-id='<?php echo $index;?>' class="<?php echo $web_list_list_type; ?>_subtitle check_empty" type="text"/> <button id="<?php echo $web_list_list_type ?>_sublink_<?php echo $index;?>_2" data-id='<?php echo $index;?>' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_sublink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                <li class="topic-sublink"><input id="<?php echo $web_list_list_type ?>_subtitle_<?php echo $index;?>_3" data-id='<?php echo $index;?>' class="<?php echo $web_list_list_type; ?>_subtitle check_empty" type="text"/> <button id="<?php echo $web_list_list_type ?>_sublink_<?php echo $index;?>_3" data-id='<?php echo $index;?>' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_sublink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                <li class="topic-sublink"><input id="<?php echo $web_list_list_type ?>_subtitle_<?php echo $index;?>_4" data-id='<?php echo $index;?>' class="<?php echo $web_list_list_type; ?>_subtitle check_empty" type="text"/> <button id="<?php echo $web_list_list_type ?>_sublink_<?php echo $index;?>_4" data-id='<?php echo $index;?>' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_sublink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
                <li class="topic-sublink"><input id="<?php echo $web_list_list_type ?>_subtitle_<?php echo $index;?>_5" data-id='<?php echo $index;?>' class="<?php echo $web_list_list_type; ?>_subtitle check_empty" type="text"/> <button id="<?php echo $web_list_list_type ?>_sublink_<?php echo $index;?>_5" data-id='<?php echo $index;?>' class="btn btn-icon store_link_btn <?php echo $web_list_list_type; ?>_sublink" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
            </ul>
        </div>
    </div>
    <div class="" style="display: flex; align-content: center; justify-content: center; flex-direction: column; height: 198px; width: 258px; border: 1px solid grey; padding: 15px; box-sizing: border-box;">
        <div style="display: flex;"><i class="fas fa-link" style="margin-right: 4px; color: rgb(49, 133, 189);"></i><input type="text" id="<?php echo $web_list_list_type ?>_picturelink_<?php echo $index;?>" data-id='<?php echo $index;?>' class="check_empty"/></div>
        <p style="text-align: center;">~ or ~</p>
        <button class="btn btn-green">Upload <i class="fas fa-upload"></i></button>
    </div>
</div></li>




    <!-- <li class="remarks"><button class="btn b-green" style="font-size: 14px;">Add <i class="fas fa-plus"></i></li> -->
                </ol>
