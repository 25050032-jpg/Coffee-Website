<?php

session_start();

$errors = [
    "login" => $_SESSION["login_error"] ?? "",
    // the ?? acts as an if statement, if "login_error" isnt null in the session then set that
    // as the variable, if not then set the value as "" 
    "register" => $_SESSION["register_error"] ?? ""
];

$activeForm = $_SESSION["active_form"] ?? "login";

session_unset();

function showError($errors) {
    return !empty($errors) ? "<p class='error-message'>$errors</p>" : "";
}

function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? "active" : "" ;
    // Compares the current form name against the active form state.
    // Returns 'active' for the matching form and '' to ensure the inactive form remains hidden.
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brewhaven Log-In Page</title>
    
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
      
    <!-- Link Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="login.css">
    <script src="login-script.js" defer></script>
</head>
<body>
    <header>
        <div class="container header-container">
            <a href="#" class="logo">
                <i class="fa-solid fa-mug-hot logo-icon"></i>
                <div class="logo-text">Brew<span>Haven</span></div>
            </a> 

            <div class="nav-btn">
                <a href="index.html" class="return">Back to the shop</a>
            </div>
        </div>
    </header>
        
    <main>
        <section id="left">
            <div class="anchor">
                <div class="accent-text">ETHICALLY SOURCED THOUGHTFULLY ROASTED</div>
            </div>
            <h1 class="main-text">Your daily ritual,
                <span class="newline">beautifully</span>
                <span class="newline newline-coloured">brewed.</span>
            </h1>
            <p class="muted-desc">Exceptional beans. Small-batch craft.
                 A little moment of warmth, made just for you.</p>

            <div class="left-bottom-page">
                <div class="slogan">Good coffee. Better moments.</div>
                <div class="accent-text">FROM ORIGIN TO YOUR CUP</div>
            </div>
        </section>

        <section id="right">
            <div class="form-container">
                
                <!-- LOGIN FORM -->
                <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-container">
                    <div class="form-header">
                        <div class="accent-text">YOUR BREWHAVEN ACCOUNT</div>
                        <h2 class="main-text">Welcome back.</h2>
                        <p class="muted-desc">Sign in for your favourite blends and little daily rituals.</p>
                    </div>

                    <form action="login-register.php" method="POST" class="login-form">
                        <?= showError($errors["login"]); ?>
                        <label for="login-email">Email address</label>
                        <input type="email" name="email" id="login-email" placeholder="you@example.com" required>

                        <label for="login-password">Password</label>
                        <input type="password" name="password" id="login-password" placeholder="Enter Your Password" required>

                        <div class="form-options">
                            <label class="checkbox-label">
                                <input type="checkbox" name="remember" id="login-remember">
                                <span class="custom-checkbox"></span>
                                Remember me
                            </label>
                            <a href="#" class="forgot-link">Forgot password?</a>
                        </div>

                        <button type="submit" name="login" class="submit-btn">
                            Sign in <i class="fa-solid fa-arrow-right"></i>
                        </button>

                        <p class="form-change">Don't have an account? <a href="#" class="register" onclick="event.preventDefault(); showForm('register-container')">Register</a></p>
                    </form>
                </div>  

                <!-- REGISTER FORM -->
                <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-container">
                    <div class="form-header">
                        <div class="accent-text">CREATE A BREWHAVEN ACCOUNT</div>
                        <h2 class="main-text">Welcome.</h2>
                        <p class="muted-desc">Sign up for your favourite blends and little daily rituals.</p>
                    </div>

                    <form action="login-register.php" method="POST" class="register-form">
                        <?= showError($errors["register"]); ?>
                        <label for="register-name">Name</label>
                        <input type="text" name="name" id="register-name" placeholder="John Doe" required>

                        <label for="register-email">Email address</label>
                        <input type="email" name="email" id="register-email" placeholder="you@example.com" required>

                        <label for="register-password">Password</label>
                        <input type="password" name="password" id="register-password" placeholder="Enter Your Password" required>

                        <div class="form-options">
                            <label class="checkbox-label">
                                <input type="checkbox" name="remember" id="register-remember">
                                <span class="custom-checkbox"></span>
                                Remember me
                            </label>
                            <a href="#" class="forgot-link">Forgot password?</a>
                        </div>

                        <button type="submit" name="register" class="submit-btn">
                            Create Account <i class="fa-solid fa-arrow-right"></i>
                        </button>

                        <p class="form-change">Already have an account? <a href="#" class="login" onclick="event.preventDefault(); showForm('login-container')">Log in</a></p>
                    </form>
                </div>  

            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="copyright">
            © 2026 Your Brand. All rights reserved.
        </div>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Need Help?</a>
        </div>
    </footer>
</body>
</html>