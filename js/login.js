document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    console.log(formData);
    fetch(
        '../Controller/loginController.php', {
        method: "POST",
        body: formData
    }).then(response => response.json())
        .then(data => {
            if(data["status"]=="failed"){
                document.getElementById('loginResult').textContent = data["reason"];
            }else{
                switch (data["role"]){
                case 0:
                    window.location.replace("../View/admin.php");
                    break;
                case 1:
                    window.location.replace("../View/teacher.php");
                    break;
                case 2:
                    window.location.replace("../View/student.php");
                    break;
                default:
                    console.log("error undefined role");
                }
            }
        }).catch(
            error => console.log("Error:" + error)
        );
})