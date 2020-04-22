<?php
include 'functions.php';
?>

<?=template_header('Home')?>

    <div class="content">
        <h2>Home</h2>
        <p>Welcome on our library!</p>
    </div>

    <div class="login">
        <h1>Login</h1>
        <form action="authenticate.php" method="post">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="Login">
        </form>
    </div>

    <div class="register">
        <h1>Register</h1>
        <form action="register.php" method="post" autocomplete="off">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="email">
                <i class="fas fa-envelope"></i>
            </label>
            <input type="email" name="email" placeholder="Email" id="email" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="Register">
        </form>
    </div>

<?=template_footer()?>
