
<h3 class="thin no-margin" style="padding-top: 21px;">👟 0 to 1 | Ordered guides or sites</h3>
<div class="spacer small"></div>
<ol class="tab-in3 large">
    <?php
    if(isset($data)){
        $index = 0;
        foreach($data["tutorial"] as &$item){
            echo '<li><input value="'.$item["title"].'" id="tutorial_title_'.$index.'" data-id="'.$index.'" data-original="'.$item["title"].'" data-type="tutorial_title" class="tutorial_title bottom_input auto_remove_input existed_item" type="text"/>
            <button id="tutorial_link_'.$index.'" data-id="'.$index.'" class="btn btn-icon tutorial_link store_link_btn existed_item '.getLinkCssClass($item["link"]).'" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;" ';
    
            if($item["link"]) echo "data-link=\"".$item["title"]."\"  data-original=\"".$item["title"]."\"";
            else echo "data-original=\"\"";
    
            echo '><i class="fas fa-link"></i></button>
                <button id="tutorial_up_'.$index.'" data-id="'.$index.'" class="tutorial_up btn btn-icon" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-chevron-up"></i></button>
                <button id="tutorial_down_'.$index.'" data-id="'.$index.'" class="tutorial_down btn btn-icon" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-chevron-down"></i></button>
            </li>';
            $index++;
        }
    }
    ?>

    <li>
        <input type="text" id="tutorial_title_<?php echo $index; ?>" data-id='<?php echo $index; ?>' data-type="tutorial_title" class="tutorial_title bottom_input auto_remove_input"/>
        <button id="tutorial_link_<?php echo $index; ?>" data-id='<?php echo $index; ?>' class="tutorial_link btn btn-icon store_link_btn" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px; margin-right: 11px;"><i class="fas fa-link"></i></button>
        <button id="tutorial_up_<?php echo $index; ?>" data-id='<?php echo $index; ?>' class="tutorial_up btn btn-icon" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-chevron-up"></i></button>
        <button id="tutorial_down_<?php echo $index; ?>" data-id='<?php echo $index; ?>' class="tutorial_down btn btn-icon" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-chevron-down"></i></button>
    </li>

</ol>

<p class="sub center">--- Try to keep tutorials on the balance between big leaps and being redundant ---</p>
<div class="spacer big"></div>