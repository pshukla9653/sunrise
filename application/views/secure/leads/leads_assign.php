<div class="page-header page-header-default">
  <div class="page-header-content">
    <div class="page-title">
      <h4><a href="javascript:window.history.back();"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold"> <a href="<?= base_url('secure/dashboard'); ?>">Dashboard</a></span> - <a href="#">
          Assign Work Lead
        </a></h4>
    </div>
  </div>
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="<?= base_url('dashboard'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
      <li class="active"><a href="#">
          Assign Work Lead
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
        <?php if ($this->session->userdata('group_id') == 4) { ?>
          <div class="row">

            <form action="<?= base_url('secure/leads/gettodayassignlead'); ?>" method="post">
              <div class="col-md-12">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>From Date:</label>
                    <input type="date" class="form-control" value="<?= date("Y-m-d"); ?>" name="datefrom" />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>From To:</label>
                    <input type="date" class="form-control" value="<?= date("Y-m-d"); ?>" name="dateto" />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Work Assigned To:</label>
                    <select name="workassignedu" class="form-control">
                      <option value="">Select</option>
                      <?php foreach ($workuserlist as $w) { ?>
                        <option value="<?= $w['id']; ?>"><?= $w['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <input type="submit" class="btn btn-info" value="Search" name="btn" style="margin-top:28px" />
                </div>
              </div>
            </form>

          </div>
        <?php } ?>
        <div class="row">
          <?php echo $this->session->flashdata('msg'); ?>
          <div class="col-md-12">
            <fieldset>
              <legend class="text-semibold">
                <?= ucfirst($this->uri->segment(2)); ?> Reminder
                List</legend>
              <!-- Ajax sourced data -->
              <table class="table datatable-basic">
                <thead>
                  <th>Customer Name</th>

                  <th>Mobile</th>
                  <th>Description</th>

                  <?php if ($this->session->userdata('group_id') <= 4) {  ?>
                    <th>Followup Assigned</th>
                    <th>Work Assigned</th>
                    <th>Work Status</th>
                  <?php } ?>
                  <th>Reminder On</th>
                  <th style="width:120px;">Actions</th>
                  <th>Product Name</th>
                  <th>Service Name</th>
                </thead>
                <tbody>
                  <?php foreach ($leadList as $lead) { ?>
                    <tr>
                      <td><?= $lead['cutomer_name']; ?></td>

                      <td><?= $lead['mobile']; ?></td>
                      <td><?= $lead['description']; ?></td>

                      <?php if ($this->session->userdata('group_id') <= 4) {  ?>
                        <td><?= $lead['username']; ?></td>
                        <td><?= $lead['work_assigned']; ?></td>
                        <td><?= $lead['work_status']; ?></td>
                      <?php } ?>
                      <td><?= $lead['reminder_on']; ?></td>
                      <td><?= $lead['action']; ?></td>
                      <td><?= $lead['product']; ?></td>
                      <td><?= $lead['service']; ?></td>
                    </tr>

                  <?php  } ?>
                </tbody>
              </table>
              <!-- /ajax sourced data -->
            </fieldset>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Lead modal -->
<div id="modal_default" class="modal fade" data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:7px 20px; height:35px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title btn btn-info">Add
          <?= ucfirst($this->uri->segment(2)); ?>
        </h5>
      </div>
      <?= form_open_multipart('secure/leads/add', array('class' => 'form-horizontal', 'id' => 'addlead')); ?>
      <?php echo $this->session->flashdata('msg'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group col-md-3">
              <label class="control-label">Product:</label>
              <select class="form-control select2" name="product_id" id="product_id">
                <option value="">Select</option>
                <?php foreach ($Productlist as $s) : ?>
                  <option value="<?= $s['id']; ?>">
                    <?= $s['product_name']; ?>
                  </option>
                <?php endforeach; ?>
                <option value="0" selected>Other</option>
              </select>
              <span class="text-danger">
                <?= form_error('product_id'); ?>
              </span>
            </div>
            <div class="form-group col-md-3">
              <label class="control-label">Service Type:</label>
              <select class="form-control select2" name="service_id" id="service_id">
                <option value="">Select</option>
                <?php foreach ($servicelist as $s) : ?>
                  <option value="<?= $s['id']; ?>">
                    <?= $s['service_name']; ?>
                  </option>
                <?php endforeach; ?>
                <option value="0" selected>Other</option>
              </select>
              <span class="text-danger">
                <?= form_error('service_id'); ?>
              </span>
            </div>
            <div class="form-group col-md-2">
              <label class="control-label">Source:</label>
              <select class="form-control select2" name="source_id" id="source_id">
                <option value="">Select</option>
                <?php foreach ($sourceslist as $s) : ?>
                  <option value="<?= $s['id']; ?>">
                    <?= $s['sources_name']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <span class="text-danger">
                <?= form_error('source_id'); ?>
              </span>
            </div>
            <div class="form-group col-md-2">
              <label class="control-label">Status:</label>
              <select class="form-control select2" name="status_id" id="status_id">
                <option value="">Select</option>
                <?php foreach ($Statuslist as $s) : ?>
                  <option value="<?= $s['id']; ?>">
                    <?= $s['status_name']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <span class="text-danger">
                <?= form_error('status_id'); ?>
              </span>
            </div>
            <?php if ($this->session->userdata('group_id') == 4) { ?>
              <div class="form-group col-md-2">
                <label class="control-label">Followup Assigned:</label>
                <select class="form-control" name="followup_assigned" id="followup_assigned">
                  <option value="<?= $this->session->userdata('id'); ?>">
                    <?= $this->session->userdata('name'); ?>
                  </option>
                  <?php foreach ($Userlist as $s) : ?>
                    <option value="<?= $s['id']; ?>">
                      <?= $s['name']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <span class="text-danger">
                  <?= form_error('followup_assigned'); ?>
                </span>
              </div>
            <?php } ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-lg-3 control-label">Name:</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" placeholder="Name of the Customer" name="customer_name" id="customer_name" value="<?= set_value('customer_name'); ?>" autocomplete="off">
                <span class="text-danger">
                  <?= form_error('customer_name'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Mobile</label>
              <div class="col-lg-9">
                <input type="number" placeholder="9999999999" max="9999999999" min="6666666666" class="form-control" id="mobile" name="mobile" value="<?= set_value('mobile'); ?>">
                <span class="text-danger">
                  <?= form_error('mobile'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Email</label>
              <div class="col-lg-9">
                <input type="text" placeholder="example@domain.com" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>">
                <span class="text-danger">
                  <?= form_error('email'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Alternate Mobile</label>
              <div class="col-lg-9">
                <input type="number" placeholder="9999999999" max="9999999999" min="6666666666" class="form-control" id="alternate_mobile" name="alternate_mobile" value="<?= set_value('alternate_mobile'); ?>">
                <span class="text-danger">
                  <?= form_error('alternate_mobile'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Landline Number</label>
              <div class="col-lg-9">
                <input type="text" placeholder="000-00000" class="form-control" name="landline_no" id="landline_no" value="<?= set_value('landline_no'); ?>">
                <span class="text-danger">
                  <?= form_error('landline_no'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Description:</label>
              <div class="col-lg-9">
                <textarea rows="5" cols="5" class="form-control" placeholder="Description" id="description" name="description"><?= set_value('description'); ?>
</textarea>
              </div>
              <span class="text-danger">
                <?= form_error('description'); ?>
              </span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-lg-3 control-label">Address:</label>
              <div class="col-lg-9">
                <textarea rows="5" cols="5" class="form-control" placeholder="Street Address" id="address" name="address"><?= set_value('address'); ?>
</textarea>
              </div>
              <span class="text-danger">
                <?= form_error('address'); ?>
              </span>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Country:</label>
              <div class="col-lg-9">
                <select class="form-control" name="country_id" id="country_id">
                  <option value="">Select</option>
                  <?php foreach ($countrieslist as $c) { ?>
                    <option value="<?= $c['country_id']; ?>">
                      <?= $c['country_name']; ?>
                    </option>
                  <?php } ?>
                </select>
                <span class="text-danger">
                  <?= form_error('country_id'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">State:</label>
              <div class="col-lg-9">
                <select class="form-control" name="state_id" id="state_id">
                </select>
                <span class="text-danger">
                  <?= form_error('state_id'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">City:</label>
              <div class="col-lg-9">
                <select class="form-control" name="city_id" id="city_id">
                </select>
                <span class="text-danger">
                  <?= form_error('city_id'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">PIN Code:</label>
              <div class="col-lg-9">
                <input type="text" placeholder="000000" class="form-control" id="zip_code" name="zip_code" <?= set_value('zip_code'); ?>>
                <span class="text-danger">
                  <?= form_error('zip_code'); ?>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="btn" value="Save" />
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>
<!-- /Add Lead modal -->

<!-- Update Lead modal -->
<div id="modal_edit" class="modal fade" data-backdrop="false" style="z-index:99999;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:7px 20px; height:35px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title btn btn-info">Update
          <?= ucfirst($this->uri->segment(2)); ?>
        </h5>
      </div>
      <?= form_open_multipart('secure/leads/update', array('class' => 'form-horizontal', 'id' => 'updatelead')); ?>
      <?php echo $this->session->flashdata('msg'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group col-md-3">
              <label class="control-label">Product:</label>
              <select class="form-control" name="product_id" id="editproduct_id">
                <option value="">Select</option>
                <?php foreach ($Productlist as $s) : ?>
                  <option value="<?= $s['id']; ?>">
                    <?= $s['product_name']; ?>
                  </option>
                <?php endforeach; ?>
                <option value="0">Other</option>
              </select>
              <span class="text-danger">
                <?= form_error('product_id'); ?>
              </span>
            </div>
            <div class="form-group col-md-3">
              <label class="control-label">Service Type:</label>
              <select class="form-control" name="service_id" id="editservice_id">
                <option value="">Select</option>
                <?php foreach ($servicelist as $s) : ?>
                  <option value="<?= $s['id']; ?>">
                    <?= $s['service_name']; ?>
                  </option>
                <?php endforeach; ?>
                <option value="0">Other</option>
              </select>
              <span class="text-danger">
                <?= form_error('service_id'); ?>
              </span>
            </div>
            <div class="form-group col-md-2">
              <label class="control-label">Source:</label>
              <select class="form-control" name="source_id" id="editsource_id">
                <option value="">Select</option>
                <?php foreach ($sourceslist as $s) : ?>
                  <option value="<?= $s['id']; ?>">
                    <?= $s['sources_name']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <span class="text-danger">
                <?= form_error('source_id'); ?>
              </span>
            </div>
            <div class="form-group col-md-2">
              <label class="control-label">Status:</label>
              <select class="form-control" name="status_id" id="editstatus_id">
                <option value="">Select</option>
                <?php foreach ($Statuslist as $s) : ?>
                  <option value="<?= $s['id']; ?>">
                    <?= $s['status_name']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <span class="text-danger">
                <?= form_error('status_id'); ?>
              </span>
            </div>
            <?php if ($this->session->userdata('group_id') == 4) { ?>
              <div class="form-group col-md-2">
                <label class="control-label">Followup Assigned:</label>
                <select class="form-control" name="followup_assigned" id="editfollowup_assigned">
                  <option value="<?= $this->session->userdata('id'); ?>">
                    <?= $this->session->userdata('name'); ?>
                  </option>
                  <?php foreach ($Userlist as $s) : ?>
                    <option value="<?= $s['id']; ?>">
                      <?= $s['name']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <span class="text-danger">
                  <?= form_error('followup_assigned'); ?>
                </span>
              </div>
            <?php } ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-lg-3 control-label">Name:</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" placeholder="Name of the Customer" name="customer_name" id="editcustomer_name" value="<?= set_value('customer_name'); ?>" autocomplete="off">
                <input type="hidden" name="id" id="editid" />
                <span class="text-danger">
                  <?= form_error('customer_name'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Mobile</label>
              <div class="col-lg-9">
                <input type="number" placeholder="9999999999" max="9999999999" min="6666666666" class="form-control" id="editmobile" name="mobile" value="<?= set_value('mobile'); ?>">
                <span class="text-danger">
                  <?= form_error('mobile'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Email</label>
              <div class="col-lg-9">
                <input type="email" placeholder="example@domain.com" class="form-control" id="editemail" name="email" value="<?= set_value('email'); ?>">
                <span class="text-danger">
                  <?= form_error('email'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Alternate Mobile</label>
              <div class="col-lg-9">
                <input type="number" placeholder="9999999999" max="9999999999" min="6666666666" class="form-control" id="editalternate_mobile" name="alternate_mobile" value="<?= set_value('alternate_mobile'); ?>">
                <span class="text-danger">
                  <?= form_error('alternate_mobile'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Landline Number</label>
              <div class="col-lg-9">
                <input type="text" placeholder="000-00000" class="form-control" name="landline_no" id="editlandline_no" value="<?= set_value('landline_no'); ?>">
                <span class="text-danger">
                  <?= form_error('landline_no'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Work Status</label>
              <div class="col-lg-9">
                <select name="work_status" class="form-control" id="editwork_status">
                  <option value="0">Assigned</option>
                  <option value="1">Done</option>
                  <option value="2">Not Done</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Description:</label>
              <div class="col-lg-9">
                <textarea rows="5" cols="5" class="form-control" placeholder="Description" id="editdescription" name="description"><?= set_value('description'); ?>
</textarea>
              </div>
              <span class="text-danger">
                <?= form_error('description'); ?>
              </span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-lg-3 control-label">Address:</label>
              <div class="col-lg-9">
                <textarea rows="5" cols="5" class="form-control" placeholder="Street Address" id="editaddress" name="address"><?= set_value('address'); ?>
</textarea>
              </div>
              <span class="text-danger">
                <?= form_error('address'); ?>
              </span>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Country:</label>
              <div class="col-lg-9">
                <select class="form-control" name="country_id" id="editcountry_id">
                  <option value="">Select</option>
                  <?php foreach ($countrieslist as $c) { ?>
                    <option value="<?= $c['country_id']; ?>">
                      <?= $c['country_name']; ?>
                    </option>
                  <?php } ?>
                </select>
                <span class="text-danger">
                  <?= form_error('country_id'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">State:</label>
              <div class="col-lg-9">
                <select class="form-control" name="state_id" id="editstate_id">
                  <option value="">Select</option>
                  <?php foreach ($statelist as $c) { ?>
                    <option value="<?= $c['state_id']; ?>">
                      <?= $c['state_name']; ?>
                    </option>
                  <?php } ?>
                </select>
                <span class="text-danger">
                  <?= form_error('state_id'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">City:</label>
              <div class="col-lg-9">
                <select class="form-control" name="city_id" id="editcity_id">
                  <option value="">Select</option>
                  <?php foreach ($citylist as $c) { ?>
                    <option value="<?= $c['city_id']; ?>">
                      <?= $c['city_name']; ?>
                    </option>
                  <?php } ?>
                </select>
                <span class="text-danger">
                  <?= form_error('city_id'); ?>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">PIN Code:</label>
              <div class="col-lg-9">
                <input type="text" placeholder="000000" class="form-control" id="editzip_code" name="zip_code" <?= set_value('zip_code'); ?>>
                <span class="text-danger">
                  <?= form_error('zip_code'); ?>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="btn" value="Update" />
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>
<!-- /Update Lead modal -->

<!-- Lead Followup modal -->
<div id="modal_followup" class="modal fade" data-backdrop="false" style="z-index:99999;">
  <div class="modal-dialog modal-ms" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:7px 20px; height:35px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title btn btn-info"> Add Followup Reminder
        </h5>
      </div>
      <?= form_open_multipart('secure/leads/addreminder', array('class' => 'form-horizontal', 'id' => 'addreminder')); ?>
      <?php echo $this->session->flashdata('msg'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="form-group">
            <label class="col-lg-3 control-label">Reminder Date:</label>
            <div class="col-lg-9">
              <input type="date" id="reminder_date" name="reminder_date" class="form-control" required />
              <input type="hidden" name="reminder_id" id="reminder_id" />
            </div>
            <span class="text-danger">
              <?= form_error('address'); ?>
            </span>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Description:</label>
            <div class="col-lg-9">
              <textarea rows="5" cols="5" class="form-control" placeholder="Description" id="reminder_description" name="reminder_description" required>
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
<!-- /Lead Followup modal -->

<!-- Work Assignment modal -->
<div id="modal_workassign" class="modal fade" data-backdrop="false" style="z-index:99999;">
  <div class="modal-dialog modal-ms" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:7px 20px; height:35px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title btn btn-info"> Work Assigned To
        </h5>
      </div>
      <?= form_open_multipart('secure/leads/workassgned', array('class' => 'form-horizontal', 'id' => 'workassgned')); ?>
      <?php echo $this->session->flashdata('msg'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="form-group">
            <label class="col-lg-3 control-label">Work Assigned To:</label>
            <div class="col-lg-9">
              <select name="workassigned" id="workassigned" class="form-control" required>
                <option value="">Select</option>
                <?php foreach ($workuserlist as $w) { ?>
                  <option value="<?= $w['id']; ?>"><?= $w['name']; ?></option>
                <?php } ?>
              </select>

            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Work Assigned on:</label>
            <div class="col-lg-9">
              <input type="date" id="work_assign_on" name="work_assign_on" class="form-control" value="<?= date("Y-m-d"); ?>" required />
            </div>
            <span class="text-danger">
              <?= form_error('address'); ?>
            </span>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="btn" value="Assign" />
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>
<!-- /Work Assignment modal -->


<!-- Show data modal -->
<div id="modal_show" class="modal fade" data-backdrop="false">
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
              <li class="active"><a href="#justified-badges-tab1" data-toggle="tab">Lead Detail</a></li>
              <?php if (in_array('lead-followupremider', $this->GroupPermission)) { ?>
                <li><a href="#justified-badges-tab2" data-toggle="tab" onClick="getreminderlist();">Followup Reminders <span class="badge bg-info position-right" id="remindercount"></span></a></li>
              <?php } ?>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="justified-badges-tab1">
                <div class="row">
                  <div class="pull-left" id="restbtn" style="padding:5px;">

                  </div>
                  <div class="pull-right" id="convertbtn" style="padding:5px;">

                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <h6 class="bg-info">&nbsp;Lead Information</h6>
                    <p>Name : <strong><span id="showname"></span></strong></p>
                    <p>Mobile : <strong><span id="showmobile"></span></strong></p>
                    <p>Email : <strong><span id="showemail"></span></strong></p>
                    <p>Alternate Mobile : <strong><span id="showalternate"></span></strong></p>
                    <p>Landline Number : <strong><span id="showlandline"></span></strong></p>
                    <p>Description : <strong><span id="showdescription" style="color:#FF5722;"></span></strong></p>
                    <p>Address : <strong><span id="showaddress"></span></strong></p>
                  </div>
                  <div class="col-sm-6">
                    <h6 class="bg-info">&nbsp;Other Information</h6>
                    <p>Product : <strong><span id="showproduct"></span></strong></p>
                    <p>Service : <strong><span id="showservice"></span></strong></p>
                    <p>Source : <strong><span id="showsource"></span></strong></p>
                    <p>Status : <strong><span id="showstatus"></span></strong></p>
                    <hr>
                    <p>Followup Assigned : <strong><span id="showfollowup"></span></strong></p>
                    <hr>
                    <p>Work Assigned To : <strong><span id="showworkassign"></span></strong></p>
                    <p>Work Assigned On : <strong><span id="showworkassigndate"></span></strong></p>
                    <p>Work Assigned By : <strong><span id="showassignby"></span></strong></p>
                    <p>Work Assignement Date : <strong><span id="showassignon"></span></strong></p>
                    <hr>
                    <p>Lead Created On : <strong><span id="showcreatedon"></span></strong></p>
                    <p>Lead Created By : <strong><span id="showcreatedby"></span></strong></p>
                    <p>Lead Updated On : <strong><span id="showupdatedon"></span></strong></p>
                    <p>Lead Updated By : <strong><span id="showupdatedby"></span></strong></p>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="justified-badges-tab2" onClick="getreminderlist();">
                <div class="row">
                  <div class="pull-left" id="reminderbtn" style="padding:5px;">

                  </div>
                </div>
                <hr>
                <div class="row">
                  <input type="hidden" id="showdataid" />
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="remiderlistb">

                    </tbody>
                  </table>
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


<script type="application/x-javascript">
  $("#addlead").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');
    var product_id = $('#product_id').val();
    var service_id = $('#service_id').val();
    var customer_id = $('#customer_name').val();
    var mobile = $('#mobile').val();

    if (product_id == '') {
      new PNotify({
        title: 'Error!',
        text: 'Please Select Product First',
        addclass: 'bg-danger'
      });
    } else if (service_id == '') {
      new PNotify({
        title: 'Error!',
        text: 'Please Select Service First',
        addclass: 'bg-danger'
      });
    } else if (customer_id == '') {
      new PNotify({
        title: 'Error!',
        text: 'Please Fill Customer Name',
        addclass: 'bg-danger'
      });
    } else if (mobile == '') {
      new PNotify({
        title: 'Error!',
        text: 'Please Fill Mobile',
        addclass: 'bg-danger'
      });
    } else {
      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(response) {
          $('#modal_default').modal('toggle');
          new PNotify({
            title: 'Success!',
            text: 'Lead Generated!',
            addclass: 'bg-success'
          });
          location.reload();

        },
        error: function(response) {
          new PNotify({
            title: 'Error!',
            text: 'Try Again',
            addclass: 'bg-danger'
          });
        }
      });
    }


  });

  $("#addreminder").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    var reminder_data = $('#reminder_date').val();
    var reminder_description = $('#reminder_description').val();
    var lead_id = $('#showdataid').val();
    var btn = $('#reminder_btn').val();
    if (btn == 'Submit') {
      var vdata = 'reminder_data=' + reminder_data + '&reminder_description=' + reminder_description + '&lead_id=' + lead_id + '&btn=' + btn;
    } else if (btn == 'Update') {
      var reminder_id = $('#reminder_id').val();
      var vdata = 'reminder_data=' + reminder_data + '&reminder_description=' + reminder_description + '&lead_id=' + lead_id + '&id=' + reminder_id + '&btn=' + btn;
    }
    if (reminder_data == '') {
      new PNotify({
        title: 'Error!',
        text: 'Please Select Reminder Date',
        addclass: 'bg-danger'
      });
    } else {
      $.ajax({
        type: "POST",
        url: url,
        data: vdata,
        success: function(response) {
          $('#modal_followup').modal('toggle');
          getreminderlist();
          if (btn == 'Submit') {
            new PNotify({
              title: 'Success!',
              text: 'Lead Reminder Added!',
              addclass: 'bg-success'
            });
          } else if (btn == 'Update') {
            new PNotify({
              title: 'Success!',
              text: 'Lead Reminder Updated!',
              addclass: 'bg-success'
            });
          }
          //location.reload();			 

        },
        error: function(response) {
          new PNotify({
            title: 'Error!',
            text: 'Try Again',
            addclass: 'bg-danger'
          });
        }
      });
    }


  });

  $("#updatelead").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');
    var product_id = $('#editproduct_id').val();
    var service_id = $('#editservice_id').val();
    var customer_id = $('#editcustomer_name').val();
    var mobile = $('#editmobile').val();

    if (product_id == '') {
      new PNotify({
        title: 'Error!',
        text: 'Please Select Product First',
        addclass: 'bg-danger'
      });
    } else if (service_id == '') {
      new PNotify({
        title: 'Error!',
        text: 'Please Select Service First',
        addclass: 'bg-danger'
      });
    } else if (customer_id == '') {
      new PNotify({
        title: 'Error!',
        text: 'Please Fill Customer Name',
        addclass: 'bg-danger'
      });
    } else if (mobile == '') {
      new PNotify({
        title: 'Error!',
        text: 'Please Fill Mobile',
        addclass: 'bg-danger'
      });
    } else {
      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(response) {

          $('#modal_edit').modal('toggle');
          new PNotify({
            title: 'Success!',
            text: 'Lead Updated!',
            addclass: 'bg-success'
          });
          location.reload();

        },
        error: function(response) {
          new PNotify({
            title: 'Error!',
            text: 'Try Again',
            addclass: 'bg-danger'
          });
        }
      });
    }


  });

  $("#workassgned").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form. work_assign_on

    var form = $(this);
    var url = form.attr('action');
    var id = $('#showdataid').val();
    var userwork = $('#workassigned').val();
    var work_assign_on = $('#work_assign_on').val();


    if (userwork == '') {
      new PNotify({
        title: 'Error!',
        text: 'Please Select Product First',
        addclass: 'bg-danger'
      });
    } else if (id == '') {
      new PNotify({
        title: 'Error!',
        text: 'Please Select Service First',
        addclass: 'bg-danger'
      });
    } else {
      $.ajax({
        type: "POST",
        url: url,
        data: 'id=' + id + '&userwork=' + userwork + '&work_assign_on=' + work_assign_on, // serializes the form's elements.
        success: function(response) {
          $('#modal_workassign').modal('toggle');
          new PNotify({
            title: 'Success!',
            text: 'Work Assigned!',
            addclass: 'bg-success'
          });
          location.reload();

        },
        error: function(response) {
          new PNotify({
            title: 'Error!',
            text: 'Try Again',
            addclass: 'bg-danger'
          });
        }
      });
    }


  });

  function showdetail(id) {
    $('#modal_show').modal('toggle');
    $.ajax({
      url: '<?= base_url("secure/leads/getleadsdetail"); ?>',
      type: 'post',
      data: 'id=' + id,
      dataType: 'json',
      success: function(result) {
        console.log(result);
        if (result.status == true) {
          $('#showdataid').val(result.data.id);
          $('#cuto').html('#' + result.data.id + ' - ' + result.data.customer_name);
          $('#showname').html(result.data.customer_name);
          $('#showmobile').html(result.data.mobile);
          $('#showemail').html(result.data.email);
          $('#showalternate').html(result.data.alternate_mobile);
          $('#showlandline').html(result.data.landline_no);
          $('#showdescription').html(result.data.description);
          $('#showaddress').html(result.data.address);
          $('#showproduct').html(result.data.product);
          $('#showservice').html(result.data.service);
          $('#showsource').html(result.data.source);
          $('#showstatus').html(result.data.status);
          $('#showfollowup').html(result.data.followed);
          $("#workassigned option").each(function() {
            if ($(this).val() === result.data.workassignid) {
              $(this).prop('selected', true);
            }
          });


          $('#work_assign_on').val(result.data.workassigndatem);

          $('#showworkassign').html(result.data.workassign);
          $('#showworkassigndate').html(result.data.workassigndate);
          $('#showassignby').html(result.data.assignby);
          $('#showassignon').html(result.data.assignon);
          $('#remindercount').html(result.data.remindercount);
          $('#showcreatedon').html(result.data.createdon);
          $('#showcreatedby').html(result.data.createdby);
          $('#showupdatedon').html(result.data.updatedon);
          $('#showupdatedby').html(result.data.updatedby);

          $('#convertbtn').html('<?php if (in_array('leads-assign', $this->GroupPermission)) { ?><a onClick="workassign(' + result.data.id + ')" class="btn btn-info"><i class="fa fa-mail-forward"></i> Work Assign</a><?php }
                                                                                                                                                                                                                    if (in_array('leads-convertcustomer', $this->GroupPermission)) { ?>&nbsp;<a onClick="convertcustomer(' + result.data.id + ')" class="btn btn-success"><i class="fa fa-user"></i> Convert to Customer</a><?php } ?>');

          $('#restbtn').html('<?php if (in_array('leads-edit', $this->GroupPermission)) { ?><a onClick="editdetail(' + result.data.id + ')"><i class="fa fa-edit fa-1x" style="font-size:18px;"></i> Edit</a><?php }
                                                                                                                                                                                                        if (in_array('leads-delete', $this->GroupPermission)) { ?>&nbsp;<a onClick="deleterow(' + result.data.id + ');"><i class="fa fa-trash fa-1x" style="color:red; font-size:18px;"></i>Delete</a><?php } ?>');
          $('#reminderbtn').html('<?php if (in_array('leads-addreminder', $this->GroupPermission)) { ?><a onClick="addreminder(' + result.data.id + ')" class="btn btn-info"><i class="fa fa-bell"></i> Add Lead Reminder</a><?php } ?>');

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

  function deleterow(id) {
    $.ajax({
      url: '<?= base_url("secure/leads/getleads"); ?>',
      type: 'post',
      data: 'id=' + id,
      dataType: 'json',
      success: function(result) {
        console.log(result);
        if (result.status == true) {

          if (confirm('Are You Sure, You want to delete ' + result.data.customer_name + ' from lead!')) {
            confirmdelete(id);

          }
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

  function getreminderlist() {
    var dataid = $('#showdataid').val();
    //alert('this is remider panel' + dataid);
    if (dataid) {
      $.ajax({
        type: 'POST',
        url: '<?= base_url('secure/leads/leadreminderlist'); ?>',
        data: 'id=' + dataid,
        success: function(html) {
          console.log(html);
          $('#remiderlistb').html(html);
        }

      });
    }

  }

  function addreminder(id) {
    $('#reminder_date').val('');
    $('#reminder_id').val('');
    $('#reminder_description').val('');
    $('#reminder_btn').val('Submit');
    $('#showdataid').val(id);
    $('#modal_followup').modal('toggle');

  }

  function convertcustomer(id) {
    alert('Convert customer ' + id);
    editdetail(id);
  }

  function workassign(id) {


    $('#modal_workassign').modal('toggle');
  }

  function confirmdelete(id) {

    $.ajax({
      url: '<?= base_url("secure/leads/deletelead"); ?>',
      type: 'post',
      data: 'id=' + id,
      dataType: 'json',
      success: function(result) {
        console.log(result);
        if (result.status == true) {

          new PNotify({
            title: 'Success',
            text: 'Record delete Successfully!',
            addclass: 'bg-success'
          });
          location.reload();
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

  function editdetail(id) {
    if (id != '') {

      $.ajax({
        url: '<?= base_url("secure/leads/getleads"); ?>',
        type: 'post',
        data: 'id=' + id,
        dataType: 'json',
        success: function(result) {
          console.log(result);
          if (result.status == true) {
            $('#modal_edit').modal('toggle');
            $('#editcustomer_name').val(result.data.customer_name);
            $('#editid').val(result.data.id);
            $('#editmobile').val(result.data.mobile);
            $('#editemail').val(result.data.email);
            $('#editalternate_mobile').val(result.data.alternate_mobile);
            $('#editlandline_no').val(result.data.landline_no);
            $('#editdescription').val(result.data.description);
            $('#editaddress').val(result.data.address);
            $('#editzip_code').val(result.data.zip_code);
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
            $("#editsource_id option").each(function() {
              if ($(this).val() === result.data.source_id) {
                $(this).prop('selected', true);
              }
            });
            $("#editfollowup_assigned option").each(function() {
              if ($(this).val() === result.data.followup_assigned) {
                $(this).prop('selected', true);
              }
            });
            $("#editwork_status option").each(function() {
              if ($(this).val() === result.data.work_status) {
                $(this).prop('selected', true);
              }
            });
            $("#editstatus_id option").each(function() {
              if ($(this).val() === result.data.status_id) {
                $(this).prop('selected', true);
              }
            });
            $("#editcountry_id option").each(function() {
              if ($(this).val() === result.data.country_id) {
                $(this).prop('selected', true);
              }
            });
            $("#editstate_id option").each(function() {
              if ($(this).val() === result.data.state_id) {
                $(this).prop('selected', true);
              }
            });
            $("#editcity_id option").each(function() {
              if ($(this).val() === result.data.city_id) {
                $(this).prop('selected', true);
              }
            });

          } else if (result.status == false) {

          }

        }

      });


    }




  }

  function editreminder(id) {
    if (id != '') {

      $.ajax({
        url: '<?= base_url("secure/leads/getleadsreminder"); ?>',
        type: 'post',
        data: 'id=' + id,
        dataType: 'json',
        success: function(result) {
          console.log(result);
          if (result.status == true) {
            $('#modal_followup').modal('toggle');
            $('#reminder_date').val(result.data.reminder_on);
            $('#reminder_id').val(result.data.id);
            $('#reminder_description').val(result.data.description);
            $('#reminder_btn').val('Update');
          } else if (result.status == false) {
            $('#smobile').attr('readonly', 'readonly');
            $('#otp_status').html('<span style="color:red">Invalid OTP</span>');
          }

        }

      });


    }
  }

  function deletereminder(id) {

    if (confirm('Are You Sure, You want to delete this lead reminder!')) {
      $.ajax({
        url: '<?= base_url("secure/leads/deleteleadreminder"); ?>',
        type: 'post',
        data: 'id=' + id,
        dataType: 'json',
        success: function(result) {

          if (result.status == true) {

            new PNotify({
              title: 'Success',
              text: 'Record delete Successfully!',
              addclass: 'bg-success'
            });
            //location.reload();	   
          } else if (result.status == false) {
            new PNotify({
              title: 'Error!',
              text: 'Try Again',
              addclass: 'bg-danger'
            });
            //location.reload();
          }

        }

      });
    }

  }
</script>