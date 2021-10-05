
<h3 class="thin no-margin" style="padding: 27px 0px 6px 0px;">✅ Tips and Tricks <remarks>(things people wished had known)</remarks></h3>
<ul class="segoe topic-tips" style="color: #4c4c4c;">

    <?php
    if(isset($data)){
        $index = 0;
        foreach($data["tips"] as &$item){
            echo '<li><input value="'.$item["title"].'" id="tips_title_'.$index.'" data-id="'.$index.'" data-original="'.$item["title"].'" data-type="tips_title" class="tips_title bottom_input auto_remove_input existed_item" type="text"/>
            <button id="tips_link_'.$index.'" data-id="'.$index.'" class="btn btn-icon tips_link store_link_btn existed_item '.getLinkCssClass($item["link"]).'" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;" ';
    
            if($item["link"]) echo "data-link=\"".$item["title"]."\"  data-original=\"".$item["title"]."\"";
            else echo "data-original=\"\"";
    
            echo '><i class="fas fa-link"></i></button></li>';
            $index++;
        }
    }
    ?>

    <li><input type="text" id="tips_title_<?php echo $index; ?>" data-id='<?php echo $index; ?>' data-type="tips_title" class="tips_title bottom_input auto_remove_input"/><button class="btn btn-icon store_link_btn" id="tips_link_<?php echo $index; ?>" data-id='<?php echo $index; ?>' class="tips_link" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>
</ul>
<div class="spacer big"></div>