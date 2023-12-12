function submit(responseRow, has_project) {
    let word = has_project != null ? "drop" : "choose";
    if (confirm("are you sure you want to " + word + " this project")) {
        fetch(
            '../Controller/studentController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                "drop_add_project": true,
                "project_id": responseRow["project_id"],
                "state": word
            })

        }
        ).then(response => response.json())
            .then(data => {
                if (data["status"] == "failed") {
                    alert("couldn't " + word + " table please refresh\n" + data["msg"]);
                    return;
                }
                console.log(data);

                window.location.reload();


            }).catch(error => alert(error));
    }
}


function showProjects() {
    fetch(
        '../Controller/sharedController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            "showProjects": true
        })

    }
    ).then(response => response.json())
        .then(data => {
            console.log(data["chosen_project"]);
            if (data["status"] == "failed") {
                alert("couldn't load table please refresh\n" + data["msg"]);
                return;
            }
            let table = document.getElementById("projects_table");
            let responseTable = data["table"];
            responseTable.forEach(responseRow => {
                let row = table.insertRow(-1);
                for (const key in responseRow) {
                    let cell = row.insertCell(-1);
                    cell.innerHTML = responseRow[key];
                }
                let cell = row.insertCell(-1);
                let button = document.createElement('button');
                button.className = data["chosen_project"] == responseRow["project_id"] ? 'drop-btn' : 'choose-btn';
                button.textContent = data["chosen_project"] == responseRow["project_id"] ? 'Drop' : 'Choose';
                if ((data["chosen_project"] != null && data["chosen_project"] != responseRow["project_id"]) || (
                    responseRow["remaining_number_of_student"] == 0&&data["chosen_project"] != responseRow["project_id"])) {
                    button.disabled = true;
                    button.style = "background-color:grey";
                }
                button.addEventListener('click', function () {
                    submit(responseRow, data["chosen_project"]);
                });
                cell.appendChild(button);
            })

        }).catch(error => alert(error));
}

import { logout } from './logout.js';

showProjects();
document.getElementById('logoutButton').addEventListener('click', logout);
