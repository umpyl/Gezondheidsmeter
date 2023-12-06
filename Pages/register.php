<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="../../Assets/CSS/register.css">
</head>

<body>
    <div class="register_content">
        <form name="register_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="hoofd_txt">
                <h1>Registeren</h1>
            </div>
            <div class="form-field">
                <label for="username">Naam:</label><span><br>
                    <input type="text" id="username" name="_username" />
                </span>
            </div>
            <div class="form-field">
                <label for="username">Email:</label><span><br>
                    <input type="text" id="username" name="_username" />
                </span>
            </div>
            <div class="form-field">
                <label for="credentials">Wachtwoord:</label><span><br>
                    <input type="password" id="credentials" name="_passwd" />
                </span>
            </div>
            <div class="form-field">
                <label for="credentials">Geslacht:</label><span><br>
                    <input type="radio" />
                    <input type="radio" />
                </span>
            </div>
            <div class="form-submit">
                <div class="form-submit-button">
                    <button class="submit" value="Submit"><b>Registreren</b></button>
                </div>
            </div>

        </form>
    </div>
</body>

</html>