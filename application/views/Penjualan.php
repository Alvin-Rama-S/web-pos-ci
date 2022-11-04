<html>
<head>
    <title>Tabel Penjualan</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    
</head>
<body>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a>Tabel Jual</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Data</li>
            </ol>
        </nav>
        <div class="card">
            <div class="col-md-12 mt-3">
                    <button type="button" id="add_button" class="btn btn-info btn-lg">Add</button>
                </div>
            <div class="card-body">
                <span id="success_message"></span>
                <table class="table table-bordered table-striped">
                    <thead align="center">
                        <tr class="table-success">
                            <th>ID</th>
                            <th>Kode Barang</th>
                            <th>Tanggal Jual</th>
                            <th>Jumlah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="">Add Jual</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>ID</label>
                    <input type="text" name="idjual" id="idjual" class="form-control" readonly="hidden" />
                    <span id="idjual_error" class="text-danger"></span>
                    <br />
                    <label>Kode Barang</label>
                    <input type="text" name="kdbarang" id="kdbarang" class="form-control" />
                    <span id="kdbarang_error" class="text-danger"></span>
                    <br />
                    <label>Tanggal Jual</label>
                    <input type="date" name="tgljual" id="tgljual" class="form-control" />
                    <span id="tgljual_error" class="text-danger"></span>
                    <br />
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" />
                    <span id="jumlah_error" class="text-danger"></span>
                    <br />
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="data_action" id="data_action" value="Insert" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
    
    function fetch_data()
    {
        $.ajax({
            url:"<?php echo base_url(); ?>PenjualanController/action",
            method:"POST",
            data:{data_action:'fetch_all'},
            success:function(data)
            {
                $('tbody').html(data);
            }
        });
    }

    fetch_data();

    $('#add_button').click(function(){
        $('#user_form')[0].reset();
        $('.modal-title').text("Add User");
        $('#action').val('Add');
        $('#data_action').val("Insert");
        $('#userModal').modal('show');
    });

    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        $.ajax({
            url:"<?php echo base_url() . 'PenjualanController/action' ?>",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            {
                if(data.success)
                {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    fetch_data();
                    if($('#data_action').val() == "Insert")
                    {
                        $('#success_message').html('<div class="alert alert-success">Data Inserted</div>');
                    }
                }

                if(data.error)
                {
                    $('#idjual_error').html(data.idjual_error);
                    $('#kdbarang_error').html(data.kdbarang_error);
                    $('#tgljual_error').html(data.tgljual_error);
                    $('#jumlah_error').html(data.jumlah_error);
                }
            }
        })
    });

    $(document).on('click', '.edit', function(){
        var idjual = $(this).attr('id');
        $.ajax({
            url:"<?php echo base_url(); ?>PenjualanController/action",
            method:"POST",
            data:{idjual:idjual, data_action:'fetch_single'},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#idjual').val(data.idjual);
                $('#kdbarang').val(data.kdbarang);
                $('#tgljual').val(data.tgljual);
                $('#jumlah').val(data.jumlah);
                $('.modal-title').text('Edit User');
                $('#idjual').val(idjual);
                $('#action').val('Edit');
                $('#data_action').val('Edit');
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var idjual = $(this).attr('id');
        if(confirm("Are you sure you want to delete this?"))
        {
            $.ajax({
                url:"<?php echo base_url(); ?>PenjualanController/action",
                method:"POST",
                data:{idjual:idjual, data_action:'Delete'},
                dataType:"JSON",
                success:function(data)
                {
                    if(data.success)
                    {
                        $('#success_message').html('<div class="alert alert-success">Data Deleted</div>');
                        fetch_data();
                    }
                }
            })
        }
    });
    
});
</script>