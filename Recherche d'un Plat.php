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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE plat SET Nom=%s, Prix=%s, Categorie=%s WHERE NumPlat=%s",
                       GetSQLValueString($_POST['Nom'], "text"),
                       GetSQLValueString($_POST['Prix'], "int"),
                       GetSQLValueString($_POST['Categorie'], "text"),
                       GetSQLValueString($_POST['NumPlat'], "text"));

  mysql_select_db($database_Connection_Projet, $Connection_Projet);
  $Result1 = mysql_query($updateSQL, $Connection_Projet) or die(mysql_error());
}

$colname_Recordset1 = "-1";
if (isset($_POST['NumPlat'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_POST['NumPlat'] : addslashes($_POST['NumPlat']);
}
mysql_select_db($database_Connection_Projet, $Connection_Projet);
$query_Recordset1 = sprintf("SELECT * FROM plat WHERE NumPlat = '%s'", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $Connection_Projet) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Document sans titre</title>
</head>

<body>   
<form id="form1" name="form1" method="post" action="">
Numero de Plat
  <label>
  <input name="NumPlat" type="text" id="NumPlat" />
  </label>
  <label>
  <input type="submit" name="Submit" value="Recherche d'un plat" />
  </label>
<p>&nbsp;</p>
</form>

<form method="post" name="form2" action="<?php echo $editFormAction; ?>"> 
  <table align="center" bordercolor="#996600" bgcolor="#FF6633">
    <tr valign="baseline">
      <td nowrap align="right">NumPlat:</td>
      <td><?php echo $row_Recordset1['NumPlat']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nom:</td>
      <td><input type="text" name="Nom" value="<?php echo $row_Recordset1['Nom']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Prix:</td>
      <td><input type="text" name="Prix" value="<?php echo $row_Recordset1['Prix']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Categorie:</td>
      <td><input type="text" name="Categorie" value="<?php echo $row_Recordset1['Categorie']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Mettre à jour l'enregistrement"></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p><a href="Mise_a_jour.Plat.php"><<<<<<<<<<<Retour</a>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
