<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Additional Information <?php echo ucwords($products->namaProduct);?></h3>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li><a href="<?php echo $base_url_admin;?>products">Products</a></li>
          <li class="active">Additional Information : <?php echo $products->namaProduct;?></li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
          <button class="btn btn-sm btn-flat btn-primary" onclick="add_data()"><i class="fa fa-plus"></i>  Tambah Data Baru</button>
        <table id="tableslider" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead> 
                <tr>
                    <th width='10'>No.</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no=1;
                    foreach ($add_information->result() as $r) {
                        echo"
                            <tr>
                                <td>$no</td>
                                <td>$r->name</td>
                                <td>$r->value</td>
                                <td width='100' style='text-align:center'><div class='btn-group'>
                                    <button type='button' class='btn btn-default btn-xs btn-flat dropdown-toggle' data-toggle='dropdown'>Action <span class='caret'></span> 
                                        <span class='sr-only'>Toggle Dropdown</span>
                                    </button>
                                    <ul class='dropdown-menu' role='menu'>
                                        <li><a href='#' onclick='add_information_edit(".'"'.$r->id.'"'.")'>Edit</a></li>
                                        <li><a href='#' onclick='add_information_delete(".'"'.$r->id.'"'.")'>Delete</a></li>
                                    </ul></div>
                                </td>
                               
                            </tr>";
                    $no++;
                    }
                ?>
            </tbody>
        </table>
    <div class="box-footer">

        <?php
            echo anchor('admin/products/view','Kembali',array('class'=>'btn btn-flat btn-default'));
        ?>
    </div>
        </div>
      </div> <!-- row body -->
    </div> <!-- panel body -->
  </div> <!-- panel default -->
</div> <!-- sitecontent  -->      

<script type="text/javascript">
function confirmDialog() {
 return confirm('Apakah anda yakin?')

}

</script>


<script type="text/javascript">

var save_method; //for save method string
var table;

function add_data()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Data'); // Set Title to Bootstrap modal title
}

function add_information_edit(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/products/add_information_id')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="idProduct"]').val(data.idProduct);
            $('[name="name"]').val(data.name);
            $('[name="order"]').val(data.order);
            $('[name="value"]').val(data.value);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('admin/products/add_information_add')?>";
    } else {
        url = "<?php echo site_url('admin/products/add_information_edit')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                location.reload();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function add_information_delete(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('admin/products/add_information_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                    <input type="hidden" value="" name="id"/> 
                    <input type="hidden" value="<?php echo $this->uri->segment(4);?>" name="idProduct"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Name</label>
                            <div class="col-md-9">
                                <input name="name" placeholder="Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Order</label>
                            <div class="col-md-9">
                                <input name="order" placeholder="order" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Value</label>
                            <div class="col-md-9">
                                <input name="value" placeholder="Value" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->load->view('templates/backend/footer'); ?>      
