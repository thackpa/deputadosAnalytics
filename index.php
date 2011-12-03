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

$valor = getValues("http://www2.camara.gov.br/deputados/pesquisa","<option\s+value=\"(.*?)\|(.*?)%(.*?)!(.*?)=(.*?)\?(.*?)\">(.*?)</option>");

$count = 0;
for($i=0;$i<count($valor[0]);$i++){
//        print "<br>Nome do FDP: ".strip_tags($valor[1][$i])." - ";
//    print "Id: ".$valor[2][$i]." - ";
//    print "Matricula: ".$valor[3][$i]." - ";
//    print "Partido: ".$valor[5][$i]." - ";
//    print "PK: ".$valor[6][$i]." - ";
//    print "Estado: ".$valor[4][$i]."<br><br>";
    try{
        $sql = "INSERT INTO deputado VALUES('".$valor[2][$i]."','".$valor[3][$i]."','".utf8_decode(strip_tags($valor[1][$i]))."','".$valor[5][$i]."','".$valor[4][$i]."','".$valor[6][$i]."')";
        $count += $dbh->exec($sql) or die(print_r($dbh->errorInfo(), true));       
    } catch (Exception $e) {
          die("Unable to connect: " . $e->getMessage());
    }
}
