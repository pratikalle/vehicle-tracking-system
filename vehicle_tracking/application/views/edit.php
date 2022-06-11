<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit </title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" >
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <style>
        body {
    background-color: #eee;
}

*[role="form"] {
    max-width: 530px;
    padding: 15px;
    margin: 0 auto;
    background-color: #fff;
    border-radius: 0.3em;
}

*[role="form"] h2 {
    margin-left: 5em;
    margin-bottom: 1em;
}

    </style>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1 style="font-weight:700;">Edit</h1>
        </div>   
        
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" style="margin-top: 20px;" id="" href="<?php echo base_url('logout') ?>">Logout</a>
        </div>    
    </div>
</div>
    <div class="row">
        
        <div class="col-xs-12">
        <div class="">
            <form class="form-horizontal" role="form" id="edit_vehicle_details_form" name="edit_vehicle_details_form" method="POST">
                <h2>Update Vehicle Details</h2>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $details['id'];?>"/>
                    <label for="firstName" class="col-sm-3 control-label">Vehicle Name</label>
                    <div class="col-sm-6">
                        <input type="text" id="veh_name" name="veh_name" value="<?php echo $details['veh_name']; ?>" placeholder="" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="veh_type" class="col-sm-3 control-label">Vehicle Type</label>
                    <div class="col-sm-6">
                        <select id="veh_type" name="veh_type" class="form-control">
                            <option value="">Select Type</option>
                            <option value="Car" <?php if($details['veh_type'] == 'Car') echo "selected"; ?> >Car</option>
                            <option value="Bike" <?php if($details['veh_type'] == 'Bike') echo "selected"; ?> >Bike</option>
                            <option value="Bus" <?php if($details['veh_type'] == 'Bus') echo "selected"; ?> >Bus</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="man_year" class="col-sm-3 control-label">Year Of Manufacture</label>
                    <div class="col-sm-6">
                        <input type="number" id="man_year" name="man_year" value="<?php echo $details['man_year']; ?>" placeholder="" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="pur_date" class="col-sm-3 control-label">Date of Purchase</label>
                    <div class="col-sm-6">
                        <input type="date" id="pur_date" name="pur_date" class="form-control" value="<?php echo $details['pur_date']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Update</button>
                    </div>
                </div>
                <span id="update_msg"></span>
            </form> <!-- /form -->
        </div> 
        </div>
    </div>

    <script>
$(document).ready(function() {
    
    $("form#edit_vehicle_details_form").submit(function(e){
        e.preventDefault();
        var data = new FormData($("#edit_vehicle_details_form")[0]);
        $.ajax({
            type:'post',
            dataType:'json',
            processData: false,
            cache: false,
            contentType: false,
            url:"<?php echo base_url('home/update_vehicle_details'); ?>",
            data: data,
            beforeSend: function() {
                $("#update_msg").html('');
                $('#submit').prop("disabled",true);
            },
            success: function(response){
                $('#submit').prop("disabled",false);
                $("#update_msg").html(response.msg);
                
                if(response.status == 200) {
                window.location.href="<?php echo base_url('home'); ?>"
                }
            }
        });
        
    });
});

    </script>

</body>
</html>