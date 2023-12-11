import { logout } from './logout.js';

function toggleProjectList() {
    var projectList = document.getElementById('existing_projects');
    var toggleLabel = document.getElementById('toggle_label');
    var isChecked = document.getElementById('toggle_project_action').checked;
    var submitButtom = document.getElementById('teacher_sumbit');
    var form = document.getElementById('teacher_form');

    if (isChecked) {
        projectList.disabled = false;
        toggleLabel.textContent = 'Modify Existing Project';
        submitButtom.value = 'Modify project';
        editProjectInfo();
    } else {
        projectList.disabled = true;
        toggleLabel.textContent = 'Add New Project';
        submitButtom.value = 'Add project';
        form.reset();
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

async function editProjectInfo() {
    let projectInfo = await getProjectInfo(document.getElementById('existing_projects').value);
    document.getElementById('name').value = projectInfo["name"];
    document.getElementById('description').value = projectInfo["description"];
    document.getElementById('number_students').value = projectInfo["number_of_student"];
}

function getProjectInfo(project) {
    return fetch(
        '../Controller/teacherController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            "get_project_info": true,
            "project_id": project
        })
    }).then(response => response.json())
        .then(data => {
            if (data["status"] == "failed") {
                alert("couldn't load teacher's projects please refresh\n" + data["msg"]);
                return;
            }
            return data["info"];
        }).catch(error => alert(error));
}

function showTeacherProjects() {
    fetch(
        '../Controller/teacherController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            "show_teacher_projects": true
        })
    }).then(response => response.json())
        .then(data => {
            if (data["status"] == "failed") {
                alert("couldn't load teacher's projects please refresh\n" + data["msg"]);
                return;
            }
            let projectList = document.getElementById("existing_projects");
            let responseData = data["projects"];
            Object.entries(responseData).forEach(([key, value]) => {
                projectList.add(new Option(value, key));
            })


        }).catch(error => alert(error));
}

function addProject() {
    var form=document.getElementById("teacher_form");
    var formData=new FormData(form);
    formData.append("add_project",true);
    fetch(
        '../Controller/teacherController.php', {
        method: "POST",
        body: formData
    }).then(response => response.json())
        .then(data => {
            console.log(data);
            if (data["status"] == "failed") {
                alert(data["msg"]);
            } else {
                alert("project added successfully");
                window.location.reload();   
            }
            form.reset();
        }).catch(error => alert(error));
}

function modifyProject() {
    var form=document.getElementById("teacher_form");
    var formData=new FormData(form);
    formData.append("modify_project",true);
    fetch(
        '../Controller/teacherController.php', {
        method: "POST",
        body: formData
    }).then(response => response.json())
        .then(data => {
            console.log(data);
            if (data["status"] == "failed") {
                alert(data["msg"]);
            } else {
                alert("project modified successfully");
                window.location.reload();
            }
            form.reset();
        }).catch(error => alert(error));
}

function submit(e) {
    e.preventDefault();
    document.getElementById('toggle_project_action').checked ? modifyProject() : addProject();
}

showProjects();
showTeacherProjects();
document.getElementById("logoutButton").addEventListener("click", logout);
document.getElementById("toggle_project_action").addEventListener("click", toggleProjectList);
document.getElementById("existing_projects").addEventListener('change', editProjectInfo);
document.getElementById("teacher_form"), addEventListener('submit', submit);