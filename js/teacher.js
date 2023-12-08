import { logout } from './logout.js';

function toggleProjectList() {
    var projectList = document.getElementById('existing_projects');
    var toggleLabel = document.getElementById('toggle_label');
    var isChecked = document.getElementById('toggle_project_action').checked;

    if (isChecked) {
        projectList.disabled = false;
        toggleLabel.textContent = 'Modify Existing Project';
    } else {
        projectList.disabled = true;
        toggleLabel.textContent = 'Add New Project';
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
            if (data["status"] == "failed") {
                alert("couldn't load table please refresh\n" + data["msg"]);
                return;
            }
            let table = document.getElementById("projects_table");
            let responseTable = data["table"];
            responseTable.forEach(responseRow => {
                let row = table.insertRow(-1);
                let idx = 0;
                for (const key in responseRow) {
                    let cell = row.insertCell(idx);
                    idx++;
                    cell.innerHTML = responseRow[key];
                }
            })

        }).catch(error => alert(error));
}

showProjects();
document.getElementById("logoutButton").addEventListener("click", logout)
document.getElementById("toggle_project_action").addEventListener("click", toggleProjectList);