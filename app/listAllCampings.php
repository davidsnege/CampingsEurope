<?php
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
/**
 * @version     0.0.1
 * @package     
 * @subpackage  
 * @author      davidsnege <david.snege@gmail.com>
 * @copyright   2020 davidsnege (FabrikaDev)
 * @license     Licença de uso Somente para uso no ensino de Programação (Outros usos estão vetados)
 */
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Lista registros da tabela da Base de dados
//║
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Parametros de conexao
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
    require 'config_db.php';
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Definimos a query para listar registros da tabela da base de dados e armazenamos na variavel $sql
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
    $sql = "SELECT * FROM campingDataUseGeneral ORDER BY id ASC LIMIT 0, 25";
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Criamos a variavel $result para armazenar a execução da query 
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
    $result = mysqli_query($conecta, $sql);
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Fazemos um loop foreach para recorrer a Array da variavel $result e printar na tela
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
    $resulta = [];

    foreach ($result as $key => $value) {
            if($value != ""){
                array_push($resulta, $value);
            }
    };
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Exemplo Saida para Angular
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
   echo json_encode($resulta);             
//╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
//║  Exemplo de uso com HTML
//╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
// <h5 class="card-title"> '.$value['raisonSociale'].'</h5>