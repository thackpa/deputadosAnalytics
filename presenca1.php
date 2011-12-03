<?php
ini_set("error_reporting" , E_ALL & ~E_NOTICE);
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$dbh = new PDO('mysql:host=localhost;dbname=congresso', "root", "");

function getValues($url,$regex){
    $oControle = new Controle();
    $oSpider = $oControle->get_spider();

    $conteudo = $oSpider->get($url);
    if($oSpider->get_error() != NULL){
    	//$msg = $oSpider->get_error();
    	$msg = $oSpider->__get('error');
    }
        
    preg_match_all("#$regex#is",$conteudo,$valor);
    return $valor;
}

$sql = "SELECT * FROM deputado";
$deputados = $dbh->query($sql);

foreach ($deputados as $row) {
    print "Inserindo as presencas.....\n";
    $url = "http://www2.camara.gov.br/deputados/pesquisa/layouts_deputados_prensecaComissoes?nuLegislatura=53&nuMatricula=MATRICULADEP0&dtInicio=01/02/2007&dtFim=04/12/2010&id=522187";
    $url2 = str_replace("MATRICULADEP", substr($row["matricula"],3), $url);

    $regex = "<strong>.*?\s*?<span>(\d+)/(\d+)/(\d\d\d\d)</span></strong></td>\s*?</tr>(.*?)(?:colspan|</table>)"; 
    $valor = getValues($url2, $regex);
    for($i=0;$i<count($valor[0]);$i++){
        print "\n\n\n inserindo $i...\n";
        $data = $valor[3][$i]."-".$valor[2][$i]."-".$valor[1][$i];
        $regex = "\s*?<tr\s*?class.*?\s*?<td><span>(.*?)\s+-\s+(.*?)\s+-\s+(.*?)</span></td>\s*?<td><span>(.*?)</span></td>\s*?<td>\s*?<span>(.*?)</span>\s*?</td>\s*?</tr>"; 
        preg_match_all("#$regex#is",$valor[4][$i],$valor2);
        for($j=0;$j<count($valor2[0]);$j++){
            $sql = "INSERT INTO reuniao VALUES(null,'".$row["idDeputado"]."','".$valor2[2][$j]."-".utf8_decode(strip_tags(rtrim(trim($valor2[3][$j]))))."','".utf8_decode(strip_tags(rtrim(trim($valor2[4][$j]))))."','$data','".utf8_decode(strip_tags(rtrim(trim($valor2[5][$j]))))."','".utf8_decode(strip_tags(rtrim(trim($valor2[1][$j]))))."')";
            $dbh->exec($sql);
        }
    }
    print "\n\n\n\n\npresencas de dias inseridas....";

}