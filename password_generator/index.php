<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de Mot de Passe</title>
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

        #container {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
        }

        h1 {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        input[type="number"] {
            width: 50px;
            padding: 5px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        input[type="checkbox"] {
            margin-right: 5px;
            transform: scale(1.5);
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        button:last-child {
            margin-right: 0;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>Générateur de Mot de Passe</h1>
        <label for="length">Longueur du mot de passe (5-128) :</label>
        <input type="number" id="length" min="5" max="128" value="12"><br>

        <label><input type="checkbox" id="uppercase"> Majuscules</label><br>
        <label><input type="checkbox" id="lowercase" checked> Minuscules</label><br>
        <label><input type="checkbox" id="numbers" checked> Chiffres</label><br>
        <label><input type="checkbox" id="specialChars"> Caractères spéciaux: !@#$%^&amp;*</label><br><br>

        <input type="text" id="password" readonly><br><br>
        <button onclick="generatePassword()">Générer</button>
        <button onclick="copyToClipboard()">Copier</button>
    </div>

    <script>
        function generatePassword() {
            const length = document.getElementById("length").value;
            const includeUppercase = document.getElementById("uppercase").checked;
            const includeLowercase = document.getElementById("lowercase").checked;
            const includeNumbers = document.getElementById("numbers").checked;
            const includeSpecialChars = document.getElementById("specialChars").checked;

            let charset = "";
            if (includeUppercase) charset += "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            if (includeLowercase) charset += "abcdefghijklmnopqrstuvwxyz";
            if (includeNumbers) charset += "0123456789";
            if (includeSpecialChars) charset += "!@#$%^&*";

            let password = "";
            for (let i = 0; i < length; ++i) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                password += charset[randomIndex];
            }
            document.getElementById("password").value = password;
        }

        function copyToClipboard() {
            const passwordField = document.getElementById("password");
            passwordField.select();
            document.execCommand("copy");
            alert("Mot de passe copié dans le presse-papiers !");
        }
    </script>

</body>
</html>
