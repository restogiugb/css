<?php require_once('Connections/Connection_Projet.php'); ?>
<?php
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) {
  $insertSQL = sprintf("INSERT INTO plat (NumPlat, Nom, Prix, Categorie) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['NumPlat'], "text"),
                       GetSQLValueString($_POST['Nom'], "text"),
                       GetSQLValueString($_POST['Prix'], "int"),
                       GetSQLValueString($_POST['Categorie'], "text"));

  mysql_select_db($database_Connection_Projet, $Connection_Projet);
  $Result1 = mysql_query($insertSQL, $Connection_Projet) or die(mysql_error());
}
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
.Style2 {color: #FFFFFF}
.Style8 {font-size: 16px; color: #000000; font-weight: bold; }
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
	<td width="33" nowrap="nowrap" ><img src="mm_spacer.gif" alt="" width="15" height="1" border="0" /></td>
	<td height="60" colspan="3" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#663300" class="logo Style1"><div align="center" class="Style2">FORMULAIRE PLAT </div></td>
	<td width="4">&nbsp;</td>
	<td width="6">&nbsp;</td>
	</tr>

	<tr bgcolor="#003399">
	<td width="33" nowrap="nowrap">&nbsp;</td>
	<td height="36" colspan="3" nowrap="nowrap" bgcolor="#663300" class="navText" id="navigation"><form name="form2" id="form2">
	  <label></label>
	</form>	</td>
	  <td width="4">&nbsp;</td>
	<td width="6">&nbsp;</td>
	</tr>

	<tr bgcolor="#ffffff">
	<td colspan="6"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
	</tr>

	<tr bgcolor="#ffffff">
	<td colspan="2" valign="top" bgcolor="#ffffcc"><table width="670" border="0" cellpadding="0" cellspacing="0" bgcolor="#663300">
		<tr>
		<td width="15">&nbsp;</td>
		<td width="212" bgcolor="#663300" class="smallText" id="padding"><br />		</td>
		<td width="10">&nbsp;</td>
		</tr>
	</table>	  
	  <img src="image_Restaurant/IMG-20240120-WA0018.jpg" width="698" height="381" /></td>
	<td width="50" valign="top" bgcolor="#666633"><img src="mm_spacer.gif" alt="" width="50" height="1" border="0" /></td>
	<td width="583" valign="top" bgcolor="#666633"><br />
	&nbsp;<br />
	<table border="0" cellspacing="0" cellpadding="0" width="492">
		<tr>
		<td width="492" bgcolor="#00CCCC" class="pageHeader">&nbsp;
          <form method="post" name="form1" action="<?php echo $editFormAction; ?>"><a href="ListePlat.php">Listes des Plats disponible</a> 
          </form>
          <p>&nbsp;</p>
          <form method="post" name="form3" action="<?php echo $editFormAction; ?>">
            <table align="center">
              <tr valign="baseline">
                <td align="right" nowrap bgcolor="#FFFFFF"><div align="center"><span class="Style8">Numero Plat:</span></div></td>
                <td><input type="text" name="NumPlat" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td align="right" nowrap bgcolor="#FFFFFF"><div align="center"><span class="Style8">Nom du Plat:</span></div></td>
                <td><input type="text" name="Nom" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td align="right" nowrap bgcolor="#FFFFFF"><div align="center"><span class="Style8">Prix du Plat:</span></div></td>
                <td><input type="text" name="Prix" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td align="right" nowrap bgcolor="#FFFFFF"><div align="center"><span class="Style8">Categorie de Plat:</span></div></td>
                <td><input type="text" name="Categorie" value="" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">&nbsp;</td>
                <td><input type="submit" value="Ins&eacute;rer un Plat"></td>
              </tr>
            </table>
            <input type="hidden" name="MM_insert" value="form3">
          </form>
          <form name="form4" id="form4">
            <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
              <option value="endex.php">Menu</option>
            </select>
            <input type="button" name="Button1" value="Retour au menu" onclick="MM_jumpMenuGo('menu1','parent',0)" />
          </form>          <p><a href="endex.php"></a>&nbsp;</p></td>
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
	<td width="33" bgcolor="#663300">&nbsp;</td>
	<td width="485" bgcolor="#663300">&nbsp;</td>
	<td width="50" bgcolor="#663300">&nbsp;</td>
	<td width="583" bgcolor="#663300">&nbsp;</td>
	<td width="4" bgcolor="#663300">&nbsp;</td>
	<td width="6" bgcolor="#663300">&nbsp;</td>
	</tr>
</table>
</body>
</html>
