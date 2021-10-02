<?php
$pageSearch = false;
$pageTopic = false;
if(strpos($_SERVER['REQUEST_URI'], "/search.php")  !== false){
    $pageSearch = true;
}
?>

<body style="margin: 0px;">
    <nav id="main-navBar">
        <div class="desktopHeader">
            <a class="headerlogolink" href="/" style="">
                <h3 class="tempLogo">Self study <br/>&nbsp;&nbsp;&nbsp;Wiki</h3>
            </a>
            
            <?php 
            if($pageSearch) echo '<div style="flex-grow: 3;"></div>';
            ?>

            <a class='headerlink' href="/">Search</a>
            <a class='headerlink' href="/search.php?q=#recommendations">Recommendations</a>
            <a class='headerlink' href="/about.php">Published-here</a>
            <a class='headerlink' href="/about.php">About</a>
            
            <div style="flex-grow: 3;"></div>
            
            <button class="btn btn-tight headerlink" style="height: 30px; margin-top: -40px; margin-right: 4px;"><img src="/src/ico/shrink-margin.jpg" style="width: 30px;"/></button>
            <a class='headerlink btn btn-small btn-green' href="/about.php" style="margin-top: -36px;">Contribute</a>
            <?php 
            if($pageSearch != true) 
                echo '<input id="headerSearch" name="headerSearch" class="btn headerlink headerSearch" style="margin-left: 10px; margin-top: -40px;" type="text" placeholder="Search..."/>';
            ?>
        </div>
    </nav>

    <div style="height: 72px; width: 100%"></div>
