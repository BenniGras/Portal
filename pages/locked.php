<!DOCTYPE html>
<html>
<head>
    <title>Gesperrt</title>
    <meta http-equice="content-type" content="text/html" charset="utf-8"/>
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/header.css">
    <link rel="stylesheet" href="../../CSS/locked.css">
</head>
<body>

    <?php if(!empty($error)): ?>
        <p>
            <?php echo $error ?>
        </p>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-container">
            <div class="form">
                <div class="input-container">
                    <input class="input" name="password" type="password" placeholder="Passwort" required>
                </div>
                <div class="button-container">
                    <button class="button">Login</button>   
                </div>         
            </div>
        </div>
    </form>

</body>
</html>