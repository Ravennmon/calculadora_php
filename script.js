document.addEventListener("DOMContentLoaded", (event) => {
    const num1 = document.getElementById("numero1");
    const num2 = document.getElementById("numero2");
    const caculo = document.getElementById("calculo");

    num1.addEventListener("keyup", apenasNumeros);
    num2.addEventListener("keyup", apenasNumeros);
    caculo.addEventListener("click", calcular)

    document.body.addEventListener("click", (event) => {
        if (event.target.classList.contains("operacao")) {
            const operacao = event.target.getAttribute("data-operacao");
            const operador = document.getElementById("operador");
            operador.value = operacao;
            classeAtiva(event.target)
            exibir()
        }
    });
});

function apenasNumeros(event) {
    event.target.value = event.target.value.replace(/[^0-9-]/g, '');
    exibir()
}

function calcular() {
    const form = document.getElementById("form");
    form.submit()
}

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

    if(!operador && num1){
        resultado(num1)
    } else if(operador === "radiciacao" ) {
        resultado(`${operacoes[operador]} (${num1} + ${num2})`);
    } else if(operador === "fatorial" ) {
        resultado(`(${num1} + ${num2}) ${operacoes[operador]}`);
    } else {
        resultado(`${num1} ${operacoes[operador]} ${num2}`);
    }
}

function resultado(info){
    const resultado = document.getElementById("resultado");
    resultado.value = info;
}

function classeAtiva(button){
    const botoes = document.querySelectorAll(".operacao");
    botoes.forEach((botao) => botao.classList.remove("ativo"));
    button.classList.add("ativo");

}