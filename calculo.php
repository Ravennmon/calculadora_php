<?php

session_start();

if(isset($_POST['calculo'])){
    $calculadora = (object) [
        'numero1' => $_POST['numero1'],
        'numero2' => $_POST['numero2'],
        'operador' => $_POST['operador']
    ];

    $validacao = validarDados($calculadora);
    
    if($validacao !== true){
        resultado($validacao, true);
    }
    
    $resultado = calcular($calculadora->numero1, $calculadora->numero2, $calculadora->operador);
    
    resultado(number_format($resultado, 2), false);
}


function validarDados($calculadora) {
    if(!isset($calculadora->numero1) || !is_numeric($calculadora->numero1)){
        return 'O primeiro número é obrigatório';
    }

    if(!isset($calculadora->numero2) || !is_numeric($calculadora->numero2)){
        return 'O segundo número é obrigatório';
    }

    if(!isset($calculadora->operador) || !in_array($calculadora->operador, ['soma', 'subtracao', 'multiplicacao', 'divisao', 'potenciacao', 'fatorial', 'radiciacao'])){
        return 'Operador inválido';
    }

    if($calculadora->operador == 'divisao' && $calculadora->numero2 == 0){
        return 'Não é possível dividir por zero';
    }

    return true;
}

function calcular($numero1, $numero2, $operador) {
    $numero1 = (float) $numero1;
    $numero2 = (float) $numero2;

    switch ($operador) {
        case 'soma':
            return $numero1 + $numero2;
        case 'subtracao':
            return $numero1 - $numero2;
        case 'multiplicacao':
            return $numero1 * $numero2;
        case 'divisao':
            return $numero1 / $numero2;
        case 'potenciacao':
            return pow($numero1, $numero2);
        case 'fatorial':
            return fatorial($numero1 + $numero2);
        case 'radiciacao':
            return sqrt($numero1 + $numero2);
        default:
            resultado('Operador inválido!', true);
    }
}

function fatorial($num) {
    $resultado = 1;
    for ($i = $num; $i > 0; $i--) {
        $resultado *= $i;
    }
    return $resultado;
}

function resultado($resultado, $erro) {
    $_SESSION['resultado'] = $resultado;
    $_SESSION['erro'] = $erro;
    header('Location: index.php');
    exit();
}
