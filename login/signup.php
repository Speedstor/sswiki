<? 
    require $_SERVER['DOCUMENT_ROOT']."/head.php";
    require $_SERVER['DOCUMENT_ROOT']."/header.php";
?>


<div style="width: 80%; max-width: 1380px; margin: auto; padding-bottom: 60px;  min-height: calc(100vh - 306px); ">

<div style="width: 100%; margin: auto; padding: 10px 10% 14px 10%; box-sizing: border-box; border-bottom: 1px grey solid;">
    <h4 style="margin: 0px; padding: 40px 20px 13px 30px; font-weight: 300;">selfstudywiki.speedstor.net / signup &nbsp;&nbsp;<small></small></h4>

    
    <div class="mainDiv">
        <h1>Sign up</h1>
        <h1 style="font-size:25px; color:orange">beta</h1>
        <?php
            if(isset($_GET['error'])){
                if($_GET['error'] == 'emptyfields'){
                    echo "<h2 style='color: red;'> Fill in all fields!</h2>";
                }
            }
        ?>
        <form action="/includes/signup.inc.php" method="post">
            <input type="text" name="username" placeholder="What shall we call you?">
            <input type="text" name="mail" placeholder="Email...">
            <input type="password" name="pwd" placeholder="Password...">
            <input type="password" name="pwd-repeat" placeholder="Retype Password...">
            <button style="margin-bottom: 30px;" type="submit" name="signup-submit">Sign up</button>
        </form>
    </div>
    <a href="./login.php" style="color: #598da2; width: 100%; text-align: center; display: inline-block; margin: 20px 0px 30px 0px;" >Have an account? Sign in instead</a>
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
    require $_SERVER['DOCUMENT_ROOT']."/footer.php";
