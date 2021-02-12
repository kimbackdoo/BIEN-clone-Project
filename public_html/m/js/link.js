function home(){location.href="/m/index.php";} // 홈
function adm(){location.href="/adm";} //관리자
function login(){location.href="/m/bbs/login.php";} //로그인
function logout(){location.href="/m/bbs/logout.php?url=/index.php";} //로그아웃
function register(){location.href="/m/bbs/register.php";} //회원가입
function order(){location.href="/m/shop/orderinquiry.php";} //주문배송확인
function mypage(){location.href="/m/shop/mypage.php";} //마이페이지
function cart(){location.href="/m/shop/cart.php";} //장바구니
function m_it9(){window.open("http://it9.co.kr/m/bbs/board.php?bo_table=portfolio");} //아이티나인
function revision(){location.href="/m/bbs/member_confirm.php?url=register_form.php";} //회원정보수정

function guide2(){location.href="/m/pages.php?p=100_6_1_1";} //이용약관
function info2(){location.href="/m/pages.php?p=100_7_1_1";} //개인정보취급방침
function email2(){location.href="/m/pages.php?p=100_16_1_1";} //이메일무단수집거부

//function sand(){location.href="/bbs/login.php?url=..%2Fshop%2Forderinquiry.php";} //비회원배송조회

function menum(link_go) {
	switch ( link_go ) {

		//건축소개
		case 'menu01-1' : //건축가의 말
		location.href="/m/pages.php?p=1_1_1_1"; break;
		case 'menu01-2' : //제공건축
		location.href="/m/pages.php?p=1_2_1_1"; break;

		//객실소개
		case 'menu02-1' ://비양1 · 비양2 · 비양3
		location.href="/m/pages.php?p=2_1_1_1"; break;
		case 'menu02-2' ://비양 단독주택
		location.href="/m/pages.php?p=2_2_1_1"; break;

		//부대시설
		case 'menu03-1' :// 무료 조식서비스 · 카페
		location.href="/m/pages.php?p=3_1_1_1"; break;


		//예약안내
		case 'menu04-1' : //예약안내
		location.href="/m/pages.php?p=4_1_1_1"; break;
		case 'menu04-2' : //예약문의
		location.href="/m/bbs/board.php?bo_table=4_2_1_1"; break;
		case 'manu04-3' : //예약 캘린더
		location.href="/m/pages.php?p=4_3_1_1"; break;

		//오시는 길
		case 'menu05-1' : //오시는 길
		location.href="/m/pages.php?p=5_1_1_1"; break;
		

		//이용약관
		case 'menu07-1' : //이용약관
		location.href="/m/pages.php?p=7_1_1_1"; break;
		case 'menu07-2' : //개인정보취급방침
		location.href="/m/pages.php?p=7_2_1_1"; break;	

		}
}
