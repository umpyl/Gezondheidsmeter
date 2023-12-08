<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="../../Assets/CSS/register.css">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="head">
        <svg class="pumping-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 14.25 2 11.28 2 7.5 2 4.42 4.42 2 7.5 2 9.43 2 11.11 3.11 12 4.74 12.89 3.11 14.57 2 16.5 2 19.58 2 22 4.42 22 7.5c0 3.78-3.4 6.75-8.55 12.54L12 21.35z" />
        </svg>
    </div>
    <div class="register_content">
        <form class="register_form" name="register_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="hoofd_txt">
                <h1>Registeren</h1>
            </div>
            <div class="form-field">
                <label for="username">Naam:</label><span><br>
                    <input type="text" id="username" name="_username" class="input_reg" autocomplete="off" required />
                </span>
            </div>
            <div class="form-field">
                <label for="email">Email:</label><span><br>
                    <input type="text" id="email" name="_email" class="input_reg" autocomplete="off" required />
                </span>
            </div>
            <div class="form-field">
                <label for="credentials">Wachtwoord:</label><span><br>
                    <input type="password" id="credentials" name="_passwd" class="input_reg" autocomplete="off" required />
                </span>
            </div>
            <div class="form-field">
                <label for="credentials">Geslacht:</label><span><br>
                    <input type="radio" id="man" name="gender" required />
                    <label for="man">Man</label>

                    <input type="radio" id="vrouw" name="gender" required />
                    <label for="vrouw">Vrouw</label>
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