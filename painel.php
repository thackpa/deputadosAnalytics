<?php 

ini_set("error_reporting" , E_ALL & ~E_NOTICE);

$dbh = new PDO('mysql:host=localhost;dbname=congresso', "root", "");

$sql = "SELECT * FROM deputado ORDER BY name";
$deputados = $dbh->query($sql);


if($_GET['id']){
    //filtrar somente numeros
    $id = strip_tags(addslashes($_GET['id']));
    $sql = "SELECT * FROM deputado WHERE idDeputado=".$id;
    $res = $dbh->query($sql);
    $deputado = $res->fetch();

    $sql = "SELECT count(*) as freqDia FROM frequenciaDia WHERE presenca LIKE 'Presen%' AND idDeputado=".$id;
    $res = $dbh->query($sql);
    $freqDias = $res->fetch();
    $freqDia = $freqDias["freqDia"];
    
    $sql = "SELECT count(*) as falta FROM frequenciaDia WHERE presenca NOT LIKE 'Presen%' AND presenca NOT LIKE '%just%' AND idDeputado=".$id;
    $res = $dbh->query($sql);
    $falta = $res->fetch();
    $faltas = $falta["falta"];
    
//    $sql = "SELECT count(*) as freqDia FROM frequenciaDia WHERE idDeputado=".$id;
//    $res = $dbh->query($sql);
//    $freqDia = $res->fetch();
//    $freqDia = $freqDia["freqDia"];
//    
//    $sql = "SELECT count(*) as freqDia FROM frequenciaDia WHERE idDeputado=".$id;
//    $res = $dbh->query($sql);
//    $freqDia = $res->fetch();
//    $freqDia = $freqDia["freqDia"];
}

$sql = "SELECT estado FROM deputado GROUP BY estado ORDER BY estado";
$estados = $dbh->query($sql);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Parlamentar Analytics</title>
<link href="css/css.css" rel="stylesheet" type="text/css" />
<!-- <link href="css/visualize.css" type="text/css" rel="stylesheet" />-->
<!-- <link href="css/basic.css" type="text/css" rel="stylesheet" />-->
<!-- <link href="css/visualizedark.css" type="text/css" rel="stylesheet" />--> 
<script type="text/javascript" src="js/visualize.jQuery.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/excanvas.js"></script>
<script type="text/javascript" src="js/example.js"></script>	
</head>

<body>
<table width="100%" border="0" cellspacing="10" cellpadding="0">
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="img/logo.jpg" width="261" height="60" /></td>
        <td align="right"><a href="#" class="menu">Sobre</a> | <a href="#" class="menu">Contato</a> &nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="caixa">
      <tr>
        <td>&Uacute;ltima atualiza&ccedil;&atilde;o dos dados: 12/12/2010</td>
        <td align="right">Selecione o parlamentar &nbsp;</td>
        <td>
        
        <select name="cmbDep">
        	<?php 
        	foreach ($deputados as $dep) {
        	    ?>
        	    <option value="<?php print $dep["idDeputado"]?>"><?php print $dep["name"]?></option>
        	    <?php 
        	}
        	?>
        </select>        
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="16%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="boxbranco">
          <tr>
            <td><a href="#" class="textomenu">Parlamentares</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="img/blank.gif" width="1" height="10" /></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="boxbranco">
          <tr>
            <td height="25"><a href="#" class="textomenu">Brasil</a></td>
          </tr>
          <tr>
            <td bgcolor="#CCCCCC"><img src="img/blank.gif" width="1" height="1" /></td>
          </tr>
           <?php 
        	foreach ($estados as $estado) :
            ?>
          <tr>
            <td height="25"><a href="painel.php?estado=<?php print $estado["estado"];?>" class="textomenu"><?php print $estado["estado"];?></a></td>
          </tr>
          <?php endforeach;?>
        </table></td>
      </tr>
    </table>
      </td>
    <td width="84%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="boxbranco">
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="boxcinza">
          <tr>
            <td> &nbsp;&nbsp;<span class="azul_18"><?php print $deputado["name"]?> - <?php print $deputado["partido"]?>/<?php print $deputado["estado"]?></span></td>
          </tr>
        </table>          </td>
      </tr>
      <tr>
        <td><img src="img/blank.gif" width="1" height="10" /></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="boxdetalhe">
              <tr>
                <td height="29" bgcolor="#666666" class="arial_12_branco">&nbsp;&nbsp;Ranking Par&aacute; </td>
                <td height="29" align="right" bgcolor="#666666" class="arial_12_branco"><img src="img/melhor.gif" width="32" height="22" /></td>
              </tr>
              <tr>
                <td height="35" colspan="2" class="menu">&nbsp;&nbsp;<a href="#" class="textomenu_noneg"></a>
				<?php include __DIR__."/graphEstado.php";?>	
				</td>
                </tr>
              <tr>
                <td colspan="2" bgcolor="#CCCCCC"><img src="img/blank.gif" width="1" height="1" /></td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="#CCCCCC"><img src="img/blank.gif" width="1" height="1" /></td>
              </tr>
              <tr>
                <td height="30" colspan="2" bgcolor="#FAFAFA"> &nbsp;&nbsp;<a href="#" class="textomenu_noneg">Visualizar relat&oacute;rios</a> </td>
              </tr>
            </table></td>
            <td width="10"><img src="img/blank.gif" width="10" height="1" /></td>
            <td width="50%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="boxdetalhe">
              <tr>
                <td height="29" bgcolor="#666666" class="arial_12_branco">&nbsp;&nbsp;Ranking Brasil </td>
                <td height="29" align="right" bgcolor="#666666" class="arial_12_branco"><img src="img/melhor.gif" width="32" height="22" /></td>
              </tr>
              <tr>
                <td height="35" colspan="2" class="menu">&nbsp;&nbsp;<a href="#" class="textomenu_noneg"></a></td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="#CCCCCC"><img src="img/blank.gif" width="1" height="1" /></td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="#CCCCCC"><img src="img/blank.gif" width="1" height="1" /></td>
              </tr>
              <tr>
                <td height="30" colspan="2" bgcolor="#FAFAFA">&nbsp;&nbsp;<a href="#" class="textomenu_noneg">Visualizar relat&oacute;rios</a> </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="img/blank.gif" width="1" height="10" /></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="boxdetalhe">
          <tr>
            <td height="29" colspan="2" bgcolor="#666666" class="arial_12_branco">&nbsp;&nbsp;Resumo</td>
            <td height="29" colspan="2" align="right" bgcolor="#666666" class="arial_12_branco"><img src="img/pior.gif" width="32" height="22" /></td>
          </tr>
          <tr>
            <td width="11%" height="35" class="menu">&nbsp;&nbsp;</td>
            <td width="39%" class="menu"><span class="textomenu16"><?php print $freqDia?></span> Presen&ccedil;a Di&aacute;rias no Plen&aacute;rio</td>
            <td width="12%" class="menu">&nbsp;</td>
            <td width="38%" class="menu"><span class="textomenu16"><?php print $propostas?></span> Propos&ccedil;&otilde;es de sua autoria </td>
          </tr>
          <tr>
            <td colspan="4" bgcolor="#CCCCCC"><img src="img/blank.gif" width="1" height="1" /></td>
          </tr>
          <tr>
            <td height="35" class="menu">&nbsp;</td>
            <td height="35" class="menu"><span class="textomenu16"><?php print $faltas?></span> Faltas n&atilde;o justificadas</td>
            <td class="menu">&nbsp;</td>
            <td class="menu"><span class="textomenu16"><?php print $relatorias?></span> Propos&ccedil;&otilde;es relatadas</td>
          </tr>
          <tr>
            <td height="35" class="menu">&nbsp;</td>
            <td height="35" class="menu"><span class="textomenu16"><?php print $discursos?></span> Discursos proferidos em plen&aacute;rio</td>
            <td class="menu">&nbsp;</td>
            <td class="menu"><span class="textomenu16"><?php print $votacoes?></span> Vota&ccedil;&otilde;es em plen&aacute;rio</td>
          </tr>
          <tr>
            <td colspan="4" bgcolor="#CCCCCC"><img src="img/blank.gif" width="1" height="1" /></td>
          </tr>
          <tr>
            <td colspan="4" bgcolor="#CCCCCC"><img src="img/blank.gif" width="1" height="1" /></td>
          </tr>
          <tr>
            <td height="30" colspan="4" bgcolor="#FAFAFA">&nbsp;&nbsp;<a href="#" class="textomenu_noneg">Visualizar relat&oacute;rios</a> </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="img/blank.gif" width="1" height="10" /></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="boxdetalhe">
          <tr>
            <td height="29" colspan="2" bgcolor="#666666" class="arial_12_branco">&nbsp;&nbsp;Ranking Par&aacute; </td>
            <td height="29" colspan="3" align="right" bgcolor="#666666" class="arial_12_branco">&nbsp;</td>
          </tr>
          <tr>
            <td width="29%" height="35" align="right" class="menu">&nbsp;&nbsp;Presen&ccedil;a no Plen&aacute;rio</td>
            <td width="12%" class="menu"><span class="textomenu16"> &nbsp;&nbsp;23&deg;</span> </td>
            <td width="33%" height="35" align="right" class="menu">&nbsp;Proposi&ccedil;&otilde;es de sua autoria</td>
            <td width="9%" class="menu"><span class="textomenu16"> &nbsp;&nbsp;23&deg;</span> </td>
            <td width="17%" align="center" bgcolor="#E6F2FA" class="textomenu_noneg">Posi&ccedil;&atilde;o Geral </td>
            </tr>
          <tr>
            <td colspan="5" bgcolor="#CCCCCC"><img src="img/blank.gif" width="1" height="1" /></td>
          </tr>
          <tr>
            <td height="35" align="right" class="menu">&nbsp;&nbsp;Faltas n&atilde;o justificadas</td>
            <td class="menu"><span class="textomenu16"> &nbsp;&nbsp;23&deg;</span> </td>
            <td height="35" align="right" class="menu">Proposi&ccedil;&otilde;es relatadas</td>
            <td class="menu"><span class="textomenu16"> &nbsp;&nbsp;23&deg;</span> </td>
            <td align="center" bgcolor="#E6F2FA" class="azul_18">123&deg;</td>
            </tr>
          <tr>
            <td colspan="5" bgcolor="#CCCCCC"><img src="img/blank.gif" width="1" height="1" /></td>
          </tr>
          <tr>
            <td height="35" align="right" class="menu">&nbsp;&nbsp;Discursos proferidos em plen&aacute;rio</td>
            <td class="menu"><span class="textomenu16"> &nbsp;&nbsp;23&deg;</span> </td>
            <td height="35" align="right" class="menu">Vota&ccedil;&otilde;es em plen&aacute;rio</td>
            <td class="menu"><span class="textomenu16"> &nbsp;&nbsp;23&deg;</span> </td>
            <td align="center" bgcolor="#E6F2FA" class="azul_18">&nbsp;</td>
          </tr>

        </table></td>
      </tr>
      <tr>
        <td><img src="img/blank.gif" width="1" height="10" /></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="boxdetalhe">
          <tr>
            <td height="29" colspan="2" bgcolor="#666666" class="arial_12_branco">&nbsp;&nbsp;Ranking Par&aacute; </td>
            <td height="29" colspan="3" align="right" bgcolor="#666666" class="arial_12_branco">&nbsp;</td>
          </tr>
          <tr>
            <td width="29%" height="35" align="right" class="menu">&nbsp;&nbsp;Presen&ccedil;a no Plen&aacute;rio</td>
            <td width="12%" class="menu"><span class="textomenu16"> &nbsp;&nbsp;23&deg;</span> </td>
            <td width="33%" height="35" align="right" class="menu">&nbsp;Proposi&ccedil;&otilde;es de sua autoria</td>
            <td width="9%" class="menu"><span class="textomenu16"> &nbsp;&nbsp;23&deg;</span> </td>
            <td width="17%" align="center" bgcolor="#E6F2FA" class="textomenu_noneg">Posi&ccedil;&atilde;o Geral </td>
          </tr>
          <tr>
            <td colspan="5" bgcolor="#CCCCCC"><img src="img/blank.gif" width="1" height="1" /></td>
          </tr>
          <tr>
            <td height="35" align="right" class="menu">&nbsp;&nbsp;Faltas n&atilde;o justificadas</td>
            <td class="menu"><span class="textomenu16"> &nbsp;&nbsp;23&deg;</span> </td>
            <td height="35" align="right" class="menu">Proposi&ccedil;&otilde;es relatadas</td>
            <td class="menu"><span class="textomenu16"> &nbsp;&nbsp;23&deg;</span> </td>
            <td align="center" bgcolor="#E6F2FA" class="azul_18">123&deg;</td>
          </tr>
          <tr>
            <td colspan="5" bgcolor="#CCCCCC"><img src="img/blank.gif" width="1" height="1" /></td>
          </tr>
          <tr>
            <td height="35" align="right" class="menu">&nbsp;&nbsp;Discursos proferidos em plen&aacute;rio</td>
            <td class="menu"><span class="textomenu16"> &nbsp;&nbsp;23&deg;</span> </td>
            <td height="35" align="right" class="menu">Vota&ccedil;&otilde;es em plen&aacute;rio</td>
            <td class="menu"><span class="textomenu16"> &nbsp;&nbsp;23&deg;</span> </td>
            <td align="center" bgcolor="#E6F2FA" class="azul_18">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</body>
</html>
