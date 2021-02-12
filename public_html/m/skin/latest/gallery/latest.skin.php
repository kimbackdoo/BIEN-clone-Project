<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$cols  = 1; //  이미지 가로갯수 //  이미지 세로 갯수는 메인에서 지정(총 이미지 수)
$image_h  = 1; // 이미지 상하 간격
$col_width = (int)(99 / $cols);

$img_width = 540; //썸네일 가로길이
$img_height = 380; //썸네일 세로길이
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

<style>
.la_subj {
    width:235px;color:#333333;font-size:22px;line-height:24px;font-weight:500; padding:14px 0 0 22px; text-align:center;
    display:inline-block;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:normal;
    height:48px;
     word-wrap: break-word;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.la_date { 
	margin:0px 0 0 0px; font-size:20px; color:#383838; text-align:center; padding:0px 20px;
    display:inline-block;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:normal;
    height:42px;
     word-wrap: break-word;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;

}



</style>

<div style="padding-top:0px;">
<table style="margin-top:0px; padding:0px; border-spacing:0px;border-collapse:0px;">
<tr>
<? for ($i=0; $i<count($list); $i++) { ?>
<?
$wr_content = "<a href='{$list[$i]['href']}' style='color:#7a7a7a;'>".cut_str(strip_tags($list[$i]['wr_content']), 20, '...')."</a>";
 //   if ($i>0 && $i%$cols==0) { echo "<td colspan='$cols' height='$image_h'></td><tr>"; }
    $img = "<img src='/res/images/noimg.jpg' border=1 width='$img_width' height='$img_height' title='이미지 없음' align=left style='border:1 #222222 solid;'>";
    $thumb = $thumb_path.'/'.$list[$i][wr_id];


	// 섬네일과 새로 올린파일 날짜를 비교하여 셈네일을 갱신하기위해서 지운다.
	if ( file_exists($thumb) && (filemtime($thumb) < filemtime($list[$i][file][0][path] .'/'. $list[$i][file][0][file])) ) {
		@unlink($thumb);
	}

    // 썸네일 이미지가 존재하지 않는다면
    if (!file_exists($thumb)) {
        $file = $list[$i][file][0][path] .'/'. $list[$i][file][0][file];
        // 업로드된 파일이 이미지라면
		//echo $i;
        if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file)) {
            $size = getimagesize($file);
            if ($size[2] == 1)
                $src = imagecreatefromgif($file);
            else if ($size[2] == 2)
                $src = imagecreatefromjpeg($file);
            else if ($size[2] == 3)
                $src = imagecreatefrompng($file);
            else
                break;

            $rate = $img_width / $size[0];
            $height = (int)($size[1] * $rate);
			$width = (int)($size[0] * $rate);

            // 계산된 썸네일 이미지의 높이가 설정된 이미지의 높이보다 작다면
            $dst = imagecreatetruecolor($img_width, $img_height);

            if ($height < $img_height) {                // 계산된 이미지 높이로 복사본 이미지 생성
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $img_height, $size[0], $size[1]);
				@imagepng($dst, $thumb_path.'/'.$list[$i][wr_id], $img_quality);
            } else {   // 설정된 이미지 높이로 복사본 이미지 생성
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $img_width, $height, $size[0], $size[1]);
				@imagepng($dst, $thumb_path.'/'.$list[$i][wr_id], $img_quality);

			}
			//echo $i;
            chmod($thumb_path.'/'.$list[$i][wr_id], 0606);
        }
    }

    //if (file_exists($thumb))
    //     $img = "<img src='$thumb' border=0 style='width:".$img_width."px; height:".$img_height."px;'>";
		if (!file_exists($thumb)){
		 $img = "<img src='/m/images/noimg.jpg' style='width:".$img_width."px; height:".$img_height."px; display:block;'>";
		}else{
	     $img = "<img src='{$list[$i][file][0][path]}/{$list[$i][file][0][file]}' border=0 style='width:".$img_width."px; height:".$img_height."px; display:block;'>";
		}
?>
<?
        $datetime = substr($list[$i][wr_datetime],0,10);
        $datetime2 = $list[$i][wr_datetime];

        if ($list[$i]['wr_datetime'] >= date("Y-m-d H:i:s", $g4['server_time'] - ($row['bo_new'] * 3600))) $comment_new = "new";

        if ($datetime == $g4[time_ymd])
            $datetime2 = substr($datetime2,11,5);
        else
            $datetime2 = substr($datetime2,5,5);

    $list[$i][datetime] = $datetime;
    $list[$i][datetime2] = $datetime2;

    $a[$i] = array(
      "wr_date"=>$datetime2,
);
?>

<?
 $rw_subject = cut_str(stripslashes($list[$i][subject]),$subject_size,'..');
 $a_link="<a href='{$list[$i][href]}'>$rw_subject</a>";
   $a_img="<a href='{$list[$i][href]}' style='margin:0; padding:0; display:block;'>$img</a>";
 $a_comment="<a href=\"{$list[$i][comment_href]}\"><span class='commentFont'>{$list[$i]['comment_cnt']}</span></a>";
 $rw_content = cut_str(stripslashes($list[$i][wr_content]),30,' ..more');
 $rw_content = strip_tags($rw_content);
?>

<td valign="top">
<!-- <script>
$(document).ready(function (){
	$("#border<?=$i?>").hover(function(){
	$(this).css("border","1px solid #5a5a5a").css("border-bottom","0px"); },
	function(){$(this).css("border","1px solid #5a5a5a").css("border-bottom","0px");
	});
});
</script>-->
	<div style="width:<?=$img_width?>px; height:211px; cursor:pointer; <?if($i<count($list)-1){?>margin-right:10px;<?}?>"  onclick="location.href='<?=$list[$i][href]?>'">
		<div style="margin:0 auto; float:left; text-align:left;" >
			<div id="border<?=$i?>">
				<?=$a_img?>
			</div>

			<!-- <div class="la_subj">
				<?=$list[$i]['subject']?>
			</div -->

		<!-- 	<div class="la_date">
				<?=strcut_utf8(preg_replace("/<[^>]*>/iU","",preg_replace("/[\n\r]/iU","",$list[$i][wr_content])),74,". . .")?>
			</div> -->

		</div>

		<div style="text-align:center; margin:0 auto 0; font-size:22px; color:#000; line-height:45px;">
		<?
		$latestsubject=substr($list[$i]['subject'],0,120);
		echo $latestsubject;
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
