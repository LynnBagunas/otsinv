<?php include(APPPATH.'views/top.php'); ?>
<?php
$this->load->helper('form');
$attributes = array('class' => 'frm_add_record form-horizontal', 'id' => 'frm_add_user', 'name' => 'frm_add_user');
echo form_open('c=department&m=saveDepartment', $attributes);
?>
<div class="page-header position-relative">
    <h1>Add Department</h1>
</div>

<input type="hidden" name="action" value="<?php echo $strAction; ?>" id="action"/>
<input type="hidden" name="hid_id" value="<?php echo $id; ?>" id="hid_id" />
<input type="hidden" id="txt_counter" name="txt_counter" value="0" />
<input type="hidden" id="from_page" name="from_page" value="<?php echo $from_page; ?>" />

<div class="row-fluid" id="printFrmDiv">
    <div class="span10">
        <fieldset>
            <div class="control-group">
                <label for="form-field-1" class="control-label">Company Id <span class="red">*</span></label>
                <div class="controls">
                    <select class="required span6" name="slt_company_id" >
                    	<?php echo $this->Page->generateComboByTable("company_master","com_id","com_name","","where status='Active'",$rsEdit->company_id,"Select Company"); ?>
                    </select>
                </div>
            </div>
            
            <div class="control-group">
                <label for="form-field-1" class="control-label">Department Name <span class="red">*</span></label>
                <div class="controls">
                    <input type="text" id="txt_dept_name" name="txt_dept_name" class="required span6" value="<?php echo $rsEdit->dept_name; ?>" />
                </div>
            </div>
            
            <div class="control-group">
                <label for="form-field-1" class="control-label">Status<span class="red">*</span></label>
                <div class="controls">
                	<select class="required span6" name="slt_status" >
                    	<?php echo $this->Page->generateComboByTable("combo_master","combo_key","combo_value",0,"where combo_case='STATUS' order by seq",$rsEdit->status,""); ?>
                    </select>
                </div>
            </div>
            
            <div class="control-group non-printable">
                <div class="controls">
                    <input type="submit" class="btn btn-primary btn-small" value="Save" onclick="return submit_form(this.form);">
                    <input type="button" class="btn btn-primary btn-small" value="Cancel" onclick="window.history.back()" >
                </div>
            </div>
        </fieldset>
    </div>
</div>

<?php echo form_close(); ?>

<?php include(APPPATH.'views/bottom.php'); ?>

<script type="text/javascript">
$(document).ready(function(){

});</script>
