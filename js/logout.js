export function logout(){
    if (window.confirm("are you sure you want to logout?")) {
        fetch(
            '../Controller/sharedController.php', {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                "logout": "1"
            })
        }
        ).then(response => response.json())
            .then(data => {
                if (data["status"] == "failed") {
                    alert(data["msg"]);
                } else {
                    window.location.replace("../View/login.html");
                }
            }).catch(error => alert(error));
    }
}