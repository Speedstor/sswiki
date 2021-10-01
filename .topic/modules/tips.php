
<h3 class="thin no-margin" style="padding: 27px 0px 6px 0px;">✅ Tips and Tricks <remarks>(things people wished had known)</remarks></h3>
<ul class="segoe topic-tips" style="color: #4c4c4c;">
    <?php
    foreach($data["tips"] as &$item){

        echo '<li>'.$item["title"].' <button id="tips_agree_'.$item["id"].'" class="btn btn-icon small" style="margin: 0px 3px 0px 17px; color: #d7d7d7;"><i class="fas fa-check"></i> Agree</button><button id="tips_disagree_'.$item['id'].'" class="btn btn-icon small tips_disagree"style="margin: 0px 3px 0px 0px; color: #d7d7d7;"><i class="fas fa-times"></i> Disagree</button></li>';
    }
    ?>
</ul>
<div class="spacer big"></div>