
<h3 class="thin no-margin" style="padding-top: 21px;">😃/📂 Fun Things/Facts</h3>
<div class="spacer small"></div>
<ul class="tab-in3 large">
    <?php
    foreach($data["fun"] as &$item){
        if($item["link"]) echo "<li><a href=\"".$item["link"]."\">".$item["title"]."</a></li>";
        else echo "<li>".$item["title"]."</li>";
    }
    ?>
</ul>
<div class="spacer big"></div>