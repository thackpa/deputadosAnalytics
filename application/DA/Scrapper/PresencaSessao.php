<?php

namespace DA\Scrapper;

class PresencaSessao extends Scrapper
{
    private $app;
    
    public function __construct($app)
    {
        $this->app = $app;
        parent::__construct();
    }
    
    public function getPresencas($deputadoId, $lesgislatura, $last3Matricula, $dataInicio, $dataFim)
    {
        $crawler = $this->request(
                str_replace(array('%legislatura%', '%last3Matricula%', '%dataInicio%', '%dataFim%'),
                    array($lesgislatura, $last3Matricula, $dataInicio, $dataFim),
                    $this->app['config']['url.presencaPlenario'])
                );
        $presencas   = $crawler->filter('table.tabela-1 > tbody > tr');
        $dataPresencas = array();
        $pres = array();
        $pres['deputadoId'] = $deputadoId;
        foreach ($presencas as $node) {
            $tds = $node->getElementsByTagName('td');
            if($node->getAttribute('class') == "even") {
                $dates = explode('/', trim($tds->item(0)->nodeValue));
                $pres['data'] = $dates[2].'-'.$dates[1].'-'.$dates[0];
                $pres['justificativa'] = utf8_decode(trim($tds->item(2)->nodeValue));
            } else {
                $pres['sessao']         = substr(utf8_decode(trim($tds->item(0)->nodeValue)), 6);
                $comportamento = utf8_decode(trim($tds->item(1)->nodeValue));
                $pres['comportamento']  = substr($comportamento,0, strlen($comportamento)-1);
                
                $dataPresencas[] = $pres;
            }
        }
        return $dataPresencas;
    }
    
}