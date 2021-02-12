<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once($g4[mpath]."/head.sub.php");
include_once($g4['path']."/lib/calendar.php");
set_session("ss_is_pc_view", "");

if($p){
$ppage=explode("_",$p);
	$pageNum=$ppage[0];
	$subNum=$ppage[1];
	$ssNum=$ppage[2];
	$tabNum=$ppage[3];
}

if($bo_table){
	$ppage=explode("_",$bo_table);
	$pageNum=$ppage[0];
	$subNum=$ppage[1];
	$ssNum=$ppage[2];
	$tabNum=$ppage[3];
}

$ca_temp = 0;
if(isset($it)){
	$ca_temp = 1;
	$ca_id = $it[ca_id2];
	if(!$it[ca_id2]) $ca_id = $it[ca_id];

}

if($ca_id){

	for($i=0; $i<strlen($ca_id); $i++) { 
		$str_cut[$i] = substr($ca_id,$i,1); 
	}
	if($str_cut[0] == "a") $str_cut[0] = 11;
	if($str_cut[0] == "b") $str_cut[0] = 12;
	if($str_cut[0] == "c") $str_cut[0] = 13;
	if($str_cut[0] == "d") $str_cut[0] = 14;
	if($str_cut[0] == "e") $str_cut[0] = 15;

	$pageNum = $str_cut[0]+1;
	$subNum = (strlen($ca_id) <= 2) ? 1 : $str_cut[2];
	$ssNum = (strlen($ca_id) <= 4) ? 1 : $str_cut[4];
	$tabNum = (strlen($ca_id) <= 6) ? 1 : $str_cut[6];

}


if($ca_temp == 1){
	unset($ca_id);
}

$tot=$pageNum."_".$subNum;
$tott=$pageNum."_".$subNum."_".$ssNum;

$cartcnt = get_cart_count(get_session("ss_on_uid"));

// 모바일 변수설정
$board_skin_mpath = $g4[mpath]."/skin/board/".$board[bo_skin];


//모바일 실시간채팅
$ninetalk_key = sql_fetch("SELECT site_key FROM ninetalk_site_key limit 0,1", false);
$talk_link = "location.href='".$g4["mpath"]."/ninetalk.php?site_key=".$ninetalk_key[site_key]."&return_url=".$_SERVER[HTTP_HOST].urlencode($_SERVER[REQUEST_URI])."'";



$menu = array();

$menu["pageNum"][1] = "건축소개";
	$menu["tot"][1][1] = "건축가의 말";
	$menu["tot"][1][2] = "제공건축";

$menu["pageNum"][2] = "객실소개";
	$menu["tot"][2][1] = "비양 1 · 2 · 3";
	$menu["tot"][2][2] = "비양 단독주택";

$menu["pageNum"][3] = "부대시설";
	$menu["tot"][3][1] = "무료 조식서비스 · 카페";

$menu["pageNum"][4] = "예약안내";
	$menu["tot"][4][1] = "예약안내";
	$menu["tot"][4][2] = "예약문의";
	$menu["tot"][4][3] = "예약 캘린더";

$menu["pageNum"][5] = "오시는 길";
	$menu["tot"][5][1] = "오시는 길";

$menu["pageNum"][100] = $config["cf_title"];
	$menu["tot"][100][1] = "로그인";
	$menu["tot"][100][2] = "정보수정";
	$menu["tot"][100][3] = "회원가입";
	$menu["tot"][100][5] = "마이페이지";
	$menu["tot"][100][6] = "이용약관";
	$menu["tot"][100][7] = "개인정보처리방침";
	$menu["tot"][100][16] = "이메일무단수집거부";
?>


<?if(defined("__INDEX")){
//팝업관리
if(file_exists("$g4[path]/lib/popmng.mobile.lib.php")){ //모바일 팝업관리자 지원되는 셋팅버전인지 확인
	include_once("$g4[path]/lib/popmng.mobile.lib.php");
}
}?>


<script>
function gotoTop(){
	jQuery('html, body').animate( {scrollTop:0} ,300);
}
</script>

<!-- 전화걸기 스크립트 -->
<script type="text/javascript">

var callFlag = true;
function callNumber(num){   
   if(callFlag){
	   $.post("<?=$g4[mpath]?>/_ajax_call_log.php", null, function(){
		callFlag = false;
		location.href="tel:"+num;
	   });
   }
   setTimeout(function(){callFlag=true;}, 1000 * 3);
}
</script>

<div id="snsArea"><!-- right_q 열였을때 뒷배경 -->
</div>

<div id="MenuArea" onclick="menuclose()">
</div>


<style type="text/css">
#MenuArea {position:fixed; width:100%; height:100%; left:0; top:0; background-color:#000000;filter:alpha(opacity=50);opacity:.7; z-index:9999; display:none;}
#MenuZone {position:absolute; width:320px;background:#fff; z-index:99999; display:none; left:-480px; text-align:center; }
#MenuZone #Menu .smenu {display:none;}
#MenuZone #Menu .smenu.on {display:block;}
</style>

<script type="text/javascript">
	function menu(){
		jQuery("#MenuZone").height(jQuery("#wrap").height());
		jQuery("#MenuArea").show();
		jQuery("#MenuZone").show();
		jQuery("#MenuZone").animate({left:"0"});
	}
	function menuclose(){
		jQuery("#MenuArea").hide();
		jQuery("#MenuZone").animate({left:"-450px"}, function(){jQuery("#MenuZone").hide();});
	}
</script>

<div id="wrap">

	<div id="MenuZone">
		<img src="/m/images/menu/menu_off.jpg" style="position:absolute; right:-57px; top:42px;" onclick="menuclose()" alt="메뉴닫기">
		
		<div class="menu_top">
			<a href="javascript:home()"><img src="/m/images/menu/menu_logo.jpg" alt="메뉴로고" style="position:absolute; top:57px; left:32px;" /></a>
		</div>

		<ul id="Menu" >
			<?foreach($menu["pageNum"] as $pn=>$pnStr) {
				if($pn == 100) continue;
				?>
				<li <?=$pageNum == $pn ? "class='on'" : ""?> >
					<a href="#menum" onclick="menum('menu<?=sprintf("%02d", $pn)?>-1')" ><?=$pnStr?></a>
				</li>

			<?}?>
		</ul>
	</div>

	<header>
		<a href="javascript:menu()"><img src="/m/images/top/menu_open.jpg" alt="메뉴오픈" class="menu"></a>
		<a href="javascript:home()"><img src="/m/images/top/logo.jpg" alt="로고" class="logo"></a>
	</header>

	<div id="menu_cover_area">
		<?if(!defined("__INDEX")){?>
		<?
		if(file_exists("{$g4['path']}/m/images/subvisual/s{$p}.jpg"))				$Svisual = "s{$p}";
		else if(file_exists("{$g4['path']}/m/images/subvisual/s{$bo_table}.jpg"))	$Svisual = "s{$bo_table}";
		else if(file_exists("{$g4['path']}/m/images/subvisual/s{$tott}.jpg"))		$Svisual = "s{$tott}";
		else if(file_exists("{$g4['path']}/m/images/subvisual/s{$tot}.jpg"))		$Svisual = "s{$tot}";
		else if(file_exists("{$g4['path']}/m/images/subvisual/s{$pageNum}.jpg"))	$Svisual = "s{$pageNum}";
		else																		$Svisual = "s0";
		?>
			<section class="content">
				<div class="subvisual" style="background-image:url('/m/images/subvisual/<?=$Svisual?>.jpg');" >
					<!--<p class="subvi_p1" ><?=$menu["pageNum"][$pageNum]?></p>-->
					<p class="subvisual_p">푸른 하늘과 황금빛 낙조의 풍광을 이 곳 비양에서 만끽해보세요.</p>
					<? if($pageNum != 100) { ?>
					<ul class="subvisual_tab" >
						<?foreach($menu["tot"][$pageNum] as $sn=>$snStr) {?>
							<li <?=$tot == $pageNum."_".$sn ? "class='on'" : ""?> >
								<a href="#menum" onclick="menum('menu<?=sprintf("%02d", $pageNum)?>-<?=$sn?>')" ><?=$snStr?></a>
							</li>
						<?}?>
					</ul>
					<? } ?>
				</div>
			</section>
					<?if($bo_table){?>
				<div class="boardarea">
			<?}?>
		<?}?>