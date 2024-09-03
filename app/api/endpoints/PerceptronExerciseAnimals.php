<?php
require_once("../endpoints/Perceptron/PerceptronAlgorithm.php");
// except for the w0
$Pesos = [0, 0, 0];

$padroesDeTreinamento = [
// except for the x0                                          //yd
                 //glandula    Ovoviviparo     terrestre    mamifero
/*     Galinha*/ [    0,           0,             1,            0    ],
/*    Elefante*/ [    1,           0,             1,            1    ],
/*       Peixe*/ [    0,           0,             0,            0    ],
/*Ornitorrinco*/ [    1,           1,             0,            1    ],
/*   Escorpião*/ [    0,           1,             1,            0    ],
/*      Baleia*/ [    1,           0,             0,            1    ]
];

$casosDeTeste = [
                 //glandula    Ovoviviparo     terrestre
/*    Esquidna*/ [    1,           1,             1    ],
/*    Anaconda*/ [    0,           1,             0    ]
];

//$pesos = treinarPerceptro($testes, $PesosIniciais, taxaDeAprendizagem);
$neuronio = new Perceptro(padroes: $padroesDeTreinamento, Pesos: $PesosIniciais, limiar: 1, taxaDeAprendizagem: 0.6);
$neuronio->pesosAleatorios();
$neuronio->treinarPerceptro();
$neuronio->exibirPesos();

//Casos de teste
$neuronio->testarPerceptro($casosDeTeste);