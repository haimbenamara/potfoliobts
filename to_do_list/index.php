<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma To-Do List</title>
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
            width: 80%;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .task-list {
            list-style-type: none;
            padding: 0;
        }

        .task-item {
            margin-bottom: 10px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .task-item input[type="checkbox"] {
            margin-bottom: 5px;
        }

        .task-item label {
            cursor: pointer;
            margin-bottom: 5px;
        }

        .task-item button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .task-item button:hover {
            background-color: #45a049;
        }

        .add-task input[type="text"], .add-task input[type="datetime-local"], .add-task textarea, .add-task input[type="number"] {
            flex: 1;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        .add-task button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-task button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ma To-Do List</h1>
        <ul class="task-list" id="taskList">
            <!-- Les tâches seront ajoutées ici dynamiquement -->
        </ul>
        <div class="add-task">
            <input type="text" id="taskInput" placeholder="Nom de la tâche...">
            <input type="datetime-local" id="taskDateTime">
            <textarea id="taskDescription" placeholder="Description de la tâche..." rows="4"></textarea>
            <input type="number" id="taskDuration" placeholder="Durée (en minutes)">
            <button onclick="addTask()">Ajouter</button>
        </div>
    </div>

    <script>
        function addTask() {
            var taskInput = document.getElementById("taskInput");
            var taskDateTime = document.getElementById("taskDateTime");
            var taskDescription = document.getElementById("taskDescription");
            var taskDuration = document.getElementById("taskDuration");
            var taskText = taskInput.value.trim();
            var taskDate = taskDateTime.value;
            var taskDesc = taskDescription.value.trim();
            var taskDur = parseInt(taskDuration.value);

            if (taskText !== "") {
                var taskList = document.getElementById("taskList");

                var listItem = document.createElement("li");
                listItem.className = "task-item";

                var checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.addEventListener("change", function() {
                    if (this.checked) {
                        this.nextSibling.style.textDecoration = "line-through";
                    } else {
                        this.nextSibling.style.textDecoration = "none";
                    }
                });

                var label = document.createElement("label");
                label.textContent = taskText + " (Date: " + taskDate + ", Durée: " + taskDur + " minutes, Description: " + taskDesc + ")";

                var editButton = document.createElement("button");
                editButton.textContent = "Modifier";
                editButton.style.marginRight = "5px";
                editButton.addEventListener("click", function() {
                    var newText = prompt("Modifier la tâche :", label.textContent.split(" (Date")[0]);
                    var newDate = prompt("Nouvelle date et heure de la tâche :", taskDate);
                    var newDesc = prompt("Nouvelle description de la tâche :", taskDesc);
                    var newDur = prompt("Nouvelle durée de la tâche (en minutes) :", taskDur);

                    if (newText !== null && newDate !== null && newDesc !== null && newDur !== null) {
                        taskText = newText.trim();
                        taskDate = newDate;
                        taskDesc = newDesc.trim();
                        taskDur = parseInt(newDur);
                        label.textContent = taskText + " (Date: " + taskDate + ", Durée: " + taskDur + " minutes, Description: " + taskDesc + ")";
                    }
                });

                var deleteButton = document.createElement("button");
                deleteButton.textContent = "Supprimer";
                deleteButton.style.marginLeft = "5px";
                deleteButton.addEventListener("click", function() {
                    listItem.remove();
                });

                listItem.appendChild(checkbox);
                listItem.appendChild(label);
                listItem.appendChild(editButton);
                listItem.appendChild(deleteButton);
                taskList.appendChild(listItem);

                taskInput.value = "";
                taskDateTime.value = "";
                taskDescription.value = "";
                taskDuration.value = "";
            } else {
                alert("Veuillez saisir une tâche !");
            }
        }
    </script>
</body>
</html>
