<?php
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------

// CORREGIR json COM PROBLEMAS DE MULTIPLAS RAIZES {DADOS}{DADOS}{DADOS} E ERRO

//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
// Carregamos o arquivo externo Json com problemas de multiplas raizes
$json = file_get_contents('dataImportoldsite/response_country8.json');
echo '<pre>';

//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
/** NÃO SABEMOS COMO ISSO FUNCIONA MAS FUNCIONA, VEIO DO SITE: 
 * http://ryanuber.com/07-31-2012/split-and-decode-json-php.html
 * 
 * json_split_objects - Return an array of many JSON objects
 *
 * @param string $json  The JSON data to parse
 *
 * @return array
 */
function json_split_objects($json)
{
    $q = FALSE;
    $len = strlen($json);
    for($l=$c=$i=0;$i<$len;$i++)
    {   
        $json[$i] == '"' && ($i>0?$json[$i-1]:'') != '\\' && $q = !$q;
        if(!$q && in_array($json[$i], array(" ", "\r", "\n", "\t"))){continue;}
        in_array($json[$i], array('{', '[')) && !$q && $l++;
        in_array($json[$i], array('}', ']')) && !$q && $l--;
        (isset($objects[$c]) && $objects[$c] .= $json[$i]) || $objects[$c] = $json[$i];
        $c += ($l == 0);
    }   
    // print_r($objects);
    return $objects;
}
$result = json_split_objects($json);
// NÃO MEXER NO CODIGO ACIMA, ELE FUNCIONA, OK, CORRIGE MEUS JSONS COM VARIAS RAIZ

//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
// Criamos um array valido para armazenar os dados
    $newJson['campings'] = array();

    foreach ($result as $key => $value) {
        // Inserimos na Array os valores da maneira correta
        array_push($newJson['campings'], json_decode($value));
    }

    // Conferindo que ta tudo ok com nosso processo de correção de Json
    // print_r($newJson['campings']);
    echo 'Total de Campings: '.$newJson['campings'][0]->{'thesaurusCode'} . ' - ' . count($newJson['campings']);
    echo '<br>';

    // Outro foreach para insertar na base de dados
    foreach ($newJson['campings'] as $value) {
        // Aqui é onde podemos inserir o que queremos na base de dados
        //╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
        //║  INSERE registro na tabela da Base de dados
        //╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
        //╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
        //║  Parametros de conexao
        //╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
        //╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
                $host="localhost";
                $login="root";
                $senha="";
                $banco="campingsEurope";
        //╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
        //╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
        //╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
        //║  Criamos a variavel de conexao
        //╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
        //╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
                $conecta = new mysqli ($host, $login, $senha, $banco);
        //╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
        //╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
        //║  Definimos a query para inserir o registro na tabela na base de dados e armazenamos na variavel $sql
        //╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
        //╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
                $sqli = "INSERT INTO campings_data (id_camping, name_campìng, etc, etc, etc)".
                "VALUES ('$value->id_camping','$value->email', '$value->RaisonSociale', 'etc', 'etc')";
        //╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
        //╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
        //║  Executamos e conferimos o estado "verdadeiro ou falso" e definimos mensagens para "true or false"
        //╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
        //╔══════════════════════════════════════════════════════════════════════════════════════════════════════════╗
                if ($conecta->query($sqli) === TRUE){
                echo '<div class="alert alert-success"><strong>Parabéns, </strong> Dados inseridos com sucesso! </div>';
                }else{
                echo '<div class="alert alert-danger"><strong>Que pena, </strong> não foi possível inserir os dados </div>';
                }
        //╚══════════════════════════════════════════════════════════════════════════════════════════════════════════╝
        // Aqui printamos para conferir o que temos
        echo '<br>';
        echo '<hr>';
        echo '2: '; echo strtoupper($value->id_camping); echo '&nbsp;';
        echo '<br>';
        echo '3: '; echo strtoupper($value->RaisonSociale); echo '&nbsp;';
        echo '<br>';
        // echo '0: '; echo strtoupper($value->raisonSociale_en); echo '&nbsp;';
        // echo '<br>';
        // echo '0: '; echo strtoupper($value->raisonSociale_pt); echo '&nbsp;';
        // echo '<br>';
        // echo '0: '; echo strtoupper($value->raisonSociale_es); echo '&nbsp;';
        // echo '<br>';
        // echo '0: '; echo strtoupper($value->raisonSociale_fr); echo '&nbsp;';
        // echo '<br>';
        echo '4: '; echo strtoupper($value->raisonSociale); echo '&nbsp;';
        echo '<br>';
        echo '5: '; echo strtoupper($value->codePostal); echo '&nbsp;';
        echo '<br>';
        echo '6: '; echo $value->email; echo '&nbsp;';
        echo '<br>';
        echo '7: '; echo strtoupper($value->alias); echo '&nbsp;';
        echo '<br>';
        echo '8: '; echo strtoupper($value->Adr1); echo '&nbsp;';
        echo '<br>';
        //echo '0: '; echo strtoupper($value->Coord); echo '&nbsp;';
        // echo '<br>';
        echo '9: '; echo strtoupper($value->inseeCode); echo '&nbsp;';
        echo '<br>';
        echo '10: '; echo strtoupper($value->seo_urlkey); echo '&nbsp;';
        echo '<br>';
        echo '11: '; echo strtoupper($value->Libelle); echo '&nbsp;';
        echo '<br>';
        echo '12: '; echo strtoupper($value->{81}); echo '&nbsp;';
        echo '<br>';
        echo '13: '; echo strtoupper($value->{88}); echo '&nbsp;';
        echo '<br>';
        // echo '0: '; echo strtoupper($value->{92}); echo '&nbsp;';
        // echo '<br>';
        echo '14: '; echo strtoupper($value->{102}); echo '&nbsp;';
        echo '<br>';
        echo '15: '; echo strtoupper($value->{104}); echo '&nbsp;';
        echo '<br>';
        echo '16: '; echo strtoupper($value->{114}); echo '&nbsp;';
        echo '<br>';
        // echo '0: '; echo strtoupper($value->{111}); echo '&nbsp;';
        // echo '<br>';
        echo '17: '; echo strtoupper($value->{121}); echo '&nbsp;';
        echo '<br>';
        echo '18: '; echo strtoupper($value->{122}); echo '&nbsp;';
        // echo '<br>';
        // echo '0: '; echo strtoupper($value->{109}); echo '&nbsp;';
        // echo '<br>';
        // echo '0: '; echo strtoupper($value->{110}); echo '&nbsp;';
        echo '<br>';
        echo '19: '; echo strtoupper($value->{47}); echo '&nbsp;';
        echo '<br>';
        echo '20: '; echo strtoupper($value->{46}); echo '&nbsp;';
        echo '<br>';
        echo '21: '; echo strtoupper($value->{55}); echo '&nbsp;';
        echo '<br>';
        echo '22: '; echo strtoupper($value->{54}); echo '&nbsp;';
        echo '<hr>';
        echo '</br>';
    }
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------


echo '</pre>';
// 


