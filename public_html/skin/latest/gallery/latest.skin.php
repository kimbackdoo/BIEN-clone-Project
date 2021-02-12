<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once("$g4[path]/lib/thumb.lib.php");

$cols  = 1; //  이미지 가로갯수 //  이미지 세로 갯수는 메인에서 지정(총 이미지 수)
$image_h  = 1; // 이미지 상하 간격
$col_width = (int)(99 / $cols);

$img_width = 83; //썸네일 가로길이
$img_height = 61; //썸네일 세로길이
$img_quality = 90; //퀼리티 100이하로 설정 일부 php버전에서는 10이하의 수로 처리 될 수 있삼

if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있는 갤러리 게시판 입니다.");

$data_path = $g4[path]."/data/file/$bo_table";
$thumb_path = $data_path.'/thumb_img_list'; //썸네일 이미지 생성 디렉토리

@mkdir($thumb_path, 0707);
@chmod($thumb_path, 0707);

/*
//공지사항 맨위로 올림
 if (count($list) >1 ) {
foreach( $list as $key => $value) $tmp_notice[$key] = $value['is_notice'] *100000 + $value['wr_id'];
 array_multisort($tmp_notice, SORT_DESC, $list);
}
*/
?>
<div style="padding-top:9px;padding-left:8px;">
<table style="margin-top:0px; padding:0px; border-spacing:0px;border-collapse:0px;">
<tr>
	<? for ($i=0; $i<count($list); $i++) {

		// 첨부파일 이미지가 있으면 썸을 생성, 아니면 pass~!
		if ($list[$i][file][0][file]) {

			// 이미지 체크
			$image = urlencode($list[$i][file][0][file]);
			$ori="$g4[path]/data/file/$bo_table/" . $image;
			$ext = strtolower(substr(strrchr($ori,"."), 1)); //확장자

			// 이미지가 있다면.
			if ($ext=="gif"||$ext=="jpg"||$ext=="jpeg"||$ext=="png"||$ext=="bmp"||$ext=="tif"||$ext=="tiff") {

				// 섬네일 경로 만들기 + 섬네일 생성
				$list_img_path = $list[$i][file][0][path]."/".$list[$i][file][0][file];
				$list_thumb = thumbnail($list_img_path ,$img_width, $img_height,0,2,100);

			}

		} else {                ////  첨부파일 이미지가 없으면

			$list_thumb = "/res/images/noimg.jpg";

		}
		
		$img = "<img src='{$list_thumb}' style='width:{$img_width}px; height:{$img_height}px;' />";
		$a_img="<a href='{$list[$i][href]}'>$img</a>";
?>

<td valign="top">
<script>
$(document).ready(function (){
	$("#border<?=$i?>").hover(function(){
	$(this).css("border","1px solid #0098dc"); },
	function(){$(this).css("border","1px solid #5a5a5a");
	});
});
</script>
	<div style="width:<?=$img_width+2?>px; <?if($i<count($list)-1){?>padding-right:11px;<?}?>">
		<div style="margin:0 auto; float:left; text-align:center;" >
		<div id="border<?=$i?>" style="border:1px solid #5a5a5a;margin-bottom:5px;">
		<?=$a_img?>
		</div>

			<!--<div style="height:14px; margin-top:2px;">
	       <?
            if ($list[$i]['is_notice'])
               echo "<font style='font:12px dotum;'><font color=#252525>{$list[$i]['subject']}</font></font>";
               else
               echo "<font style='font:12px dotum;'><font color=#252525>{$list[$i]['subject']}</font></font>";
               echo "</a>";
		   ?>
			</div>-->

			<!--<div style="height:13px; margin-top:1px;">
			<font style='font:12px dotum; text-align:center;'><font 	color=#252525><?=date("Y.m.d",strtotime($list[$i][wr_datetime]));?></font>
			</div>-->

		</div>

		<div style="font-family:돋움; text-align:center; margin:0 auto;">
		<?
		/*$latestsubject=substr($list[$i]['subject'],0,12);
		echo $latestsubject;*/
		?>
		</div>
		<div style="clear:both;"></div>
	</div>
</td>

<?
	}
?>

</tr>
</table>
</div>
