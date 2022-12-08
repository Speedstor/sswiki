
<h3 class="thin no-margin" style="padding-top: 21px;">😃/📂 Fun Things/Facts</h3>
<div class="spacer small"></div>
<ul class="tab-in3 large">
    <?php
    if(isset($data) && isset($data["info"]) && $data != false && $data != null){
        foreach($data["fun"] as &$item){
            $index = $item["id"];
            echo '<li><input value="'.$item["title"].'" id="fun_title_'.$index.'" data-id="'.$index.'" data-original="'.$item["title"].'" data-type="fun_title" class="fun_title bottom_input auto_remove_input existed_item" type="text"/>
            <button id="fun_link_'.$index.'" data-id="'.$index.'" class="btn btn-icon fun_link store_link_btn existed_item '.getLinkCssClass($item["link"]).'" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;" ';
    
            if($item["link"]) echo "data-link=\"".$item["title"]."\"  data-original=\"".$item["title"]."\"";
            else echo "data-original=\"\"";
    
            echo '><i class="fas fa-link"></i></button></li>';
        }
    }
    $index = 99999;
    ?>


    <li><input id="fun_title_<?php echo $index; ?>" data-id="<?php echo $index; ?>" data-type="fun_title" class="fun_title bottom_input auto_remove_input" type="text"/><button id="fun_link_<?php echo $index; ?>" data-id="<?php echo $index; ?>" class="btn btn-icon fun_link store_link_btn" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>

</ul>
<div class="spacer big"></div>