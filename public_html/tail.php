<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<?if(!defined("__INDEX")){?>
	<?if($bo_table){?>
	</div>
	<?}?>
	</section>
</section>
</div>
<?}?>

<? 
if(file_exists("{$g4[path]}/res/include/sub{$tott}full.php")) {
	include_once("$g4[path]/res/include/sub{$tott}full.php");
}else if(file_exists("{$g4[path]}/res/include/sub{$tot}full.php")) {
	include_once("$g4[path]/res/include/sub{$tot}full.php");
}else if(file_exists("{$g4[path]}/res/include/sub{$pageNum}full.php")) {
	include_once("$g4[path]/res/include/sub{$pageNum}full.php");
}?>

<div class="wrap-footer">
	<footer class="layout">
		<div class="position">
			<!--하단 영역-->
			<!--
			<div class="hidden">
				<dl>
					<dt></dt>
					<dd></dd>
					<dt></dt>
					<dd></dd>
					<dt></dt>
					<dd></dd>
				</dl>
			</div>
			-->
			<div class="footer_div1">
				<ul>
					<li><a href="/bbs/board.php?bo_table=4_2_1_1">예약문의</a></li>
					<li><a href="/pages.php?p=5_1_1_1">오시는 길</a></li>
					<li><a href="javascript:info2()">개인정보취급방침</a></li>
				</ul>
				
				<a href="#"><img src="/res/images/bottom/top.jpg" alt="Top" /></a>
			</div>
			<div class="footer_div2">
				<p>
					비양<span>·</span>
					대표자 : 심대중<span>·</span>
					주소 : 63012 제주특별자치도 제주시 옹포3길 25-2<span>·</span>
					지번주소 : 제주시 한림읍 옹포리 489번지<span>·</span>
					예약문의 : 010-6226-5736<span>·</span>
					사업자등록번호 : 616-86-27531
					BIEN <span>·</span>
					Address : 25-2 Ongpo 3-gil Hallim-eup Jeju-si Jeju-do Korea 63012<span>·</span>
					Tel : +82-10-6226-5836(Reservation only)<br />
					개인정보책임자 : 심대중<span>·</span>
					개인정보관리자 : 심대중
				</p>
			</div>
			<div class="footer_div3">
				<span>COPYRIGHT 2020 &copy; <?=$g4['title']?> <span>BIEN</span>. ALL RIGHT RESERVED.
				<a href="javascript:adm()"><img src="/res/images/bottom/admin.jpg" alt="admin" /></a>
				DESIGN BY <a href="javascript:it9()"><img src="/res/images/bottom/itnine.jpg" alt="아이티나인" /></a></span>
			</div>
		</div>
	</footer>
</div>

</div>
<?
include_once("$g4[path]/tail.sub.php");
?>