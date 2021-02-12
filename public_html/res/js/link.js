
function home(){location.href="/index.php";} // 홈
function register(){location.href="/bbs/register.php";} // 회원가입
function adm(){location.href="/adm";} //관리자
function login(){location.href="/bbs/login.php?url=/index.php";} //로그인
function logout(){location.href="/bbs/logout.php?url=/index.php";} //로그아웃
function cart(){location.href="/shop/cart.php";} //장바구니
function mypage(){location.href="/shop/mypage.php";} //마이페이지
function sand(){location.href="/bbs/login.php?url=..%2Fshop%2Forderinquiry.php";} //비회원배송조회
function info(){location.href="/bbs/register.php";} //개인정보취급방침
function guide(){location.href="/community/guidance.php";} //이용안내
function find(){location.href="javascript:win_password_lost();";} //아이디/비밀번호찾기
function revision(){location.href="/bbs/member_confirm.php?url=register_form.php";} //회원정보수정
//로그인페이지항시추가
function guide2(){location.href="/pages.php?p=100_6_1_1";} //이용약관
function info2(){location.href="/pages.php?p=100_7_1_1";} //개인정보취급방침
function email2(){location.href="/pages.php?p=100_16_1_1";} //이메일무단수집거부
function it9(){window.open("http://it9.co.kr/bbs/board.php?bo_table=portfolio");} //아이티나인
function cube(){window.open("http://jejucube.com/bbs/board.php?bo_table=3_1_1_1");} //큐브
function jlink(){window.open("http://j-link.co.kr/bbs/board.php?bo_table=2_1_1_1&sca=%EA%B8%B0%EB%B3%B8%ED%98%95");} //제이링크
function roomnet02(){window.open("http://jejuroom.net/bbs/login.php?url=%2Fadm%2Findex.php%3F");} //룸넷

function info3(){window.open('/privacy.html','','width=675,height=670,scrollbars=yes')} //개인정보취급방침 팝업창
function info4(){window.open('http://www.ftc.go.kr/info/bizinfo/communicationList.jsp')} //사업자정보확인
function load(){window.open('/map.html','','width=750,height=620')} //오시는길 팝업창
function img(){location.href="/swf/img.zip";} //사진다운로드
//function travel(){var test = window.open('http://tourinfo.1937.co.kr/swf/main1.swf', '', 'fullscreen=yes,scrollbars=yes');} //travel
function travel(){ window.open('/travel.php', '', 'fullscreen=yes,scrollbars=yes') }//travel

function bookmark() {
 
 url = g4_url2; //즐겨찾기에 추가할 곳의 url
 title="사이트명"//사이트명
 // Internet Explorer
 if(document.all)
 {
  window.external.AddFavorite(url, title);
 }
 // Google Chrome
 else if(window.chrome){
  alert("이 브라우저는 Ctrl+D 키를 눌러서 \n즐겨찾기추가를 하셔야 합니다 ^^;");
 }
 // Firefox
 else if (window.sidebar) // firefox
 {
  window.sidebar.addPanel(title, url, "");
 }
 // Opera
 else if(window.opera && window.print)
 { // opera
  var elem = document.createElement('a');
  elem.setAttribute('href',url);
  elem.setAttribute('title',title);
  elem.setAttribute('rel','sidebar');
  elem.click();
 } else {
		var rv = -1;
		if (navigator.appName == 'Netscape')
		{
			var ua = navigator.userAgent;
			var re  = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
			if (re.exec(ua) != null)
			rv = parseFloat( RegExp.$1 );

			if(rv >= 11){
				  alert("이 브라우저는 Ctrl+D 키를 눌러서 \n즐겨찾기추가를 하셔야 합니다 ^^;");
			}
		}
 }
}

function menulink(link_go) {
	switch ( link_go ) {

		//비양
		case 'menu01-1' : //인사말
		location.href="/pages.php?p=1_1_1_1"; break;
		case 'menu01-2' : //건축가의 말
		location.href="/pages.php?p=1_2_1_1"; break;
		

		//객실소개
		case 'menu02-1' : //비양1
		location.href="/pages.php?p=2_1_1_1"; break;
		case 'menu02-2' : //비양2
		location.href="/pages.php?p=2_2_1_1"; break;
		case 'menu02-3' : //비양3
		location.href="/pages.php?p=2_3_1_1"; break;
		case 'menu02-4' : //비양 단독주택
		location.href="/pages.php?p=2_4_1_1"; break;


		//부대시설
		case 'menu03-1' : //무료 조식서비스
		location.href="/pages.php?p=3_1_1_1"; break;
		case 'menu03-2' : //카페
		location.href="/pages.php?p=3_2_1_1"; break;

		//예약안내
		case 'menu04-1' : //예약안내
		location.href="/pages.php?p=4_1_1_1"; break;
		case 'menu04-2' : // 예약문의
		location.href="/bbs/board.php?bo_table=4_2_1_1"; break;
		case 'menu04-2' : //예약 캘린더
		location.href="/pages.php?p=4_2_1_1"; break;

		//오시는 길
		case 'menu05-1' : //오시는 길
		location.href="/pages.php?p=5_1_1_1"; break;
	}
}

