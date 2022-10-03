<div class="page-header page-header-default">
  <div class="page-header-content">
    <div class="page-title">
      <h4><a href="javascript:window.history.back();"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold"> <a href="<?= base_url('dashboard'); ?>">Dashboard</a></span> - <a href="<?= base_url($this->uri->segment(2)); ?>">
          <?= ucfirst($this->uri->segment(2)); ?>
        </a></h4>
    </div>
  </div>
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="<?= base_url('dashboard'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
      <li class="active"><a href="<?= base_url($this->uri->segment(2)); ?>">
          <?= ucfirst($this->uri->segment(2)); ?>
        </a></li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">

  <!-- Horizontal form options -->
  <div class="row">
    <div class="panel panel-flat">
      <div class="panel-heading">
        <h5 class="panel-title"></h5>

      </div>
      <div class="panel-body">
        <div class="row">

        </div>
        <div class="row">
          <?php echo $this->session->flashdata('msg'); ?>
          <div class="col-md-12">
            <fieldset>
              <legend class="text-semibold">
                <?= ucfirst($this->uri->segment(2)); ?>
                List</legend>
              <!-- Ajax sourced data -->
              <table class="table datatable-cutomerlist">
                <thead>
                  <th>Customer Name</th>
                  <th>Customer Code</th>
                  <th>Mobile</th>
                  <th>Alternate Mobile</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th style="width:120px;">Actions</th>
                </thead>
              </table>
              <!-- /ajax sourced data -->
            </fieldset>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- Show data modal -->
<div id="modal_show" class="modal fade" data-backdrop="false" style="overflow-y:scroll">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:7px 20px; height:35px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title btn btn-info" id="cuto">

        </h5>
      </div>

      <?php echo $this->session->flashdata('msg'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
              <li class="active"><a href="#justified-badges-tab1" data-toggle="tab">Customer Detail</a></li>
              
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="justified-badges-tab1">
                <div class="row">
                  <div class="pull-left" id="restbtn" style="padding:5px;">

                  </div>
                  <div class="pull-right" id="addnewproduct" style="padding:5px;">

                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-12">
                    <h6 class="bg-info">&nbsp;Customer Information</h6>
                    <div class="col-sm-6">
                      <p>Name : <strong><span id="showname"></span></strong></p>
                      <p>Mobile : <strong><span id="showmobile"></span></strong></p>
                      <p>Email : <strong><span id="showemail"></span></strong></p>
                    </div>
                    <div class="col-sm-6">
                      <p>Alternate Mobile : <strong><span id="showalternate"></span></strong></p>
                      <p>Landline Number : <strong><span id="showlandline"></span></strong></p>
                      <p>Address : <strong><span id="showaddress"></span></strong></p>
                      <p>Status : <strong><span id="showstatus"></span></strong></p>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <h6 class="bg-info">&nbsp;Product Information</h6>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Product Name</th>
                          <th>Service</th>
                          <th>AMC/Warrany Start Date</th>
                          <th>AMC/Warrany End Date</th>
                          <th>Address</th>
                          <th>MS Dates</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="productlist">

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /badges -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>
    </div>
  </div>
</div>
<!-- /Show data modal -->
<!-- Product Details modal -->
<div id="modal_productdetail" class="modal fade" data-backdrop="false" style="z-index:99999;">
  <div class="modal-dialog modal-ms" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:7px 20px; height:35px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title btn btn-info"> Update Product Details
        </h5>
      </div>
      <?= form_open_multipart('secure/customer/updateservicedetail', array('class' => 'form-horizontal', 'id' => 'editproductdetail')); ?>
      <?php echo $this->session->flashdata('msg'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="form-group">
            <label class="col-lg-3 control-label">Product:</label>
            <div class="col-lg-9">
              <select name="product_id" id="editproduct_id" class="form-control">
                <?php foreach ($productlist as $product) { ?>
                  <option value="<?= $product['id']; ?>"><?= $product['product_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Service:</label>
            <div class="col-lg-9">
              <select name="service_id" id="editservice_id" class="form-control">
                <?php foreach ($servicelist as $service) { ?>
                  <option value="<?= $service['id']; ?>"><?= $service['service_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">AMC/Warrany Start Date:</label>
            <div class="col-lg-9">
              <input type="date" id="wreminder_start_date" name="wreminder_start_date" class="form-control" required />

            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">AMC/Warrany End Date:</label>
            <div class="col-lg-9">
              <input type="date" id="wreminder_end_date" name="wreminder_end_date" class="form-control" required />

            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Address:</label>
            <div class="col-lg-9">
              <textarea rows="5" cols="5" class="form-control" placeholder="Address" id="paddress" name="paddress" required>
</textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="btn" id="reminder_btn" value="Submit" />
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>
<!-- /Product Details modal -->


<script type="application/x-javascript">
  

  function showdetail(id) {
    $('#modal_show').modal('toggle');
    $.ajax({
      url: '<?= base_url("secure/customer/getdetail"); ?>',
      type: 'post',
      data: 'id=' + id,
      dataType: 'json',
      success: function(result) {
        console.log(result);
        if (result.status == true) {
          $('#showdataid').val(result.data.id);
          $('#cuto').html('#' + result.data.customer_code + ' - ' + result.data.customer_name);
          $('#showname').html(result.data.customer_name);
          $('#showmobile').html(result.data.mobile);
          $('#showemail').html(result.data.email);
          $('#showalternate').html(result.data.alternate_mobile);
          $('#showlandline').html(result.data.landline_no);
          $('#showaddress').html(result.data.address);
          $('#showstatus').html(result.data.status);
          $('#addnewproduct').html('<?php if (in_array('product-add', $this->GroupPermission)) { ?><a onClick="workassign(' + result.data.id + ')" class="btn btn-info"><i class="fa fa-mail-forward"></i> Add New Product</a><?php } ?>');
          $('#restbtn').html('<?php if (in_array('leads-edit', $this->GroupPermission)) { ?><a onClick="editdetail(' + result.data.id + ')"><i class="fa fa-edit fa-1x" style="font-size:18px;"></i> Edit</a><?php }
           if (in_array('leads-delete', $this->GroupPermission)) { ?>&nbsp;<a onClick="deleterow(' + result.data.id + ');"><i class="fa fa-trash fa-1x" style="color:red; font-size:18px;"></i>Delete</a><?php } ?>');
          $('#complaintbtn').html('<a onClick="addreminder(' + result.data.id + ')" class="btn btn-info"><i class="fa fa-bell"></i> Add Complaint</a>');
          productlist(id);
        } else if (result.status == false) {
          new PNotify({
            title: 'Error!',
            text: 'Try Again',
            addclass: 'bg-danger'
          });
          location.reload();
        }

      }

    });
  }

  function productlist(id) {
    $.ajax({
      url: '<?= base_url("secure/customer/productlist"); ?>',
      type: 'post',
      data: 'id=' + id,
      success: function(html) {
        console.log(html);
        $('#productlist').html(html);

      }

    });
  }


  function editproductdetail(id) {
    $('#modal_productdetail').modal('toggle');
    $.ajax({
      url: '<?= base_url("secure/customer/getservicedetail"); ?>',
      type: 'post',
      data: 'id=' + id,
      dataType: 'json',
      success: function(result) {
        console.log(result);
        if (result.status == true) {
          $("#editproduct_id option").each(function() {
            if ($(this).val() === result.data.product_id) {
              $(this).prop('selected', true);
            }
          });
          $("#editservice_id option").each(function() {
            if ($(this).val() === result.data.service_id) {
              $(this).prop('selected', true);
            }
          });
          $('#wreminder_start_date').val(result.data.amc_start_date);
          $('#wreminder_end_date').val(result.data.amc_end_date);
          $('#paddress').html(result.data.address);
        } else if (result.status == false) {
          new PNotify({
            title: 'Error!',
            text: 'Try Again',
            addclass: 'bg-danger'
          });
          location.reload();
        }

      }

    });
  }
</script>