<?php
$applicationtitle = "<title>:: JMSCPOS.COM - Point of Sale Inventory Tracking System, POS Software ::</title>
<meta name='description' content='Jay Maharaj Software Consulting INC. is expert in developing software for Inventory Control and Point of Sale for different types of retail business. We can understand actual need of Point of Sale Software. We know the retail business procedure in USA, so we can deliver the best service, support and knowledge in the industry. Jay Maharaj Software Consulting INC. is providing the best POS software for your retail business needs. We are also providing Lottery Sales Tracking System software.' />
<meta name='keywords' content='Point of Sale Inventory Control,POS,  Point of Sale, Inventory Control,Retail Store point of sale Software,grocery store point of sale inventory control software,liquore store point of sale inventory control software,Lottery point of sale inventory control management software,gujarati Point of Sale Inventory Control,Driver license scanning software with point of sale inventory control software, Customer account management, Account management, Scanning System,  Touch Screen Software, Bank Account management, Touch Screen, Purchase Order, Auto Purchase Order management, Lottery Sale management software, Lottery Tracking, Lottery inventory control software,Jay Maharaj Software Consulting INC, JMSC POS' /><link rel='shortcut icon' HREF='favicon.ico'>";
error_reporting (E_ALL ^ E_NOTICE);
$phoneno ="(630) 430-6402";
$emailaddress = "support@jmscpos.com";


//-- handling database connection


//-- Database class
$db = new DB_Sql();

$db2 = new DB_Sql();


$RecordsPerPage = finsettingval("totalrecordperpageadmin");
//$descriptionlimit = finsettingval("totalrecordperpageadmin");
$descriptionlimit = finsettingval("descriptionlimit");
$RecordsPerPageSearchresult = finsettingval("totalrecordinonepagesearchresult");

function tohtml($strValue)
{
  return htmlspecialchars($strValue);
}

function tourl($strValue)
{
  return urlencode($strValue);
}

function get_param($ParamName)
{
  //global $HTTP_POST_VARS;
  //global $HTTP_GET_VARS;
  global $_POST;
  global $_GET;

  $ParamValue = "";
  if(isset($_POST[$ParamName]))
    $ParamValue = $_POST[$ParamName];
  else if(isset($_GET[$ParamName]))
    $ParamValue = $_GET[$ParamName];
	if ($ParamValue != "")
	{
		//$ParamValue = strtoupper($ParamValue);
		//$ParamValue = preg_replace('/<(.*?)>/',"",$ParamValue);
		$ParamValue = str_replace(array("<?php","<?","?>"),"",$ParamValue);
		$ParamValue = str_replace(array("<?php","<?","?>"),"",$ParamValue);
		/*$ParamValue = str_replace(array("SELECT","INSERT","UPDATE","DELETE","ALTER","CREATE","DROP","TABLE","VIEW","PROCEDURE","FUNCION","CAST","CONVERT","OBJECT","SCHEMA","NULL","ADD","ALL","ALTER","ANALYZE","AND","AS","ASC","ASENSITIVE","BEFORE","BETWEEN","BIGINT","BINARY", 
"BLOB","BOTH","BY","CALL","CASCADE","CASE","CHANGE","CHAR","CHARACTER","CHECK","COLLATE","COLUMN","CONDITION","CONSTRAINT","CONTINUE","CONVERT","CREATE","CROSS","CURRENT_DATE","CURRENT_TIME","CURRENT_TIMESTAMP","CURRENT_USER","CURSOR","DATABASE","DATABASES","DAY_HOUR","DAY_MICROSECOND","DAY_MINUTE","DAY_SECOND DEC","DECIMAL","DECLARE","DEFAULT","DELAYED","DELETE","DESC","DESCRIBE","DETERMINISTIC","DISTINCT","DISTINCT","ROW","DIV","DOUBLE","DROP","DUAL","EACH","ELSE","ELSEIF","ENCLOSED","ESCAPED","EXISTS","EXIT","EXPLAIN","FALSE","FETCH","FLOAT","FLOAT4","FLOAT8","FOR","FORCE","FOREIGN","FROM","FULLTEXT","GRANT","GROUP","HAVING","HIGH_PRIORITY","HOUR_MICROSECOND","HOUR_MINUTE","HOUR_SECOND","
IF","IGNORE","IN","INDEX","INFILE","INNER","INOUT","INSENSITIVE","INSERT","INT","INT1","INT2","INT3","INT4","INT8","INTEGER","INTERVAL","INTO","IS","ITERATE","JOIN","KEY","KEYS","KILL","LEADING","LEAVE","LEFT","LIKE","LIMIT","LINES","LOAD","LOCALTIME","LOCALTIMESTAMP","LOCK","LONG","LONGBLOB","LONGTEXT","LOOP","LOW_PRIORITY","MATCH","MEDIUMBLOB","MEDIUMINT","MEDIUMTEXT","MIDDLEINT","MINUTE_MICROSECOND","MINUTE_SECOND","MOD","MODIFIES","NATURAL","NOT","NO_WRITE_TO_BINLOG","NULL","NUMERIC","ON","OPTIMIZE","OPTION","OPTIONALLY","OR","ORDER","OUT","OUTER","OUTFILE","PRECISION","PRIMARY","PROCEDURE","PURGE","READ","READS","REAL","REFERENCES","REGEXP","RELEASE","RENAME","REPEAT","REPLACE","REQUIRE","RESTRICT","RETURN","REVOKE","RIGHT","RLIKE","SCHEMA","SCHEMAS","SECOND_MICROSECOND","SELECT","SENSITIVE","SEPARATOR","SET","SHOW","SMALLINT","SONAME","SPATIAL","SPECIFIC","SQL","SQLEXCEPTION","SQLSTATE","SQLWARNING","SQL_BIG_RESULT","SQL_CALC_FOUND_ROWS","SQL_SMALL_RESULT","SSL","STARTING","STRAIGHT_JOIN","TABLE","TERMINATED","THEN","TINYBLOB","TINYINT","TINYTEXT","TO","TRAILING","TRIGGER","TRUE","UNDO","UNION","UNIQUE","UNLOCK","UNSIGNED","UPDATE","USAGE","USE","USING","UTC_DATE","UTC_TIME","UTC_TIMESTAMP","VALUES","VARBINARY","VARCHAR","VARCHARACTER","VARYING","WHEN","WHERE","WHILE","WITH","WRITE","XOR","YEAR_MONTH","ZEROFILL","ASENSITIVE","CALL","CONDITION","CONNECTION","CONTINUE","CURSOR","DECLARE","DETERMINISTIC","EACH","ELSEIF","EXIT","FETCH","GOTO","INOUT","INSENSITIVE","ITERATE","LABEL","LEAVE","LOOP","MODIFIES","OUT","READS","RELEASE","REPEAT","RETURN","SCHEMA","SCHEMAS","SENSITIVE","SPECIFIC","SQL","SQLEXCEPTION","SQLSTATE","SQLWARNING","TRIGGER","UNDO","UPGRADE","WHILE"
),"",$ParamValue); */
	}
	//$ParamValue = preg_replace('/<(.*?)>/',"",$ParamValue);
  return $ParamValue;
}

function get_session($ParamName)
{
  global $_POST;
  global $_GET;
  global ${$ParamName};

  $ParamValue = "";
  if(!isset($_POST[$ParamName]) && !isset($_GET[$ParamName]) && session_is_registered($ParamName)) 
    $ParamValue = ${$ParamName};
  $ParamValue = $_SESSION[$ParamName];
  return $ParamValue;
}

function set_session($ParamName, $ParamValue)
{
  global ${$ParamName};
  if(!isset($_SESSION[$ParamName]))
  //if(session_is_registered($ParamName)) 
    session_unset($ParamName);
  ${$ParamName} = $ParamValue;
  $_SESSION[$ParamName] = $ParamName;
}

function is_number($string_value)
{
  if(is_numeric($string_value) || !strlen($string_value))
    return true;
  else 
    return false;
}

function is_param($param_value)
{
  if($param_value)
    return 1;
  else
    return 0;
}

function tosql($value, $type="Text")
{
  if($value == "")
  {
    return "NULL";
  }
  else
  {
    if($type == "Number")
      return doubleval($value);
    else
    {
      if(get_magic_quotes_gpc() == 0)
      {
        $value = str_replace("'","''",$value);
        $value = str_replace("\\","\\\\",$value);
      }
      else
      {
        $value = str_replace("\\'","''",$value);
        $value = str_replace("\\\"","\"",$value);
      }
      return "'" . $value . "'";
     }
   }
}

function strip($value)
{
  if(get_magic_quotes_gpc() == 0)
    return $value;
  else
    return stripslashes($value);
}

function finsettingval($fName)
{
  global $db2;
  $db2 = new DB_Sql();
  $ans = "";
  $rsRow = $db2->query("SELECT fldval FROM settingmaster WHERE fldnm ='$fName'");
  while ($rs = $db2->returnarray($rsRow))
  {
  	$ans = $rs[0];
  }
  return $ans;
}
function onefielddata($sSql)
{
  global $db2;
  $db2 = new DB_Sql();
  $ans = "";
  $rsRow = $db2->query($sSql);
  while ($rs = $db2->returnarray($rsRow))
  {
  	$ans = $rs[0];
  }
  return $ans;
}
function dlookup($Table, $fName, $sWhere)
{
  global $db2;
  $db2 = new DB_Sql();
  //$db2->Database = DATABASE_NAME;
  //$db2->User     = DATABASE_USER;
  //$db2->Password = DATABASE_PASSWORD;
  //$db2->Host     = DATABASE_HOST; 
  $ans = "";
 
  $rsRow = $db2->query("SELECT " . $fName . " FROM " . $Table . " WHERE " . $sWhere);
  while ($rs = $db2->returnarray($rsRow))
  {
  	$ans = $rs[0];
  }
  return $ans;
  /* $db2->query("SELECT " . $fName . " FROM " . $Table . " WHERE " . $sWhere);
  if($db2->next_record())
    return $db2->f(0);
  else 
    return ""; */
}


function get_checkbox_value($sVal, $CheckedValue, $UnCheckedValue)
{
  if(!strlen($sVal))
    return tosql($UnCheckedValue);
  else
    return tosql($CheckedValue);
}

//- function returns options for HMTL control "<select>" as one string
function get_options($sql,$is_search,$is_required,$selected_value)
{
  global $db2;  //-- connection special for list box

  $options_str="";
  if ($is_search)
    $options_str.="<option value=\"\">All</option>";
  else
  {
    if (!$is_required)
    {
      $options_str.="<option value=\"\"></option>";
    }
  }
  
  $db2->query($sql);
  while ($db2->next_record($sql))
  {
    $id=$db2->f(0);
    $value=$db2->f(1);
    $selected="";
    if ($id == $selected_value)
    {
      $selected = "SELECTED";
    }
    $options_str.= "<option value='".$id."' ".$selected.">".$value."</option>";
  }
  return $options_str;
}
//--------------------------
function get_lov_options($lov_str,$is_search,$is_required,$selected_value)
{
  $options_str="";
  if (!$is_required && !$is_search)
    $options_str.="<option value=\"\"></option>";

  $LOV = split(";", $lov_str);

  if(sizeof($LOV)%2 != 0) 
    $array_length = sizeof($LOV) - 1;
  else
    $array_length = sizeof($LOV);
  reset($LOV);

  for($i = 0; $i < $array_length; $i = $i + 2)
  {
    $id =  $LOV[$i];
    $value = $LOV[$i + 1];
    $selected="";
    if ($id == $selected_value)
      $selected = "SELECTED";

    $options_str.= "<option value='".$id."' ".$selected.">".$value."</option>";
  }
  return $options_str;
}
//--------------------------
//-- function take $lov_str as parameter, parse it and return the result as array
function get_lov_values($lov_str)
{
  $options_str="";
  $LOV = split(";", $lov_str);

  if(sizeof($LOV)%2 != 0) 
    $array_length = sizeof($LOV) - 1;
  else
    $array_length = sizeof($LOV);
  reset($LOV);

  $values = array();
  for($i = 0; $i < $array_length; $i = $i + 2)
  {
    $id =  $LOV[$i];
    $value = $LOV[$i + 1];
    $values[$id] = $value;
  }
  return $values;
}



function check_security($iLevel)
{
  global $UserRights;
  if(!session_is_registered("UserID"))
    header ("Location: login.php?querystring=" . tourl(getenv("QUERY_STRING")) . "&ret_page=" . tourl(getenv("REQUEST_URI")));
  /* else
    if(!session_is_registered("UserRights") || $UserRights < $iLevel)
      header ("Location: Login.php?querystring=" . tourl(getenv("QUERY_STRING")) . "&ret_page=" . tourl(getenv("REQUEST_URI"))); */
}
function commonwherequerytoselectads()
{
	" a.currentstatus =0 and a.invisible='N' and ";
}
function num_rows($result)
{
return mysql_num_rows($result);
}
function checkadminlogin()
{
  if(!isset($_SESSION["adminID"]))
    header ("Location: index.php");
}
function sendinquiryemail($inqid)
{
	global $db;
	$rsRow = $db->query("select inquiryid,inq.inquirydate,a.name as listingtitle,a.ad_id,inq.name,inq.emailaddress,inq.phoneno,inq.description,m.member_login,m.member_password,m.email,m.member_id,m.name from inquirymaster inq,ads a,members m where inq.adsid =a.ad_id and a.member_id =m.member_id and inq.inquiryid = $inqid");
	$message ="";
  while ($rs = $db->returnarray($rsRow))
  {
  	$message .= "Inquiry id :$rs[0]<br>";
	$message .= "Inquiry Date :$rs[1]<br>";
	$message .= "Listing Name :$rs[2]<br>";
	$message .= "Listing id :$rs[3]<br>";
	$message .= "Inquire Name :$rs[4]<br>";
	
	$message .= "Inquire Email Address :$rs[5]<br>";
	$message .= "Inquire Phone No :$rs[6]<br>";
	$message .= "Comment :$rs[7]<br>";
	$message .= "Your User name with our website site :$rs[8]<br>";
	$message .= "Your Password :$rs[9]<br>";
	$message .= "<a href='". finsettingval("weburl") ."/login.php'>Click here to login in our website</a>";
	//$toemailaddress = $rs[10];
	//$toname = $rs[2];
  }
  $toemailaddress = finsettingval("adminemailaddress");
  $toname = finsettingval("adminfromemailname");
  if ($message !="")
  	sendmail(0,$toemailaddress1,$toname1,$message);
   	sendmail(1,$toemailaddress,$toname,$message);
}
function sendmail($emailid,$toemailaddress,$toname,$exmessage)
{
	global $db;
	$rsRow = $db->query("select subject,message from emailmaster where emailid = $emailid");
	while ($rs = $db->returnarray($rsRow))
	{
  		$subject= $rs[0];
		$message = $rs[1];
  	}
  	$subject = str_replace("[name]",$toname,$subject);
	$subject = str_replace("[emailaddress]",$toemailaddress,$subject);
	$message = str_replace("[name]",$toname,$message);
	$message = str_replace("[emailaddress]",$toemailaddress,$message);
	$message = str_replace("[extramessage]",$exmessage,$message);
	
   $fromname = finsettingval("adminfromemailname");
   $fromaddress = finsettingval("adminemailaddress");
   
   $headers  = "MIME-Version: 1.0\n";
   $headers .= "Content-type: text/html; charset=iso-8859-1\n";
   $headers .= "X-Priority: 3\n";
   $headers .= "X-MSMail-Priority: Normal\n";
   $headers .= "X-Mailer: php\n";
   $headers .= "From: \"".$fromname."\" <".$fromaddress.">\n"; 
   
  //echo($subject);
  //echo($message);
   
   mail($toemailaddress,$subject,$message,"From: $fromaddress\r\nContent-type: text/html\r\n\r\n");
   
   //return mail($toemailaddress, $subject, $message,$headers);
}
function sendemaildirect($toemailaddress, $subject, $message,$fromname,$fromaddress)
{
 $headers  = "MIME-Version: 1.0\n";
   $headers .= "Content-type: text/html; charset=iso-8859-1\n";
   $headers .= "X-Priority: 3\n";
   $headers .= "X-MSMail-Priority: Normal\n";
   $headers .= "X-Mailer: php\n";
   $headers .= "From: \"".$fromname."\" <".$fromaddress.">\n";
   //return mail($toemailaddress, $subject, $message,$headers);
   mail($toemailaddress,$subject,$message,"From: $fromaddress\r\nContent-type: text/html\r\n\r\n");
}
function filldropdown($sSql,$selectval,$firstoption)
{ 
if ($firstoption != "")
{
?>
	<option value="0"><?= $firstoption ?></option>
<? } 
	global $db;
	$rsRow = $db->query($sSql);
	while ($rs = $db->returnarray($rsRow))
    {
	if ($selectval == $rs[0])
		$s= "selected";
	else
		$s="";
	?>
	<option value="<?= $rs[0]?>" <?= $s ?>><?= $rs[1]?></option>
	<? }
}
function deletedata($fldmainfld,$fldtblnm,$fldfilenm,$status,$currstatus)
{
global $db;
if ($fldtblnm != "updatequery")
	$where = " where currentstatus <> 2 ";
else
	$where = "";

$rsRow = $db->query("select $fldmainfld from $fldtblnm $where");
while ($rs = $db->returnarray($rsRow))
{
	
	if (isset($_POST["chkid$rs[0]"]))
	{
		if ($fldtblnm != "updatequery")
		$db->query("update $fldtblnm set currentstatus =$currstatus where $fldmainfld=$rs[0]");
		else
		$db->query("delete from $fldtblnm where $fldmainfld=$rs[0]");

		if ($fldmainfld == "mediaid")
		{
			$fnm = onefielddata("select filename from mediamaster where mediaid=$rs[0]");
			if ($fnm !="")
			{
				$fnm = "../uploadfiles/$fnm";
			if (file_exists($fnm))
			unlink("$fnm");
			}
		}
		
		if ($fldtblnm == "user_upload_master")
		{
			$fnm = onefielddata("select filenm from user_upload_master where uploadid=$rs[0]");
			if ($fnm !="")
			{
				$fnm = "../user_upload/$fnm";
				if (file_exists($fnm))
				{
					$db->query("delete from user_upload_master where uploadid=$rs[0]");
					//echo("delete from user_upload_master where uploadid=$rs[0]");
			
					unlink("$fnm");
				}
			}
			//echo("select filenm from user_upload_master where uploadid=$rs[0]");
		}
		if ($fldmainfld == "member_id")
		{
			$db->query("update forumtopics set currentstatus=$currstatus where userid=$rs[0]");
			$db->query("update forumpostigs set currentstatus=$currstatus where userid=$rs[0]");
		}

		$exque ="";
		if ($fldmainfld == "navigationid")
		{
		$positionid = onefielddata("select positionid from $fldtblnm where $fldmainfld = $rs[0]");
		if ($positionid !=="")
		$exque = " and positionid = $positionid";
		}
		if (($fldmainfld == "footerid") ||($fldmainfld == "headerid") || ($fldmainfld == "navigationid") || ($fldmainfld == "cssid"))
		sendforgeneration($fldmainfld,$fldtblnm,$exque,$rs[0]);
	}
}	
header("location:$fldfilenm.php?b=$status&info=1");
}

function writefile($filenm,$strtext)
{
 $fd = @fopen ("../cmsfiles/$filenm", "w");
 fwrite($fd,$strtext);
 @fclose ($fd);
}
function generatefooterfile()
{
	$strtext = onefielddata("select footertext from cmsfootermaster where currentstatus=0");
	if ($strtext != "")
	{
	$weburl = finsettingval("weburl");
	$strtext = ereg_replace("\[weburl\]",$weburl,$strtext);
	}
	writefile("footer.php",$strtext);
}
function generatecssfile()
{
	$strtext = onefielddata("select csstext from cmscssmaster where currentstatus=0");
	if ($strtext != "")
	{
		$weburl = finsettingval("weburl");
		$strtext = ereg_replace("\[weburl\]",$weburl,$strtext);
	}
	writefile("sitecss.css",$strtext);

}

function generateheaderfile()
{
	$strtext = onefielddata("select headetext from cmsheadermaster where currentstatus=0");
	if ($strtext != "")
	{
		$weburl = finsettingval("weburl");
		$strtext = ereg_replace("\[weburl\]",$weburl,$strtext);
	}
	writefile("header.php",$strtext);
}
function generatenavigationfile()
{
	global $db;
	$rsRow = $db->query("select navigationtext,positionid from cmsnavigationmaster where currentstatus=0 group by positionid");
	while ($rs = $db->returnarray($rsRow))
	{
		$strtext = $rs[0];
		$positionid =$rs[1];
		if ($positionid == 1)
			$filenm = "navtop";
		if ($positionid == 2)
			$filenm = "navbottom";
		if ($positionid == 3)
			$filenm = "navleft";
		if ($positionid == 4)
			$filenm = "navright";
		if ($strtext != "")
		{
			$weburl = finsettingval("weburl");
			$strtext = ereg_replace("\[weburl\]",$weburl,$strtext);
		}
		writefile("$filenm.php",$strtext);
	}
}
function generatedocument($pagetitle,$metatag,$pagebody,$filename)
{
	$fd = @fopen ("../cmstemplates/sitelayout.php", "r");
	$content ="";
	while (!feof($fd)) 
	{
		$content = $content . fgets($fd, 4096);
	}
	@fclose ($fd);
if ($content !="")
{
	$weburl = finsettingval("weburl");
	if ($pagetitle !=="")
		$content = ereg_replace("\[pagetitle\]",$pagetitle,$content);
	if ($metatag !=="")
		$content = 	ereg_replace("\[metatag\]",$metatag,$content);
	if ($weburl !=="")
		$content =	ereg_replace("\[weburl\]",$weburl,$content);	
	if ($pagebody !=="")
		$content = ereg_replace("\[pagebody\]",$pagebody,$content);	
	 $fd = @fopen ("../$filename", "w");
 	 fwrite($fd , $content);
	 @fclose ($fd);
}
}
function findmax($fldnm,$tablenm)
{
	return onefielddata("select max($fldnm) from $tablenm");
}
function updateforactive($mainfldnm,$tablenm,$exque)
{
	global $db;
	$id = findmax($mainfldnm,$tablenm);
	if ($id != "")
	sendforgeneration($mainfldnm,$tablenm,"",$id);
    	
}
function sendforgeneration($fldmainfld,$tablenm,$exque,$id)
{
	global $db;
	$db->query("update $tablenm set currentstatus =1 where $fldmainfld <> $id and currentstatus =0 $exque ");
if ($fldmainfld =="cssid")
		generatecssfile();
if ($fldmainfld == "footerid")
	generatefooterfile();
if ($fldmainfld == "headerid")
	generateheaderfile();
if ($fldmainfld == "navigationid")
	generatenavigationfile();
}


$mobile = "http://www.jmscpos.com/mobile";

$var = array(
	// Apple
	'iPhone',
	'iPod',
	'iPad',
	'iTouch',
	// eReaders; see also iPad above
	'Sony Reader',
	'Kindle',
	'Nook',
	// gaming
	'PlayStation',
	'Nintendo',
	'Wii',
	// PDAs
	'Dell Streak',
	'Dell Axim',
	'HP iPAQ',
	'palmOne',
	'PalmOS',
	'Palm',
	'PalmSource',
	'Pocket PC',
	// phones and mobile carriers
	'Android',
	'O2',
	'Bell Mobility',
	'Rogers',
	'Verizon',
	'Spring',
	'Cingular',
	'T-Mobile',
	'RiM',
	'BenQ',
	'AT&T',
	'Pearl',
	'ARCHOS',
	'Xiino',
	'PIE',
	'NetFront',
	'Plucker',
	'PocketLink',
	'OpenWave',
	'Minimo',
	'ftxBrowser',
	'EudoraWeb',
	'ASTEL',
	'PDXGW',
	'Air-Edge',
	'J-Phone',
	'Vodafone',
	'UP.Browser',
	'KDDI-KC31',
	'KDDI',
	'DoCoMo',
	'AvantGo',
	'Orange',
	'Cricket',
	'bSquare',
	'Nexus One',
	'HTC',
	'LGE',
	'LG',
	'Motorola',
	'MOT',
	'NEC',
	'Nokia',
	'Psion',
	'QTEK',
	'SAGEM',
	'Samsung',
	'SEC',
	'AU-MIC',
	'Sanyo',
	'Siemens',
	'Sharp',
	'Samsung',
	'Ericsson',
	'SonyEricsson',
	'Tear',
	'UCWEB',
	'ZTE',
	'WebPro',
	'ProxiNet',
	'Elaine',
	'BlackBerry',
);
//
$text = $_SERVER['HTTP_USER_AGENT'];

foreach ($var as $vari) {
	if (stripos($text, $vari) !== FALSE) {
		header("Location: $mobile");
		die('Mobile device detected ... ');
	}
}

function filldropdown_day($selectval)
{ 
?>
	<option value="0">Day</option>
<?  
	
	for($i=1;$i<=31;$i++)
    {
	if ($selectval == $i)
		$s= "selected";
	else
		$s="";
	?>
	<option value="<?= $i?>" <?= $s ?>><?= $i ?></option>
	<? }
}
function filldropdown_month($selectval)
{ 
?>
	<option value="0">Month</option>
<?  
	
	for($i=1;$i<=12;$i++)
    {
	if ($selectval == $i)
		$s= "selected";
	else
		$s="";
	?>
	<option value="<?= $i?>" <?= $s ?>><?= $i ?></option>
	<? }
}
function filldropdown_year($selectval)
{ 
?>
	<option value="0">Year</option>
<?  
	
	for($i=date("Y")-4;$i<=date("Y")+10;$i++)
    {
	if ($selectval == $i)
		$s= "selected";
	else
		$s="";
	?>
	<option value="<?= $i?>" <?= $s ?>><?= $i ?></option>
	<? }
}


?>