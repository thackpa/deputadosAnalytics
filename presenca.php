<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

print "Recuperando os Dados dos fdp....";
sleep(1);
print "..............";
sleep(1);

$dbh = new PDO('mysql:host=localhost;dbname=congresso', "root", "");

function getValues($url,$regex){
    $oControle = new Controle();
    $oSpider = $oControle->get_spider();

    $conteudo = $oSpider->get($url);
    if($oSpider->get_error() != NULL){
    	//$msg = $oSpider->get_error();
    	$msg = $oSpider->__get('error');
    }
        
    preg_match_all("#$regex#i",$conteudo,$valor);
    return $valor;
}

$sql = "SELECT * FROM deputado";
$deputados = $dbh->query($sql);

foreach ($deputados as $row) {
    print "Inserindo as presencas.....";
    $url = "http://www.camara.gov.br/internet/deputado/RelPresencaPlenario.asp?nuLegislatura=53&nuMatricula=MATRICULADEP&dtInicio=01/02/2007&dtFim=04/12/2010";
    $url2 = str_replace("MATRICULADEP", substr($row["matricula"],3), $url);
    //Data, presença, ausencia e justificativa:
    $regex = "<tr\s+class=\"even\">\s*?<td\s+class=\"borderPrint\">\s*?(\d+)/(\d+)/(\d\d\d\d)\s*?</td>\s*?<td\s+class=\"borderPrint\">.*?</td>\s*?<td\s+class=\"borderPrint\">\s*?(.*?)\s*?</td>\s*?<td\s+class=\"borderPrint\">\s*?(.*?)\s*?</td>\s*?</tr>"; 
    $valor = getValues($url2, $regex);
    //print_r($valor);
    //die;
    for($i=0;$i<count($valor[0]);$i++){
        $sql = "INSERT INTO frequenciaDia VALUES(null,'".$row["idDeputado"]."','".$valor[3][$i]."-".$valor[2][$i]."-".$valor[1][$i]."','".utf8_decode(strip_tags(rtrim(trim($valor[4][$i]))))."',null,'".utf8_decode(strip_tags(rtrim(trim($valor[5][$i]))))."')";
        $count += $dbh->exec($sql) or die(print_r($dbh->errorInfo(), true));
    }
    print "\n\n\n\n\npresencas de dias inseridas....";
}