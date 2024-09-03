<?php

class Perceptro{
    const x0 = 1;

    public function __construct(
      private array $padroes = [],
      private array $Pesos = [],
      private int $taxaDeAprendizagem = 1,
      private int $limiar = 0,
    ){}
    
    public function treinarPerceptro(
        array $padroes = [], 
        int $taxaDeAprendizagem = 0,
        array $Pesos = [],
    ): void {
        if ($padroes) {
            $this->setPadroes($padroes);
        }

        if ($Pesos) {
            $this->setPesos($Pesos);
        }

        if ($taxaDeAprendizagem) {
            $this->taxaDeAprendizagem = $taxaDeAprendizagem;
        }

        if(!$this->verificacao()) return;

        $contCiclos = 0;
        $posDeNovosPesos = -1;

        while (1) {
            $verificado = true;
            $padrao = 1;
            print("\n                   	Ciclo: " . ++$contCiclos . "\n");

            foreach ($this->padroes as $index => &$teste) {
                print("Padrão " . $padrao++ . ": ");
                $somatorio = 0;
                $yd = $teste[sizeof($teste) - 1];
    
                for ($i = 0; $i < sizeof($teste) - 1; $i++) {
                    $somatorio += $teste[$i] * $this->Pesos[$i];
                    print($teste[$i] . ' x (' . $this->Pesos[$i] . ')');
                    if ($i != sizeof($teste) - 2) {
                        print(" + ");
                    }
                }
    
                // Evita erros de arredondamento
                $somatorio = round($somatorio, 10);
                
                print" = ";
                print(($somatorio >= 0) ? " " : "");
                print(number_format($somatorio, 1, '.', '') . " ==> " . number_format($yd, 1, '.', '') . " ? ");
                $somatorio = ($somatorio >= 0) ? 1 : 0;
                print(($somatorio == $yd) ? "Sim\n" : "Não\n\n");

                if ($yd != $somatorio) {
                    $posDeNovosPesos = $index;
                    for ($i = 0; $i < sizeof($this->Pesos); $i++) {
                        print("   	W$i = ");
                        print(($this->Pesos[$i] >= 0) ? " " : "");
                        print(number_format($this->Pesos[$i], 1, '.', '') . " + $taxaDeAprendizagem x " . $teste[$i] . " x (" . $yd . ' - ' . $somatorio . ") = ");
                        $this->Pesos[$i] += $this->taxaDeAprendizagem * $teste[$i] * ($yd - $somatorio);
                        print(($this->Pesos[$i] >= 0) ? " " : "");
                        print(number_format($this->Pesos[$i], 1, '.', '') . "\n");
                    }
                    $verificado = false;
                    print("\n   	W(novo) = [  ");
                    foreach ($this->Pesos as $peso) {
                        print($peso . "  ");
                    }
                    print"]\n\n";
                } 
                else if($posDeNovosPesos === $index) break;
            }

            if ($verificado == true) {
                break;
            }
        }

        print("======================================TREINAMENTO FINALIZADO======================================");
    }

    public function testarPerceptro(
        array $casosDeTeste,
    ){
        
        print"\n\n\n                     TESTANDO O PERCEPTRO TREINADO                      \n";
        foreach($casosDeTeste as $index => &$teste){
            $somatorio = 0;
            print("Teste ".$index+ 1 . ": \n    ");
            for ($i = 0; $i < sizeof($teste) - 1; $i++) {
                $somatorio += $teste[$i] * $this->Pesos[$i];
                print($teste[$i] . ' x (' . $this->Pesos[$i] . ')');
                if ($i != sizeof($teste) - 2) {
                    print(" + ");
                }
            }
            print" = ";
            print(($somatorio >= 0) ? "1" : "0");
            print"\n";
        }
    }

    public function verificacao(): bool
    {
        if(sizeof($this->Pesos) === 0){
            print"\nERRO! Os Pesos não estão adequadamente distribuidos\n";
            return false;
        }

        if(sizeof($this->padroes) === 0){
            print"\nSem padrões para treinamento\n";
            return false;
        }

        if(sizeof($this->Pesos) !== sizeof($this->padroes[0])-1){
            print"\nErro! Quantidades desiguais de pesos e padroes de treinamento\n";
            return false;
        }

        return true;
    }

    // Para Padrões de Treinamento

    private function setX0(): void
    {
        foreach ($this->padroes as &$padrao) {
            //x0
            array_unshift($padrao, self::x0);
        }
    }

    public function getPadroes(): array
    {
        return $this->padroes;
    }

    public function setPadroes(array $padroes):void
    {
        $this->padroes = $padroes;
        $this->setX0();
    }

    // Para Pesos
    private function setW0():void
    {
        //w0
	    array_unshift($this->Pesos, $this->limiar);
    }

    public function setPesos(array $Pesos):void
    {
        $this->Pesos = $Pesos;
        $this->setW0();
    }

    public function getPesos(): array
    {
        return $this->Pesos;
    }

    public function exibirPesos(): void
    {
        if(!$this->verificacao()) return;
        //print(str_repeat("=", 25));
        print("\n\nPesos finais: ");
        print("\n   	W(final) = [  ");
        foreach ($this->Pesos as $peso)
            print($peso . "  ");
        print("]\n\n");
        print(str_repeat("=", 98));
    }
}


// except for the w0
$PesosIniciais = [0, 0, 0, 0, 0, 0, 0, 0, 0];

$padroesDeTreinamento = [
                       //yd
    [1,1,1,0,1,0,0,1,0,  1], 
    [1,0,1,1,1,1,1,0,1,  0]
];

//$pesos = treinarPerceptro($testes, $PesosIniciais, taxaDeAprendizagem);
$neuronio = new Perceptro(padroes: $padroesDeTreinamento, Pesos: $PesosIniciais);
$neuronio->treinarPerceptro();
$neuronio->exibirPesos();

$casosDeTeste = [
    //Sem YD, queremos ver qual saida o Perceptro nos dará
    [1,1,1, 1,1,1, 0,1,0],
    [1,0,0, 1,1,1, 1,0,1],
];


//Casos de teste

$neuronio->testarPerceptro($casosDeTeste);