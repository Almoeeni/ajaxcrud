<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<meta name="_token" content="{{csrf_token()}}" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<!-- <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js"></script> -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Hello, world!</title>
  </head>
    <style>
    .m-t-20 {
        margin-top : 20px;
    }
    </style>
  <body>
  <div class="container m-t-20 ">
  <h1>Pincode Form</h1>

        <div class="row">
            <div class="col-md-12">
                 <form id="form-submit">
                    <label for="pincode" class="mb-2 mr-sm-2">Pincode:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="pincode" placeholder="Enter Pincode" name="pincode">
                  
                    <label for="name" class="mb-2 mr-sm-2">Name:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="name" placeholder="Enter name" name="name">

                    <label for="email" class="mb-2 mr-sm-2">Email:</label>
                    <input type="email" class="form-control mb-2 mr-sm-2" id="email" placeholder="Enter email" name="email">

                    <div class="form-check mb-2 mr-sm-2">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="status" id="stus"> Status
                    </label>
                    </div>   
                <button type="button" class="btn btn-primary mb-2 sub" id="sbmit">Submit</button>
                </form>
            </div> 
        </div>

        <div class="row">
            <div class="col-md-12">
            <div id="mydata">
             <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Pincode</th>
                      <th>Name</th>
                      <th>Email</th>                    
                      <th>Status</th>    
                      <th>Date</th>
                     
                     
                      <th> </th>
                      <th> </th>
                    </tr>
                  </thead>
                  <tbody id="record">
                  
                  </tbody>
                </table>
           
            </div>
            </div>        
        </div>

  </div>
   




<script>
$(document).ready(function(){
    $('#sbmit').click(function(){
        $.ajaxSetup({
             headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }           
                });
    var formdata = $('#form-submit').serializeArray();
    
    $.ajax({
        'url':'/paginate-insert',
        'type':'post',
        'data':formdata,
        success:function(data){
        if(data.code==200)
          {
        
            alert(data.message);
            location.reload();
          }    
        if(data.code == 404)
        {
            alert(data.message);
        }
        },

    
    });
    });
});
</script>