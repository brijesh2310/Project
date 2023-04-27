<?php
namespace PHPMaker2020\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$otp_expiry_delete = new otp_expiry_delete();

// Run the page
$otp_expiry_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$otp_expiry_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fotp_expirydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fotp_expirydelete = currentForm = new ew.Form("fotp_expirydelete", "delete");
	loadjs.done("fotp_expirydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $otp_expiry_delete->showPageHeader(); ?>
<?php
$otp_expiry_delete->showMessage();
?>
<form name="fotp_expirydelete" id="fotp_expirydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="otp_expiry">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($otp_expiry_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($otp_expiry_delete->otp_id->Visible) { // otp_id ?>
		<th class="<?php echo $otp_expiry_delete->otp_id->headerCellClass() ?>"><span id="elh_otp_expiry_otp_id" class="otp_expiry_otp_id"><?php echo $otp_expiry_delete->otp_id->caption() ?></span></th>
<?php } ?>
<?php if ($otp_expiry_delete->otp->Visible) { // otp ?>
		<th class="<?php echo $otp_expiry_delete->otp->headerCellClass() ?>"><span id="elh_otp_expiry_otp" class="otp_expiry_otp"><?php echo $otp_expiry_delete->otp->caption() ?></span></th>
<?php } ?>
<?php if ($otp_expiry_delete->_email->Visible) { // email ?>
		<th class="<?php echo $otp_expiry_delete->_email->headerCellClass() ?>"><span id="elh_otp_expiry__email" class="otp_expiry__email"><?php echo $otp_expiry_delete->_email->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$otp_expiry_delete->RecordCount = 0;
$i = 0;
while (!$otp_expiry_delete->Recordset->EOF) {
	$otp_expiry_delete->RecordCount++;
	$otp_expiry_delete->RowCount++;

	// Set row properties
	$otp_expiry->resetAttributes();
	$otp_expiry->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$otp_expiry_delete->loadRowValues($otp_expiry_delete->Recordset);

	// Render row
	$otp_expiry_delete->renderRow();
?>
	<tr <?php echo $otp_expiry->rowAttributes() ?>>
<?php if ($otp_expiry_delete->otp_id->Visible) { // otp_id ?>
		<td <?php echo $otp_expiry_delete->otp_id->cellAttributes() ?>>
<span id="el<?php echo $otp_expiry_delete->RowCount ?>_otp_expiry_otp_id" class="otp_expiry_otp_id">
<span<?php echo $otp_expiry_delete->otp_id->viewAttributes() ?>><?php echo $otp_expiry_delete->otp_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($otp_expiry_delete->otp->Visible) { // otp ?>
		<td <?php echo $otp_expiry_delete->otp->cellAttributes() ?>>
<span id="el<?php echo $otp_expiry_delete->RowCount ?>_otp_expiry_otp" class="otp_expiry_otp">
<span<?php echo $otp_expiry_delete->otp->viewAttributes() ?>><?php echo $otp_expiry_delete->otp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($otp_expiry_delete->_email->Visible) { // email ?>
		<td <?php echo $otp_expiry_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $otp_expiry_delete->RowCount ?>_otp_expiry__email" class="otp_expiry__email">
<span<?php echo $otp_expiry_delete->_email->viewAttributes() ?>><?php echo $otp_expiry_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$otp_expiry_delete->Recordset->moveNext();
}
$otp_expiry_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $otp_expiry_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$otp_expiry_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$otp_expiry_delete->terminate();
?>