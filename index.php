<?php
require "head.php";
?>

<link rel="stylesheet" type="text/css" href="/css/main.css"/>
<script src="/js/searchBar.js" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/1a1c0507f3.js" crossorigin="anonymous"></script>
<style>
body{
    background: rgb(239, 239, 239);
}
</style>

<div style="height: 47px; width: 100%; display: flex; flex-direction: row; justify-content: space-between; align-items: center; padding: 5px 15px; box-sizing: border-box;">
    <div>
        <p style="margin-top: 16px;">Congregate World's Learning Platforms<br/><span class="sub">An open-sourced effort</span></p>
    </div>
    <div>
        <a href="/about.php" class="spaced">About</a>
        <a href="/p/" class="spaced">Published-here</a>
        <a href="/search.php?q=%23recommendations" class="spaced">Recomendations</a>
    </div>
</div>

<div class="center" style="width: 100vw; height: calc(100vh - 47px); max-height: 716px;">
    <div>
        <h2 class="thin" style="margin: 3px 0px;">Self Study Wiki</h2>
        <p class="no-margin">Learn where to even start with something obsure<br/>w/ resources that had been used by others</p>

        <div class="spacer big"></div>
                
        <div class="input-wrap mainSearch-wrap">
            <input type="text" id="mainSearch" class="input-text input-wrapped mainSearch" value="" style="font-size: 1.2em; width: 500px; padding: 2px 11px 2px 15px;" autocomplete="off" autofocus/>
            <button id="clearSearchInput" class="btn btn-icon mainSearch-go" style="display: none;"><i class="fas fa-times"></i></button>
            <button class="btn btn-icon mainSearch-go" onclick="redirectSearch();"><i class="fas fa-search"></i></button>
        </div>
    </div>
</div>
