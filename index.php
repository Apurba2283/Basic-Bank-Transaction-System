<?php
session_start();
include 'conn.php';
if(isset($_POST['log']))
{
$email = $_POST["email"];
$pass = $_POST["pass"];
if(empty($email)){
	header("Location: index.php?error=");
      exit();
}else{
$sql ="SELECT u.*, e.* FROM users u,emp_details e WHERE u.username='$email' AND e.id=u.id";
     $result = mysqli_query($con,$sql);
     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     $x = (mysqli_query($con,$sql));
if(mysqli_num_rows($x)>0){
if($row["username"]==$email && $row["password"]==$pass)
{
    if($row["status"]=="Active"){
    $_SESSION["loggedin"] = true;
    $idd=$row['id'];
    $_SESSION["type"] =$row['role'];
    $_SESSION["pass"] =$row['password'];
    $_SESSION["name"] =$row['name'];
    $_SESSION['img'] =$row['image'];
     $_SESSION["id"] =$row['id'];
    $_SESSION["email"] =$email;
    $_SESSION["status"]="Welcome ".$row['name'];
    $_SESSION["code"]="success";
    date_default_timezone_set('Asia/Karachi');
    $tms1 = date("Y-m-d h:i:s");
    $_SESSION["time"]=$tms1;
    mysqli_query($con,"INSERT INTO emp_history values('$idd','$tms1','logged still')");
  header("location: dashboard.php");
  exit();}else{
    $_SESSION["status"]="This user account is blocked";
    $_SESSION["code"]="error";
    header("Location: index.php");
      exit();
  }
}
else{
    $_SESSION["status"]="Invalid username or password";
    $_SESSION["code"]="error";
    header("Location: index.php");
      exit();
}
}
else{
    $_SESSION["status"]="Invalid username or password";
    $_SESSION["code"]="error";
    header("Location: index.php");
    exit();
}
}
}
?>
<!DOCTYPE html>
<html>
    <head>
         <title>BANGLADESH BANK| LOGIN</title>
         <link rel="icon" href="images/icc.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/native-toast.css">
        <meta charset="utf-8">
        <style type="text/css">
  @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

* {
	box-sizing: border-box;
	margin: 0;
	padding: 0;	
	font-family: Raleway, sans-serif;
}

body {
	background: linear-gradient(90deg, #C7C5F4, #776BCC);		
}

.container {
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 80vh;
}

.screen {		
	background: linear-gradient(90deg, #5D54A4, #7C78B8);		
	position: relative;	
	height: 600px;
	width: 360px;	
	box-shadow: 0px 0px 24px #5C5696;
}

.screen__content {
	z-index: 1;
	position: relative;	
	height: 100%;
}

.screen__background {		
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 0;
	-webkit-clip-path: inset(0 0 0 0);
	clip-path: inset(0 0 0 0);	
}

.screen__background__shape {
	transform: rotate(45deg);
	position: absolute;
}

.screen__background__shape1 {
	height: 520px;
	width: 520px;
	background: #FFF;	
	top: -50px;
	right: 120px;	
	border-radius: 0 72px 0 0;
}

.screen__background__shape2 {
	height: 220px;
	width: 220px;
	background: #6C63AC;	
	top: -172px;
	right: 0;	
	border-radius: 32px;
}

.screen__background__shape3 {
	height: 540px;
	width: 190px;
	background: linear-gradient(270deg, #5D54A4, #6A679E);
	top: -24px;
	right: 0;	
	border-radius: 32px;
}

.screen__background__shape4 {
	height: 400px;
	width: 200px;
	background: #7E7BB9;	
	top: 420px;
	right: 50px;	
	border-radius: 60px;
}

.login {
	width: 320px;
	padding: 30px;
	padding-top: 156px;
}

.login__field {
	padding: 20px 0px;	
	position: relative;	
}

.login__icon {
	position: absolute;
	top: 30px;
	color: #7875B5;
}

.login__input {
	border: none;
	border-bottom: 2px solid #D1D1D4;
	background: none;
	padding: 10px;
	padding-left: 24px;
	font-weight: 700;
	width: 75%;
	transition: .2s;
}

.login__input:active,
.login__input:focus,
.login__input:hover {
	outline: none;
	border-bottom-color: #6A679E;
}

.login__submit {
	background: #fff;
	font-size: 14px;
	margin-top: 30px;
	padding: 16px 20px;
	border-radius: 26px;
	border: 1px solid #D4D3E8;
	text-transform: uppercase;
	font-weight: 700;
	display: flex;
	align-items: center;
	width: 100%;
	color: #4C489D;
	box-shadow: 0px 2px 2px #5C5696;
	cursor: pointer;
	transition: .2s;
}

.login__submit:active,
.login__submit:focus,
.login__submit:hover {
	border-color: #6A679E;
	outline: none;
}

.button__icon {
	font-size: 24px;
	margin-left: auto;
	color: #7875B5;
}

.social-login {	
	position: absolute;
	height: 140px;
	width: 160px;
	text-align: center;
	bottom: 0px;
	right: 0px;
	color: #fff;
}

.social-icons {
	display: flex;
	align-items: center;
	justify-content: center;
}

.social-login__icon {
	padding: 20px 10px;
	color: #fff;
	text-decoration: none;	
	text-shadow: 0px 0px 8px #7875B5;
}

.social-login__icon:hover {
	transform: scale(1.5);	
} 

.login-form__links {
    margin-top: 15px;
    text-align: center;
}

.login-form__link {
    font-size: 1em;
    font-weight: bold;
    color: red;
    text-decoration: none;
}
.pageHeading{
    display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
}
.pagelogo {
            max-width: 70px; /* Adjust the width as needed */
            margin-bottom: 20px; /* Adjust the margin as needed */
        }
        </style>
    </head>
    <body>
 
    <div class="container">
           
	<div class="screen">
        <div class="screen__content">
        <div class="pageHeading">
            <img class="pagelogo" src="images/icc.ico" alt="Logo">
    <h1>BANGLADESH BANK</h1>

            </div>
			<form class="login" method="POST">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					
                    <input class="login__input" type="email" name="email" placeholder="Username" required autofocus>
                
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
				
                    <input class="login__input" type="password" name="pass" placeholder="Password" required>
				</div>
				<button class="button login__submit" type="submit" name="log">
					<span class="button__text">Log In Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>
                <div class="login-form__links">
                    <a class="login-form__link" href="forget.php">Forgot Password?</a>
                </div>				
			</form>
			<!-- <div class="social-login">
				<h3>log in via</h3>
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"></a>
					<a href="#" class="social-login__icon fab fa-facebook"></a>
					<a href="#" class="social-login__icon fab fa-twitter"></a>
				</div>
			</div> -->
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>   
<script src="js/native-toast.min.js"></script>
<?php
if(isset($_SESSION['status']) && $_SESSION['status']!=''){

?>
<script type="text/javascript">
    nativeToast({
  message: '<?php echo $_SESSION['status']?>',
  position: 'center',
  timeout: 4000,
  type: '<?php echo $_SESSION['code']?>',
  closeOnClick:true
 })
</script>
<?php
 unset($_SESSION['status']);
}
?>
    </body>
</html>
