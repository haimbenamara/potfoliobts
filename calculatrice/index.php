<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculatrice Futuriste</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial Black', sans-serif;
            background-color: #272727;
        }

        .calculator {
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            background-color: #333333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #display {
            width: calc(100% - 40px);
            margin-bottom: 20px;
            padding: 10px;
            font-size: 28px;
            border: none;
            background-color: #444444;
            color: #ffffff;
            text-align: right;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        button {
            padding: 15px;
            font-size: 20px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #666666;
            color: #ffffff;
        }

        .operator {
            background-color: #ff6600;
        }

        .number {
            background-color: #0099cc;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h1 style="text-align: center; color: #ff6600;">Calculatrice Futuriste</h1>
        <input type="text" id="display" readonly>
        <div class="buttons">
            <button class="number" onclick="addToDisplay('7')">7</button>
            <button class="number" onclick="addToDisplay('8')">8</button>
            <button class="number" onclick="addToDisplay('9')">9</button>
            <button class="operator" onclick="addToDisplay('+')">+</button>
            <button class="number" onclick="addToDisplay('4')">4</button>
            <button class="number" onclick="addToDisplay('5')">5</button>
            <button class="number" onclick="addToDisplay('6')">6</button>
            <button class="operator" onclick="addToDisplay('-')">-</button>
            <button class="number" onclick="addToDisplay('1')">1</button>
            <button class="number" onclick="addToDisplay('2')">2</button>
            <button class="number" onclick="addToDisplay('3')">3</button>
            <button class="operator" onclick="addToDisplay('*')">*</button>
            <button class="number" onclick="addToDisplay('0')">0</button>
            <button class="number" onclick="addToDisplay('.')">.</button>
            <button class="number" onclick="clearDisplay()">C</button>
            <button class="operator" onclick="addToDisplay('/')">/</button>
            <button class="operator" onclick="calculate()">=</button>
        </div>
    </div>
    <script>
        function addToDisplay(value) {
            document.getElementById('display').value += value;
        }

        function clearDisplay() {
            document.getElementById('display').value = '';
        }

        function calculate() {
            let expression = document.getElementById('display').value;
            try {
                let result = eval(expression);
                document.getElementById('display').value = result;
            } catch (error) {
                document.getElementById('display').value = 'Error';
            }
        }
    </script>
</body>
</html>
