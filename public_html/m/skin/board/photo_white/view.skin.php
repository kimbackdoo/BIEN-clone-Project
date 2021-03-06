<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<style>
.mb_area { display:inline-block; width:100%; padding-bottom:16px; position:relative; font-size:18px; font-weight:300; line-height:26px; }
.mb_area > div { float:left; height:100%; display:inline-block; }
.mb_area_bar { display:inline-block; width:1px; height:14px; background:#999; margin:-3px 8px 0; vertical-align:middle; }

.view_title { font-size:25px; color:#111; line-height:1.5em; padding-bottom:10px; border-bottom:2px solid #000; }

#view_file_download_area { padding:10px 0 10px; display:inline-block; width:100%; }

#writeContents { padding-bottom:40px; margin-top:30px; }
#writeContents,
#writeContents p, 
#writeContents div { display:block; line-height:1.5em; }
#writeContents img { max-width:600px; height:auto !important; }


.link_buttons { display:inline-block; width:100%; text-align:center; padding-top:20px; }
.link_buttons > a { display:inline-block; }
.link_buttons > a > span { display:inline-block; }

a.nBtn { padding:0px 15px; line-height:40px; font-size:17px; font-weight:400; display:inline-block; text-decoration:none; }
a.nBtn1 { background:#484848; color:#ffffff; }
a.nBtn2 { background:#727272; color:#ffffff; }
a.nBtn3 { background:#dddddd; color:#555555; }
</style>


<div style="clear:both; display:none;" >
    <!-- 링크 버튼
    <div style="float:right;">
    <?
    ob_start();

    //비회원의 경우 수정/삭제 버튼 없앰
    if(!$member["mb_id"] && !$view["icon_secret"]) {
        if(!isset($bo_use_password_input) || !in_array($bo_table, $bo_use_password_input)){
            $delete_href = "";
            $update_href = "";
        }
    }
    ?>
	<? if ($search_href) { echo "<a href=\"$search_href\" class='nBtn nBtn1'>검색목록</a> "; } ?>
	<? echo "<a href=\"$list_href\" class='nBtn nBtn1'>목록보기</a> "; ?>
    <? if ($copy_href && false) { echo "<a href=\"$copy_href\" class='nBtn nBtn3'>복사하기</a> "; } ?>
    <? if ($move_href && false) { echo "<a href=\"$move_href\" class='nBtn nBtn3'>이동하기</a> "; } ?>
	<? if ($delete_href) { echo "<a href=\"$delete_href\" class='nBtn nBtn3'>삭제하기</a> "; } ?>
    <? if ($reply_href) { echo "<a href=\"$reply_href\" class='nBtn nBtn3'>답변하기</a> "; } ?>
	<? if ($update_href) { echo "<a href=\"$update_href\" class='nBtn nBtn2'>수정하기</a> "; } ?>
    <? if ($write_href) { echo "<a href=\"$write_href\" class='nBtn nBtn2'>글쓰기</a> "; } ?>
    <?
    $link_buttons = ob_get_contents();
    ob_end_flush();
    ?>
    </div> -->
</div>



<div class="mb_area" >
	<div style="width:100%;" >
		<p style="color:#555; font-size:19px;" ><span class="hidden_span" >작성자 : </span><?=$view["wr_name"]?></p>
		<div style="color:#888;" >
			<span class="hidden_span" >등록일 : </span><?=date("Y.m.d",strtotime($view[datetime]))?><div class="mb_area_bar" ></div>조회수&nbsp;<?=$view[wr_hit]?>
		</div>
	</div>
</div>


<div class="view_title">
   <?=cut_hangul_last(get_text($view[wr_subject]))?>
</div>



<?
// 가변 파일
$cnt = 0;
echo "<div id='view_file_download_area' >";
for ($i=0; $i<count($view[file]); $i++) {
    if ($view[file][$i][source] && !$view[file][$i][view]) {
        $cnt++;
        echo "<div>";
        echo	"<img src='{$board_skin_path}/img/icon_file.gif' align=absmiddle border='0' alt='첨부파일 아이콘' >";
        echo	"<a href=\"#boardarea\" title='{$view[file][$i][content]}' onclick=\"file_download('{$view[file][$i][href]}', '{$view[file][$i][source]}');\" >";
        echo		"&nbsp;<span style=\"color:#888;\">{$view[file][$i][source]} ({$view[file][$i][size]})</span>";
        echo		"&nbsp;<span style=\"color:#ff6600; font-size:15px;\">[{$view[file][$i][download]}]</span>";
        echo		"&nbsp;<span style=\"color:#b3b3b3; font-size:15px;\">DATE : {$view[file][$i][datetime]}</span>";
        echo	"</a>";
        echo "</div>";
    }
}
echo "</div>";

// 링크
$cnt = 0;
echo "<div id='view_link_area' >";
for ($i=1; $i<=$g4[link_count]; $i++) {
    if ($view[link][$i]) {
        $cnt++;
        echo "<div>";
        echo	"<img src='{$board_skin_path}/img/icon_link.gif' align=absmiddle border='0' alt='링크 아이콘' >";
        echo	"<a href='{$view[link_href][$i]}' target=_blank>";
        echo		"&nbsp;<span style=\"color:#888;\">{$link}</span>";
        echo		"&nbsp;<span style=\"color:#ff6600; font-size:15px;\">[{$view[link_hit][$i]}]</span>";
        echo	"</a>";
        echo "</div>";
    }
}
echo "</div>";
?>


<div id="writeContents">
	<?
	/*
	// 파일 출력
	for ($i=0; $i<=count($view[file]); $i++) {
		if ($view[file][$i][view])
			echo $view[file][$i][view] . "<p>";
	}
	*/
	?>

	<!-- 내용 출력 -->
	<?=$view[content];?>
</div>


<table width=100% border=0 cellpadding=0 cellspacing=0 style="border-top:1px solid #d6d6d6; border-bottom:1px solid #d6d6d6; " >
	<colgroup>
		<col width="60px" />
		<col width="80px" />
		<col width="" />
	</colgroup>
	<tr>
		<td align="center" valign="middle" <?=$prev_href ? " onclick=\"location.href='".$prev_href."'\" " : ""?> >
			<img src="/img/up.jpg" style="display:block;" >
		</td>
		<td align="left" valign="middle" style="color:#666; font-size:16px;" >이전 글</td>
		<td style="padding:13px 10px 13px 0px; font-size:16px;" >
			<?=$prev_href ? "<a href='".$prev_href."' style='color:#666; text-decoration:none;' >".$prev_wr_subject."</a>" : "<span style='color:#999'>이전 글이 없습니다.</span>"?>
		</td>
	<tr>
	<tr>
		<td align="center" valign="middle" style="border-top:1px solid #d6d6d6;" <?=$next_href ? " onclick=\"location.href='".$next_href."'\" " : ""?> >
			<img src="/img/down.jpg" style="display:block;" />
		</td>
		<td align="left" valign="middle" style="color:#666; font-size:16px; border-top:1px solid #d6d6d6;" >다음 글</td>
		<td style="padding:13px 10px 13px 0px; font-size:16px; border-top:1px solid #d6d6d6;" >
			<?=$next_href ? "<a href='".$next_href."' style='color:#666; text-decoration:none;' >".$next_wr_subject."</a>" : "<span style='color:#999'>다음 글이 없습니다.</span>"?>
		</td>
	<tr>
</table>


<?
// 코멘트 입출력
if($board["bo_comment_level"] < 10){
	include_once("./view_comment.php");
}
?>

<!-- 링크 버튼 -->
<div class="link_buttons" >
	<?=$link_buttons?>
</div>




<script type="text/javascript">
function file_download(link, file) {
    <? if ($board[bo_download_point] < 0) { ?>if (confirm("'"+file+"' 파일을 다운로드 하시면 포인트가 차감(<?=number_format($board[bo_download_point])?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?"))<?}?>
    document.location.href=link;
}
</script>

<script type="text/javascript" src="<?="$g4[path]/js/board.js"?>"></script>
<script type="text/javascript">
window.onload=function() {
    resizeBoardImage(<?=(int)$board[bo_image_width]?>);
    //drawFont();
}
/*
$(function(){
	$("img[name='target_resize_image[]']").each(function(){
		$(this).css("cursor", "pointer");
	});
});
*/
</script>
<!-- 게시글 보기 끝 -->
