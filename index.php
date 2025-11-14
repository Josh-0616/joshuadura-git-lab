<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator Feature</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            padding: 30px;
        }
        .container {
            background: #fff;
            padding: 20px;
            width: 400px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .result {
            padding: 10px;
            font-size: 18px;
            background: #eaeaea;
            border-radius: 5px;
            margin-top: 10px;
            text-align: center;
        }
        .strength-box {
            height: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Hello Git!</h2>
    <p>This is the feature-1 update: Password Generator Feature</p>

    <?php
    // This function creates a random password based on user-selected criteria.
    function generate_password($length = 12, $use_letters = true, $use_numbers = true, $use_symbols = true) {
        $chars = '';

        if ($use_letters) $chars .= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($use_numbers) $chars .= '0123456789';
        if ($use_symbols) $chars .= '!@#$%^&*()-_=+[]{}|;:,.<>?/`~';

        if (empty($chars)) return '';

        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, strlen($chars) - 1)];
        }

        return $password;
    }

    // Password Strength Calculator
    function password_strength($password) {
        $score = 0;
        $length = strlen($password);

        if ($length >= 8) $score++;
        if ($length >= 12) $score++;
        if ($length >= 16) $score++;

        if (preg_match('/[a-z]/', $password)) $score++;
        if (preg_match('/[A-Z]/', $password)) $score++;
        if (preg_match('/[0-9]/', $password)) $score++;
        if (preg_match('/[^a-zA-Z0-9]/', $password)) $score++;

        $percentage = min(100, ($score / 7) * 100);

        if ($score <= 2) return ['WEAK', '#e74c3c', $percentage];
        elseif ($score <= 4) return ['MEDIUM', '#f1c40f', $percentage];
        else return ['STRONG', '#2ecc71', $percentage];
    }

    $password = '';
    $strength = ['', '', 0];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $length = intval($_POST['length'] ?? 12);
        $use_letters = isset($_POST['letters']);
        $use_numbers = isset($_POST['numbers']);
        $use_symbols = isset($_POST['symbols']);

        $password = generate_password($length, $use_letters, $use_numbers, $use_symbols);
        $strength = password_strength($password);
    }
    ?>

    <form method="POST">
        <label>Password Length:</label>
        <input type="number" name="length" value="12" min="4" max="30"><br><br>

        <label><input type="checkbox" name="letters" checked> Include Letters</label><br>
        <label><input type="checkbox" name="numbers" checked> Include Numbers</label><br>
        <label><input type="checkbox" name="symbols" checked> Include Symbols</label><br><br>

        <button type="submit">Generate Password</button>
    </form>

    <?php if (!empty($password)): ?>
        <div class="result">
            <strong>Generated Password:</strong><br>
            <?= htmlspecialchars($password) ?>
        </div>

        <div class="strength-box" style="background: <?= $strength[1] ?>; width: <?= $strength[2] ?>%;"></div>
        <p><strong>Strength: <?= $strength[0] ?></strong></p>
    <?php endif; ?>

</div>

</body>
</html>

<h1>Hello Git!</h1>
<?php 
// added feature: random password generator 
?>

