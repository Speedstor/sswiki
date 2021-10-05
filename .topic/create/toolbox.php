
<div class="box" style="margin-top: 20px; width: 321px;">
    <div class="box-margin">
        <h4 style="margin: 0px" class="thin">Toolbox</h4>
        <p class="sub">
            Don't learn them one by one, treat it like a toolbox
        </p>
        <div class="separator"></div>
        <div class="spacer tiny"></div>
        
        <ol style="padding-left: 10px;">
            <?php
            if(isset($data)){
                $index = 0;
                foreach($data["toolbox"] as &$item){
                    echo '<li><input value="'.$item["title"].'" id="toolbox_title_'.$index.'" data-id="'.$index.'" data-original="'.$item["title"].'" data-type="toolbox_title" class="toolbox_title bottom_input auto_remove_input existed_item" type="text"/>
                    <button id="toolbox_link_'.$index.'" data-id="'.$index.'" class="btn btn-icon toolbox_link store_link_btn existed_item '.getLinkCssClass($item["link"]).'" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;" ';
    
                    if($item["link"]) echo "data-link=\"".$item["title"]."\"  data-original=\"".$item["title"]."\"";
                    else echo "data-original=\"\"";
    
                    echo '><i class="fas fa-link"></i></button></li>';
                    $index++;
                }
            }
            ?>


        
            <li><input type="text" id="toolbox_title_<?php echo $index; ?>" data-id='<?php echo $index; ?>' data-type="toolbox_title" class="toolbox_title bottom_input auto_remove_input"/><button class="btn btn-icon store_link_btn" id="toolbox_link_<?php echo $index; ?>" data-id='<?php echo $index; ?>' class="toolbox_link" style="border: 1px solid grey; border-radius: 5px; margin-left: 4px;"><i class="fas fa-link"></i></button></li>

        </ol>
    </div>
</div>