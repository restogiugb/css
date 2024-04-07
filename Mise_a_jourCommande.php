<?php require_once('Connections/Connection_Projet.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO client (NumClient, NomClient, PrenomClient, Tel, Email) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['NumClient'], "text"),
                       GetSQLValueString($_POST['NomClient'], "text"),
                       GetSQLValueString($_POST['PrenomClient'], "text"),
                       GetSQLValueString($_POST['Tel'], "int"),
                       GetSQLValueString($_POST['Email'], "text"));

  mysql_select_db($database_Connection_Projet, $Connection_Projet);
  $Result1 = mysql_query($insertSQL, $Connection_Projet) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
  $updateSQL = sprintf("UPDATE client SET NomClient=%s, PrenomClient=%s, Tel=%s, Email=%s WHERE NumClient=%s",
                       GetSQLValueString($_POST['NomClient'], "text"),
                       GetSQLValueString($_POST['PrenomClient'], "text"),
                       GetSQLValueString($_POST['Tel'], "int"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['NumClient'], "text"));

  mysql_select_db($database_Connection_Projet, $Connection_Projet);
  $Result1 = mysql_query($updateSQL, $Connection_Projet) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form4")) {
  $updateSQL = sprintf("UPDATE commande SET NumClient=%s, NumPlat=%s, Quantité=%s, `Date`=%s WHERE NumCommande=%s",
                       GetSQLValueString($_POST['NumClient'], "text"),
                       GetSQLValueString($_POST['NumPlat'], "text"),
                       GetSQLValueString($_POST['Quantit'], "int"),
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['NumCommande'], "text"));

  mysql_select_db($database_Connection_Projet, $Connection_Projet);
  $Result1 = mysql_query($updateSQL, $Connection_Projet) or die(mysql_error());
}

$maxRows_Recordset1 = 1;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_Connection_Projet, $Connection_Projet);
$query_Recordset1 = "SELECT * FROM commande";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $Connection_Projet) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<title>Restaurant - Mon site</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="mm_restaurant1.css" type="text/css" />
<style type="text/css">
<!--
.Style1 {font-size: 36px}
.Style4 {font-size: 14px}
.Style5 {color: #FFFFFF}
.Style6 {font-size: 18px; font-weight: bold; }
.Style7 {font-size: 18px}
.Style8 {font-size: 16px}
-->
</style>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_jumpMenuGo(selName,targ,restore){ //v3.0
  var selObj = MM_findObj(selName); if (selObj) MM_jumpMenu(targ,selObj,restore);
}
//-->
</script>
</head>
<body bgcolor="#0066cc">
<table width="106%" border="0" cellspacing="0" cellpadding="0">
	<tr bgcolor="#99ccff">
	<td width="15" nowrap="nowrap" ><img src="mm_spacer.gif" alt="" width="15" height="1" border="0" /></td>
	<td height="60" colspan="3" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#663300" class="logo Style1"><div align="center" class="Style5">MISE A JOUR DES COMMANDES </div></td>
	<td width="4">&nbsp;</td>
	<td width="6">&nbsp;</td>
	</tr>

	<tr bgcolor="#003399">
	<td width="15" nowrap="nowrap">&nbsp;</td>
	<td height="36" colspan="3" nowrap="nowrap" bgcolor="#663300" class="navText" id="navigation"><form name="form2" id="form2">
	</form>
	</td>
	  <td width="4">&nbsp;</td>
	<td width="6">&nbsp;</td>
	</tr>

	<tr bgcolor="#ffffff">
	<td colspan="6"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
	</tr>

	<tr bgcolor="#ffffff">
	<td colspan="2" valign="top" bgcolor="#FFCC99"><table border="0" cellspacing="0" cellpadding="0" width="230">
		<tr>
		<td width="15">&nbsp;</td>
		<td width="200" class="smallText" id="padding"><br />		</td>
		<td width="15">&nbsp;</td>
		</tr>
	</table>	
	  <img src="image_Restaurant/jordan-arnold-Ul07QK2AR-0-unsplash.jpg" width="650" height="534" /></td>
	<td width="58" valign="top" bordercolor="#FFCC99">&nbsp;</td>
	<td width="575" valign="top" bgcolor="#FFCC99"><br />
	&nbsp;<br />
	<table border="0" cellspacing="0" cellpadding="0" width="492">
		<tr>
		<td width="492" bgcolor="#FFFFCC" class="pageHeader">&nbsp;
          <form name="form5" id="form5">
            <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
              <option value="endex.php">Menu</option>
            </select>
            <input type="button" name="Button1" value="Retour au menu" onclick="MM_jumpMenuGo('menu1','parent',0)" />
          </form>
          <a href="endex.php"></a>
          <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
            <img src="mm_spacer.gif" alt="" width="50" height="1" border="0" />
          </form>
          <p>&nbsp;</p>
    
          <form method="post" name="form4" action="<?php echo $editFormAction; ?>">
            <table width="453" height="254" align="center">
              <tr valign="baseline">
                <td nowrap align="right"><div align="center" class="Style6">Numero Commande:</div></td>
                <td><div align="center" class="Style6"><?php echo $row_Recordset1['NumCommande']; ?></div></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right"><div align="center" class="Style6">Numero Client:</div></td>
                <td><div align="center" class="Style6">
                  <input type="text" name="NumClient" value="<?php echo $row_Recordset1['NumClient']; ?>" size="32">
                </div></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right"><div align="center" class="Style6">Num Plat:</div></td>
                <td><div align="center" class="Style6">
                  <input type="text" name="NumPlat" value="<?php echo $row_Recordset1['NumPlat']; ?>" size="32">
                </div></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right"><div align="center" class="Style6">Quantité:</div></td>
                <td><div align="center" class="Style6">
                  <input type="text" name="Quantit" value="<?php echo $row_Recordset1['Quantité']; ?>" size="32">
                </div></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right"><div align="center" class="Style6">Date:</div></td>
                <td><div align="center" class="Style6">
                  <input type="text" name="Date" value="<?php echo $row_Recordset1['Date']; ?>" size="32">
                </div></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right"><div align="center"><span class="Style4"><span class="Style7"></span></span></div></td>
                <td><div align="center" class="Style7"><strong>
                  <input type="submit" value="Mettre à jour l'enregistrement">
                </strong></div></td>
              </tr>
            </table>
            <input type="hidden" name="MM_update" value="form4">
            <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>" class="Style7">Premier</a>
          &nbsp;<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>" class="Style8">Pr&eacute;c&eacute;dent</a>
          <span class="Style8">&nbsp;<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Suivant</a></span>
          &nbsp;<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>" class="Style8">Dernier</a>
          </form>
          <p>&nbsp;</p>
          <form method="post" name="form3" action="<?php echo $editFormAction; ?>">
            <p><a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>"></a>            </p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
          </form>
          <p>&nbsp;</p></td>
		</tr>

		<tr>
		<td class="bodyText"><p>&nbsp;</p>

		 <br />		</td>
		</tr>
	</table>	</td>
	<td width="4">&nbsp;</td>
	<td width="6">&nbsp;</td>
	</tr>

	<tr bgcolor="#ffffff">
	<td colspan="6"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
	</tr>

	<tr>
	<td colspan="6" bgcolor="#663300">&nbsp;</td>
	</tr>


	<tr bgcolor="#003399">
	<td colspan="6" bgcolor="#663300"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
	</tr>

	<tr>
	<td colspan="6" bgcolor="#663300"><img src="mm_spacer.gif" alt="" width="1" height="2" border="0" /></td>
	</tr>

	<tr bgcolor="#003399">
	<td colspan="6" bgcolor="#663300"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
	</tr>


	<tr>
	<td width="15" bgcolor="#663300">&nbsp;</td>
	<td width="503" bgcolor="#663300">&nbsp;</td>
	<td width="58" bgcolor="#663300">&nbsp;</td>
	<td width="575" bgcolor="#663300">&nbsp;</td>
	<td width="4" bgcolor="#663300">&nbsp;</td>
	<td width="6" bgcolor="#663300">&nbsp;</td>
	</tr>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
