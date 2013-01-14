<?php

namespace DA\Builder;

abstract class Presenca extends Builder
{
    protected $presencaScrapper;
    protected $presencaRepository;
    protected $legislaturaRepository;
    protected $deputadoRepository;
    protected $urlParams;
    
    /**
     * Inicializa as principais variaveis para realização da exração e armazenamento no BD
     * @param Silex\Application $app                        
     */
    public function __construct($app)
    {
        parent::__construct($app);                
    }

    /**
     * Tranforma o mes passado como parametro em um array 
     * contendo o primeiro e ultimo dia deste mes.
     * 
     * @param  int $mes 
     * @return array  array('dataInicio'=>'01/$mes/$ano', 'dataFim'=>'$endDay/$mes/$ano');
     */
    protected function getDatas4Extracao($mes)
    {
        $endDay = 31;

        if($mes == 2) {
            $endDay = 28;
        }elseif($mes % 2 == 0) {
            $endDay = 30;
        }

        $ano = date('Y');
        $mes = str_pad($mes, 2, "0", STR_PAD_LEFT);
        
        return array("dataInicio" => "01/$mes/$ano", "dataFim" => "$endDay/$mes/$ano");
    }
        
}