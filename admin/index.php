<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="frontend/css/stylel.css" type="text/css">
</head>
<body>
    <img src="frontend/images/1.svg" alt="bg" id="background1">
    <div id="box" class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']).'php/login.php'; ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input id="txt-input" type="text" placeholder="username" name="username" class="form-control" value="<?php echo $username; ?>">
                <img src="frontend/images/acc.svg" class="posAbs icons" style="bottom: 100px;">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input id="pw-input" placeholder="password" type="password" name="password" class="form-control">
                <img src="frontend/images/pw.svg" class="posAbs icons" style="bottom: 70px;">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input id="btn" type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</body>
</html>