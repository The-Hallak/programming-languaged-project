document.getElementById("adminForm").addEventListener("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    formData.set("addUser","true");
    fetch(
        '../Controller/adminController.php', {
        method: "POST",
        body: formData
    }).then(response => response.json())
        .then(data => {
            if (data["status"] == "failed") {
                alert(data["msg"]);
            } else {
                alert("user added successfully");
            }
            this.reset();
        }).catch(alert(error));
})

document.getElementById("logoutButton").addEventListener("click",function(e){
    if(window.confirm("are you sure you want to logout?")){
        window.location.replace("../View/login.html");
    }
})