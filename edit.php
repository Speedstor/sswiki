<?php
$required_access_level = 33;
require $_SERVER['DOCUMENT_ROOT']."/secure/check_access.php";

require_once($_SERVER['DOCUMENT_ROOT']."/api/jsonPhp.php");

$is_edit = true;
$editing_for = $_POST["topicname"];

$data = getTopicJson($editing_for);
if($data == false) header("Location: /feedbackPages/bad-request.php");
?>


<?php
//access allowed and topic exists
require_once("config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/api/jsonPhp.php");

require "head.php";
?>


<script>
    var changed = false;
    window.onbeforeunload = function() {
        if(changed)
            return 'Do you really want to leave this page?';
    };

    window.topicname = <?php echo $editing_for  ?>;
</script>

<body style="margin: 0px;">
    <nav id="main-navBar">
        <div class="desktopHeader">
            <a class="headerlogolink" href="/" style="">
                <h3 class="tempLogo">Self study <br/>&nbsp;&nbsp;&nbsp;Wiki</h3>
            </a>
            <div style="margin-top: -36px; font-size: 20px; height: 24px; margin-top: 17px; padding: 7px;">Contribute  &nbsp;&nbsp;|&nbsp;&nbsp;  Edit</div>
            
            <div style="flex-grow: 3;"></div>

            <div style="display: flex; align-items: bottom; align-content: flex-end; flex-wrap: wrap;">
                <button class="btn b-red" style="margin-bottom: 7px; margin-left: 13px;" onclick="changed = false; window.location.href = 'http://selfstudywiki.speedstor.net';">Cancel</button>
                <button class="btn b-green" style="margin-bottom: 7px; margin-left: 13px;" onclick="previewAndSave()">Preview and Save</button>
            </div>
            
        </div>
    </nav>

    <div style="height: 72px; width: 100%"></div>


<link rel="stylesheet" type="text/css" href="/css/main.css"/>
<script src="https://kit.fontawesome.com/1a1c0507f3.js" crossorigin="anonymous"></script>

<?php 
    require $_SERVER['DOCUMENT_ROOT']."/.topic/imports.php"; 

    include $_SERVER['DOCUMENT_ROOT']."/.topic/create/main.php";
?>



</div>
</div>


<?php
require "footer.php";
?>