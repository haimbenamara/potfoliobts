<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertisseur de Devises</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            margin-bottom: 20px;
        }
        input[type="number"] {
            width: 200px;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        #result {
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Convertisseur de Devises</h1>
        <input type="number" id="amount" placeholder="Montant à convertir">
        <select id="fromCurrency">
            <option value="USD">Dollar américain (USD)</option>
            <option value="EUR">Euro (EUR)</option>
            <option value="GBP">Livre sterling (GBP)</option>
            <option value="JPY">Yen japonais (JPY)</option>
            <option value="CAD">Dollar canadien (CAD)</option>
            <option value="CHF">Franc suisse (CHF)</option>
            <option value="AUD">Dollar australien (AUD)</option>
            <option value="CNY">Yuan chinois (CNY)</option>
            <option value="INR">Roupie indienne (INR)</option>
            <option value="SEK">Couronne suédoise (SEK)</option>
            <option value="NZD">Dollar néo-zélandais (NZD)</option>
            <option value="RUB">Rouble russe (RUB)</option>
        </select>
        <span>en</span>
        <select id="toCurrency">
            <option value="USD">Dollar américain (USD)</option>
            <option value="EUR">Euro (EUR)</option>
            <option value="GBP">Livre sterling (GBP)</option>
            <option value="JPY">Yen japonais (JPY)</option>
            <option value="CAD">Dollar canadien (CAD)</option>
            <option value="CHF">Franc suisse (CHF)</option>
            <option value="AUD">Dollar australien (AUD)</option>
            <option value="CNY">Yuan chinois (CNY)</option>
            <option value="INR">Roupie indienne (INR)</option>
            <option value="SEK">Couronne suédoise (SEK)</option>
            <option value="NZD">Dollar néo-zélandais (NZD)</option>
            <option value="RUB">Rouble russe (RUB)</option>
        </select>
        <button onclick="convertCurrency()">Convertir</button>
        <div id="result"></div>
    </div>

    <script>
        function convertCurrency() {
            const amount = document.getElementById('amount').value;
            const fromCurrency = document.getElementById('fromCurrency').value;
            const toCurrency = document.getElementById('toCurrency').value;

            // Appel à une API de conversion de devises (API à remplacer par votre propre API ou un service tiers)
            const apiUrl = `https://api.exchangerate-api.com/v4/latest/${fromCurrency}`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const rate = data.rates[toCurrency];
                    const convertedAmount = amount * rate;
                    document.getElementById('result').innerHTML = `${amount} ${fromCurrency} équivaut à ${convertedAmount.toFixed(2)} ${toCurrency}`;
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des taux de change :', error);
                    document.getElementById('result').innerHTML = 'Erreur lors de la récupération des taux de change. Veuillez réessayer plus tard.';
                });
        }
    </script>
</body>
</html>
