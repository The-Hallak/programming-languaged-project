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
                window.location.replace("../View/admin.php");
            }
        }).catch(
            error => console.log("Error:" + error)
        );
})