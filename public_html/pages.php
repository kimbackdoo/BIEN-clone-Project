<?
include_once("./_common.php");
include_once("$g4[path]/lib/latest.lib.php");
$g4['title'] = "";
include_once("./_head.php");
?>
<script type="text/javascript">
	g4_title = document.title = "<?=$g4['title'] ?>";
</script>
<div>

<?if($tot==''){?>

<?}else if($tot==''){?>


<?}else if($tot=='100_6')//이용약관 
	include_once("$g4[path]/res/include/utilization.php");

else if($tot=='100_7')//개인정보처리방침
	include_once("$g4[path]/res/include/privacy.php");

else if($tot=='100_16')//이메일주소무단수집거부
	include_once("$g4[path]/res/include/email_privacy.php");

else{
    if(file_exists("{$g4[path]}/res/include/sub{$tott}.php"))
       include_once("$g4[path]/res/include/sub{$tott}.php");
    
	else if(file_exists("{$g4[path]}/res/include/sub{$tott}full.php")){ 

    }else if(file_exists("{$g4[path]}/res/images/sub{$tott}.jpg"))
		echo "<img src='/res/images/sub{$tott}.jpg' alt='".$menu["tott"][$pageNum][$subNum][$ssNum]." 컨텐츠'/>";

    else if(file_exists("{$g4[path]}/res/include/sub{$tot}.php"))
		include_once("$g4[path]/res/include/sub{$tot}.php");

    else if(file_exists("{$g4[path]}/res/include/sub{$tot}full.php")){

	}else if(file_exists("{$g4[path]}/res/images/sub{$tot}.jpg")) {
		if($tot=='5_1') { ?>
			<div class="location_map">
				<? echo "<img src='/res/images/sub{$tot}.jpg' alt='".$menu["tot"][$pageNum][$subNum]." 컨텐츠'/>"; ?>
				<!-- * 카카오맵 - 지도퍼가기 -->
				<!-- 1. 지도 노드 -->
				<div id="daumRoughmapContainer1608595904538" class="root_daum_roughmap root_daum_roughmap_landing" style="position:absolute; left:13px; top:115px;"></div>

				<!--
					2. 설치 스크립트
					* 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
				-->
				<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

				<!-- 3. 실행 스크립트 -->
				<script charset="UTF-8">
					new daum.roughmap.Lander({
						"timestamp" : "1608595904538",
						"key" : "23kzn",
						"mapWidth" : "610",
						"mapHeight" : "390"
					}).render();
				</script>
			</div>
		<? }
		else
			echo "<img src='/res/images/sub{$tot}.jpg' alt='".$menu["tot"][$pageNum][$subNum]." 컨텐츠'/>";
	}
		

    else if(file_exists("{$g4[path]}/res/include/sub{$pageNum}.php"))
		include_once("$g4[path]/res/include/sub{$pageNum}.php");

    else if(file_exists("{$g4[path]}/res/include/sub{$pageNum}full.php")){

    }else if(file_exists("{$g4[path]}/res/images/sub{$pageNum}.jpg"))
		echo "<img src='/res/images/sub{$pageNum}.jpg' alt='".$menu["pageNum"][$pageNum]." 컨텐츠'/>";

    else {?>
		<p style="padding:180px 0; font-size:30px; line-height:40px; color:#222; text-align:center;" >준비중입니다.</p>
    <?}
}?>

</div>
<?
include_once("./_tail.php");
?>