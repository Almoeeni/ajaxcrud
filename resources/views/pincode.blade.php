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
            <div class="col-md-6">
                 <form id="form-submit">
                    <label for="pincode" class="mb-2 mr-sm-2">Pincode:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="pincode" placeholder="Enter Pincode" name="pincode">
                  
                    <label for="name" class="mb-2 mr-sm-2">Name:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="name" placeholder="Enter name" name="name">

                    <label for="nice" class="mb-2 mr-sm-2">Nick:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="nick" placeholder="Enter nick" name="nick">

                    <div class="form-check mb-2 mr-sm-2">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="status" id="stus"> Status
                    </label>
                    </div>   
                <button type="button" class="btn btn-primary mb-2 sub" id="sbmit">Submit</button>
                </form>
            </div>

            <div class="col-md-6 " id="mydata2">
            <div id="mydata">
             <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Pincode</th>
                      <th>Name</th>
                      <th>nick</th>                    
                      <th>Date</th>    
                      <th>status</th>
                     
                     
                      <th> </th>
                      <th> </th>
                    </tr>
                  </thead>
                  <tbody id="record">
                  
                  </tbody>
                </table>
            
            <div class="nav-btn-container">
              <button class="prev-btn"  id="previos">Prev</button>
              <button class="next-btn" id="next">next</button>
            </div>
            </div>
            </div>
        </div>

  </div>
   






<div class="modal fade" id="myModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="linkEditorModalLabel">Update form </h4>
                        </div>
                        <div class="modal-body">
                            <form id="modalFormData" name="modalFormData" class="form-horizontal" >
						  		<input name="id" type="hidden" id="ids">

                                <div class="form-group">
                                    <label for="inputLink" class="col-sm-2 control-label">Pincode</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="pincodec" name="pincode"
                                              value="">
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label for="inputLink" class="col-sm-2 control-label">name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="mname" name="name"
                                              value="">
                                    </div>
                                </div>
 
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nick</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nickc" name="nick"
                                              value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">status</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" class="form-check-input" id="statusc" name="statusc" >
                                    </div>                                 
                                    
                                </div>
							
                            </form>
                        </div>
                        <div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="btn-update" value="add">Save changes
                            </button>
                            <input type="hidden" id="link_id" name="link_id" value="0">
                        </div>
                    </div>
                </div>
            </div>




    
  </body>
</html>


<script>


	 $(document).on('click', '.l',function(){
     $("#pincodec").val($(this).data('pin'));
	 $('#mname').val($(this).data('name'));
     $('#nickc').val($(this).data('nick'));    
     $('#ids').val($(this).data('id'));
     var chk =$(this).data('status');
     if(chk === 1)
     {
       $('#statusc').prop('checked', true);
     }

   $('#myModal').modal('show');	
			
		
	});

    $(document).ready(function(){

        //Create the form 
       $('#sbmit').click(function(){
             	$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
            var formdata = $('#form-submit').serializeArray();
                $.ajax({
                    type: 'POST',
                    url: 'make-it',
                    data: formdata
                });
       });
       
               

          $(document).on('click', '.next-btn',function(){
              //debugger;
                var page = $(this).data("page");
            
                var per_page = $(this).data("per_page");
                var total = $(this).data("total");
                if(page * per_page < total)
                    {
                        page++;                       
                        $("#mydata").load(location.href + " #mydata");
                        query(page);
                    }    
                 });
          $(document).on('click', '#previos',function(){
              //debugger;
                var page = $(this).data("page");
                console.log(page);
                var per_page = $(this).data("per_page");
                var total = $(this).data("total");
                if(page > 1)
                    {
                        page--;                       
                        $("#mydata").load(location.href + " #mydata");
                        query(page);
                    }    
                 });

       // Get the form 
       query();
       function query(page)
       {
          
        var  page1 = 0;
       if(page1 < page)
       {
             page1 = page;
       }
       console.log(page1);
       $.ajax({
        'type' : 'GET',
        'url'  : 'fetch',
        'data' : {
            page1
        },
        success:function(data)
        {
            var obj        =  $.parseJSON(data);
            var ob2        =  obj.data.data;
            var cr         =  obj.data;   //$('#next').val(cr.current_page);
            var page       =  $('#next').attr('data-page',cr.current_page);
            var per_page   =  $('#next').attr('data-per_page',cr.per_page);
            var total_page =  $('#next').attr('data-total',cr.total);
             var pre_page       =  $('#previos').attr('data-page',cr.current_page);
           //console.log(total_page);
           $.each(ob2 ,function(value,item) {
               
                 var dat = "<tr><td>"  +item.pincode +  "</td> <td>" + item.name + "</td> <td> "+ item.nick + " </td> <td> " + item.created_at+ " </td> <td> " + item.pin_status+ 
                         "</td> <td> <button data-id='"+item.id+"' data-pin='"+item.pincode+"' data-name='"+item.name+"' data-nick='"+item.nick+"' data-status='"+item.pin_status+"'  class='l btn btn-primary  '> edit</button></td> <td> <button id='dele'  data-id='"+item.id+"' class='btn btn-danger '>Delete</button></td></tr>";
                         $("#record").append(dat);                
           });
        }
       });
       }

        $(document).on('click', '#dele',function(){
        alert();
       });

       //edit the form
        $('#btn-update').click(function(){
             	$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
             
                $.ajax({
                    type: 'POST',
                    url: 'edit-it',
                    data: $('#modalFormData').serialize(),
                    success:function(data)
                    {
                         $("#mydata").load(location.href + " #mydata");
                         $('#myModal').modal('hide');	
                         query();
                    }
                });
       });

    

       //Delete the record
       $('.del').click(function(){
             	$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                var del = $(this).data("id")
                $.ajax({
                    type: 'POST',
                    url: 'del-it',
                    data: {
                        del : del
                    }
                });
       });

    });

</script>



<script type="text/javascript">
window.query = '<?php echo !empty($_GET['query']) ? $_GET['query'] : ' '; ?>';
window.key = '<?php echo !empty($_GET['key']) ? $_GET['key'] : ' '; ?>';
$('.btnv').click(function(){
     $('#keysearch').val("");
     window.key = "";
     window.query = $(this). attr("value");
     var page = 1;
     var key = window.key;
     fetch_data(page, query, key);
});

$('#keysearch').keypress(function(e) {
    var keycode = e.keyCode || e.which;
    window.key = $('#keysearch').val();
    if(key != " ")
    {
        key = window.key;
        var query = key;
        var page = 1;
        if(keycode == '13') {
             fetch_data(page, query, key);
        }
    }
    else 
    {
       alert('Please enter some text');
    }
});
$(document).on('click', '.pagination a', function(e){
   e.preventDefault(); 
   $('li').removeClass('active');
   $(this).parent('li').addClass('active');  
   var myurl = $(this).attr('href');
   var page = $(this).attr('href').split('page=')[1];
   var query = window.query; 
   var key = window.key;
   fetch_data(page, query, key);
});

function fetch_data(page, query,key)
{
  $.ajax({
    url:"/modules/employees-directory/employee-directory-list/?page="+page+"&query="+query+"&key="+key,
  }).done(function(data){
    $("#tag_container").html(data);
     location.hash = page;
  }).fail(function(jqXHR, ajaxOptions, thrownError){
     alert('No response from server');
    });
 }
</script>