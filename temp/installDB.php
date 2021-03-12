<?php
/**
 * @version     0.0.1
 * @package     
 * @subpackage  
 * @author      davidsnege <david.snege@gmail.com>
 * @copyright   2020 davidsnege (FabrikaDev)
 * @license     Licença de uso Somente para uso no ensino de Programação (Outros usos estão vetados)
 */
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Cria Base de dados
//║
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Parametros de conexao
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
    $host="localhost";
    $login="root";
    $senha="";
    $banco="";
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Criamos a variavel de conexao
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
	$conecta = new mysqli ($host, $login, $senha, $banco);
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Definimos a query para criar a base de dados e armazenamos na variavel $sql
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
    $sql = "CREATE DATABASE campingsEuropeFabrikaDS";
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Executamos e conferimos o estado "verdadeiro ou falso" e definimos mensagens para "true or false"
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
    if ($conecta->query($sql)===TRUE){
    echo '<div class="alert alert-success"><strong>Parabéns, </strong> a base de dados foi criada com sucesso!</div>';
    }else{
    echo '<div class="alert alert-danger"><strong>Que pena, </strong> a base de dados não foi criada!</div>';
    }
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Definimos a query para criar a tabela na base de dados e armazenamos na variavel $sql
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
    $sql="CREATE TABLE campingDataUseGeneral (
        id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        raisonSociale VARCHAR(100),
        alias VARCHAR(100), 
        email VARCHAR(100), 
        contactEmail VARCHAR(100), 
        contactPhone VARCHAR(100), 
        addressOne VARCHAR(120),
        addressTwo VARCHAR(120),
        addressComplement VARCHAR(120),
        addressPostalCode VARCHAR(12),
        isAgroupCampings VARCHAR(1),
        addressCountry VARCHAR(15),
        addressRegion VARCHAR(30),
        addressDepartement VARCHAR(30),
        principalTitle TEXT(150),
        principalDescription TEXT(500),
        principalAdvantagesDescription TEXT(500),
        defaultLogoCamping VARCHAR(250),
        principalIMGuniqueRoute VARCHAR(250),
        principalIMGslideRoute VARCHAR(250),
        namePerson VARCHAR(30),
        nameSurnamePerson VARCHAR(30),
        contactPerson VARCHAR(30),
        emailPerson VARCHAR(30),
        coordLatitude VARCHAR(30),
        coordLongitud VARCHAR(30),
        login VARCHAR(30),
        pass VARCHAR(30),
        backoffice VARCHAR(1),
        seoTitle VARCHAR(30),
        seoDescription VARCHAR(120),
        languageDef VARCHAR(2),
        reg_date TIMESTAMP
        )";
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Executamos e conferimos o estado "verdadeiro ou falso" e definimos mensagens para "true or false"
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
    $conecta = new mysqli ($host, $login, $senha, "campingsEuropeFabrikaDS");
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
    if ($conecta->query($sql) === TRUE){
    echo '<div class="alert alert-success"><strong>Parabéns, </strong> Tabela foi criada! </div>';
    }else{
    echo '<div class="alert alert-danger"><strong>Que pena, </strong> Tabela Não foi criada! </div>';
    }
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Encerramos a conexao com o mysql para nao consumir mais recursos
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
    $conecta->close();
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
?>
