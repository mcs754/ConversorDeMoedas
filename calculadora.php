<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moedas</title>
    <style type="text/css">
        body {
            font-family: 'Segoe UI', sans-serif;
            font-style: normal;
            font-variant: normal;
            font-size: 16px;
            font-weight: 600;
            color: #bfbfff;
            background-color: #111173;
            text-align: center;
            margin-top: 10%;
        }

        select {
            font-family: 'Segoe UI', sans-serif;
            font-style: normal;
            font-variant: normal;
            font-size: 16px;
            font-weight: 600;
            color: #bfbfff;
            background-color: #111173;
            margin-right: 5px;
            padding: 0px;
            width: 150px;
            height: 30px;
            box-shadow: 0 0 0 0;
            border: 1px solid #bfbfff;
            outline: 0;
        }

        option {
            font-weight: 600;
            color: #bfbfff;
            background-color: #111173;
            box-shadow: 0 0 0 0;
            outline: 0;
        }

        option:hover {
            font-weight: 600;
            color: #bfbfff;
            box-shadow: 0 0 0 0;
            border: 0 none;
            outline: 0;
        }

        input {
            font-family: 'Segoe UI', sans-serif;
            font-style: normal;
            font-variant: normal;
            font-size: 16px;
            font-weight: 600;
            text-align: right;
            color: #bfbfff;
            background-color: #111173;
            margin-right: 5px;
            padding: 0px;
            width: 150px;
            height: 28px;
            box-shadow: 0 0 0 0;
            border: 1px solid #bfbfff;
            outline: 0;
        }

        input::placeholder {
            color: #bfbfff;
        }

        #botao {
            font-family: 'Segoe UI', sans-serif;
            font-style: normal;
            font-variant: normal;
            font-size: 16px;
            font-weight: 600;
            color: #bfbfff;
            background-color: #111173;
            width: 30px;
            height: 30px;
            border: 1px solid #bfbfff;
        }
    </style>
</head>

<body>
    <?php
    //criando array com os valores numéricos das moedas e inserindo os valores numa list de variáveis
    $a = array(5.2587986, 6.417299, 7.4600978, 1, 0.04824, 0.8185);
    list($dlr, $eur, $lbr, $brl, $ine, $ren) = $a;
    //transformando os valores numéricos em números com quatro casas decimais após o ponto, mas preservando variável original para operações matemáticas
    $dlr2 = number_format($dlr, 4, '.', '');
    $eur2 = number_format($eur, 4, '.', '');
    $lbr2 = number_format($lbr, 4, '.', '');
    $brl2 = number_format($brl, 4, '.', '');
    $ine2 = number_format($ine, 4, '.', '');
    $ren2 = number_format($ren, 4, '.', '');
    //sobrepondo vírgula no lugar de ponto
    $dolar = str_replace('.', ',', $dlr2);
    $euro = str_replace('.', ',', $eur2);
    $libra = str_replace('.', ',', $lbr2);
    $real = str_replace('.', ',', $brl2);
    $iene = str_replace('.', ',', $ine2);
    $renminbi = str_replace('.', ',', $ren2);
    //iniciando cabeçalho básico da calculadora de câmbio apresentando informações úteis
    ?>
    <h1>Casa de câmbio Muito Dinheiro</h1>
    <h2>Cotação das principais moedas do mundo hoje</h2>
    <h3>Dólar Americano (USD) R$ <?php echo $dolar ?> • Euro (EUR) R$ <?php echo $euro ?> • Iene (JPY) R$ <?php echo $iene ?> • Libra Esterlina (GBP) R$ <?php echo $libra ?> • Renminbi (CNY) R$ <?php echo $renminbi ?></h3>
    <?php //implementando formulário para o usuário informar os parâmetros para o câmbio
    ?>
    <form action="calculadora.php" method="post">
        <label>Moeda de origem</label>
        <select name="origem" required>
            <option value=<?php echo $dlr ?>>Dólar (USD)</option>
            <option value=<?php echo $eur ?>>Euro (EUR)</option>
            <option value=<?php echo $ine ?>>Iene (JPY)</option>
            <option value=<?php echo $lbr ?>>Libra (GBP)</option>
            <option selected value=<?php echo $brl ?>>Real (BRL)</option>
            <option value=<?php echo $ren ?>>Renminbi (CNY)</option>
        </select>
        <label>Moeda de destino</label>
        <select name="destino" required>
            <option selected value=<?php echo $dlr ?>>Dólar (USD)</option>
            <option value=<?php echo $eur ?>>Euro (EUR)</option>
            <option value=<?php echo $ine ?>>Iene (JPY)</option>
            <option value=<?php echo $lbr ?>>Libra (GBP)</option>
            <option value=<?php echo $brl ?>>Real (BRL)</option>
            <option value=<?php echo $ren ?>>Renminbi (CNY)</option>
        </select>
        <label>Valor:</label>
        <input name="valor" type="number" placeholder="0,0000" step="any" required>
        <button id="botao" type="submit">=<i class="fas fa-exchange-alt"></i></button>
        <?php
        //capturando as informações do formulário que foi preenchido pelo usuário
        if ($_POST) {
            $origem = $_POST['origem'];
            $destino = $_POST['destino'];
            $valor = $_POST['valor'];
            //realizando as operações baseadas nos requisitos
            $convert = $valor * $origem; //convertendo a moeda de origem em real
            $calc = $convert / $destino; //convertendo o resultado da conversão anterior em moeda de destino
            $desc = (10 / 100) * $calc; //aplicando o desconto de 10%
            $saldo = $calc - $desc; //mensurando resultado final
            //tranformando o resultado em números com quatro casas decimais e sobrepondo a vírgula
            $valor = number_format($valor, 4, '.', '');
            $valor = str_replace('.', ',', $valor);
            $calc = number_format($calc, 4, '.', '');
            $calc = str_replace('.', ',', $calc);
            $desc = number_format($desc, 4, '.', '');
            $desc = str_replace('.', ',', $desc);
            $saldo = number_format($saldo, 4, '.', '');
            $saldo = str_replace('.', ',', $saldo);
            //capturando informação da moeda para identificá-la e apresentá-la ao usuário. Foi utilizado switch case para evitar processamento desnecessário de informações
            $cifra_origem = ' ';
            switch ($cifra_origem) {
                case $origem == $dlr;
                    $cifra_origem = 'USD';
                    break;
                case $origem == $eur;
                    $cifra_origem = 'EUR';
                    break;
                case $origem == $ine;
                    $cifra_origem = 'JPY';
                    break;
                case $origem == $lbr;
                    $cifra_origem = 'GBP';
                    break;
                case $origem == $brl;
                    $cifra_origem = 'BRL';
                    break;
                case $origem == $ren;
                    $cifra_origem = 'CNY';
                    break;
            }
            $cifra_destino = ' ';
            switch ($cifra_destino) {
                case $destino == $dlr;
                    $cifra_destino = 'USD';
                    break;
                case $destino == $eur;
                    $cifra_destino = 'EUR';
                    break;
                case $destino == $ine;
                    $cifra_destino = 'JPY';
                    break;
                case $destino == $lbr;
                    $ccifra_destino = 'GBP';
                    break;
                case $destino == $brl;
                    $cifra_destino = 'BRL';
                    break;
                case $destino == $ren;
                    $cifra_destino = 'CNY';
                    break;
            }
            //apresentando os resultados das operações em tela
            echo ('<p>Conversão de ' . $cifra_origem . ' ' . $valor . ' para ' . $cifra_destino . ' ' . $calc . '</p>');
            echo ('<p>Desconto de ' . $cifra_destino . ' ' . $desc . ' equivalente a 10% de taxa de serviço</p>');
            echo ('<h3>Saldo do cliente: ' . $cifra_destino . ' ' . $saldo . '</h3>');
        }
        ?>
    </form>
</body>

</html>
