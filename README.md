Deputados Analytics [![Build Status](https://secure.travis-ci.org/thackpa/deputadosAnalytics.png?branch=master)](http://travis-ci.org/thackpa/deputadosAnalytics)
===================

Passos pra rodar
-----------
1. Baixe o Composer: [http://getcomposer.org/](http://getcomposer.org/)
2. Baixe as dependencias: 
   `$ php composer.phar install`
5. Edite o arquivo `config/config.ini` com as credenciais de acesso aos banco
    5.1 Configure dois bancos diferentes para os ambientes  `dev` e `automatedtests`
6. Execute as migrations com os comandos:
`$ ./tests/cli/console.php --configuration=migrations.yml migrations:migrate`
`$ ./application/cli/console.php --configuration=migrations.yml migrations:migrate`
6. Rode os testes: 
`$ phpunit --configuration phpunit.xml`
7. Rodar o spider 
`$ application/cli/console.php atualizar`

Informações
-----------
Veja: deputadosanalytics.com.br


Contribuição
------------
Detalhes pra contibruição em breve.


Licença
-------


Sobre o THack-PA
----------------