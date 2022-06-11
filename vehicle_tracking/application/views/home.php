<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            <h1 style="font-weight:700;">Home</h1>
        </div>   
        
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" style="margin-top: 20px;" id="" href="<?php echo base_url('logout') ?>">Logout</a>
        </div>    
    </div>
</div>
    <div class="row">
        <div class="col-xs-6" id="details_div">  
            <div class="row">    
                <div class="col-md-12">
                    <table id="veh_data" class="table table-striped table-bordered ">
                        <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th style="width: 30px;" colspan="1" rowspan="1">Vehicle Name</th>
                            <th style="width: 30px;" colspan="1" rowspan="1">Vehicle Type</th>
                            <th style="width: 30px;" colspan="1" rowspan="1">Year of Manufacture</th>
                            <th style="width: 30px;" colspan="1" rowspan="1">Date of Purchase</th>
                            <th style="width:30px;" colspan="1" rowspan="1">Created at</th>
                            <th style="width:30px;" colspan="1" rowspan="1">Updated at</th>
                            <th>Action</th>
                        </tr>
                        </thead> 
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
        <div class="">
            <form class="form-horizontal" role="form" id="add_details_form" name="add_details_form" method="POST">
                <h2>Insert Vehicle Details</h2>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Vehicle Name</label>
                    <div class="col-sm-6">
                        <input type="text" id="veh_name" name="veh_name" placeholder="" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="veh_type" class="col-sm-3 control-label">Vehicle Type</label>
                    <div class="col-sm-6">
                        <select id="veh_type" name="veh_type" class="form-control">
                            <option value="">Select Type</option>
                            <option value="car">Car</option>
                            <option value="bike">Bike</option>
                            <option value="bus">Bus</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="man_year" class="col-sm-3 control-label">Year Of Manufacture</label>
                    <div class="col-sm-6">
                        <input type="number" id="man_year" name="man_year" placeholder="" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="pur_date" class="col-sm-3 control-label">Date of Purchase</label>
                    <div class="col-sm-6">
                        <input type="date" id="pur_date" name="pur_date" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </div>
                <span id="update_msg"></span>
            </form> <!-- /form -->
        </div> 
        </div>
    </div>


<script>

$(document).ready(function() {
    
    $("form#add_details_form").submit(function(e){
        e.preventDefault();
        var data = new FormData($("#add_details_form")[0]);
        $.ajax({
            type:'post',
            dataType:'json',
            processData: false,
            cache: false,
            contentType: false,
            url:"<?php echo base_url('home/submit_vehicle_details'); ?>",
            data: data,
            beforeSend: function() {
                $("#update_msg").html('');
                $('#submit_data').prop("disabled",true);
            },
            success: function(response){
                $('#submit_data').prop("disabled",false);
                $("#update_msg").html(response.msg);
                
                if(response.status == 200)
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        });
        
    });
});

        $(function() {
          var veh_data;
          veh_data = $('#veh_data').DataTable({ 
          fixedHeader: false,
          "pageLength": 10,
		  'searching':true,
          order: [[3, 'desc']], 
          "ajax" : 
          {
           url: "<?php echo base_url('home/get_vehicle_details_data') ?>",
           type: "post"
          }, 
          });
          
        });
        
function delete_data(id)
{
    $.ajax({
        type:'post',
        dataType:'json',
        url:"<?php echo base_url('home/delete_data'); ?>",
        data: {id:id},
        beforeSend: function() {

        },
        success: function(response){
            if(response.status == 200)
            $('#veh_data').DataTable().ajax.reload();
        }
    });
}
</script>

</body>
</html>