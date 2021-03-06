<?php include(APPPATH.'views/top.php'); ?>
<div class="page-header position-relative">
    <h1>Create Order</h1>
</div>
<div class="row-fluid">
    <div class="span12">                 
    	<form class="form-horizontal" id="frmOrder"/>
        	<div class="control-group">
                <label class="control-label" for="form-input-readonly">Order #</label>

                <div class="controls">
                    <input readonly="" type="text" class="span4" id="txtOrderNo" name="txtOrderNo" value="<?php echo $orderNo; ?>" disabled="disabled" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="form-field-2">Customer</label>

                <div class="controls">
                    <select id="selCustomer" name="selCustomer" class="span4 required">
                        <?php echo $this->Page->generateComboByTable("customer_master","cust_id","CONCAT(cust_first_name,' ',cust_last_name)","","where status='ACTIVE' order by cust_first_name",$orderDetailArr['customer_id'],"Select Customer"); ?>
                    </select>
					<a id="" href="#cust-form" data-toggle="modal">Add New Customer<i class="icon-external-plus"></i></a>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="form-field-4">Order Date</label>
                
                <div class="controls">
                    <input type="text" data-date-format="yyyy-mm-dd" id="txtOrderDate" name="txtOrderDate" class="date-picker span4 required" placeholder="dd-mm-yyyy" value="<?php echo $orderDetailArr['order_date']; ?>">
                    <span class="add-on">
                        <i class="icon-calendar"></i>
                    </span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="form-field-4">Shipment Date</label>
                
                <div class="controls">
                    <input type="text" data-date-format="yyyy-mm-dd" id="txtShipDate" name="txtShipDate" class="date-picker span4 required" placeholder="dd-mm-yyyy" value="<?php echo $orderDetailArr['order_ship_date']; ?>">
                    <span class="add-on">
                        <i class="icon-calendar"></i>
                    </span>
					<h4 style="float:right">
						<a id="btnManufecture" href="#mft-form" data-toggle="modal">Create Menufecture Order <i class="icon-plus"></i></a>
					</h4>
                </div>
            </div>
           
           <!-- START ADD ITEM DETAILS -->
           <div class="widget-box transparent"> 
                <div class="widget-body">
                    <div class="widget-main">
                    	<h3 class="smaller lighter blue">
                            Item Details
                        </h3>
                        <!-- START ITEM DETAILS -->
                    	<table class="table table-striped tbl-item-dtl">
                            <thead>
                                <tr>
									<th class="span2">Type</th>
                                    <th class="span2">Product Name</th>
                                    <th class="span1">Quantity</th>
                                    <th class="span2">Price</th>
                                    <th class="span1">Tax</th>
                                    <th class="span2">Discount</th>
                                    <th class="span1">Amount</th>
                                    <th class="span1">Action</th>
                                </tr>
                            </thead>

                            <tbody>
								<tr class="entry-hidden hide">
									<td class="span2">
										<select class="form-control span12 productType" name="selProductType" id="selProductType">
											<?php echo $this->Page->generateComboByTable("combo_master","combo_key","combo_value",0," where combo_case='PRODUCT_TYPE' order by seq","",""); ?>
										</select>
                                    </td>
                                    <td class="span2">
										<select class="form-control span12 product" name="selProduct" id="selProduct">
											<?php echo $this->Page->generateComboByTable("product_master","prod_id","prod_name","","where prod_type='product' and status='ACTIVE'","","Select Product"); ?>
										</select>
                                    </td>
                                    <td class="span1">
                                    	<input class="form-control span12 calc" type="text" name="txtProductQty" id="txtProductQty" placeholder="QTY" onKeyPress="javascript:return OnlyNumeric(event);"/>
										<input type="hidden" name="jsonString" id="jsonString" value="" />
                                    </td>
                                    <td class="span2">
                                    	<input class="form-control span12 calc" name="txtProductPrice" id="txtProductPrice" type="text" placeholder="INR" />
                                    </td>
                                    <td class="span1">
                                    	<input class="form-control span12 calc" name="txtProductTax" id="txtProductTax" type="text" placeholder="%" />
                                        <small class="small-tax" id="txtProductTaxAmt" name="txtProductTaxAmt"></small>
                                    </td>
                                    <td class="span2">
                                    	<input class="form-control span8 calc" name="txtProductDiscountValue" id="txtProductDiscountValue" type="text" placeholder="INR" />
                                        <select class="span4" name="txtProductDiscountType" id="txtProductDiscountType" onChange="javascript:$('.calc').blur();">
											<?php echo $this->Page->generateComboByTable("combo_master","combo_key","combo_value",0," where combo_case='DISCOUNT_TYPE' order by seq","",""); ?>
                                        </select>
										<small id="txtProductDiscountAmt" name="txtProductDiscountAmt"></small>
                                    </td>
                                    <td class="span1">
                                    	<label id="prodTotalAmount" name="prodTotalAmount" class="span12">0.0</label>
                                    </td>
                                    <td class="span1">
                                    	<button id="btnOrderProdAdd" type="button" class="btn btn-remove btn-danger"><span class="icon-minus bigger-110"></span></button>
                                    </td>
                                </tr>
								<?php
								$cnt = 0;
								$prodDetailsArr = $orderDetailArr['orderProductDetailsArr'];
								if(count($prodDetailsArr) > 0)
								{
									foreach($prodDetailsArr AS $key=>$productRow)
									{
									?>
										<tr class="entry" id="<?php echo $cnt; ?>">
											<td class="span2">
												<select class="form-control span12 required productType" name="selProductType" id="selProductType<?php echo $cnt; ?>">
													<?php echo $this->Page->generateComboByTable("combo_master","combo_key","combo_value",0," where combo_case='PRODUCT_TYPE' order by seq",$productRow['prod_type'],""); ?>
												</select>
											</td>
											<td class="span2">
												<select class="form-control span12 required product" name="selProduct" id="selProduct<?php echo $cnt; ?>">
													<?php echo $this->Page->generateComboByTable("product_master","prod_id","prod_name","","where prod_type='".$productRow['prod_type']."' and status='ACTIVE'",$productRow['prod_id'],"Select Product"); ?>
												</select>
											</td>
											<td class="span1">
												<input class="form-control span12 required calc" type="text" name="txtProductQty" id="txtProductQty<?php echo $cnt; ?>" placeholder="QTY" onKeyPress="javascript:return OnlyNumeric(event);" value="<?php echo $productRow['prod_qty']; ?>" />
												<input type="hidden" name="jsonString" id="jsonString0" value="" />
											</td>
											<td class="span2">
												<input class="form-control span12 required calc" name="txtProductPrice" id="txtProductPrice<?php echo $cnt; ?>" type="text" placeholder="INR" value="<?php echo $productRow['price_per_qty']; ?>" />
											</td>
											<td class="span1">
												<input class="form-control span12 calc" name="txtProductTax" id="txtProductTax<?php echo $cnt; ?>" type="text" placeholder="%" value="<?php echo $productRow['tax_value']; ?>" />
												<small class="small-tax" id="txtProductTaxAmt<?php echo $cnt; ?>" name="txtProductTaxAmt"><?php echo $productRow['tax_amount']; ?></small>
											</td>
											<td class="span2">
												<input class="form-control span8 calc" name="txtProductDiscountValue" id="txtProductDiscountValue<?php echo $cnt; ?>" type="text" placeholder="INR" value="<?php echo $productRow['discount_value']; ?>" />
												<select class="span4" name="txtProductDiscountType" id="txtProductDiscountType<?php echo $cnt; ?>" onChange="javascript:$('.calc').blur();">
													<?php echo $this->Page->generateComboByTable("combo_master","combo_key","combo_value",0," where combo_case='DISCOUNT_TYPE' order by seq",$productRow['discount_type'],""); ?>
												</select>
												<small id="txtProductDiscountAmt<?php echo $cnt; ?>" name="txtProductDiscountAmt"><?php echo $productRow['discount_amount']; ?></small>
											</td>
											<td class="span1">
												<label id="prodTotalAmount<?php echo $cnt; ?>" name="prodTotalAmount" class="span12"><?php echo $productRow['prod_total_amount']; ?></label>
											</td>
											<td class="span1">
												<?php
												if($cnt == 0)
												{
												?>
													<button class="btn btn-success btn-add" type="button" id="btnOrderProdAdd"><span class="icon-plus bigger-110"></span></button>
												<?php
												}
												else
												{
												?>
													<button id="btnOrderProdAdd" type="button" class="btn btn-remove btn-danger"><span class="icon-minus bigger-110"></span></button>
												<?php
												}
												?>
											</td>
										</tr>
									<?php
										$cnt++;
									}
								}
								else
								{
								?>
                                <tr class="entry" id="0">
									<td class="span2">
										<select class="form-control span12 required productType" name="selProductType" id="selProductType0">
											<?php echo $this->Page->generateComboByTable("combo_master","combo_key","combo_value",0," where combo_case='PRODUCT_TYPE' order by seq","",""); ?>
										</select>
                                    </td>
                                    <td class="span2">
										<select class="form-control span12 required product" name="selProduct" id="selProduct0">
											<?php echo $this->Page->generateComboByTable("product_master","prod_id","prod_name","","where prod_type='product' and status='ACTIVE'","","Select Product"); ?>
										</select>
                                    </td>
                                    <td class="span1">
                                    	<input class="form-control span12 required calc" type="text" name="txtProductQty" id="txtProductQty0" placeholder="QTY" onKeyPress="javascript:return OnlyNumeric(event);" />
										<input type="hidden" name="jsonString" id="jsonString0" value="" />
                                    </td>
                                    <td class="span2">
                                    	<input class="form-control span12 required calc" name="txtProductPrice" id="txtProductPrice0" type="text" placeholder="INR" />
                                    </td>
                                    <td class="span1">
                                    	<input class="form-control span12 calc" name="txtProductTax" id="txtProductTax0" type="text" placeholder="%" />
                                        <small class="small-tax" id="txtProductTaxAmt0" name="txtProductTaxAmt"></small>
                                    </td>
                                    <td class="span2">
                                    	<input class="form-control span8 calc" name="txtProductDiscountValue" id="txtProductDiscountValue0" type="text" placeholder="INR" />
                                        <select class="span4" name="txtProductDiscountType" id="txtProductDiscountType0" onChange="javascript:$('.calc').blur();">
											<?php echo $this->Page->generateComboByTable("combo_master","combo_key","combo_value",0," where combo_case='DISCOUNT_TYPE' order by seq","",""); ?>
                                        </select>
										<small id="txtProductDiscountAmt0" name="txtProductDiscountAmt"></small>
                                    </td>
                                    <td class="span1">
                                    	<label id="prodTotalAmount0" name="prodTotalAmount" class="span12">0.0</label>
                                    </td>
                                    <td class="span1">
                                    	<button class="btn btn-success btn-add" type="button" id="btnOrderProdAdd">
											<span class="icon-plus bigger-110"></span>
										</button>
                                    </td>
                                </tr>
								<?php
								}
								?>
                            </tbody>
                        </table>
                        <!-- END ITEM DETAILS -->
                        
                        <!-- START TOTAL -->
                        <table class="table">
                        	<tbody>
                                <tr>
                                	<td align="right">
                                    	<div class="span12">
                                           <div class="span6">
										   </div> 
                                           <div class="span6 divTotal">
											   <div class="control-group">
                                                    <label class="control-label">Total Qty</label>
                                                    <div class="controls">
														<label class="control-label span5" id="lblTotalQty"><?php echo $orderDetailArr['tot_prod_qty']; ?></label>
                                                    </div>
                                                </div>	
                                               <div class="control-group">
                                                    <label class="control-label">Sub Total</label>
                                                    <div class="controls">
														<label class="control-label span5" id="lblSubTotal"><?php echo $orderDetailArr['sub_total_amount']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Total Tax</label>
                                                    <div class="controls">
                                                        <label class="control-label span5" id="lblTotalTax"><?php echo $orderDetailArr['total_tax']; ?></label>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label">Discount</label>
                                                    <div class="controls">
                                                        <input class="span4 calc" name="txtTotalDiscountValue" id="txtTotalDiscountValue" type="text" placeholder="INR" value="<?php echo $orderDetailArr['discount_value']; ?>" />
                                                        <select class="span3" name="selTotalDiscountType" id="selTotalDiscountType" onChange="javascript:$('.calc').blur();">
															<?php echo $this->Page->generateComboByTable("combo_master","combo_key","combo_value",0," where combo_case='DISCOUNT_TYPE' order by seq",$orderDetailArr['discount_type'],""); ?>
                                                        </select>
                                                        <label class="control-label span4" id="lblDiscountAmount"><?php echo $orderDetailArr['discount_amount']; ?></label>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="control-group">
                                                    <label class="control-label">Adjustment</label>
                                                    <div class="controls">
                                                        <input type="text" class="span6 calc" name="txtAdjustAmount" id="txtAdjustAmount" value="<?php echo $orderDetailArr['adjust_amount']; ?>" placeholder="INR" />
                                                        <label class="control-label span4" id="lblAdjustAmount"><?php echo $orderDetailArr['adjust_amount']; ?></label>
                                                    </div>
                                                </div>	
                                                <div class="control-group div-final-total">
                                                	<label class="control-label" for="form-input-readonly">TOTAL</label>
                                                    <div class="controls">
                                                        <label class="control-label span5" id="lblFinalTotal"><?php echo $orderDetailArr['final_total_amount']; ?></label>
                                                </div>
                                           </div>
                                       </div> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- END TOTAL -->
                    </div>
                </div>
            </div>
           <!-- END ITEM DETAILS -->

		   <div class="control-group">
                <label class="control-label" for="form-input-readonly">Note</label>

                <div class="controls">
                    <textarea id="txtNote" class="span12"><?php echo $orderDetailArr['order_note']; ?></textarea>
                </div>
            </div>
           
           <!-- START BUTTON SECTION -->
           <div class="form-actions" align="left">
                <button class="btn btn-info" type="submit"><i class="icon-ok bigger-110"></i>Submit</button>
                <button class="btn" type="reset"><i class="icon-undo bigger-110"></i>Reset</button>
				<input type="hidden" name="hdnOrderId" id="hdnOrderId" value="<?php echo $orderId; ?>" />
				<input type="hidden" name="hdnAction" id="hdnAction" value="<?php echo $strAction; ?>" />
           </div>
		   <!-- END BUTTON SECTION -->
        </form>						
    </div>
</div>    
</div>

<!-- START Modal popup for Manufacture -->
<div id="mft-form" class="modal hide fade" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="blue bigger">Please fill the following information</h4>
    </div>

    <div class="modal-body overflow-visible">
    	<div class="vspace"></div>
        <div class="row-fluid">
            <div class="controls">
                <div class="entry" style="margin:10px 0px;">
                    <label class="span4">Product Name</label>
                    <label class="span4">Quantity</label>
                    <label class="span2"></label>
                </div>
            </div>
            
            <div class="controls"> 
                <form class = "form-inline" id="frmMenuProdAdd" role="form" autocomplete="off">
                    <div class="entry form-group" style="margin:10px 0px;">
                    	<select class="form-control span4">
                    		<?php echo $this->Page->generateComboByTable("product_master","prod_id","prod_name","","","","Select Product"); ?>
                    	</select>
                        <input class="form-control span4" type="text" placeholder="Enter Qty" onKeyPress="javascript:return OnlyNumeric(event);" />
                        <button class="btn btn-success btn-add" type="button" id="btnMenuProdAdd">
                            <span class="icon-plus bigger-110"></span>
                        </button><br />
                    </div>
                </form>
            </div>
    	</div>
	</div>
    
    <div class="modal-footer">
        <button class="btn btn-small btn-primary" id="saveMenuOrder">
            <i class="icon-ok"></i>
            Save
        </button>
    </div>
</div>
<!-- END Modal popup for Manufacture -->

<!-- START Modal popup for Customer Form -->
<div id="cust-form" class="modal hide fade" tabindex="-1" style="position:absolute;">
	<form class="form-horizontal" id="frmCustomer" name="frmCustomer">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="blue bigger">Add New Customer</h4>
		</div>

		<div class="modal-body overflow-visible">
			<div class="row-fluid">
				<div class="span10">
					<fieldset>
						<div class="control-group">
							<label for="form-field-1" class="control-label">First Name <span class="red">*</span></label>
							<div class="controls">
								<input type="text" id="txt_cust_first_name" name="txt_cust_first_name" class="required" value="" />
							</div>
						</div>
						<div class="control-group">
							<label for="form-field-1" class="control-label">Last Name <span class="red">*</span></label>
							<div class="controls">
								<input type="text" id="txt_cust_last_name" name="txt_cust_last_name" class="required" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label for="form-field-1" class="control-label">Email</label>
							<div class="controls">
								<input type="text" id="txt_cust_email" name="txt_cust_email" class="isemail span8" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label for="form-field-1" class="control-label">Phone</label>
							<div class="controls">
								<input type="text" id="txt_cust_phone" name="txt_cust_phone" class="" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label for="form-field-1" class="control-label">Mobile<span class="red">*</span></label>
							<div class="controls">
								<input type="text" id="txt_cust_mobile" name="txt_cust_mobile" class="required" value="" />
							</div>
						</div>
						
						<div class="control-group">
							<label for="form-field-1" class="control-label">Website</label>
							<div class="controls">
								<input type="text" id="txt_cust_website" name="txt_cust_website" class="span8" value="" />
							</div>
						</div>
					</fieldset>
				</div>
				<div class="span12">
					<div class="span6">
						 <h6 class="blue bigger">Shipping Address</h6>
						 <div class="control-group">
							<label for="form-field-1" class="control-label span3">Street<span class="red">*</span></label>
							<div class="controls span9">
								<textarea placeholder="Shipping Address" id="txt_shipping_street" name="txt_shipping_street" class="span10 required"></textarea>
							</div>
						 </div>
						 <div class="control-group">
							<label for="form-field-1" class="control-label span3">City<span class="red">*</span></label>
							<div class="controls span9">
								<input type="text" id="txt_shipping_city" name="txt_shipping_city" class="span8 required" value="" />
							</div>
						 </div>
						  <div class="control-group">
							<label for="form-field-1" class="control-label span3">State<span class="red">*</span></label>
							<div class="controls span9">
								<input type="text" id="txt_shipping_state" name="txt_shipping_state" class="required span8" value="" />
							</div>
						 </div>
						  <div class="control-group">
							<label for="form-field-1" class="control-label span3">Zip Code<span class="red">*</span></label>
							<div class="controls span9">
								<input type="text" id="txt_shipping_zipcode" name="txt_shipping_zipcode" class="required span8" value="" />
							</div>
						 </div>
						 <div class="control-group">
							<label for="form-field-1" class="control-label span3">Country<span class="red">*</span></label>
							<div class="controls span9">
								<input type="text" id="txt_shipping_country" name="txt_shipping_country" class="required span8" value="" />
							</div>
						 </div>
					</div>
					<div class="span6">
						<h6 class="blue bigger">Billing Address
							<label id="chk-cust-copy-addr">
								<input type="checkbox" name="chk-copy-address" id="chk-copy-address">
								<span class="lbl"> Same as shipping address</span>
							</label>
						</h6>
						 <div class="control-group">
							<label for="form-field-1" class="control-label span3">Street</label>
							<div class="controls span9">
								<textarea placeholder="Billng Address" id="txt_billing_street" name="txt_billing_street" class="span10"></textarea>
							</div>
						 </div>
						 <div class="control-group">
							<label for="form-field-1" class="control-label span3">City</label>
							<div class="controls span9">
								<input type="text" id="txt_billing_city" name="txt_billing_city" class="span8" value="" />
							</div>
						 </div>
						  <div class="control-group">
							<label for="form-field-1" class="control-label span3">State</label>
							<div class="controls span9">
								<input type="text" id="txt_billing_state" name="txt_billing_state" class="span8" value="" />
							</div>
						 </div>
						  <div class="control-group">
							<label for="form-field-1" class="control-label span3">Zip Code</label>
							<div class="controls span9">
								<input type="text" id="txt_billing_zipcode" name="txt_billing_zipcode" class="span8" value="" />
							</div>
						 </div>
						 <div class="control-group">
							<label for="form-field-1" class="control-label span3">Country</label>
							<div class="controls span9">
								<input type="text" id="txt_billing_country" name="txt_billing_country" class="span8" value="" />
							</div>
						 </div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal-footer">
			<button type="submit" class="btn btn-small btn-primary" id="saveCustomer">
				<i class="icon-ok"></i>
				Save
			</button>
			<button type="reset" class="btn btn-small"><i class="icon-undo"></i>Reset</button>
		</div>
	</form>
</div>
<!-- END Modal popup for Customer Form -->

<!-- START Modal popup for inventory details -->
<div id="inv-form" class="modal hide fade" tabindex="-1">
	<input type="hidden" name="hdnTrId" id="hdnTrId" value="" />
	<form name="frmTakeIn" id="frmTakeIn">
	</form>
</div>
<!-- END Modal popup for inventory details -->

<?php include(APPPATH.'views/bottom.php'); ?>

<script type="text/javascript">
$(document).ready(function(){
	$(".calc").blur();
	/* Add product for order entry */
	var row = '<?php echo $cnt; ?>';
	$(document).on('click', '#frmOrder .btn-add', function(e)
    {
		row++;
		e.preventDefault();
		var controlForm =  $('table.tbl-item-dtl tbody');
        var currentEntry = $('table.tbl-item-dtl tbody tr.entry-hidden');
        var newEntry = $(currentEntry.clone()).appendTo(controlForm);

		newEntry.removeClass("entry-hidden hide").addClass("entry");
        newEntry.attr('id',row);

		newEntry.find('#selProduct').addClass("required");
		newEntry.find('#txtProductQty').addClass("required");
		newEntry.find('#txtProductPrice').addClass("required");

		newEntry.find('input').removeClass('border-red');
		newEntry.find('select').removeClass('border-red');

		newEntry.find('#selProductType').attr('id','selProductType'+row);
		newEntry.find('#selProduct').attr('id','selProduct'+row);
		newEntry.find('#txtProductQty').attr('id','txtProductQty'+row);
		newEntry.find('#txtProductPrice').attr('id','txtProductPrice'+row);
		newEntry.find('#txtProductDiscountValue').attr('id','txtProductDiscountValue'+row);
		newEntry.find('#txtProductDiscountType').attr('id','txtProductDiscountType'+row);
		newEntry.find('#txtProductDiscountAmt').attr('id','txtProductDiscountAmt'+row);
		newEntry.find('#txtProductTax').attr('id','txtProductTax'+row);
		newEntry.find('#txtProductTaxAmt').attr('id','txtProductTaxAmt'+row);
		newEntry.find('#prodTotalAmount').attr('id','prodTotalAmount'+row);
		newEntry.find('#jsonString').attr('id','jsonString'+row);
    }).on('click', '.btn-remove', function(e)
    {
		e.preventDefault();
		$(this).parents('.entry:last').remove();
		$(".calc").blur();
		return false;
	});
	
	/* Add product for menufecture entry */
	$(document).on('click', '#frmMenuProdAdd .btn-add', function(e)
    {
        e.preventDefault();
        var controlForm = $('.controls form#frmMenuProdAdd:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
			
        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="icon-minus bigger-110"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		e.preventDefault();
		$(this).parents('.entry:first').remove();
		return false;
	});

	$(document).on("change",".productType",function(){
		var trid = $(this).parent().parent().attr("id");
		var param = {};
		param['prod_type'] = $(this).val();
		$.ajax({
			type:"POST",
			data:param,
			url:"index.php?c=commonajax&m=getProductComboByType",
			success:function(res)
			{
				$("#selProduct"+trid).html(res);
				$("#selProduct"+trid).trigger("liszt:updated");
			}
		});
		
	});
	
	//$(".product").change(function(){
	$(document).on("change",".product",function(){
		var trid = $(this).parent().parent().attr("id");
		var prod_id = $(this).val();
		if(prod_id == "" || prod_id == 0)
		{
			$("#txtProductPrice"+trid).val("");
			$(".calc").blur();
		}
		else
		{
			$.ajax({
				type:"POST",
				data:"prod_id="+prod_id,
				url:"index.php?c=product&m=getProductQty",
				success:function(res)
				{
					res = $.trim(res);
					$("#txtProductPrice"+trid).val(res);
					$(".calc").blur();
				}
			});

			var param = {};
			param['prod_id'] = prod_id;
			param['json'] = 0;
			param['stage_in_stock'] = 1;
			param['stage_inventory_order'] = 1;
			$.ajax({
				type:"POST",
				data:param,
				url:"index.php?c=inventory&m=getInventoryDetail",
				success:function(res)
				{
					$("#frmTakeIn").html(res);
				}
			});
			$("#hdnTrId").val(trid);
			$("#inv-form").modal();
		}
	});
	
	$(document).on("blur",".calc",function(){
		$(".text-error").remove();
		var trid = $(this).parent().parent().attr("id");
		var productId = $("#selProduct"+trid).val();
		var prodQty = $("#txtProductQty"+trid).val();

		// Check inventory
		/*if($(this).attr("name") == "txtProductQty" && productId != "" && prodQty != "")
		{
			var param = {};
			param['prod_id'] = productId;
			param['json'] = 1;
			$.ajax({
				type:"POST",
				data:param,
				dataType: "json",
				url:"index.php?c=inventory&m=getInventoryDetail",
				success:function(res)
				{
					var total_stock = parseInt(res.in_stock)+parseInt(res.in_process);
					if(prodQty > total_stock)
					{
						$("#txtProductQty"+trid).after("<span class='text-error'>In Stock : "+total_stock+"</span>");
						return false;
					}
				}
			});
		}*/


		var prodQty = (prodQty != "")?parseInt(prodQty):prodQty;
		var pricePerQty = $("#txtProductPrice"+trid).val();
		var pricePerQty = (pricePerQty != "")?parseFloat(pricePerQty):pricePerQty;
		var prodDiscountValue = $("#txtProductDiscountValue"+trid).val();
		var prodDiscountValue = (prodDiscountValue != "")?parseFloat(prodDiscountValue):prodDiscountValue;
		var prodDiscountType = $("#txtProductDiscountType"+trid).val();
		var productTax = $("#txtProductTax"+trid).val();
		var productTax = (productTax != "")?parseFloat(productTax):productTax;
		var productTotalAmount = "";
		
		var discountValue = $("#txtTotalDiscountValue").val();
		var discountValue = (discountValue != "")?parseFloat(discountValue):discountValue;
		var discountType = $("#selTotalDiscountType").val();
		var adjustAmount = $("#txtAdjustAmount").val();
		var adjustAmount = (adjustAmount != "")?parseFloat(adjustAmount):adjustAmount;
		var totalQty = 0;
		var subTotal = 0;
		var totalTax = 0;
		var finalTotal = 0;
		var discountAmount = 0;
		
		$("#txtProductTaxAmt"+trid).text('');
		$("#txtProductDiscountAmt"+trid).text('');
		$("#prodTotalAmount"+trid).text("0.0");

		// Calculate Product total amount
		if(prodQty != "" && pricePerQty != "")
		{
			productTotalAmount = parseFloat(pricePerQty*prodQty);

			// Add tax
			if(productTax != "")
			{
				taxAmount = parseFloat(productTotalAmount*productTax/100);
				productTotalAmount = parseFloat(productTotalAmount + taxAmount);
				$("#txtProductTaxAmt"+trid).text(taxAmount);
			}

			// substract discount amount
			if(prodDiscountValue != "")
			{
				if(prodDiscountType == "rs")
				{
					productTotalAmount = parseFloat(productTotalAmount - prodDiscountValue);
				}
				else
				{
					prodDiscountValue = parseFloat(productTotalAmount*prodDiscountValue/100);
					productTotalAmount = parseFloat(productTotalAmount - prodDiscountValue);
				}
				$("#txtProductDiscountAmt"+trid).text(prodDiscountValue);
			}
		}
		
		// Set product total amount
		if(productTotalAmount != "")
		{
			$("#prodTotalAmount"+trid).text(productTotalAmount);
		}

		// Calculate total product qty
		$('table.tbl-item-dtl tbody tr input[name="txtProductQty"]').each(function(){
			if($(this).val() != "")
			{
				totalQty = parseInt(totalQty) + parseInt($(this).val());
			}
		});
		$("#lblTotalQty").text(totalQty);
		
		// calculate sub total
		$('table.tbl-item-dtl tbody tr label').each(function(){
			subTotal = parseFloat(subTotal) + parseFloat($(this).text());
		});
		
		// calculate total tax amount
		$('table.tbl-item-dtl tbody tr small.small-tax').each(function(){
			if($(this).text() != "")
			{
				totalTax = parseFloat(totalTax) + parseFloat($(this).text());
			}
		});

		// set subtotal
		$("#lblSubTotal").text(subTotal);
		
		// substract discount amount from subtotal
		if(discountValue != "")
		{
			if(discountType == "rs")
			{
				discountAmount = parseFloat(discountValue);
				subTotal = parseFloat(subTotal - discountAmount);
			}
			else
			{
				discountAmount = parseFloat(subTotal*discountValue/100);
				subTotal = parseFloat(subTotal - discountAmount);
			}
			$("#lblDiscountAmount").text(-1*discountAmount)
		}
		
		// substract adjust amount from subtotal
		if(adjustAmount != "")
		{
			$("#lblAdjustAmount").text(adjustAmount);
			subTotal = parseFloat(subTotal + adjustAmount);
		}
		else
		{
			$("#lblAdjustAmount").text("0.0");
		}
		
		// Set total taxt amount and final total
		$("#lblTotalTax").text(totalTax);
		$("#lblFinalTotal").text(subTotal);
		
	});

	/* START Save Order */
	$(document).on("submit","#frmOrder",function(e){
		e.preventDefault();
		var error = 0;
		$(".errmsg").remove();
		if(!submit_form(this))
		{
			error++;
		}

		var productArr = {};
		var jsonArr = {};
		var chkProductArr = [];
		var prodError = 0;
		$('table.tbl-item-dtl tbody tr.entry').each(function(){
			var trid = $(this).attr('id');
			var prod_id = $(this).find('select[name="selProduct"]').val();
			productArr[prod_id] = {};
			productArr[prod_id]['prodType'] = $(this).find('select[name="selProductType"]').val();
			productArr[prod_id]['prodQty'] = $(this).find('input[name="txtProductQty"]').val();
			productArr[prod_id]['pricePerQty'] = $(this).find('input[name="txtProductPrice"]').val();
			productArr[prod_id]['prodTax'] = $(this).find('input[name="txtProductTax"]').val();
			productArr[prod_id]['prodTaxAmount'] = $(this).find('small[name="txtProductTaxAmt"]').text();
			productArr[prod_id]['prodDiscValue'] = $(this).find('input[name="txtProductDiscountValue"]').val();
			productArr[prod_id]['prodDiscType'] = $(this).find('select[name="txtProductDiscountType"]').val();
			productArr[prod_id]['prodDiscAmount'] = $(this).find('small[name="txtProductDiscountAmt"]').text();
			productArr[prod_id]['prodTotalAmount'] = $(this).find('label[name="prodTotalAmount"]').text();

			// Check duplicate product validation
			var found = jQuery.inArray(prod_id, chkProductArr);
			if (found >= 0) {
				$("#selProduct"+trid).addClass("border-red"); 
				$("#selProduct"+found).addClass("border-red");
				prodError++;
			} else {
				chkProductArr[trid] = prod_id;
			}

			if($(this).find('input[name="jsonString"]').val() != "")
			{
				jsonArr[prod_id] = $(this).find('input[name="jsonString"]').val();
			}
		});

		if(prodError > 0)
		{
			alert("Same product selected more than one time");
			error++;
		}

		if(error > 0)
		{
			return false;
		}
		
		var param = {};
		param['hdnAction'] = $("#hdnAction").val();
		param['hdnOrderId'] = $("#hdnOrderId").val();
		param['txtOrderNo'] = $("#txtOrderNo").val();
		param['selCustomer'] = $("#selCustomer").val();
		param['txtOrderDate'] = $("#txtOrderDate").val();
		param['txtShipDate'] = $("#txtShipDate").val();
		param['txtNote'] = $("#txtNote").val();

		param['totalQty'] = $("#lblTotalQty").text();
		param['subTotal'] = $("#lblSubTotal").text();
		param['totalTax'] = $("#lblTotalTax").text();
		param['discountValue'] = $("#txtTotalDiscountValue").val();
		param['discountType'] = $("#selTotalDiscountType").val();
		param['discountAmount'] = $("#lblDiscountAmount").text();
		param['adjustAmount'] = $("#txtAdjustAmount").val();
		param['finalTotalAmount'] = $("#lblFinalTotal").text();
		param['productArr'] = productArr;
		param['jsonArr'] = jsonArr;
		//alert(param.toSource()); return false;
		$.ajax({
			type:"POST",
			data:param,
			url:"index.php?c=order&m=saveOrder",
			success:function(res)
			{
				if(res == "1")
				{
					alert("Order saved successfully");
					window.location.href="index.php?c=order";
				}
				else
				{
					alert("Data not saved property please try again!"); return false;
				}
			}
		})
	});
	/* END Save Order */
	
	/* START Save menufecture order*/
	$(document).on("click","#saveMenuOrder",function(){
		$(".text-error").remove();
		$("#frmMenuProdAdd").find('select').css("border-color","#d5d5d5");
		$("#frmMenuProdAdd").find('input[type="text"]').css("border-color","#d5d5d5");
		var i=0;
		var nullVal=0;
		var data = {};
		var tot_qty = 0;
		$("#frmMenuProdAdd .entry").each(function(){
			var selectObj = $(this).find('select');
			var inputObj = $(this).find('input[type="text"]');
			var btnObj = $(this).find('button');
			if(btnObj.hasClass("btn-remove"))
			{
				if(selectObj.val() == "" || selectObj.val() == 0 || selectObj.val() == null)
				{
					selectObj.css("border-color","#d15b47");
					nullVal++;
				}
				if(inputObj.val() == "" || inputObj.val() == 0 || inputObj.val() == null)
				{
					inputObj.css("border-color","#d15b47");
					nullVal++;
				}
									
				data[i] = {};
				data[i]['prodId'] = selectObj.val();
				data[i]['prodQty'] = inputObj.val();
				tot_qty += parseInt(inputObj.val());
				i++;
			}
		});
		
		// validation
		if(nullVal > 0)
		{
			$("#saveMenuOrder").before('<span class="text-error">some field are blanks</span>');
			return false;
		}
		else if(Object.keys(data).length == 0)
		{
			$("#saveMenuOrder").before('<span class="text-error">Minimum one product required</span>');
			return false;
		}
		
		var param = {};
		param['dataArr'] = data;
		param['tot_qty'] = tot_qty;
		//alert(param.toSource());
		$.ajax({
			type:"POST",
			data:param,
			url:"index.php?c=manufecture&m=saveMftOrder",
			success:function(res)
			{
				alert("Menufecture order created successfully"); 
				$('#mft-form').modal('hide');
				return false;
			}
		});
	});

	// enable/disable textbox on check/uncheck and set stage wise using qty
	$(document).on("click",".chk",function(){
		var id=this.id;
		var checked = ($(this).is(":checked"))?1:0;
		if(checked)
		{
			$("#txtOrderQty"+id).prop('disabled', false);
		}
		else
		{
			$("#txtOrderQty"+id).prop('disabled', true);
		}

		// set stage wise using qty on checked
		var stageId = $(this).attr('stageId');
		var mftId = $(this).attr('mftId');

		if(checked)
		{
			var total_qty = parseInt($("#spnOrderTotalQty"+stageId+mftId).text());
			var value = 0;
			if($("#txtOrderQty"+stageId+mftId).val() != "")
			{
				var value = parseInt($("#txtOrderQty"+stageId+mftId).val());
			}

			if(value > total_qty)
			{
				alert("Quantity should not more than total Qty "+total_qty);
				return false;
			}
		}

		var qty = 0;
		$(".tab-content div#"+stageId+" input[type='text']:enabled").each(function(){
			if($(this).val() != "")
			{
				qty = parseInt(qty)+ parseInt($(this).val());
			}
		});
		$("#spnUseQty"+stageId).text(qty);
	});

	// set stage wise using qty on blur
	$(document).on("blur",".useQty",function(){
		var stageId = $(this).attr('stageId');
		var mftId = $(this).attr('mftId');
		var total_qty = parseInt($("#spnOrderTotalQty"+stageId+mftId).text());
		var value = $(this).val();
		
		if(value > total_qty)
		{
			alert("Quantity should not more than total Qty "+total_qty);
			return false;
		}
		var qty = 0;
		$(".tab-content div#"+stageId+" input[type='text']").each(function(){
			if($(this).val() != "")
			{
				qty = parseInt(qty)+ parseInt($(this).val());
			}
		});
		$("#spnUseQty"+stageId).text(qty);
	});

	$("#frmTakeIn").submit(function(e){
		e.preventDefault();
		var trId = $("#hdnTrId").val();
		var hash = {};
		$("table#tblStgInvOrderList tbody tr input[type='text']:enabled").each(function(){
			var prod_id = $(this).attr('prodId');
			var stage_id = $(this).attr('stageId');
			var mft_id = $(this).attr('mftId');
			var qty = $(this).val();

			
			if(typeof(hash[prod_id]) == 'undefined')
				hash[prod_id] = {};
			if(typeof(hash[prod_id][stage_id]) == 'undefined')
				hash[prod_id][stage_id] = {};	
			if(typeof(hash[prod_id][stage_id][mft_id]) == 'undefined')
				hash[prod_id][stage_id][mft_id] = {};	
			hash[prod_id][stage_id][mft_id] = qty;
			$("#jsonString"+trId).val(JSON.stringify(hash));
		});
		//alert(hash.toSource()); return false;
		$("#inv-form").modal('hide');
	});

	// Save customer details from popup
	$("#frmCustomer").submit(function(e){
		e.preventDefault();
		$(".errmsg").remove();
		if(!submit_form(this))
		{
			return false;
		}
		
		var param = $("#frmCustomer").serialize();
		$.ajax({
			type:"POST",
			url:"index.php?c=customer&m=saveCustomer",
			data:param,
			beforeSend:function(){
			},
			success:function(r){
				var res = $.trim(r).split("|");
				if(res[1] == "success")
				{
					var firstname = $("#txt_cust_first_name").val();
					var lastname = $("#txt_cust_last_name").val();
					var option = "<option value="+res[0]+" selected='selected'>"+firstname+" "+lastname+"</option>"
					$("#selCustomer").append(option);
					$('#frmCustomer')[0].reset();
					$("#cust-form").modal('hide');
				}
				else if(res[1] == "exist")
				{
					$("#selCustomer").append(res[0]);
					$('#frmCustomer')[0].reset();
					$("#cust-form").modal('hide');
				}
				else
				{
					alert(r);
				}
			}
		});
	});
});
</script>