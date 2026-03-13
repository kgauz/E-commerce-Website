

<!-- this form will serve as the destination for form submition -->
 <?php

 session_start();

 require_once 'confi.php';

  if(isset($_POST['Submit']))
    {
        echo "hello"
    }

 if(isset($_POST['register']))   // post- retrieve data from the html
 {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role= $_POST['role'];

    //check if the email exist in the databse or not

    $checkEmail  = $conn->query("SELECT email FROM users WHERE email = '$email'");


    if($checkEmail->num_rows >0)
    {
        $_SESSION['register_error'] = 'Email is already registered';
        $_SESSION['active_form'] ='register';
    }
    else{
        $conn->query("INSERT INTO users(name,email,password,role) VALUES ('$name', '$email', '$password', '$role')");
    }
    header("Location: input.php");
    exit();

 }


if(isset($_POST['login'])){
    $email =$_POST['email']; // retrieve email from the index.php file
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");

    if($result->num_rows >0) // email is correct
    {
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            if($user['role'] === 'admin')
            {
                header("Location: admin_page.php");
            }
            else{
                header("Location: user_page.php");
            }
            exit();
        }
    }

    $_SESSION['login_error'] = 'Incorrect email or password';
    $_SESSION['active_form'] = 'login';
    header(header: "Location: input.php");
    exit();
}
 ?>