<? 
    require_once($_SERVER['DOCUMENT_ROOT']."/head.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/header.php");
?>

<div id="background" style="background-color: rgb(226, 226, 226); width:100%;">

<div style="width: 80%; max-width: 1380px; margin: auto; padding-bottom: 60px; min-height: calc(100vh - 306px); ">
    <div style="width: 100%; margin: auto; padding: 10px 10% 14px 10%; box-sizing: border-box; border-bottom: 1px grey solid;">
        <h4 style="margin: 0px; padding: 40px 20px 13px 30px; font-weight: 300;">selfstudywiki.com / login &nbsp;&nbsp;<small></small></h4>

        <div class="mainDiv">
        <?php
            if(isset($_SESSION['userId'])){
                echo '
                <form action="/includes/logout.inc.php" method="post">
                <div style="height: 10px;"></div>
                <h1 style="font-size:25px; color:orange">beta</h1>
                    <p style="text-align: center">You are logged in, '.$_SESSION['user_name'].'</p>
                    <div style="height: 30px;"></div>
                    <button style="margin-bottom: 30px;" type="submit" name="logout-submit">Logout</button>
                </form>';
            }else {
                echo '<form action="/includes/login.inc.php" method="post">
                <div style="height: 10px;"></div>
                <h1 style="font-size:25px; color:orange">Login</h1>
                <input type="text" name="mailuid" placeholder="Email...">
                <input type="password" name="pwd" placeholder="Password...">
                <button type="submit" name="login-submit">Login</button>
            </form>
            <button style="margin-top: 40px;"><a href="/login/signup.php">Sign up</a></button>
                <div style="height: 30px;"></div>';
            }
        ?>
        </div>
    </div>
</div>

<style>
    
    .mainDiv{
        width:35%;
        margin:auto;
        height: 80%;
        align-content: center;
        align-items: center;
        justify-content: center;
        background: #e2e0e0;
        margin-top: 20px;
        border-radius: 2px;
        background: #44444473;
        border: 4px grey solid;
    }

    .mainDiv input{
        width: 90%;
        margin-right: 5%;
        margin-left: 5%;
        height: 30px;
        margin-top: 20px;
        margin-bottom: 10px;
    }


    .mainDiv form{
        width: 100%;
    }

    .mainDiv button{
        width: 40%;
        margin-left: 30%;
        margin-right: 30%;
    }

    h1{
        text-align: center;
    }

    @media screen and (max-width: 1840px){
        .mainDiv{
            width: 565px;
        }
    }
    @media screen and (max-width:679px){
        .mainDiv{
            width: 97%;
        }
        .backpackImg{
            width: 97% !important;
        }
    }
</style>

<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/footer.php");
?>