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

mysql_select_db($database_Connection_Projet, $Connection_Projet);
$query_Recordset1 = "SELECT * FROM plat";
$Recordset1 = mysql_query($query_Recordset1, $Connection_Projet) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
.Style4 {font-size: 18px}
.Style8 {font-size: 18px; font-weight: bold; }
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
	<td height="60" colspan="3" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#663300" class="logo Style1"><div align="center" class="Style2">LISTE DES PLATS </div></td>
	<td width="4">&nbsp;</td>
	<td width="4">&nbsp;</td>
	</tr>

	<tr bgcolor="#003399">
	<td width="15" nowrap="nowrap">&nbsp;</td>
	<td height="36" colspan="3" nowrap="nowrap" bgcolor="#663300" class="navText" id="navigation"><form name="form2" id="form2">
	</form>
	</td>
	  <td width="4">&nbsp;</td>
	<td width="4">&nbsp;</td>
	</tr>

	<tr bgcolor="#ffffff">
	<td colspan="6"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
	</tr>

	<tr bgcolor="#ffffff">
	<td colspan="2" valign="top" bgcolor="#ffffcc"><div align="center"><img src="image_Restaurant/IMG-20240120-WA0016.jpg" width="182" height="161" />
	    <img src="image_Restaurant/IMG-20240120-WA0026.jpg" width="195" height="155" />
	    <img src="image_Restaurant/IMG-20240120-WA0021.jpg" width="253" height="156" />
	  </div>
	  <table border="0" cellspacing="0" cellpadding="0" width="230">
		<tr>
		<td width="15">&nbsp;</td>
		<td width="200" class="smallText" id="padding"><br />		</td>
		<td width="15">&nbsp;</td>
		</tr>
	</table>	
	  <div align="center"><img src="image_Restaurant/IMG-20240120-WA0025.jpg" width="231" height="138" /></div></td>
	<td width="50" valign="top"><img src="mm_spacer.gif" alt="" width="50" height="1" border="0" /></td>
	<td width="667" valign="top" bgcolor="#FFFFFF"><br />
	&nbsp;<br />
	<table border="0" cellspacing="0" cellpadding="0" width="492">
		<tr>
		<td width="492" bgcolor="#FFFFCC" class="pageHeader">&nbsp;
            <form name="form1" id="form1">
              <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
                <option value="endex.php">Menu</option>
              </select>
              <input type="button" name="Button1" value="Retour au menu" onclick="MM_jumpMenuGo('menu1','parent',0)" />
            </form>
            <a href="endex.php"></a>
            <p>&nbsp;</p>
          <table height="176" border="1" bgcolor="#3399FF">
            <tr>
              <td><div align="center" class="Style8 Style4">Numero plat</div></td>
              <td><div align="center" class="Style8">Nom du plat </div></td>
              <td><div align="center" class="Style8">Prix du plat </div></td>
              <td><div align="center" class="Style8">Categorie de plat </div></td>
            </tr>
            <?php do { ?>
              <tr>
                <td><div align="center" class="Style8"><?php echo $row_Recordset1['NumPlat']; ?></div></td>
                <td><div align="center" class="Style8"><?php echo $row_Recordset1['Nom']; ?></div></td>
                <td><div align="center" class="Style8"><?php echo $row_Recordset1['Prix']; ?></div></td>
                <td><div align="center" class="Style8"><?php echo $row_Recordset1['Categorie']; ?></div></td>
              </tr>
              <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
          </table></td>
		</tr>

		<tr>
		<td bgcolor="#FFCC66" class="bodyText"><p>&nbsp;</p>

		 <a href="FormulaireCommande.php" class="Style4">Commandez ICI</a><br />		</td>
		</tr>
	</table>	</td>
	<td width="4">&nbsp;</td>
	<td width="4">&nbsp;</td>
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
	<td width="50" bgcolor="#663300">&nbsp;</td>
	<td width="667" bgcolor="#663300">&nbsp;</td>
	<td width="4" bgcolor="#663300">&nbsp;</td>
	<td width="4" bgcolor="#663300">&nbsp;</td>
	</tr>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
