<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Câmbio</title>
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
    //criando array com os valore numéricos e inserindo os valores numa list de variáveis
    $a = array(5.2755, 6.4134, 7.4513, 1, 0.0483, 0.8191);
    list($dlr, $eur, $lbr, $brl, $ine, $ren) = $a;
    //transformando os valores numéricos em números com quatro casas decimais após o ponto, conforme Banco Central do Brasil, mas preservando variável original para operações matemáticas
    $dolar = number_format($dlr, 4, '.', '');
    $euro = number_format($eur, 4, '.', '');
    $libra = number_format($lbr, 4, '.', '');
    $real = number_format($brl, 4, '.', '');
    $iene = number_format($ine, 4, '.', '');
    $renminbi = number_format($ren, 4, '.', '');
    //sobrepondo vírgula no lugar de ponto, mas preservando variável original para operações matemáticas
    $dolar = str_replace('.', ',', $dlr);
    $euro = str_replace('.', ',', $eur);
    $libra = str_replace('.', ',', $lbr);
    $real = str_replace('.', ',', $brl);
    $iene = str_replace('.', ',', $ine);
    $renminbi = str_replace('.', ',', $ren);
    ?>
    <?php //cabeçalho básico da calculadora de câmbio
    ?>
    <h2>Casa de câmbio Muito Dinheiro</h2>
    <h3>Cotação das principais moedas do mundo hoje</h3>
    <h3>Dólar Americano (USD) R$ <?php echo $dolar ?> • Euro (EUR) R$ <?php echo $euro ?> • Iene (JPY) R$ <?php echo $iene ?> • Libra Esterlina (GBP) R$ <?php echo $libra ?> • Renminbi (CNY) R$ <?php echo $renminbi ?></h3>
    <?php //formulário para possibilitar o usuário informar os parâmetros para o câmbio
    ?>
    <div>
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
                //tranformando o resultado em números com duas casas decimais e sobrepondo a vírgula
                $valor = number_format($valor, 4, '.', '');
                $valor = str_replace('.', ',', $valor);
                $calc = number_format($calc, 4, '.', '');
                $calc = str_replace('.', ',', $calc);
                $desc = number_format($desc, 4, '.', '');
                $desc = str_replace('.', ',', $desc);
                $saldo = number_format($saldo, 4, '.', '');
                $saldo = str_replace('.', ',', $saldo);
                //apresentando os resultados das operações em tela
                echo ('<p>Conversão de ' . $valor . ' para ' . $calc . '</p>');
                echo ('<p>Desconto de ' . $desc . ' equivalente a 10% de taxa de serviço</p>');
                echo ('<h3>Saldo do cliente ' . $saldo . '</h3>');
            }
            ?>
        </form>
    </div>
</body>

</html>