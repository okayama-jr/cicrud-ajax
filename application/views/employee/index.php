<div class="container">
    <h3>Employee List</h3>
    <div class="alert alert-success" style="display:none;">
    
    </div>
    <button id="btnAdd" class="btn btn-success">Add new</button>
    <table class="table table-bordered table-responsive" style="margin-top:20px">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="showData">

        </tbody>
    </table>
</div>

<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="form-horizontal" id="myForm">
            <input type="hidden" name="txtId" value="0">
            <div class="form-group">
                <label for="name" class="label-control col-md-4">Employee Name</label>
                <div class="col-md-8">
                    <input type="text" name="txtEmployeeName" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="label-control col-md-4">Address</label>
                <div class="col-md-8">
                    <textarea name="txtAddress" class="form-control"></textarea>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="deleteModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            Do you want to delete this employee?
      </div>
      <div class="modal-footer">
        <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(function(){
        showAllEmployee();

        //Add New
        $('#btnAdd').click(function(){
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Add New Employee');
            $('#myForm').attr('action','<?=base_url('employee/addEmployee');?>');
        });

        $('#btnSave').click(function(){
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();
            //validate form
            var employeeName = $('input[name=txtEmployeeName]');
            var address = $('textarea[name=txtAddress]');
            var result = '';
            if(employeeName.val() == ''){
                employeeName.parent().parent().addClass('has-error');
            }else{
                employeeName.parent().parent().removeClass('has-error');
                result += '1';
            }
            if(address.val()==''){
                address.parent().parent().addClass('has-error');
            }else{
                address.parent().parent().removeClass('has-error');
                result += '2';
            }

            if(result == '12'){
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#myModal').modal('hide');
                            $('#myForm')[0].reset();
                            if(response.type=='add'){
                                var type='Added';
                            }else if(response.type=='update'){
                                var type='Updated';
                            }
                            $('.alert-success').html('Employee '+type+' successfully').fadeIn().delay(4000).fadeOut();
                            showAllEmployee();
                        }else{
                            alert('Error');
                        }
                    },
                    error: function(){
                        alert('Could not add data');
                    }
                });
            }
        });

        //edit
        $('#showData').on('click', '.item-edit', function(){
            var id = $(this).attr('data');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Edit Employee');
            $('#myForm').attr('action','<?=base_url('employee/updateEmployee');?>');
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?=base_url('employee/editEmployee');?>',
                data: {id : id},
                async: false,
                dataType: 'json',
                success: function(data){
                    $('input[name=txtEmployeeName]').val(data.employee_name);
                    $('textarea[name=txtAddress]').val(data.address);
                    $('input[name=txtId]').val(data.id);
                },
                error: function(){
                    alert('Could not Edit Employee');
                }
            });
        });

        //delete
        $('#showData').on('click','.item-delete',function(){
            var id = $(this).attr('data');
            $('#deleteModal').modal('show');
            $('#btnDelete').unbind().click(function(){
                $.ajax({
                    type: 'ajax',
                    method: 'get',
                    async: false,
                    url: '<?=base_url('employee/deleteEmployee');?>',
                    data: {id:id},
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                        $('#deleteModal').modal('hide');
                        $('.alert-success').html('Employee Deleted Successfully').fadeIn().delay(4000).fadeOut('slow');
                        showAllEmployee();
                        }else{
                            alert('error!!!');
                        }
                    },
                    error: function(){
                        alser('Error Deleting');
                    }
                });
            });
        });

        //function
        function showAllEmployee(){
            $.ajax({
                type: 'ajax',
                url: '<?=base_url('employee/showAllEmployee');?>',
                async: false,
                dataType: 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                    '<td>'+data[i].id+'</td>'+
                                    '<td>'+data[i].employee_name+'</td>'+
                                    '<td>'+data[i].address+'</td>'+
                                    '<td>'+data[i].created_at+'</td>'+
                                    '<td>'+
                                        '<a href="javascript:;" class="btn btn-info item-edit" data="'+data[i].id+'">Edit</a>'+
                                        '<a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</a>'+
                                    '</td>'+
                                '</tr>';
                    }
                    $('#showData').html(html);
                },
                error: function(){
                    alert('Could not get data from Database');
                }
            });
        }
    });
</script>