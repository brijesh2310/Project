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
$registration_delete = new registration_delete();

// Run the page
$registration_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$registration_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fregistrationdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fregistrationdelete = currentForm = new ew.Form("fregistrationdelete", "delete");
	loadjs.done("fregistrationdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $registration_delete->showPageHeader(); ?>
<?php
$registration_delete->showMessage();
?>
<form name="fregistrationdelete" id="fregistrationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="registration">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($registration_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($registration_delete->registration_id->Visible) { // registration_id ?>
		<th class="<?php echo $registration_delete->registration_id->headerCellClass() ?>"><span id="elh_registration_registration_id" class="registration_registration_id"><?php echo $registration_delete->registration_id->caption() ?></span></th>
<?php } ?>
<?php if ($registration_delete->name->Visible) { // name ?>
		<th class="<?php echo $registration_delete->name->headerCellClass() ?>"><span id="elh_registration_name" class="registration_name"><?php echo $registration_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($registration_delete->_email->Visible) { // email ?>
		<th class="<?php echo $registration_delete->_email->headerCellClass() ?>"><span id="elh_registration__email" class="registration__email"><?php echo $registration_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($registration_delete->password->Visible) { // password ?>
		<th class="<?php echo $registration_delete->password->headerCellClass() ?>"><span id="elh_registration_password" class="registration_password"><?php echo $registration_delete->password->caption() ?></span></th>
<?php } ?>
<?php if ($registration_delete->address->Visible) { // address ?>
		<th class="<?php echo $registration_delete->address->headerCellClass() ?>"><span id="elh_registration_address" class="registration_address"><?php echo $registration_delete->address->caption() ?></span></th>
<?php } ?>
<?php if ($registration_delete->city->Visible) { // city ?>
		<th class="<?php echo $registration_delete->city->headerCellClass() ?>"><span id="elh_registration_city" class="registration_city"><?php echo $registration_delete->city->caption() ?></span></th>
<?php } ?>
<?php if ($registration_delete->area->Visible) { // area ?>
		<th class="<?php echo $registration_delete->area->headerCellClass() ?>"><span id="elh_registration_area" class="registration_area"><?php echo $registration_delete->area->caption() ?></span></th>
<?php } ?>
<?php if ($registration_delete->postalcode->Visible) { // postalcode ?>
		<th class="<?php echo $registration_delete->postalcode->headerCellClass() ?>"><span id="elh_registration_postalcode" class="registration_postalcode"><?php echo $registration_delete->postalcode->caption() ?></span></th>
<?php } ?>
<?php if ($registration_delete->gender->Visible) { // gender ?>
		<th class="<?php echo $registration_delete->gender->headerCellClass() ?>"><span id="elh_registration_gender" class="registration_gender"><?php echo $registration_delete->gender->caption() ?></span></th>
<?php } ?>
<?php if ($registration_delete->mobile->Visible) { // mobile ?>
		<th class="<?php echo $registration_delete->mobile->headerCellClass() ?>"><span id="elh_registration_mobile" class="registration_mobile"><?php echo $registration_delete->mobile->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$registration_delete->RecordCount = 0;
$i = 0;
while (!$registration_delete->Recordset->EOF) {
	$registration_delete->RecordCount++;
	$registration_delete->RowCount++;

	// Set row properties
	$registration->resetAttributes();
	$registration->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$registration_delete->loadRowValues($registration_delete->Recordset);

	// Render row
	$registration_delete->renderRow();
?>
	<tr <?php echo $registration->rowAttributes() ?>>
<?php if ($registration_delete->registration_id->Visible) { // registration_id ?>
		<td <?php echo $registration_delete->registration_id->cellAttributes() ?>>
<span id="el<?php echo $registration_delete->RowCount ?>_registration_registration_id" class="registration_registration_id">
<span<?php echo $registration_delete->registration_id->viewAttributes() ?>><?php echo $registration_delete->registration_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($registration_delete->name->Visible) { // name ?>
		<td <?php echo $registration_delete->name->cellAttributes() ?>>
<span id="el<?php echo $registration_delete->RowCount ?>_registration_name" class="registration_name">
<span<?php echo $registration_delete->name->viewAttributes() ?>><?php echo $registration_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($registration_delete->_email->Visible) { // email ?>
		<td <?php echo $registration_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $registration_delete->RowCount ?>_registration__email" class="registration__email">
<span<?php echo $registration_delete->_email->viewAttributes() ?>><?php echo $registration_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($registration_delete->password->Visible) { // password ?>
		<td <?php echo $registration_delete->password->cellAttributes() ?>>
<span id="el<?php echo $registration_delete->RowCount ?>_registration_password" class="registration_password">
<span<?php echo $registration_delete->password->viewAttributes() ?>><?php echo $registration_delete->password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($registration_delete->address->Visible) { // address ?>
		<td <?php echo $registration_delete->address->cellAttributes() ?>>
<span id="el<?php echo $registration_delete->RowCount ?>_registration_address" class="registration_address">
<span<?php echo $registration_delete->address->viewAttributes() ?>><?php echo $registration_delete->address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($registration_delete->city->Visible) { // city ?>
		<td <?php echo $registration_delete->city->cellAttributes() ?>>
<span id="el<?php echo $registration_delete->RowCount ?>_registration_city" class="registration_city">
<span<?php echo $registration_delete->city->viewAttributes() ?>><?php echo $registration_delete->city->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($registration_delete->area->Visible) { // area ?>
		<td <?php echo $registration_delete->area->cellAttributes() ?>>
<span id="el<?php echo $registration_delete->RowCount ?>_registration_area" class="registration_area">
<span<?php echo $registration_delete->area->viewAttributes() ?>><?php echo $registration_delete->area->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($registration_delete->postalcode->Visible) { // postalcode ?>
		<td <?php echo $registration_delete->postalcode->cellAttributes() ?>>
<span id="el<?php echo $registration_delete->RowCount ?>_registration_postalcode" class="registration_postalcode">
<span<?php echo $registration_delete->postalcode->viewAttributes() ?>><?php echo $registration_delete->postalcode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($registration_delete->gender->Visible) { // gender ?>
		<td <?php echo $registration_delete->gender->cellAttributes() ?>>
<span id="el<?php echo $registration_delete->RowCount ?>_registration_gender" class="registration_gender">
<span<?php echo $registration_delete->gender->viewAttributes() ?>><?php echo $registration_delete->gender->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($registration_delete->mobile->Visible) { // mobile ?>
		<td <?php echo $registration_delete->mobile->cellAttributes() ?>>
<span id="el<?php echo $registration_delete->RowCount ?>_registration_mobile" class="registration_mobile">
<span<?php echo $registration_delete->mobile->viewAttributes() ?>><?php echo $registration_delete->mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$registration_delete->Recordset->moveNext();
}
$registration_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $registration_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$registration_delete->showPageFooter();
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
$registration_delete->terminate();
?>