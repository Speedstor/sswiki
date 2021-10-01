
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
                if(count($data["toolbox"]) >= 6){
                    for($i = 1; $i < 7; $i){
                        echo '<li><a href="'.$data["toolbox"][$i]["link"].'">'.$data["toolbox"][$i]["title"].'</a></li>';
                    }
                }else{
                    foreach($data["toolbox"] as &$item){
                        echo '<li><a href="'.$item["link"].'">'.$item["title"].'</a></li>';
                    }
                }
            ?>
        </ol>
    </div>
</div>