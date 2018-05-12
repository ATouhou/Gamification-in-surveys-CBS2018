<?php session_start();

require 'includes/MysqliDb.php';
require 'includes/inc_credentials.php';

function guidv4($data)
{
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
} // php 7 guidv4(random_bytes(16));




if(isset($_SESSION['uuid'])){

//echo "hey hvad laver du her igen?";

}


if(isset($_POST['submit'])){

    $_SESSION['uuid'] = guidv4(random_bytes(16)); // php 7 uuid

    if(isset($_POST['name'])){
        $_SESSION['name'] = $_POST['name'];
    }
    if(isset($_POST['email'])){
        $_SESSION['email'] = $_POST['email'];
    }


  $min=1; //gamified
  $max=2; //standard
  $variation = rand($min,$max);
  $starttime = $db->now();

if($variation == 1){
$firstsurvey = "gamified_start";
}elseif($variation == 2){
$firstsurvey = "standard_start";
}

if(isset($_SERVER['HTTP_USER_AGENT'])){
  $useragent = $_SERVER['HTTP_USER_AGENT'];
}else{
  $useragent = 'hidden';
}

$data = Array (
    'uuid' => $_SESSION['uuid'],
    'ip' => $_SERVER['REMOTE_ADDR'],
    'email' => $_POST['email'],
    'name' => $_POST['name'],
    'firstroute' => $variation,
    $firstsurvey => $starttime,
    'useragent' => $useragent
);

$id = $db->insert ('entries', $data);
if ($id){
    //echo 'user was created. Id=' . $id;

if($variation == 1){

header("Location: https://touhou.dk/gamification/g/survey-gamified.html");
exit;
}elseif($variation == 2){
header("Location: https://touhou.dk/gamification/g/survey-standard.html");
exit;

}





}
else{
    echo 'insert failed: ' . $db->getLastError();
}



var_dump($_SESSION);

// Check if session UUID set
// If not create new
// Redirect to random and log in MySQL
//

} //end

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Spørgeskema</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <style>
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300);
* {
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-weight: 300;
}
body {
  font-family: 'Source Sans Pro', sans-serif;
  color: white;
  font-weight: 300;
}
body ::-webkit-input-placeholder {
  /* WebKit browsers */
  font-family: 'Source Sans Pro', sans-serif;
  color: white;
  font-weight: 300;
}
body :-moz-placeholder {
  /* Mozilla Firefox 4 to 18 */
  font-family: 'Source Sans Pro', sans-serif;
  color: white;
  opacity: 1;
  font-weight: 300;
}
body ::-moz-placeholder {
  /* Mozilla Firefox 19+ */
  font-family: 'Source Sans Pro', sans-serif;
  color: white;
  opacity: 1;
  font-weight: 300;
}
body :-ms-input-placeholder {
  /* Internet Explorer 10+ */
  font-family: 'Source Sans Pro', sans-serif;
  color: white;
  font-weight: 300;
}
.wrapper {
  background: #50a3a2;
  background: -webkit-gradient(linear, left top, right bottom, from(#50a3a2), to(#53e3a6));
  background: linear-gradient(to bottom right, #50a3a2 0%, #53e3a6 100%);
  position: absolute;
 /* top: 50%; */
  left: 0;
  width: 100%;
  height: 100%;
/*  margin-top: -200px; */
  overflow: hidden;
}
.wrapper.form-success .container h1 {
  -webkit-transform: translateY(85px);
          transform: translateY(85px);
}
.container {
  max-width: 600px;
  margin: 0 auto;
  padding: 80px 0;
  height: 400px;
  text-align: center;
}
.container h1 {
  font-size: 40px;
  -webkit-transition-duration: 1s;
          transition-duration: 1s;
  -webkit-transition-timing-function: ease-in-put;
          transition-timing-function: ease-in-put;
  font-weight: 200;
}
form {
  padding: 20px 0;
  position: relative;
  z-index: 2;
}
form input {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  outline: 0;
  border: 1px solid rgba(255, 255, 255, 0.4);
  background-color: rgba(255, 255, 255, 0.2);
  width: 250px;
  border-radius: 3px;
  padding: 10px 15px;
  margin: 0 auto 10px auto;
  display: block;
  text-align: center;
  font-size: 18px;
  color: white;
  -webkit-transition-duration: 0.25s;
          transition-duration: 0.25s;
  font-weight: 300;
}
form input:hover {
  background-color: rgba(255, 255, 255, 0.4);
}
form input:focus {
  background-color: white;
  width: 300px;
  color: #53e3a6;
}
form button {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  outline: 0;
  background-color: white;
  border: 0;
  padding: 10px 15px;
  color: #53e3a6;
  border-radius: 3px;
  width: 250px;
  cursor: pointer;
  font-size: 18px;
  -webkit-transition-duration: 0.25s;
          transition-duration: 0.25s;
}
form button:hover {
  background-color: #f5f7f9;
}
.bg-bubbles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
}
.bg-bubbles li {
  position: absolute;
  list-style: none;
  display: block;
  width: 40px;
  height: 40px;
  background-color: rgba(255, 255, 255, 0.15);
  bottom: -160px;
  -webkit-animation: square 25s infinite;
  animation: square 25s infinite;
  -webkit-transition-timing-function: linear;
  transition-timing-function: linear;
}
.bg-bubbles li:nth-child(1) {
  left: 10%;
}
.bg-bubbles li:nth-child(2) {
  left: 20%;
  width: 80px;
  height: 80px;
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
  -webkit-animation-duration: 17s;
          animation-duration: 17s;
}
.bg-bubbles li:nth-child(3) {
  left: 25%;
  -webkit-animation-delay: 4s;
          animation-delay: 4s;
}
.bg-bubbles li:nth-child(4) {
  left: 40%;
  width: 60px;
  height: 60px;
  -webkit-animation-duration: 22s;
          animation-duration: 22s;
  background-color: rgba(255, 255, 255, 0.25);
}
.bg-bubbles li:nth-child(5) {
  left: 70%;
}
.bg-bubbles li:nth-child(6) {
  left: 80%;
  width: 120px;
  height: 120px;
  -webkit-animation-delay: 3s;
          animation-delay: 3s;
  background-color: rgba(255, 255, 255, 0.2);
}
.bg-bubbles li:nth-child(7) {
  left: 32%;
  width: 160px;
  height: 160px;
  -webkit-animation-delay: 7s;
          animation-delay: 7s;
}
.bg-bubbles li:nth-child(8) {
  left: 55%;
  width: 20px;
  height: 20px;
  -webkit-animation-delay: 15s;
          animation-delay: 15s;
  -webkit-animation-duration: 40s;
          animation-duration: 40s;
}
.bg-bubbles li:nth-child(9) {
  left: 25%;
  width: 10px;
  height: 10px;
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
  -webkit-animation-duration: 40s;
          animation-duration: 40s;
  background-color: rgba(255, 255, 255, 0.3);
}
.bg-bubbles li:nth-child(10) {
  left: 90%;
  width: 160px;
  height: 160px;
  -webkit-animation-delay: 11s;
          animation-delay: 11s;
}
@-webkit-keyframes square {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  100% {
    -webkit-transform: translateY(-700px) rotate(600deg);
            transform: translateY(-700px) rotate(600deg);
  }
}
@keyframes square {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  100% {
    -webkit-transform: translateY(-700px) rotate(600deg);
            transform: translateY(-700px) rotate(600deg);
  }
}

</style>

<div class="wrapper">
    <div class="container">
        <h1>Velkommen</h1>


 <h2> Dette spørgeskema er 2-delt.</h2>
 <br>
 <h2> Ved at angive din email tillader du at vi muligvis kontakter dig i forbindelse med et 10 minutter interview :-).</h2>
    <br>
 <h3>Angivelse af navn og email er valgfrit </h3>
<form method="post" accept-charset="utf-8" class="form">
<input type="text" id="name" name="name" placeholder="Navn">
<input type="text" id="email" name="email" placeholder="Email">
<input type="submit" name="submit" id="login-button" value="Start!">


        </form>
    </div>

    <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>

<!--
<<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript" charset="utf-8" async defer></script>
<script>
 $("#login-button").click(function(event){
     //   event.preventDefault();

     $('form').fadeOut(500);
     $('.wrapper').addClass('form-success');
});
</script>
-->

</body>
</html>


