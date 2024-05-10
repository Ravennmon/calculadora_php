// Epera o DOM carregar para executar o código
document.addEventListener("DOMContentLoaded", (event) => {

    // Captura os elementos do DOM necessários para o calculo
    const num1 = document.getElementById("numero1");
    const num2 = document.getElementById("numero2");
    const caculo = document.getElementById("calculo");

    // Adiciona listeners de eventos aos elementos
    num1.addEventListener("keyup", apenasNumeros);
    num2.addEventListener("keyup", apenasNumeros);
    caculo.addEventListener("click", calcular);

    // Adiciona listener de evento para os botões de operação
    document.body.addEventListener("click", (event) => {

        // Verifica se o clique foi em um botão de operação
        if (event.target.classList.contains("operacao")) {

            // Obtém a operação associada ao botão
            const operacao = event.target.getAttribute("data-operacao");
            const operador = document.getElementById("operador");

            // Define o valor do operador no campo hidden
            operador.value = operacao;

            // Ativa a classe no botão clicado
            
            classeAtiva(event.target);
            // Exibe a expressão matemática correspondente
            exibir();
        }
    });
});

// Função para garantir que apenas números sejam digitados nos campos de entrada
function apenasNumeros(event) {
    event.target.value = event.target.value.replace(/[^0-9-]/g, '');
    // Atualiza a expressão matemática exibida
    exibir();
}

// Função para enviar o formulário quando o botão de cálculo é clicado
function calcular() {
    const form = document.getElementById("form");
    form.submit();
}

// Função para exibir a expressão matemática correspondente aos valores fornecidos
function exibir() {
    const operacoes = {
        "soma": "+",
        "subtracao": "-",
        "multiplicacao": "*",
        "divisao": "/",
        "potenciacao": "^",
        "radiciacao": "√",
        "fatorial": "!"
    }
    const num1 = document.getElementById("numero1").value;
    const num2 = document.getElementById("numero2").value;
    const operador = document.getElementById("operador").value;

    // Constrói a expressão matemática com base nos valores e operador selecionados
    if(!operador && num1){
        resultado(num1);
    } else if(operador === "radiciacao" ) {
        resultado(`${operacoes[operador]} (${num1} + ${num2})`);
    } else if(operador === "fatorial" ) {
        resultado(`(${num1} + ${num2}) ${operacoes[operador]}`);
    } else {
        resultado(`${num1} ${operacoes[operador]} ${num2}`);
    }
}

// Função para exibir o resultado na interface do usuário
function resultado(info){
    const resultado = document.getElementById("resultado");
    resultado.value = info;
}

// Função para adicionar a classe "ativo" ao botão clicado e remover de outros botões
function classeAtiva(button){
    const botoes = document.querySelectorAll(".operacao");
    botoes.forEach((botao) => botao.classList.remove("ativo"));
    button.classList.add("ativo");
}
