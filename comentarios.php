<?php

// Inicia a sessão para permitir o uso de variáveis de sessão
session_start();

// Verifica se o formulário foi enviado
if(isset($_POST['calculo'])){
    // Cria um objeto calculadora com os dados do formulário
    $calculadora = (object) [
        'numero1' => $_POST['numero1'],
        'numero2' => $_POST['numero2'],
        'operador' => $_POST['operador']
    ];

    // Valida os dados da calculadora
    $validacao = validarDados($calculadora);
    
    // Se houver erro de validação, exibe a mensagem de erro
    if($validacao !== true){
        resultado($validacao, true);
    }
    
    // Realiza o cálculo com base nos dados fornecidos
    $resultado = calcular($calculadora->numero1, $calculadora->numero2, $calculadora->operador);
    
    // Exibe o resultado formatado
    resultado(number_format($resultado, 2), false);
}

// Função para validar os dados da calculadora
function validarDados($calculadora) {
    // Verifica se os números foram fornecidos e se são numéricos
    if(!isset($calculadora->numero1) || !is_numeric($calculadora->numero1)){
        return 'O primeiro número é obrigatório';
    }

    if(!isset($calculadora->numero2) || !is_numeric($calculadora->numero2)){
        return 'O segundo número é obrigatório';
    }

    // Verifica se o operador é válido
    if(!isset($calculadora->operador) || !in_array($calculadora->operador, ['soma', 'subtracao', 'multiplicacao', 'divisao', 'potenciacao', 'fatorial', 'radiciacao'])){
        return 'Operador inválido';
    }

    // Verifica se a divisão por zero é evitada
    if($calculadora->operador == 'divisao' && $calculadora->numero2 == 0){
        return 'Não é possível dividir por zero';
    }

    // Retorna verdadeiro se os dados forem válidos
    return true;
}

// Função para realizar o cálculo com base nos números e operador fornecidos
function calcular($numero1, $numero2, $operador) {
    // Converte os números para ponto flutuante
    $numero1 = (float) $numero1;
    $numero2 = (float) $numero2;

    // Realiza a operação matemática com base no operador fornecido
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
            return fatorial($numero1 + $numero2); // Soma dos números para calcular o fatorial
        case 'radiciacao':
            return sqrt($numero1 + $numero2); // Soma dos números para calcular a raiz quadrada
        default:
            resultado('Operador inválido!', true);
    }
}

// Função para calcular o fatorial de um número
function fatorial($num) {
    $resultado = 1;
    for ($i = $num; $i > 0; $i--) {
        $resultado *= $i;
    }
    return $resultado;
}

// Função para exibir o resultado e redirecionar para a página inicial
function resultado($resultado, $erro) {
    // Armazena o resultado e o status de erro na sessão
    $_SESSION['resultado'] = $resultado;
    $_SESSION['erro'] = $erro;
    // Redireciona de volta para a página inicial
    header('Location: index.php');
    exit();
}
