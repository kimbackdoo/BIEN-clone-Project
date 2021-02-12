<?
include_once("./_common.php");

include_once("./head.php");
?>
<section class="sub">

<?if($tot==''){?>

<?}else if($tot=='100_6')//이용약관 
	include_once("$g4[mpath]/include/utilization.php");

else if($tot=='100_7')//개인정보처리방침
	include_once("$g4[mpath]/include/privacy.php");

else if($tot=='100_16')//이메일주소무단수집거부
	include_once("$g4[mpath]/include/email_privacy.php");
else{

    if(file_exists("{$g4[path]}/m/include/sub{$tott}.php"))
       include_once("$g4[path]/m/include/sub{$tott}.php");
    
    else if(file_exists("{$g4[path]}/m/images/sub{$tott}.jpg"))
		echo "<img src='/m/images/sub{$tott}.jpg' alt='".$menu["tott"][$pageNum][$subNum][$ssNum]." 컨텐츠'/>";

    else if(file_exists("{$g4[path]}/m/include/sub{$tot}.php"))
		include_once("$g4[path]/m/include/sub{$tot}.php");

	else if(file_exists("{$g4[path]}/m/images/sub{$tot}.jpg"))
		if($tot=='5_1') { ?>
			<div class="location_map">
				<? echo "<img src='/m/images/sub{$tot}.jpg' alt='".$menu["tot"][$pageNum][$subNum]." 컨텐츠'/>"; ?>
				<!-- * 카카오맵 - 지도퍼가기 -->
				<!-- 1. 지도 노드 -->
				<div id="daumRoughmapContainer1608595904538" class="root_daum_roughmap root_daum_roughmap_landing" style="position:absolute; left:20px; top:373px;"></div>

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
						"mapWidth" : "600",
						"mapHeight" : "390"
					}).render();
				</script>
			</div>
		<? }
		else
			echo "<img src='/m/images/sub{$tot}.jpg' alt='".$menu["tot"][$pageNum][$subNum]." 컨텐츠'/>";

		

    else if(file_exists("{$g4[path]}/m/include/sub{$pageNum}.php"))
		include_once("$g4[path]/m/include/sub{$pageNum}.php");

    else if(file_exists("{$g4[path]}/m/images/sub{$pageNum}.jpg"))
		echo "<img src='/m/images/sub{$pageNum}.jpg' alt='".$menu["pageNum"][$pageNum]." 컨텐츠'/>";

    else {?>
		<img src="/m/images/sub_ready.jpg" style="display:block; margin:0 auto;"/>
    <?}

}?>

</section>
<?
include_once("./tail.php");
?>
