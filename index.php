<?php include 'calculo.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calculadora - Francyne Leocadio</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="calculator">
    <form action="calculo.php" id="form" method="POST">
        <input type="text" id="numero1" name="numero1" placeholder="Primeiro número">
        <input type="text" id="numero2" name="numero2" placeholder="Segundo número">
        <input type="text" id="operador" name="operador" hidden>
        <input type="text" name="calculo" hidden>
    </form>
    <input type="text" id="resultado" disabled value="<?php echo $_SESSION['resultado'] ?? '0'?>">
    <div class="btn-group">
        <button class="btn operacao" data-operacao="soma">+</button>
        <button class="btn operacao" data-operacao="subtracao">-</button>
        <button class="btn operacao" data-operacao="multiplicacao">*</button>
        <button class="btn operacao" data-operacao="divisao">/</button>
        <button class="btn operacao" data-operacao="potenciacao">n^x</button>
        <button class="btn operacao" data-operacao="radiciacao">√</button>
        <button class="btn operacao" data-operacao="fatorial">n!</button>
        <button class="btn calculo" id="calculo">=</button>
    </div>
    <p id="result"></p>
</div>

<footer>
        <p>Francyne Aparecida Leocadio Ramos - RGM: 32876131</p>
    </footer>

<script src="script.js"></script>
</body>
</html>
