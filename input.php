
 <?php

session_start();

$error =[ 'login' => $_SESSION['login_error'] ?? '',  
'register' => $_SESSION['register_error'] ?? ''];

$activeForm = $_SESSION['active_form']?? 'login';

session_unset();

function showError($msg){
    return !empty($msg) ? "<p class ='error-message'>$msg</p>"  : '';
}

function isActiveForm($formName, $activeForm){

return $formName === $activeForm ? 'active' : '';
}

?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>login system</title>
</head>
<body>

    <div class ="container">
        <div class ="form-box  <?= isActiveForm('login',$activeForm); ?>" id ="loginSystem" >
            <form  action="login_register.php"  method="post">
                <h3>Login</h3>
                <?= showError($error['login']); ?>
                <input type="email" name="email" placeholder=" Email" required>
                <input type="password" name="password" placeholder=" Password" required>
                <button class="btn" type="submit" name="login" >login</button>
                <p>Dont have an account </p>
                <a href="#" onclick="show('registerSystem')" >register</a>

            </form>
        </div>


        <div class ="form-box <?= isActiveForm('register',$activeForm); ?> " id ="registerSystem" >
            <form  action="login_register.php"  method ="post">
                <h3>Register</h3>
                 <?= showError($error['register']); ?>
                <input type="text" name="name" placeholder=" Name" required>
                <input type="email" name="email" placeholder=" Email" required>
                <input type="password" name="password" placeholder=" Password" required>
                <select name="role" required>
                    <option value="">---Select Role---</option>
                    <option value="user"> User</option>
                    <option value="admin"> Admin</option>
                </select>
                <button class="btn" type="submit" name="register">Register</button>
                <p>Already have an account </p>
                <a href="#" onclick="show('loginSystem')">Login</a>
                

            </form>
        </div>

    </div>
   

    <script>

        function show(formId)
        {
            document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active"));
            document.getElementById(formId).classList.add("active");


        }

    </script>
    
</body>
</html>