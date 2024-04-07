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

if ((isset($_POST['NumPlat'])) && ($_POST['NumPlat'] != "")) {
  $deleteSQL = sprintf("DELETE FROM plat WHERE NumPlat=%s",
                       GetSQLValueString($_POST['NumPlat'], "text"));

  mysql_select_db($database_Connection_Projet, $Connection_Projet);
  $Result1 = mysql_query($deleteSQL, $Connection_Projet) or die(mysql_error());

  $deleteGoTo = "ListePlat.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_Connection_Projet, $Connection_Projet);
$query_Recordset1 = "SELECT * FROM plat";
$Recordset1 = mysql_query($query_Recordset1, $Connection_Projet) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Document sans titre</title>
<style type="text/css">
<!--
.Style1 {
	font-size: 36px;
	font-weight: bold;
	color: #FFFF66;
}
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

<body>
<form id="form2" name="form2" method="post" action="">
  <p>&nbsp;</p>
  <p align="center" class="Style1">Supprimer un Plat </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php do { ?>
  <form id="form1" name="form1" method="post" action="">
    <label>
    <input name="NumPlat" type="text" id="NumPlat" value="<?php echo $row_Recordset1['NumPlat']; ?>" />
    </label>
    <label>
    <input name="textfield2" type="text" value="<?php echo $row_Recordset1['Nom']; ?>" />
    </label>
    <label>
    <input name="textfield3" type="text" value="<?php echo $row_Recordset1['Prix']; ?>" />
    </label>
    <label>
    <input name="textfield4" type="text" value="<?php echo $row_Recordset1['Categorie']; ?>" />
    </label>
    <label>
    <input type="submit" name="Submit" value="Supprimer" />
    </label>
  </form>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  <form name="form3" id="form3">
    <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
      <option value="endex.php">Menu</option>
    </select>
    <input type="button" name="Button1" value="Retour au menu" onclick="MM_jumpMenuGo('menu1','parent',0)" />
  </form>
  <p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
