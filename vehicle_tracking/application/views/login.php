<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 20%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<h2>Login Form</h2>

<form id="login" method="post">

  <div class="container">
    <label for="uname"><b>Email ID</b></label>
    <input type="text" placeholder="Enter Email ID" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pwd" id="pwd" required>
        
    <button type="submit" name="login" id="login">Login</button>
    <br>
    <span id="login_msg"></span><br><br>
    <a href="<?php echo base_url('register'); ?>">No Account? Click Here to Register</a>
  </div>
</form>
<script>
$( document ).ready(function() {
    
    $("form#login").submit(function(e){
        e.preventDefault();
        var data = new FormData($("#login")[0]);
        $.ajax({
            type:'post',
            dataType:'json',
            processData: false,
            cache: false,
            contentType: false,
            url:"<?php echo base_url('login/validate_login'); ?>",
            data: data,
            beforeSend: function() {
                $("#login_msg").html('');
                $('#submit_data').prop("disabled",true);
            },
            success: function(response){
                $('#submit_data').prop("disabled",false);
                $("#login_msg").html(response.msg);
                
                if(response.status == 200)
                window.location.href="<?php echo base_url('home');  ?>";
            }
        });
        
    });
});
</script>
</body>
</html>
