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
$admin_delete = new admin_delete();

// Run the page
$admin_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fadmindelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fadmindelete = currentForm = new ew.Form("fadmindelete", "delete");
	loadjs.done("fadmindelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $admin_delete->showPageHeader(); ?>
<?php
$admin_delete->showMessage();
?>
<form name="fadmindelete" id="fadmindelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($admin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($admin_delete->id->Visible) { // id ?>
		<th class="<?php echo $admin_delete->id->headerCellClass() ?>"><span id="elh_admin_id" class="admin_id"><?php echo $admin_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($admin_delete->name->Visible) { // name ?>
		<th class="<?php echo $admin_delete->name->headerCellClass() ?>"><span id="elh_admin_name" class="admin_name"><?php echo $admin_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($admin_delete->_email->Visible) { // email ?>
		<th class="<?php echo $admin_delete->_email->headerCellClass() ?>"><span id="elh_admin__email" class="admin__email"><?php echo $admin_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($admin_delete->password->Visible) { // password ?>
		<th class="<?php echo $admin_delete->password->headerCellClass() ?>"><span id="elh_admin_password" class="admin_password"><?php echo $admin_delete->password->caption() ?></span></th>
<?php } ?>
<?php if ($admin_delete->address->Visible) { // address ?>
		<th class="<?php echo $admin_delete->address->headerCellClass() ?>"><span id="elh_admin_address" class="admin_address"><?php echo $admin_delete->address->caption() ?></span></th>
<?php } ?>
<?php if ($admin_delete->mobile->Visible) { // mobile ?>
		<th class="<?php echo $admin_delete->mobile->headerCellClass() ?>"><span id="elh_admin_mobile" class="admin_mobile"><?php echo $admin_delete->mobile->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$admin_delete->RecordCount = 0;
$i = 0;
while (!$admin_delete->Recordset->EOF) {
	$admin_delete->RecordCount++;
	$admin_delete->RowCount++;

	// Set row properties
	$admin->resetAttributes();
	$admin->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$admin_delete->loadRowValues($admin_delete->Recordset);

	// Render row
	$admin_delete->renderRow();
?>
	<tr <?php echo $admin->rowAttributes() ?>>
<?php if ($admin_delete->id->Visible) { // id ?>
		<td <?php echo $admin_delete->id->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCount ?>_admin_id" class="admin_id">
<span<?php echo $admin_delete->id->viewAttributes() ?>><?php echo $admin_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin_delete->name->Visible) { // name ?>
		<td <?php echo $admin_delete->name->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCount ?>_admin_name" class="admin_name">
<span<?php echo $admin_delete->name->viewAttributes() ?>><?php echo $admin_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin_delete->_email->Visible) { // email ?>
		<td <?php echo $admin_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCount ?>_admin__email" class="admin__email">
<span<?php echo $admin_delete->_email->viewAttributes() ?>><?php echo $admin_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin_delete->password->Visible) { // password ?>
		<td <?php echo $admin_delete->password->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCount ?>_admin_password" class="admin_password">
<span<?php echo $admin_delete->password->viewAttributes() ?>><?php echo $admin_delete->password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin_delete->address->Visible) { // address ?>
		<td <?php echo $admin_delete->address->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCount ?>_admin_address" class="admin_address">
<span<?php echo $admin_delete->address->viewAttributes() ?>><?php echo $admin_delete->address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin_delete->mobile->Visible) { // mobile ?>
		<td <?php echo $admin_delete->mobile->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCount ?>_admin_mobile" class="admin_mobile">
<span<?php echo $admin_delete->mobile->viewAttributes() ?>><?php echo $admin_delete->mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$admin_delete->Recordset->moveNext();
}
$admin_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $admin_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$admin_delete->showPageFooter();
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
$admin_delete->terminate();
?>