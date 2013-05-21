Deputados Analytics [![Build Status](https://secure.travis-ci.org/thackpa/deputadosAnalytics.png?branch=master)](http://travis-ci.org/thackpa/deputadosAnalytics)
===================

Passos pra rodar
-----------
**1.** Baixe o [Composer](http://getcomposer.org/):

**2.** Instale as dependencias:

```
$ php composer.phar install
```

**3.** Edite o arquivo ***config/config.ini*** com as credenciais de acesso ao banco. Não se esqueça de configurar diferentes databases para os ambientes  *dev* e *automatedtests*
	
	
**4.** Execute as migrations com os comandos:
```
$ ./application/cli/console.php --configuration=migrations.yml migrations:migrate
```
```
$ ./tests/cli/console.php --configuration=migrations.yml migrations:migrate
```

***5.*** Rode os testes para ver se está tudo configurado corretamente: 
```
$ phpunit --configuration phpunit.xml
```

***6.*** Rodar o spider para atualizar os dados do ambiente *dev*
```
$ application/cli/console.php atualizar
```

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
