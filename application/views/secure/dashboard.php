<!-- Page header -->
<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="#"><i class="icon-home2 position-left active"></i> Dashboard</a></li>
							
						</ul>

					</div>
				</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">
<!-- Main charts -->
<!-- Quick stats boxes -->
							<div class="row">
								<div class="col-lg-3">

									<!-- Members online -->
									<div class="panel bg-teal-400">
										<div class="panel-body">
											

											<h3 class="no-margin"><?php $count = $this->Leads_model->get_today_reminder_list(date("Y-m-d")); echo count($count);?></h3>
											Today's Lead Followup
											
										</div>

										<div class="container-fluid">
											<div id="members-online"><a href="<?=base_url('secure/leads/gettodayleadreminder');?>" style="color:#fff;">Click Here</a></div>
										</div>
									</div>
									<!-- /members online -->

								</div>

								<div class="col-lg-3">

									<!-- Members online -->
									<div class="panel bg-pink-400">
										<div class="panel-body">
											

											<h3 class="no-margin"><?php $count = $this->Leads_model->get_today_assignlead_list(date("Y-m-d")); echo count($count);?></h3>
											Today's Assign Work Lead
											
										</div>

										<div class="container-fluid">
											<div id="members-online"><a href="<?=base_url('secure/leads/gettodayassignlead');?>" style="color:#fff;">Click Here</a></div>
										</div>
									</div>
									<!-- /members online -->

								</div>

								<div class="col-lg-3">

									<!-- Today's revenue -->
									<div class="panel bg-blue-400">
										<div class="panel-body">
											<div class="heading-elements">
												<ul class="icons-list">
							                		<li><a data-action="reload"></a></li>
							                	</ul>
						                	</div>

											<h3 class="no-margin"><?php $mscount = $this->Leads_model->get_today_ms_list(date("Y-m-d")); echo count($mscount);?></h3>
											Today's Mandetory Service
											
										</div>

										<div class="container-fluid">
											<div id="members-online"><a href="<?=base_url('secure/leads/gettodaymslist');?>" style="color:#fff;">Click Here</a></div>
										</div>
									</div>
									<!-- /today's revenue -->

								</div>
                                
                                <div class="col-lg-3">

									<!-- Today's revenue -->
									<div class="panel bg-purple-400">
										<div class="panel-body">
											<div class="heading-elements">
												<ul class="icons-list">
							                		<li><a data-action="reload"></a></li>
							                	</ul>
						                	</div>

											<h3 class="no-margin"><?php $mscount = $this->Leads_model->get_today_expire_list('2022-01-08'); echo count($mscount);?></h3>
											Today's Expire AMC and Warrenty
											
										</div>

										<div class="container-fluid">
											<div id="members-online"><a href="<?=base_url('secure/leads/gettodaymslist');?>" style="color:#fff;">Click Here</a></div>
										</div>
									</div>
									<!-- /today's revenue -->

								</div>
							</div>
							<!-- /quick stats boxes -->
<!-- /main charts -->



</div>
<script type="text/javascript">

$( document ).ready(function() {
$("#leaddate").datepicker({ dateFormat: "DD/MM/yyyy" });
});
</script>