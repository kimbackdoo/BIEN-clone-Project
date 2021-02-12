<?
/*
 * author	: 김재훈
 * date		: 2020-12-23
 * desc	    : 모바일사이트
 */
include_once("./_common.php");
include_once("{$g4["path"]}/lib/thumb.lib.php");
define("__INDEX",TRUE);
include_once("./head.php");

?>

<section>

	<?include_once("{$g4["path"]}/m/include/mainvisual.php");?>

	<div>
		<img src="/m/images/index/index.jpg" alt="index" />
	</div>

</section>

<?
include_once("./tail.php");
?>
