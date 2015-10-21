<?php include(APPPATH.'views/top.php'); ?>
<?php
$this->load->helper('form');
$attributes = array('class' => 'frm_add_record form-horizontal', 'id' => 'frm_add_vendor', 'name' => 'frm_add_vendor');
echo form_open('c=setting&m=saveModule', $attributes);
?>
<div class="page-header position-relative">
    <h1>Add Module</h1>
</div>

<input type="hidden" name="action" value="<?php echo $strAction; ?>" id="action"/>
<input type="hidden" name="module_id" value="<?php echo $id; ?>" id="module_id" />
<input type="hidden" id="txt_counter" name="txt_counter" value="0" />
<input type="hidden" id="from_page" name="from_page" value="<?php echo $from_page; ?>" />

<div class="row-fluid" id="printFrmDiv">
    <div class="span10">
        <fieldset>
            <div class="control-group">
                <label for="form-field-1" class="control-label">Module Name <span class="red">*</span></label>
                <div class="controls">
                    <input type="text" id="txt_module_name" name="txt_module_name" class="required span6" value="<?php echo $rsEdit->module_name; ?>" />
                </div>
            </div>
            
            <div class="control-group">
                <label for="form-field-1" class="control-label">Panel Id <span class="red">*</span></label>
                <div class="controls">
                    <select class="required span6" name="slt_panel_id" id="slt_panel_id" >
                    	<?php echo $this->Page->generateComboByTable("panel_master","panel_id","panel_name","","",$rsEdit->user_type,"Select Panel"); ?>
                    </select>
                </div>
            </div>
            
            <div class="control-group">
                <label for="form-field-1" class="control-label">Module Url<span class="red">*</span></label>
                <div class="controls">
                    <input type="text" id="txt_module_url" name="txt_module_url" class="span6 required" value="<?php echo $rsEdit->module_url; ?>" />
                </div>
            </div>
            <div class="control-group">
                <label for="form-field-1" class="control-label">Sequence<span class="red">*</span></label>
                <div class="controls">
                    <input type="text" id="txt_seq" name="txt_seq" class="span6 required" value="<?php echo $rsEdit->seq; ?>" />
                </div>
            </div>
            
            <div class="control-group">
                <label for="form-field-1" class="control-label">Status<span class="red">*</span></label>
                <div class="controls">
                	<select class="required span6" name="slt_status" id="slt_status" >
                    	<?php echo $this->Page->generateComboByTable("combo_master","combo_value","combo_key",0,"where combo_case='STATUS' order by seq",$rsEdit->status,""); ?>
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
