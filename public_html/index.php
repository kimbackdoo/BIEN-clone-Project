<?
include_once("./_common.php");
include_once("$g4[path]/lib/latest.lib.php");

define("__INDEX",TRUE);

$g4['title'] = "";
include_once("./_head.php");

//팝업
include_once("$g4[path]/lib/popmng.lib.php");
?>


<div class="wrap-main wrap-content">
<section class="layout">

	
	<!-- <div class="holder"></div> -->
	<!--	
	<div class="section_div">
		<div class="section_div1"></div>
		<div class="section_div2"></div>
		<div class="section_div3">
			<div></div>
			<div></div>
		</div>
	</div>
	-->
	<?include_once("{$g4[path]}/res/include/mainvisual.php");?>


	<div>
		<div class="section_div4">
			<img src="/res/images/index/div4.jpg" alt="펜션사진" />
		</div>

		<div class="section_div5">
			<img src="/res/images/index/div5.jpg" alt="펜션설명" />
		</div>

		<div class="section_div6"></div>
		<div class="section_div7">
			<img src="/res/images/index/div7_지도.jpg" alt="지도" />

			<!-- * 카카오맵 - 지도퍼가기 -->
			<!-- 1. 지도 노드 -->
			<div id="daumRoughmapContainer1608595904538" class="root_daum_roughmap root_daum_roughmap_landing" style="position:absolute; left:10px; top:55px;"></div>

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
					"mapWidth" : "609",
					"mapHeight" : "390"
				}).render();
			</script>
			
			<img src="res/images/index/div7_주소.jpg" alt="주소" />
		</div>
	</div>
</section>
</div>









<?
include_once("./_tail.php");
?>