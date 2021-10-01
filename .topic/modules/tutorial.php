
<h3 class="thin no-margin" style="padding-top: 21px;">👟 0 to 1 | Ordered guides or sites</h3>
<div class="spacer small"></div>
<ol class="tab-in3 large">
    <?php
        foreach($data["tutorial"] as &$item){
            echo '<li><a href="'.$item["link"].'">'.$item["title"].'</a></li>';
        }
    ?>
</ol>
 <?php
if($data["info"]["tutorial_finished"] != 1) {
    echo '<p class="sub center">--- Section Not Finished &nbsp;|&nbsp;&nbsp;  <a class="inherit-font" href="">Request Edit? (20)</a>  &nbsp;&nbsp;|&nbsp;&nbsp; <a class="inherit-font" href="">Contribute?</a> &nbsp;---</p>';
} 
?>
<div class="spacer big"></div>