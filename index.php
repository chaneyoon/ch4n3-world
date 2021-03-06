<!DOCTYPE html>
<html style="margin: 0px;" class="no-js mdl-js" lang="ko">
<!--<![endif]-->
<?php

include "lib.php";

/*
 * 세션에 들어가 있는 값 :
 * 		- 사용자 아이디 ($_SESSION['id])
 * 		- 사용자 닉네임 ($_SESSION['nick'])
 */

session_start();

/* check whether user logged in */
/* 유저가 로그인했는지 안했는지 확인 */
if (isset($_SESSION['id']) && isset($_SESSION['nick'])) {
	$login_chk = 1;
	$id = addslashes($_SESSION['id']);
	$nick = addslashes($_SESSION['nick']);
} else {
	$login_chk = 0;
}

?>
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="naver-site-verification" content="29053d28c1390cd30d83069f669d51609adb83dc"/>

    <title>ch4n3 world</title>

    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-pink.min.css" />
    <link rel="stylesheet" type="text/css" href="maincss.css">
    <link rel="stylesheet" type="text/css" href="maincss_2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="//cdn.jsdelivr.net/velocity/1.2.3/velocity.min.js"></script>

</head>

<body style="overflow-x: hidden !important;">

<div class="backgrounudimagegebabybaby"></div>
<div class="backgroundoverlay"></div>

<div class="loginrightmenu">

    <div id="dates" class="loginregisterbutton">년 월 일</div>
    <div id="times" class="loginregisterbutton">오전 시 분 초</div>



    <?php

/* 유저가 로그인 하지 않음 */
if ($login_chk == 0) {
	$menu = '<div id="logina">로그인</div><div id="registera">회원가입</div>';
}

/* 유저가 로그인 함 */
else {
	$menu = '<div class="logouta" id="logina"><a href="./logout.php">로그아웃</a></div>';
}

/* 메뉴 프린트 */
echo $menu;

?>
</div>
<div class="fristfloar">
    <div class="logo"></div>
    <div class="main">

        <div class="con">

            <div class="centering" align="center">

                <div class="one demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">User's Page</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        You can edit your account.
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a class="profilebutton mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            go to my page!
                        </a>
                    </div>
                </div>

                <div class="two demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Probs</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        You can solve the problems.
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a class="challengebutton mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="./probs.php">
                            Go to solve probs
                        </a>
                    </div>
                </div>
                <div class="three demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Rank</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Hello? Am I a good hacker?
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a class="rankbutton mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            I want to configure my rank!
                        </a>
                    </div>
                </div>
                <div  class="four demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Chat</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Chat with other hackers
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a class="chatbutton mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            go
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="copyright">Front Web Designed by 함종현(WP 16)<br>Backend Web Designed by 정윤서(HD 15),
            <a href="http://chaneyoon.tistory.com" style="color: inherit;">윤석찬</a>
			(HD 16)<br><br>@dimigo
		</div>
    </div>
</div>
<div class="secendfloar">

    <div class="profile">
        <?php

/* 랭킹 페이지 */

include "dbconfig.php";

/* 포인트가 많은 순서대로 정렬 */
/* 중간에 서브쿼리는 중복 랭킹을 허용함 */
$query = "SELECT id ,nick,intro,point,(SELECT COUNT(*) FROM login as t2 WHERE t2.point >= t1.point) rank FROM login t1 WHERE id=('{$id}') ORDER BY point";
$result = mysqli_query($conn, $query);
$fetch = mysqli_fetch_array($result);

$rank = $fetch['rank'];
$point = $fetch['point'];
$nick = xss($fetch['nick']);
$id = xss($fetch['id']);

?>

        <div class="logoup"></div>

        <div class="userpg">

            <div class="pg yourrank">등수 | <?php echo $rank ?>등 (<?php echo $point ?>점)</div>
            <div class="pg yourname">닉네임 | <?php echo $nick ?></div>
            <div class="pg yourid">아이디 | <?php echo $id ?></div>

            <div class="pginput mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="pginput2 mdl-textfield__input" type="password" id="USERPAGEPASSWORD" name="userpagepw" placeholder="비밀번호는 원래 비밀번호를 입력해주세요!">
                <label class="pginputitle mdl-textfield__label" id="userpagepasswordtext">비밀번호</label>
            </div>

            <div class="pginput mdl-textfield mdl-js-textfield is-dirty is-upgraded">
                <textarea class="pginput2 mdl-textfield__input" type="text" rows="5" name="introduce" id="introduce"><?php echo base64_decode($fetch['intro']) ?></textarea>
                <label class="pginputitle mdl-textfield__label" for="content" id="introduce">자기소개</label>
            </div>


        <button type="button" id="changebutton" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" >
            <div class="logintitle">변경하기</div>
            <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>

            <button id="backbutton" type="button" class="backbutton mdl-button mdl-js-button mdl-js-ripple-effect">
                <div class="backbuttontext">이전으로</div>
                <span class="mdl-button__ripple-container">
                    <span class="mdl-ripple"></span>
                </span>
            </button>
        </div>

    </div>




    <div class="rank">
        <?php
//ranking system with mysql + php.
include "dbconfig.php";

//logged in user's ranking
$query = "SELECT point ,(SELECT COUNT(*) FROM login as t2 WHERE t2.point >= t1.point) rank FROM login t1 WHERE id=('" . $_SESSION['id'] . "') ORDER BY point";
$result = mysqli_fetch_array($mysqli->query($query));
$rank = $result['rank'];
$point = $result['point'];

?>

        <div class="logoup"></div>
        <div class="userrk">

                <button id="backbutton" type="button" class="backbutton mdl-button mdl-js-button mdl-js-ripple-effect">
                    <div class="backbuttontext">이전으로</div>
                    <span class="mdl-button__ripple-container">
                        <span class="mdl-ripple"></span>
                    </span>
                </button>

                <div class="pg yourrank">RANK | <?php echo $rank; ?> (<?php echo $point; ?>p)</div>
                <div class="pg yourname">닉네임 | <?php echo $_SESSION['nick']; ?></div>

                <?php
$query = "SELECT SUM(point) as max FROM probs WHERE 1";
$result = mysqli_fetch_array($mysqli->query($query));
$maxPoint = $result['max'];

$query = "SELECT * FROM login WHERE 1 ORDER BY point DESC"; //query to rank users
$result = $mysqli->query($query);

while ($rows = $result->fetch_array()) {

	if ($rows['point'] >= $maxPoint) {
		$allClear = 1;
	} else {
		$allClear = 0;
	}

	$query = "SELECT (SELECT COUNT(*)+1 FROM login as t2 WHERE t2.point > t1.point) rank FROM login t1 WHERE id=('{$rows['id']}') ORDER BY point";
	$r = mysqli_fetch_array($mysqli->query($query));?>

                    <div class="squaredesign">
                        <div align="center" class="rankcontent">
                            <?php echo $r['rank'] ?>위 - <?php echo $rows['nick'] ?>
                            (<?php
if ($allClear) {
		echo "All Cleared!";
	} else {
		echo $rows['point'] . "p";
	}
	?>)
                            <p style="font-size: 12pt; margin: 0 auto;" align="center"><?php echo htmlentities(base64_decode($rows['intro'])); ?></p>
                        </div>

                    </div>
                <?php }?>
                <div class="squaredesign">
                    <div align="center" class="rankcontent">
                        1위 - 키드
                    </div>
                </div>

                <div class="squaredesign">
                    <div align="center" class="rankcontent">
                        2위 - 윤석찬(ch4n3 - administrator)
                        <p align="center" style="font-size: 12pt;">
                            total
                            <?php
$query = "SELECT COUNT(*) as users FROM login WHERE 1";
$result = mysqli_fetch_array($mysqli->query($query));
echo $result['users'];
?> users in here!
                        </p>
                    </div>
                </div>

                <button id="backbutton" style="margin-top: 50px; margin-bottom: 50px;" type="button" class="backbutton mdl-button mdl-js-button mdl-js-ripple-effect">
                    <div class="backbuttontext">이전으로</div>
                    <span class="mdl-button__ripple-container">
                        <span class="mdl-ripple"></span>
                    </span>
                </button>

                </div>



        </div>

        <div class="chat">

       <div class="logoup"></div>

       <div class="userct">

           <button id="backbutton" type="button" class="backbutton mdl-button mdl-js-button mdl-js-ripple-effect">
               <div class="backbuttontext">이전으로</div>
               <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>

           <div class="pg yourrank">RANK | <?php echo $rank ?> (<?php echo $point ?>p)</div>
           <div class="pg yourname">닉네임 | <?php echo $_SESSION['nick'] ?></div>

               <div class="chatbox" scrolling="yes">
                   <?php
// load chats from mysql DB
$query = "SELECT * FROM (SELECT * FROM chat ORDER BY date DESC LIMIT 30) as t ORDER BY date ASC";
$result = $mysqli->query($query);

while ($rows = $result->fetch_array()) {
	?>

                       <li class="mdl-list__item">
                           <span class="mdl-list__item-primary-content">
                               <i class="material-icons mdl-list__item-icon"></i>
                                <?php
$date = $rows['date'];
	$date = explode(" ", $date);
	echo $date[0];?> | <?php echo $rows['nick'] ?> : <?php echo htmlentities($rows['text']); ?>
                           </span>
                       </li>

                   <?php }?>


                <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                        <marquee>[System] : 바르고 고운말ㅎㅎ</marquee>
                    </span>
                </li>

        </div>

           <div class="chating mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
               <input class="pginput2 mdl-textfield__input" type="text" id="CHATING" name="CHATING" onKeyDown="onKeyDown();">
               <label class="pginputitle mdl-textfield__label" id="CHATINGTEXT">메시지</label>
           </div>

           <button id="sendbutton" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
               <div class="logintitle">SEND</div>
               <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span>
           </button>


       </div>

   </div>
</div>



<div class="backblur">

</div>

<div class="alertbox">

    <div class="Login">

        <div class="toptitle"></div>

        <div class="toptitle2">LOGIN</div>

        <form action="/login_chk.php" name="LOGINFORM" method="POST" id="LOGINFORM">

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" onkeyup="inputKeyUp(event)"  type="text" id="LOGINID" name="id">
                <label class="logintitle mdl-textfield__label" id="idtext">ID</label>
            </div>

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input sendText" type="password" id="LOGINPASSWORD" name="pw">
                <label class="logintitle mdl-textfield__label" id="passwordtext">PASSWORD</label>
            </div>

            <!--
                비밀번호 찾기 기능은 제한됩니다.
                <button class="mdl-button mdl-js-button mdl-button--primary">
                    FORGETTING PASSWORD
                </button>
            -->

            <button style="float:right;" type="button" id="loginbutton" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                <div class="logintitle">LOGIN</div>
                <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span>
            </button>
        </form>
        <div id="result">

        </div>
    </div>

    <div class="Register">

        <div class="toptitle"></div>

        <div class="toptitle2">REGISTER</div>

        <form action="/join_chk.php" name="REGISTERFORM" method="POST" id="REGISTERFORM">

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" type="text" autocomplete="off" id="NAME" name="nick">
                <label id="regnametxt" class="logintitle mdl-textfield__label">NICKNAME</label>
            </div>

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" type="text" autocomplete="off" id="ID" name="id">
                <label id="regidtext" class="logintitle mdl-textfield__label">ID</label>
            </div>

            <!--
			<div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" type="text" autocomplete="off" id="ID" name="email">
                <label id="regidtext" class="logintitle mdl-textfield__label">E-mail</label>
            </div>-->

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" type="password" autocomplete="off" id="PASSWORD" name="pw">
                <label id="regpasswordtext" class="logintitle mdl-textfield__label">PASSWORD</label>
            </div>

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" type="password" autocomplete="off" id="PASSWORD2" name="pw_chk">
                <label id="regrepasswordtext" class="logintitle mdl-textfield__label">PASSWORD CHECK</label>
            </div>

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" type="text" autocomplete="off" id="INTRODUCE" name="intro">
                <label id="regemailtext" class="logintitle mdl-textfield__label">INTRODUCE</label>
            </div>

            <button id="registerbutton" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                <div class="logintitle">REGISTER</div>
                <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span>
            </button>

        </form>

    </div>

</div>

<script>

var $height = $(".main").css("height");

$.gofirst = function() {

    $('.secendfloar').css({"display" : "block", "margin-top" : $height});
    $('html, body').css("overflow", "hidden");

    $('body,html').animate({

        scrollTop: $height

    }, 1500, "swing", function() {

        $('html, body').scrollTop(0);
        $('.secendfloar').css("margin-top", "0px");
        $('html, body').css("overflow", "auto");
        $('.fristfloar').css("display", "none");

    });

}

$.gosecond = function() {

    $('.fristfloar').css("display", "block");
    $('html, body').css("overflow", "hidden");
    $('.secendfloar').css("margin-top", $height);
    $('html, body').scrollTop(parseInt($height.replace("px", "")));

    $('body,html').animate({

        scrollTop: 0

    }, 1500, "swing", function() {

        $('html, body').scrollTop(0);
        $('html, body').css("overflow", "auto");
        $('.secendfloar').css("display", "none");

    });

}

$(".profilebutton").click(function() {
    $(".challenge").css("display", "none");
    $(".rank").css("display", "none");
    $(".chat").css("display", "none");
    $(".profile").css("display", "inherit");
    $.gofirst();
});

$(".challengebutton").click(function() {
    $(".challenge").css("display", "inherit");
    $(".profile").css("display", "none");
    $(".chat").css("display", "none");
    $(".rank").css("display", "none");
    $.gofirst();
});

$(".rankbutton").click(function() {
    $(".rank").css("display", "inherit");
    $(".profile").css("display", "none");
    $(".chat").css("display", "none");
    $(".challenge").css("display", "none");
    $.gofirst();
});

$(".chatbutton").click(function() {
    $(".chat").css("display", "inherit");
    $(".profile").css("display", "none");
    $(".rank").css("display", "none");
    $(".challenge").css("display", "none");
    setInterval(function(){$('.chatbox').load('chat_load.php');}, 2000);
    $.gofirst();
});

$(".backbutton").click(function() {
    $.gosecond();
});

$.realtimes = function() {

    var servertimes = new Date();

    servertimes.setMonth(servertimes.getMonth());

    var AMPM;

    if(servertimes.getHours() > 12) {
        AMPM = "오후 ";

        servertimes.setHours(servertimes.getHours() - 12);



    } else {
        AMPM = "오전 ";
        if(servertimes.getHours() == 0) {

            servertimes.setHours(servertimes.getHours() + 12);

        }
    }
    var tmpMonth = servertimes.getMonth() + 1;
    $("#dates").text(servertimes.getFullYear() + "년 " + tmpMonth + "월 " + servertimes.getDate() + "일");
    $("#times").text(AMPM + servertimes.getHours() + "시 " + servertimes.getMinutes() + "분 " + servertimes.getSeconds() + "초");

}


$("#logina").click(function() {

    $(".backblur").css("display", "block");
    $(".backblur").animate({ "opacity": "1" }, 500);
    $(".Login").css("display", "block");
    $(".Register").css("display", "none");
    $(".alertbox").css({"display" : "block", "height" : "400px", "margin-top" : "-100px"});
    $(".alertbox").animate({ 'marginTop': '-200px',  "opacity": "1" }, 300);

});

$("#registera").click(function() {

    $(".backblur").css("display", "block");
    $(".backblur").animate({ "opacity": "1" }, 500);
    $(".Register").css("display", "block");
    $(".Login").css("display", "none");
    $(".alertbox").css({"display" : "block", "height" : "550px", "margin-top" : "-75px"});
    $(".alertbox").animate({ 'marginTop': '-275px',  "opacity": "1" }, 300);

});

$(".backblur").click(function() {
    $(".backblur").animate({ "opacity": "0" }, 500);
    $(".backblur").promise().done(function(){
        $(".backblur").css("display", "none");
    });
    $(".alertbox").animate({ 'marginTop': '-100px',  "opacity": "0" }, 300);
    $(".backblur").promise().done(function(){
        $(".alertbox").css("display", "none");
    });
});

$(window).resize(function() {
    $height = $(".main").css("height");
});

$(document).ready(function() {

    setInterval('$.realtimes()', 1000);

});

// ch4n3 로그인 및 로그인 확인 코드

$("#loginbutton").click(function() {
    var data = "id="+$('#LOGINID').val()+"&pw="+$('#LOGINPASSWORD').val();
    $.ajax({
        type: "POST",
        url: "./login_chk.php",
        data: data,
        success: function(data) {
            $('#logina').html(data);
        },
        dataType: NaN
    });
});

$(".logouta").click(function() {
    $.ajax({
        type: "POST",
        url: "./logout.php",
        data: Nan,
        success: function(data) {
            $('.logouta').html(data);
        },
        dataType: NaN
    });
});


$('#userpg').click(function() {
    <?php
//유저 페이지 오기 전에 로그인했는지 확인
if (!$login_chk) {
	?>
        <!-- 로그인하지 않았을 경우 다시 메인페이지로 접속함 -->
        alert('login plz..');
        location.href = './';
    <?php

}?>
    });

$('#changebutton').click(function() {
    var data = "pw="+$('#USERPAGEPASSWORD').val()+"&intro="+$('#introduce').val();
    $.ajax({
        type: "POST",
        url: "./edit.php",
        data: data,
        success: function(data) {
            $('.userpg').html(data);
        },
        dataType: NaN
    });
});

$(document).ready(function() {

    setInterval('$.realtimes()', 1000);


});

$chatsend = function(data) {
    $.ajax({
        type: "POST",
        url: "./chat.php",
        data: data,
        success: function(data) {
            $('.chatbox').load('chat_load.php');
            $('#CHATING').val() = "";
        },
        dataType: NaN
    });
};

$('#sendbutton').click(function() {
    var data = "nick=<?php echo $_SESSION['nick'] ?>&text="+$('#CHATING').val();
    $chatsend(data);
    $('#CHATING').val("");
});

function onKeyDown() {
    if(event.keyCode == 13) {
         var data = "nick=<?php echo $_SESSION['nick'] ?>&text="+$('#CHATING').val();
         $chatsend(data);
         $('#CHATING').val("");
    }
}

function inputKeyUp(e) {
    e.which = e.which || e.keyCode;
    if(e.which == 13) {
        var data = "nick=<?php echo $_SESSION['nick'] ?>&text="+$('#CHATING').val();
        $chatsend(data);
    }
}


</script>

</body>

</html>
