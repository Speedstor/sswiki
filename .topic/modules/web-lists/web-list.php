<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/.topic/helpers.php");
    if(!$web_list_title_str) $web_list_title_str = "🌐/📖 Websites and Books";
    // $web_list_list_type  REQUIRED!!
?>

<h3 class="thin no-margin"> <?php echo $web_list_title_str ?> &nbsp;&nbsp;<remarks style="font-weight: normal;">Sites/Books</remarks></h3>
<ol class="pure links-div">

    <?php 
        
        // https://www.php.net/manual/en/function.number-format.php
    
        foreach($data[$web_list_list_type] as &$item){
            $viewCount = intToTrucatedStr($item["positive_rating"] - $item["negative_rating"]);
            //TODO:: no decimal if the number is long

            $if_book;
            if($item["is_book"] == 1) $if_book =  "Book";
            else $if_book =  "Website";

            echo'
            <li><div class="box intrude horizontal" style="max-height: 190px; flex: auto; align-items: strech;">
                <div style="display: flex; flex-direction: column; align-items: center; background: #dadada; box-shadow: inset -1px 1px 5px 1px rgba(125, 125, 125, 0.29);">
                    <p class="sub" style="padding: 0px 2px;">'.$viewCount.'</p>
                    <button class="btn btn-icon" style="padding: 0px 3px; height: 18px; margin-bottom: 2px;"><i class="fas fa-chevron-up"></i></button>
                    <button class="btn btn-icon" style="padding: 0px 3px; height: 18px;"><i class="fas fa-chevron-down"></i></button>
                </div>
                <div class="box-margin-thin">
                    <p class="sub no-margin">'.$if_book.'</p>
                    <div class="indent">
                        <h3 class="thin no-margin"><a href="'.$item["main_link"].'">'.$item["title"].'</a></h3>
                        <ul class="plain" style="columns: 2; padding-top: 8px;">';

            if($item["sitemap_json"] != null){
                $subCateg = json_decode($item["sitemap_json"]);
                foreach($subCateg as &$subSite){
                    $urlTo = 'href= "'.$subSite->link.'"';
                    if($subSite->link == "false") $urlTo = "";

                    echo '<li class="topic-sublink"><a '.$urlTo.'>'.$subSite->title.'</a></li>';
                }
            }
            echo '</ul>
                    </div>
                </div>
                <div class="box-image" style="background: url(\''.$item["picture_link"].'\');"/>
            </div></li>';
        }
    ?>
    <li class="remarks"><button class="btn" style="font-size: 14px;">show more <i class="fas fa-chevron-down"></i></button></li>
                </ol>
