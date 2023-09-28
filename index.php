<?php 
    include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
</head>
<body>
    <h2>Registration Form</h2><hr>
    <form action="index.php" method="POST">
        <br>
        <label>User Name : </label>
        <input type="text" name="user"><br><br>
        <label>Password : </label>
        <input type="password" name="password"><br><br>
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>
<?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $user = filter_input(INPUT_POST,"user",FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
        if(empty($user)){
            echo"Please enter the user name. <br>";
        }
        elseif(empty($password)){
            echo"Please enter the password. <br>";
        }
        else{
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (user,password) VALUES ('$user','$hash')";

            try{
                mysqli_query($conn,$sql);
                echo"<br> You are registered";
            }
            catch(mysqli_sql_exception){
                echo"That username is taken";
            }
        }
    }
    mysqli_close($conn);
?>