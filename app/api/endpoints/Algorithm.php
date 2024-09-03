<?php
require_once("../endpoints/Perceptron/PerceptronAlgorithm.php");
// except for the w0
$PesosIniciais = [0,0,0, 0,0,0, 0,0,0];

$padroesDeTreinamento = [
                       //yd
    [1,1,1, 0,1,0, 0,1,0,  1], 
    [1,0,1, 1,1,1, 1,0,1,  0]
];

//$pesos = treinarPerceptro($testes, $PesosIniciais, taxaDeAprendizagem);
$neuronio = new Perceptro(padroes: $padroesDeTreinamento, Pesos: $PesosIniciais);
$neuronio->treinarPerceptro();
$neuronio->exibirPesos();

#$neuronio->pesosAleatorios(taman: 3);

$casosDeTeste = [
    //Sem YD, queremos ver qual saida o Perceptro nos dará
    [1,1,1, 1,1,1, 0,1,0],
    [1,0,0, 1,1,1, 1,0,1],
];


//Casos de teste

# $neuronio->testarPerceptro($casosDeTeste);