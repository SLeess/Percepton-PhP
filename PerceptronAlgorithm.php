<?php

function treinarPerceptro($arraysDeTreino, $Pesos, $taxaDeAprendizagem)
{
    foreach ($arraysDeTreino as &$teste) {
        //x0
        array_unshift($teste, x0);
    }
    //w0
    array_unshift($Pesos, -limiar);

    $contCiclos = 0;

    while (1) {
        $verificado = TRUE;
        $padrao = 1;
        print("\n                       Ciclo: " . ++$contCiclos . "\n");
        foreach ($arraysDeTreino as &$teste) {
            print("Padrão " . $padrao++ . ": ");
            $somatorio = 0;
            $yd = $teste[sizeof($teste) - 1];

            for ($i = 0; $i < sizeof($teste) - 1; $i++) {
                $somatorio += $teste[$i] * $Pesos[$i];
                print($teste[$i] . ' x (' . $Pesos[$i] . ')');
                if ($i != sizeof($teste) - 2) {
                    print(" + ");
                }
            }

            //Evita erros de arredondamento
            $somatorio = round($somatorio, 10);

            print(" = ");
            print(($somatorio >= 0) ? " " : "");
            print(number_format($somatorio, 1, '.', '') . " ==> " . number_format($yd, 1, '.', '') . " ? ");
            $somatorio = ($somatorio >= 0) ? 1 : 0;
            print(($somatorio == $yd) ? "Sim\n" : "Não\n\n");
            if ($yd != $somatorio) {
                for ($i = 0; $i < sizeof($Pesos); $i++) {
                    print("       W$i = ");
                    print(($Pesos[$i] >= 0) ? " " : "");
                    print(number_format($Pesos[$i], 1, '.', '') . " + $taxaDeAprendizagem x " . $teste[$i] . " x (" . $yd . ' - ' . $somatorio . ") = ");
                    $Pesos[$i] = $Pesos[$i] + $taxaDeAprendizagem * $teste[$i] * ($yd - $somatorio);
                    print(($Pesos[$i] >= 0) ? " " : "");
                    print(number_format($Pesos[$i], 1, '.', '') . "\n");
                }
                $verificado = FALSE;
                print("\n       W(novo) = [  ");
                foreach ($Pesos as $peso)
                    print($peso . "  ");
                print("]\n\n");
            }
        }
        if ($verificado == TRUE) break;
    }

    print("\n\nPesos finais: ");
    print("\n       W(final) = [  ");
    foreach ($Pesos as $peso)
        print($peso . "  ");
    print("]\n\n");
}

const limiar = 0.5;
const x0 = 1;
const taxaDeAprendizagem = 0.1;
//w1, w2
$PesosIniciais = array(0, 0);
//x0 x1 x2 yd
$testes = array(array(0, 0, 0), array(0, 1, 1), array(1, 0, 1), array(1, 1, 1));

treinarPerceptro($testes, $PesosIniciais, taxaDeAprendizagem);
