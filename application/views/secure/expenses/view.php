<style>
body {
  background: rgb(204,204,204); 
  font-family:vardana;
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
  font-size:12px !important;
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
  }
  page[size="A4"] {
  width: 21cm;
  height: auto;  
}
.table-bordered,.table-bordered td,.table-bordered th{border:1px solid #1F1F1F}
/*.footer{
	display:none;
}*/
}
.forTable{
    margin-top:10em;
}
  </style>
 
 <page size="A4" >
 <table style="width:21cm !important;" border="1" class="table-bordered" >
                    <tr>
                        <td>
                            <table>
                                    <?php //$company = $this->CommanModel->getList('site_name,logo,address,email,phone,description','tbl_setting','id','ASC');
                                            // echo '<pre>';
                                            // var_dump($company[0]['logo']);
                                    ?>
                                    <tr>
                                    <td style="width:20%;"><img src="<?=base_url('uploads/logo/'.$this->CompanyDetail['company_logo']);?>" width="100%" alt="" title=""/></td>
                                    <td style="text-align:center; width:80%;">
                                    <h1><?php echo $this->CompanyDetail['company_name'];?></h1>
                                   
                                         <strong><?=$this->BranchDetail['branch_name'];?>:</strong>
										<?=$this->BranchDetail['address'];?>, <?=$this->BranchDetail['city_name'];?>
                                        <?=$this->BranchDetail['state_name'];?>, <?=$this->BranchDetail['country_name'];?> - <?=$this->BranchDetail['pincode'];?>
                                    </td>
                                    <td></td>
                                    </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%">
                                <tr >
                                    <td colspan="3" style="padding:.5em" >
                                            <strong><center>PAYMENT VOUCHER</center></strong>
                                    </td>
                                </tr>
                                <tr >
                                    <td colspan="2" style="padding:.5em"><strong>Voucher No :</strong><span style="margin-left:3em"><?php echo $expense['id'];?></span></td>
                                    
                                    <td><strong>Date</strong> <?php echo date_format(date_create($expense['fdate']), "d/m/Y");?></td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:.5em">
                                            <strong>Paid to :</strong> <?php echo $expense['person_name'];?>
                                    </td>
                                    
                                </tr>
                                <tr>
                                   <td colspan="3" style="padding:.5em">
                                            <strong>the sum of Rs.  </strong> <?php echo $this->mycalendar->getIndianCurrency($expense['amount']);?>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:.5em">
                                            <strong>towards (A/C HEAD)</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:.5em; width:33%">
                                            <strong>Th .Case/Cheque No</strong>
                                    </td>
                                    <td style="width:33%">
                                            <strong>Bank Name</strong>
                                    </td>
                                    <td style="width:33%">
                                            <strong>Date : <span style="margin-left:1em"><?php echo date_format(date_create($expense['fdate']), "d/m/Y");?></span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:.5em">
                                            <strong>Rs. </strong><?php echo $expense['amount'];?>
                                    </td>
                                    
                                </tr>
                                <tr >
                                    <td style="padding:1.5em;">
                                            <strong>Manager / Proprietor</strong>
                                    </td>
                                    <td >
                                            <strong>Accountant</strong>
                                    </td>
                                    <td >
                                            <strong>Receiver's Signature</strong>
                                    </td>
                                    
                                </tr>
                            </table>
                        </td>
                    </tr>  
                    
                    
 </table>

 
 
                    

  </page>
  
 
 
 