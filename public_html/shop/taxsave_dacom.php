<?
include_once("./_common.php");

$g4[title] = "현금영수증 발행";
include_once("$g4[path]/head.sub.php");

$od = sql_fetch(" select * from $g4[yc4_order_table] where od_id = '$od_id' and on_uid = '$on_uid' ");
if (!$od) 
    die("주문서가 존재하지 않습니다.");

$goods = get_goods($od[on_uid]);
$goods_name = $goods[full_name];
if ($goods[count] > 1)
    $goods_name .= ' 외 '.$goods[count].'건';

$trad_time = date("YmdHis");

$amt_tot = (int)$od[od_receipt_bank];
$amt_sup = (int)round(($amt_tot * 10) / 11);
$amt_svc = 0;
$amt_tax = (int)($amt_tot - $amt_sup);
?>
<html>    
<head>
<title>현금영수증 발행</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$g4['charset']?>">
<link rel="stylesheet" href="css/group.css" type="text/css">
<style>
body, tr, td {font-size:10pt; font-family:굴림,verdana; color:#433F37; line-height:19px;}
table, img {border:none}

/* Padding ******/ 
.pl_01 {padding:1 10 0 10; line-height:19px;}
.pl_03 {font-size:20pt; font-family:굴림,verdana; color:#FFFFFF; line-height:29px;}

/* Link ******/ 
.a:link  {font-size:9pt; color:#333333; text-decoration:none}
.a:visited { font-size:9pt; color:#333333; text-decoration:none}
.a:hover  {font-size:9pt; color:#0174CD; text-decoration:underline}

.txt_03a:link  {font-size: 8pt;line-height:18px;color:#333333; text-decoration:none}
.txt_03a:visited {font-size: 8pt;line-height:18px;color:#333333; text-decoration:none}
.txt_03a:hover  {font-size: 8pt;line-height:18px;color:#EC5900; text-decoration:underline}
</style>

<script language="javascript">

// 영수증 선택에 따른 분류

function RCP1(){
	document.fdacom.usertype.value="1" // 소득공제용
}

function RCP2(){
	document.fdacom.usertype.value="2" // 지출증빙용
}


var openwin;

function pay()
{	

	
	  // 필수항목 체크 (영수증 발행 용도에 따른 주민등록번호와 사업자번호 길이와 오류 체크)
          // 주민등록번호와 사업자등록번호, 휴대폰 번호의 정상적인 입력여부 확인을 위해 아래의 자바스크립트는 반드시 사용하여야 하며, 
          // 사용하지 않을경우 발생된 문제에 대한 책임은 상점에 있습니다.
	  // 또한 휴대폰 사업자가 추가될 경우, 반드시 아래의 휴대폰 번호 체크 자바스크립트에 휴대폰 앞자리를 추가하시기 바랍니다. 
          // 이니시스에서는 실명확인 서비스를 제공하지 않으니, 실명확인 업체를 이용하시기 바랍니다.
          	
	if(document.fdacom.usertype.value == "")
	{	
		alert("현금영수증 발행용도를 선택하세요. 필수항목입니다.");
		return false;
	}
	else if(document.fdacom.usertype.value == "1")
	{
		alert("소득공제용 영수증을 선택하셨습니다.");
		
		if(document.fdacom.ssn.value.length !=13 && document.fdacom.ssn.value.length !=10 && document.fdacom.ssn.value.length !=11)
		{
			alert("올바른 주민등록번호 13자리 또는 휴대폰 번호 10자리(11자리)를 입력하세요.");
			return false;
		}
		else if(document.fdacom.ssn.value.length == 13)
		{
			var obj = document.fdacom.ssn.value;
                	var sum=0;
                	
                	for(i=0;i<8;i++) { sum+=obj.substring(i,i+1)*(i+2); }
                	
                	for(i=8;i<12;i++) { sum+=obj.substring(i,i+1)*(i-6); }
                	
                	sum=11-(sum%11);
                	
                	if (sum>=10) { sum-=10; }
                	
                	if (obj.substring(12,13) != sum || (obj.substring(6,7) !=1 && obj.substring(6,7) != 2))
                	{
                	
                	    alert("주민등록번호에 오류가 있습니다. 다시 확인하십시오.");
                	    return false;
				
	        	}
	        	
	        }	        
	        else if(document.fdacom.ssn.value.length == 11 ||document.fdacom.ssn.value.length == 10 )
	        {
	        	var obj = document.fdacom.ssn.value;
	        	if (obj.substring(0,3)!= "011" && obj.substring(0,3)!= "017" && obj.substring(0,3)!= "016" && obj.substring(0,3)!= "018" && obj.substring(0,3)!= "019" && obj.substring(0,3)!= "010")
	        	{
	        		alert("휴대폰 번호가 아니거나, 휴대폰 번호에 오류가 있습니다. 다시 확인 하십시오. ");
	        		return false;
	        	}
	        	
	        	var chr;
			for(var i=0; i<obj.length; i++){
	        		
	        		chr = obj.substr(i, 1);
	        		if( chr < '0' || chr > '9') {
   					alert("숫자가 아닌 문자가 휴대폰 번호에 추가되어 오류가 있습니다, 다시 확인 하십시오. ");
   					return false;
  				}
			}
	       }
	}
	else if(document.fdacom.usertype.value == "2")
	{
		alert("지출증빙용 영수증을 선택하셨습니다.");
		var obj = document.fdacom.ssn.value;
		
		if(document.fdacom.ssn.value.length !=10  && document.fdacom.ssn.value.length !=11 && document.fdacom.ssn.value.length !=13)
		{
			alert("올바른 주민등록번호 13자리, 사업자등록번호 10자리 또는 휴대폰 번호 10자리(11자리)를 입력하세요.");
			return false;
		}
		else if(document.fdacom.ssn.value.length == 13)
		{
			var obj = document.fdacom.ssn.value;
                	var sum=0;
                	
                	for(i=0;i<8;i++) { sum+=obj.substring(i,i+1)*(i+2); }
                	
                	for(i=8;i<12;i++) { sum+=obj.substring(i,i+1)*(i-6); }
                	
                	sum=11-(sum%11);
                	
                	if (sum>=10) { sum-=10; }
                	
                	if (obj.substring(12,13) != sum || (obj.substring(6,7) !=1 && obj.substring(6,7) != 2))
                	{
                	
                	    alert("주민등록번호에 오류가 있습니다. 다시 확인하십시오.");
                	    return false;
				
	        	}
	        	
	        }
		else if(document.fdacom.ssn.value.length == 10 && obj.substring(0,1)!= "0"){
   			var vencod = document.fdacom.ssn.value;
   			var sum = 0; 
   			var getlist =new Array(10); 
   			var chkvalue =new Array("1","3","7","1","3","7","1","3","5"); 
   			for(var i=0; i<10; i++) { getlist[i] = vencod.substring(i, i+1); } 
   			for(var i=0; i<9; i++) { sum += getlist[i]*chkvalue[i]; } 
   			sum = sum + parseInt((getlist[8]*5)/10);  
   			sidliy = sum % 10; 
   			sidchk = 0; 
   			if(sidliy != 0) { sidchk = 10 - sidliy; } 
   			else { sidchk = 0; } 
   			if(sidchk != getlist[9]) { 
   				alert("사업자등록번호에 오류가 있습니다. 다시 확인하십시오.");    
   			    return false; 
   			}
   			else return true;
		}
		else if(document.fdacom.ssn.value.length == 11 ||document.fdacom.ssn.value.length == 10 )
	        {
	        	var obj = document.fdacom.ssn.value;
	        	if (obj.substring(0,3)!= "011" && obj.substring(0,3)!= "017" && obj.substring(0,3)!= "016" && obj.substring(0,3)!= "018" && obj.substring(0,3)!= "019" && obj.substring(0,3)!= "010")
	        	{
	        		alert("휴대폰 번호에 오류가 있습니다. 다시 확인 하십시오. ");
	        		return false;
	        	}
	        	
	        	var chr;
			for(var i=0; i<obj.length; i++){
	        		
	        		chr = obj.substr(i, 1);
	        		if( chr < '0' || chr > '9') {
   					alert("숫자가 아닌 문자가 휴대폰 번호에 추가되어 오류가 있습니다, 다시 확인 하십시오. ");
   					return false;
  				}
			}
	       }
	}	
	
	// 필수항목 체크 (상품명, 현금결제금액, 공급가액, 부가세, 봉사료, 구매자명, 주민등록번호(사업자번호,휴대폰번호), 구매자 이메일주소, 구매자 전화번호, )	
	if(document.fdacom.goodname.value == "")
	{
		alert("상품명이 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.fdacom.amount.value == "")
	{
		alert("현금결제금액이 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.fdacom.sup_price.value == "")
	{
		alert("공급가액이 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.fdacom.tax.value == "")
	{
		alert("부가세가 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.fdacom.srvc_price.value == "")
	{
		alert("봉사료가 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.fdacom.buyername.value == "")
	{
		alert("구매자명이 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.fdacom.ssn.value == "")
	{
		alert("주민등록번호(또는 사업자번호, 휴대폰번호)가 빠졌습니다. 필수항목입니다.");
		return false;
			
	}
	else if(document.fdacom.buyeremail.value == "")
	{
		alert("구매자 이메일주소가 빠졌습니다. 필수항목입니다.");
		return false;
	}
	else if(document.fdacom.buyertel.value == "")
	{
		alert("구매자 전화번호가 빠졌습니다. 필수항목입니다.");
		return false;
	}		
	
	
	// 현금결제금액 합산 체크
	// 현금결제금액 합산은 아래의 자바스크립트를 통해 반드시 확인 하도록 하시기 바라며, 
	// 아래의 자바스크립트를 사용하지 않아 발생된 문제는 상점에 책임이 있습니다.
	   
	var sump = eval(document.fdacom.sup_price.value) + eval(document.fdacom.tax.value) + eval(document.fdacom.srvc_price.value);
	if(eval(document.fdacom.sup_price.value) <= eval(document.fdacom.tax.value)){
		alert("공급가액이 부가세보다 작습니다");
		return false;
	}
	if(document.fdacom.amount.value != sump)
	{
		
		alert("총결제금액 합이 맞지 않습니다.");
		return false;
	}
    /*
	else if(sump < 5000)
	{
		alert("총결제금액이 5천원 이상이어야 현금영수증 발행이 가능합니다.");
		return false;
	}
    */
	
	// 더블클릭으로 인한 중복요청을 방지하려면 반드시 confirm()을
	// 사용하십시오.
	
	if(confirm("현금영수증을 발행하시겠습니까?"))
	{
		disable_click();
		//openwin = window.open("<?=$g4[shop_path]?>/INIpay41_escrow/sample/childwin.html","childwin","width=299,height=149");
		return true;
	}
	else
	{
		return false;
	}
}


// 영수증 발행용도 리스트 보이기

var main_cnt = 1

function showhide(num){

    for (i=1; i<=main_cnt; i++){  

      menu=eval("document.all.block"+i+".style");

      if (num == i){
      	
      	if (menu.display == "block") {
        	
        	menu.display="none";        
        } 
        else{        	
        	menu.display="block";
        }
     
     }
     else{
     	
     	menu.display="none";
     }
   }
}



function enable_click()
{
	document.fdacom.clickcontrol.value = "enable"
}

function disable_click()
{
	document.fdacom.clickcontrol.value = "disable"
}

function focus_control()
{
	//if(document.fdacom.clickcontrol.value == "disable") openwin.focus();
}

</script>	

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>

<!-----------------------------------------------------------------------------------------------------
※ 주의 ※
 아래의 body TAG의 내용중에 
 onload="javascript:enable_click()" onFocus="javascript:focus_control()" 이 부분은 수정없이 그대로 사용.
 아래의 form TAG내용도 수정없이 그대로 사용.
------------------------------------------------------------------------------------------------------->

<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=15 marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0 onload="javascript:enable_click()" onFocus="javascript:focus_control()"><center>
<form name=fdacom method=post action="taxsave_dacom_receipt.php" onSubmit="return pay(this)"> 
<table width="632" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="85" background="img/dacom/cash_top.gif" style="padding:0 0 0 64">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="3%" valign="top"><img src="img/dacom/title_01.gif" width="8" height="27" vspace="5"></td>
          <td width="97%" height="40" class="pl_03"><font color="#FFFFFF"><b>현금영수증 발행요청</b></font></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td align="center" bgcolor="6095BC"><table width="620" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#FFFFFF" style="padding:8 0 0 56"> 
            <table width="510" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="7"><img src="img/dacom/life.gif" width="7" height="30"></td>
                <td background="img/dacom/center.gif"><img src="img/dacom/icon03.gif" width="12" height="10"> 
                  <b>정보를 기입하신 후 발행버튼을 눌러주십시오.</b></td>
                <td width="8"><img src="img/dacom/right.gif" width="8" height="30"></td>
              </tr>
            </table>
            <br>
            <table width="510" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="510" colspan="2"  style="padding:0 0 0 23"> <table width="470" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="18" align="center"><img src="img/dacom/icon02.gif" width="7" height="7"></td>
                      <td width="177" height="26">상 품 명</td>
                      <td width="280"><input type=text name=goodname size=20 value="<?=addslashes($goods_name)?>" readonly></td>
                    </tr>
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/dacom/line.gif"></td>
                    </tr>
                    <tr> 
                      <td width="18" align="center"><img src="img/dacom/icon02.gif" width="7" height="7"></td>
                      <td width="177" height="26">결 제 금 액</td>
                      <td width="280"><input type=text name=amount size=10 value="<?=$amt_tot?>" readonly>&nbsp;&nbsp;
                      <br>
                      <font color=red>(현금결제 총금액:공급가+부가세+봉사료)</font></td>
                    </tr>
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/dacom/line.gif"></td>
                    </tr>
                    <tr> 
                      <td width="18" align="center"><img src="img/dacom/icon02.gif" width="7" height="7"></td>
                      <td width="177" height="26">공 급 가 액</td>
                      <td width="280"><input type=text name=sup_price size=10 value="<?=$amt_sup?>" readonly></td>
                    </tr>
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/dacom/line.gif"></td>
                    </tr>
                    <tr> 
                      <td width="18" align="center"><img src="img/dacom/icon02.gif" width="7" height="7"></td>
                      <td width="177" height="26">부 가 세</td>
                      <td width="280"><input type=text name=tax size=10 value="<?=$amt_tax?>" readonly></td>
                    </tr>
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/dacom/line.gif"></td>
                    </tr>
                    <tr> 
                      <td width="18" align="center"><img src="img/dacom/icon02.gif" width="7" height="7"></td>
                      <td width="177" height="26">봉 사 료</td>
                      <td width="280"><input type=text name=srvc_price size=10 value="<?=$amt_svc?>" readonly></td>
                    </tr>                    
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/dacom/line.gif"></td>
                    </tr>
                    <tr> 
                      <td width="18" align="center"><img src="img/dacom/icon02.gif" width="7" height="7"></td>
                      <td width="109" height="25">구 매 자 명</td>
                      <td width="343"><input type=text name=buyername size=20 value="<?=$od[od_name]?>"></td>
                    </tr>
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/dacom/line.gif"></td>
                    </tr>
                    <tr> 
                      <td width="18" align="center"><img src="img/dacom/icon02.gif" width="7" height="7"></td>
                      <td width="109" height="25">전 자 우 편</td>
                      <td width="343"><input type=text name=buyeremail size=20 value="<?=$od[od_email]?>"></td>
                    </tr>
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/dacom/line.gif"></td>
                    </tr>
                    <tr> 
                      <td width="18" align="center"><img src="img/dacom/icon02.gif" width="7" height="7"></td>
                      <td width="109" height="25">이 동 전 화</td>
                      <td width="343"><input type=text name=buyertel size=20 value="<?=$od[od_hp]?>"></td>
                    </tr>
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/dacom/line.gif"></td>
                    </tr>
                    <tr> 
                      <td width="18" align="center"><img src="img/dacom/icon02.gif" width="7" height="7"></td>
                      <td width="109" height="25">주민등록 또는<br> 휴대폰 번호<br>(사업자등록번호)</td>
                      <td width="343"><input type=text name=ssn size=20 maxlength=13 value="">&nbsp;&nbsp;&nbsp;<font color=red>"-"를 뺀 숫자만 입력하세요</font></td>
                    </tr>
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/dacom/line.gif"></td>
                    </tr>                    
                    <tr>
                      <td width="18" align="center"><img src="img/dacom/icon02.gif" width="7" height="7"></td>
                      <td colspan=2>
                    	 <table width=100% cellspacing=0 cellpadding=0 border=0>
                    	   <tr>
                    	     <td>
                    	     	<input type=checkbox name=check value="1" onClick="javascript:showhide('1');">현금영수증 발행용도를 선택하세요
                    	     </td>
                    	   </tr>
                    	   <tr>
                    	     <td align=center><SPAN id=block1 style="DISPLAY:none; xCURSOR:hand">
                    	     	<table>
                    	     	 <tr>
                    	     	  <td>
                    		     <input type=radio name=choose value=1 Onclick= "javascript:RCP1()">소득공제용&nbsp;&nbsp;&nbsp;&nbsp;
				                 <input type=radio name=choose value=1 Onclick= "javascript:RCP2()">지출증빙용
                    		  </td>
                    		 </tr>
                    		</table>
                    	       </SPAN>
                    	     </td>
                    	   </tr>
                    	 </table>
                      </td>
                    </tr>
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/dacom/line.gif"></td>
                    </tr>
                    <tr valign="bottom"> 
                      <td height="40" colspan="3" align="center"><input type=image src="img/dacom/button_08.gif" width="63" height="25"></td>
                    </tr>
                    <!-- <tr valign="bottom">
                      <td height="45" colspan="3">전자우편과 이동전화번호를 입력받는 것은 고객님의 결제성공 내역을 E-MAIL 또는 SMS 로
                   알려드리기 위함이오니 반드시 기입하시기 바랍니다.</td>
                   
                    </tr> -->
                    <tr valign="bottom">
                      <td height="45" colspan="3"><b>●소득 공제용 - 주민등록 번호와 휴대폰 번호로 발급 가능</b><BR>
                   <b>●지출 증빙용 - 주민등록 번호, 휴대폰 번호, 사업자 번호로 발급 가능</b></td>
                   
                    </tr>
                  </table></td>
              </tr>
            </table> 
            <br>
          </td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><img src="img/dacom/bottom01.gif" width="632" height="13"></td>
  </tr>
</table>
</center>

<!-- 
상점아이디.
테스트를 마친 후, 발급받은 아이디로 바꾸어 주십시오.
-->
<input type=hidden name=mid value="<?=$default[de_dacom_mid]?>">

<!--
UID.
테스트를 마친후, 발급받은 상점아이디로 바꾸어 주십시오.
(반드시 mid와 동일한 값을 입력)
-->
<input type=hidden name=uid value="<?=$default[de_dacom_mid]?>">

<!--
화폐단위
WON 또는 CENT
주의 : 미화승인은 별도 계약이 필요합니다.
-->
<input type=hidden name=currency value="WON">


<input type="hidden" name="od_id"  value="<?=$od_id?>">
<input type="hidden" name="on_uid" value="<?=$on_uid?>">



<!-- 삭제/수정 불가 -->
<input type=hidden name=clickcontrol value="">
<input type=hidden name=usertype     value="">

</form>
</body>
</html>
