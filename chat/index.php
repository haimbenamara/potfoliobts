<?php
session_start();

// Générer un pseudo aléatoire si l'utilisateur n'en a pas déjà un
if (!isset($_SESSION['pseudo'])) {
    $_SESSION['pseudo'] = 'Utilisateur_' . rand(1000, 9999);
}

// Enregistrement du pseudo personnalisé s'il est fourni
if (isset($_POST['pseudo']) && !empty(trim($_POST['pseudo']))) {
    $_SESSION['pseudo'] = htmlspecialchars(trim($_POST['pseudo']));
}

// Stockage des messages dans un fichier
function saveMessage($message) {
    $file = 'chat_history.txt';
    $fp = fopen($file, 'a');
    fwrite($fp, $message . PHP_EOL);
    fclose($fp);
}

// Récupération des messages depuis le fichier
function getMessages() {
    $file = 'chat_history.txt';
    if (file_exists($file)) {
        $messages = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return $messages;
    }
    return [];
}

// Effacer le fichier d'historique du chat
function clearChatHistory() {
    $file = 'chat_history.txt';
    if (file_exists($file)) {
        unlink($file);
    }
}

// Si l'utilisateur souhaite effacer l'historique du chat
if (isset($_GET['clear']) && $_GET['clear'] == 'true') {
    clearChatHistory();
    header('Location: index.php');
    exit;
}

// Enregistrement d'un nouveau message
if (isset($_POST['message']) && !empty(trim($_POST['message']))) {
    $message = '[' . date('H:i') . '] ' . $_SESSION['pseudo'] . ': ' . htmlspecialchars(trim($_POST['message']));
    saveMessage($message);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBox - Petit Chat en Ligne</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        #chat-box {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
        #message {
            width: calc(100% - 80px);
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        #send-btn {
            width: 70px;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ChatBox - Petit Chat en Ligne</h1>
        <div id="chat-box">
            <?php
            $messages = getMessages();
            foreach ($messages as $message) {
                echo '<div class="message">' . $message . '</div>';
            }
            ?>
        </div>
        <form id="message-form" method="post">
            <input type="text" name="message" id="message" placeholder="Entrez votre message...">
            <button type="submit" id="send-btn">Envoyer</button>
        </form>
        <form id="pseudo-form" method="post" style="margin-top: 20px;">
            <label for="pseudo">Choisissez un pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" value="<?= $_SESSION['pseudo'] ?>">
            <button type="submit">Enregistrer</button>
        </form>
        <form action="index.php?clear=true" method="post" style="margin-top: 20px;">
            <button type="submit">Effacer l'historique du chat</button>
        </form>
    </div>
    <script>
        // Actualiser les messages toutes les 3 secondes
        setInterval(function() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById('chat-box').innerHTML = xhr.responseText;
                    }
                }
            };
            xhr.open('GET', 'get_messages.php', true);
            xhr.send();
        }, 3000); // 3 secondes
    </script>
</body>
</html>
