<html>
    <head>
        <title>Register</title>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        
        
        <style type="text/css">
            form_main {
                width: 100%;
            }
            .form_main h4 {
                font-family: roboto;
                font-size: 20px;
                font-weight: 300;
                margin-bottom: 15px;
                margin-top: 20px;
                text-transform: uppercase;
            }
            .heading {
                border-bottom: 1px solid #fcab0e;
                padding-bottom: 9px;
                position: relative;
            }
            .heading span {
                background: #9e6600 none repeat scroll 0 0;
                bottom: -2px;
                height: 3px;
                left: 0;
                position: absolute;
                width: 75px;
            }   
            .form {
                border-radius: 7px;
                padding: 6px;
            }
            .txt[type="text"] {
                border: 1px solid #ccc;
                margin: 10px 0;
                padding: 10px 0 10px 5px;
                width: 100%;
            }
            .txt_3[type="text"] {
                margin: 10px 0 0;
                padding: 10px 0 10px 5px;
                width: 100%;
            }
            .txt2[type="submit"] {
                background: #242424 none repeat scroll 0 0;
                border: 1px solid #4f5c04;
                border-radius: 25px;
                color: #fff;
                font-size: 16px;
                font-style: normal;
                line-height: 35px;
                margin: 10px 0;
                padding: 0;
                text-transform: uppercase;
                width: 30%;
            }
            .txt2:hover {
                background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
                color: #5793ef;
                transition: all 0.5s ease 0s;
            }

        </style>
    </head>
    <body>
    <div class="container">
    <h2>Registration Form</h2>
	<div class="row">
    <div class="col-md-12">
		<div class="form_main">
            <div class="form">
                
                <form  id="register_form" name="register_form" method="POST" enctype="multipart/form-data">
                    <input type="text" placeholder="Please input your Name" value="" name="name" class="txt">
                    <input type="text" placeholder="Please input your Contact No" value="" name="cno" class="txt" maxlength="10">
                    <input type="text" placeholder="Please input your Email" value="" name="email" class="txt"><br>
                    <input type="password" placeholder="Please input your Password" value="" name="pwd" class="form-control"><br>
                    <input type="submit" value="submit" name="submit_data" id="submit_data" class="txt2">
                    <br>
                    <span id="register_msg"></span>
                </form>
                <a href="<?php echo base_url('login'); ?>">Go To Login</a>
            </div>
            </div>
        </div>
	</div>
</div>
<script>
$(document).ready(function() {
    
    $("form#register_form").submit(function(e){
        e.preventDefault();
        var data = new FormData($("#register_form")[0]);
        $.ajax({
            type:'post',
            dataType:'json',
            processData: false,
            cache: false,
            contentType: false,
            url:"<?php echo base_url('register/submit_register_data'); ?>",
            data: data,
            beforeSend: function() {
                $("#register_msg").html('');
                $('#submit_data').prop("disabled",true);
            },
            success: function(response){
                $('#submit_data').prop("disabled",false);
                $("#register_msg").html(response.msg);
                
                if(response.status == 200)
                window.location.href = "<?php echo base_url('login'); ?>"

            }
        });
        
    });
});
</script>
    </body>
</html>