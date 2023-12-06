<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
    <div class="login-container">
        <form action="../Controller/loginController.php" method="post">
            <h2>Login</h2>
            <div class="input-group">
                <label for="userId">Id</label>
                <input type="number" id="userId" name="userId" required >
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
