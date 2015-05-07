#Projeto elaborado no Modulo API and Silex(Curso Trilhando caminho com PHP).

1 - Instalar
Clone o projeto
```
git clone https://github.com/thiagovictor/TestesAutomatizadosTDD.git
```
Apos clonar, digite os comandos:
```
cd TestesAutomatizadosTDD
php composer.phar self-update
php composer.phar install
```
Pronto. Agora, vamos iniciar o servidor PHP Built-in Server na pasta public
```
php -S localhost:8080 -t public
```
Para acesso:
```
http://localhost:8080/produtos
```
#Rodando os testes
1-Sera necessario iniciar o servidor Selenium para os testes de aceitacao. tambem sera necesario ter o Firefox.
```
java -jar selenium-server-standalone-2.45.0.jar
```
2-Iniciando o PHPUnit
```
bin\phpunit -c tests\phpunit.xml
```