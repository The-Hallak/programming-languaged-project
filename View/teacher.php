<!DOCTYPE html>
<html>
<head>
    <title>Project Management</title>
    <link rel="stylesheet" href="../style/teacher.css">
</head>
<body>
    <div class="container">
        <div class="projects-table">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Teacher Name</th>
                    <th>Number of Students</th>
                    <th>Students Names</th>
                    <th>Remaining Students</th>
                </tr>
                <!-- Example Row (Repeat as needed) -->
                <tr>
                    <td>1</td>
                    <td>Project 1</td>
                    <td>Project Description</td>
                    <td>Teacher 1</td>
                    <td>30</td>
                    <td>Student1, Student2, ...</td>
                    <td>5</td>
                </tr>
                <!-- More rows... -->
            </table>
        </div>
        <div class="vline"></div>
        <div class="project-form">
            <form>
                <div class="form-field">
                    <label for="name">Project Name:</label>
                    <input type="text" id="name" name="name">
                </div>

                <div class="form-field">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description"></textarea>
                </div>

                <div class="form-field">
                    <label for="teacher_name">Teacher Name:</label><br>
                    <select id="teacher_name" name="teacher_name">
                        <option value="teacher1">Teacher 1</option>
                        <option value="teacher2">Teacher 2</option>
                        <!-- Add more teachers as options -->
                    </select><br>
                </div>

                <div class="form-field">
                    <label for="number_students">Number of Students in the Project:</label><br>
                    <input type="number" id="number_students" name="number_students"><br>
                </div>

                
                <div class="toggle-div">
                    <div>
                        <label class="switch">
                            <input type="checkbox" id="toggle_project_action" onchange="toggleProjectList()">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div id="toggle_label">
                        Add New Project
                    </div>
                </div>

                <!-- Dropdown for existing projects (initially hidden) -->
                <select id="existing_projects" name="existing_projects" style="display:none">
                    <option value="project1">Project 1</option>
                    <option value="project2">Project 2</option>
                    <!-- More existing projects as options -->
                </select><br>

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
    <script>
    function toggleProjectList() {
        var projectList = document.getElementById('existing_projects');
        var toggleLabel = document.getElementById('toggle_label');
        var isChecked = document.getElementById('toggle_project_action').checked;

        if (isChecked) {
            projectList.style.display = 'block';
            toggleLabel.textContent = 'Modify Existing Project';
        } else {
            projectList.style.display = 'none';
            toggleLabel.textContent = 'Add New Project';
        }
    }
</script>
</body>
</html>
