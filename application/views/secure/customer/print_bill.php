<style>
body {
	background: rgb(204,204,204);
	font-family: vardana;
}
page {
	background: white;
	display: block;
	margin: 0 auto;
	margin-bottom: 0.5cm;
	box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	font-size: 12px !important;
}
page[size="A4"] {
	width: 21cm;
	height: 29.7cm;
}
page[size="A4"][layout="portrait"] {
	width: 29.7cm;
	height: 21cm;
}

@media print {
body, page {
	margin: 0 !important;
	box-shadow: 0 !important;
	page-break-after:avoid !important;
	page-break-inside:avoid !important;
	font-family: "Calibri";
}
page[size="A4"] {
	width: 21cm;
	height: auto;
}
.table-bordered, .table-bordered td, .table-bordered th {
	border: 1px solid #1F1F1F
}
.footer{
	display:none;
}
}
.forTable {
	margin-top: 10em;
}
</style>
<page size="A4">
<table>
<tr>
          <td colspan="2" style="padding:.5em" ><strong>
            <center>
             Invoice
            </center>
            </strong></td>
            
        </tr>
        <tr>
          <td style="width:20%;"><img src="<?=base_url('uploads/logo/'.$this->CompanyDetail['company_logo']);?>" width="100%" alt="" title=""/></td>
          <td style="text-align:right; width:80%;"><h1><?php echo $this->CompanyDetail['company_name'];?></h1>
          <strong><?php echo $this->CompanyDetail['phone'];?></strong><br>
            <span style="text-align:justify;"><strong>
            <?=$this->BranchDetail['branch_name'];?>
            :</strong>
            <?=$this->BranchDetail['address'];?>
            ,<?=$this->BranchDetail['city_name'];?>
            <?=$this->BranchDetail['state_name'];?>
            ,<?=$this->BranchDetail['country_name'];?>
            -<?=$this->BranchDetail['pincode'];?></span>
            <br><strong>GSTIN: </strong><?=$this->CompanyDetail['GSTIN'];?></td>
          
        </tr>
      </table>
      <hr>
      <table width="100%">
        
         <tr>
          <td> <strong>Invoice No:</strong><?=$billdata['invoice_no'];?></td>
            <td style="text-align:right;"><strong>Invoice Date:</strong><?=date('d/m/Y', strtotime($billdata['invoice_date']));?></td>
        </tr>
        </table>
        <br>
<table width="100%" cellpadding="1" cellspacing="1	"border="1">
        
         
        <tr>	
          <td style="padding:.5em"><strong>Customer Name :</strong></td>
          <td> <?=$customer_data['customer_name'];?></td>
        
        </tr>
        <tr>
          <td style="padding:.5em"><strong>Address :</strong></td>
          <td><?=$customer_data['address'];?><?=$customer_data['address'];?><?=$customer_data['address'];?></td>
          
        </tr>
        <tr>
          <td style="padding:.5em"><strong>GSTIN :</strong></td>
          <td><?=$customer_data['GSTIN'];?></td>
         
        </tr>
        <tr>
          <td style="padding:.5em"></td>
          <td></td>
          
        </tr>
        <tr>
          <td style="padding:.5em"></td>
          <td></td>
          
        </tr>
       
      </table>
<table class="table" style="width:100% !important;">
        <thead>
          <tr>
            <th>Sr.No.</th>
                      <th>Manifest Id</th>
                      <th>Manifest Date</th>
                      <th>Agent Name</th>
                      <th>Mode</th>
                      <th>total_pieces</th>
                      <th>No. of consignment</th>
                      <th>Weight</th>
                      <th>Amount</th>
          </tr>
        </thead>
        <tbody>
          <?php 
                           $manifestid =  explode(',', $billdata['awbcode_details']);
                          
                           
                           for($i =0 ; $i < count($manifestid);$i++){ 
                           
                           $getawbdata='';
                           $getawbdata = $this->Loader_model->getmanifestdata($manifestid[$i]);
						   
                          
                        ?>
          <tr>
            <td><?php echo $i + 1;?></td>
            
            <td><?php echo $manifestid[$i];?></td>
            <td><?php echo date('d-m-Y', strtotime($getawbdata['manifest_date']));?></td>
            <td><?php echo $getawbdata['agent_name'];?></td>
            <td><?php echo $getawbdata['mode_name'];?></td>
            <td><?php echo $getawbdata['total_pieces'];?></td>
            <td><?php echo $getawbdata['no_of_consignment'];?></td>
            <td><?php echo $getawbdata['total_weight'];?></td>
            <td><?php echo $getawbdata['total_docket_price'];?></td>
          </tr>
          <?php  }?>
        </tbody>
        <tfoot>
          <tr>
            <th style="font-weight:bold;">Total</th>
            <th style="font-weight:bold;"></th>
            <th style="font-weight:bold;"></th>
            <th style="font-weight:bold;"></th>
            <th style="font-weight:bold;"></th>
            <th style="font-weight:bold;"></th>
             <th style="font-weight:bold;"></th>
            <th style="font-weight:bold;"><?=$billdata['weightforbilling'];?></th>
            <th style="font-weight:bold;"><?=$billdata['amountforbilling'];?></th>
          </tr>
          
          <tr>
            <th style="font-weight:bold;" colspan="6"></th>
            <th style="font-weight:bold;" colspan="2">Sub Total:</th>
            <th style="font-weight:bold;"><?=$billdata['TotalTaxableamount']; $gstperct = 0;?></th>
          </tr>
          <?php if($billdata['cgst'] !='' ){ $gstperct += $gst['cgst']; ?>
          <tr>
            <th style="font-weight:bold;" colspan="6"></th>
            <th style="font-weight:bold;" colspan="2">CGST (
              <?=$gst['cgst'];?>
              %):</th>
            <th style="font-weight:bold;"><?=$billdata['cgst'];?></th>
          </tr>
          <?php }?>
          <?php if($billdata['sgst'] !='' ){ $gstperct += $gst['sgst']; ?>
          <tr>
            <th style="font-weight:bold;" colspan="6"></th>
            <th style="font-weight:bold;" colspan="2">SGST (
              <?=$gst['sgst'];?>
              %):</th>
            <th style="font-weight:bold;"><?=$billdata['sgst'];?></th>
          </tr>
          <?php }?>
          <?php if($billdata['igst'] !='' ){ $gstperct += $gst['igst']; ?>
          <tr>
            <th style="font-weight:bold;" colspan="6"></th>
            <th style="font-weight:bold;" colspan="2">IGST (
              <?=$gst['igst'];?>
              %):</th>
            <th style="font-weight:bold;"><?=$billdata['igst'];?></th>
          </tr>
          <?php }?>
          <?php if($billdata['cgst'] !='' || $billdata['sgst'] !='' || $billdata['igst'] !='' ){?>
          <tr>
            <th style="font-weight:bold;" colspan="6"></th>
            <th style="font-weight:bold;" colspan="2">Total GST (
              <?=$gstperct;?>
              %):</th>
            <th style="font-weight:bold;"><?=$billdata['total_gst'];?></th>
          </tr>
          <?php }?>
          <tr>
            <th style="font-weight:bold;" colspan="6"></th>
            <th style="font-weight:bold;" colspan="2">Grand Total:</th>
            <th style="font-weight:bold;"><?=$billdata['total_billing_amount'];?></th>
          </tr>
          <tr>
            <th style="font-weight:bold;" colspan="9"> <ol>
                <li>Payment to be made by cheque in favour of SR INTERNATIONAL</li>
                <li>Interest @2.4% p.a will be charged if payment is not recieved within 14 days after the presentation of the bills.</li>
                <li>Bill will be considered correct &amp; conclusion if notification of any kind of error is brought to notice within 15 days.</li>
                <li>SR INTERNATIONAL libility is restiricted the to clause mentioned on the shipper copy.</li>
                <li>All the Disputed Subject to Lucknow Jurisdiction Only .</li>
              </ol>
            </th>
            </ </tr>
        </tfoot>
      </table>

</page>
