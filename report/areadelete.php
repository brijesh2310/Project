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
$area_delete = new area_delete();

// Run the page
$area_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$area_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fareadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fareadelete = currentForm = new ew.Form("fareadelete", "delete");
	loadjs.done("fareadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $area_delete->showPageHeader(); ?>
<?php
$area_delete->showMessage();
?>
<form name="fareadelete" id="fareadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="area">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($area_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($area_delete->area_id->Visible) { // area_id ?>
		<th class="<?php echo $area_delete->area_id->headerCellClass() ?>"><span id="elh_area_area_id" class="area_area_id"><?php echo $area_delete->area_id->caption() ?></span></th>
<?php } ?>
<?php if ($area_delete->area_name->Visible) { // area_name ?>
		<th class="<?php echo $area_delete->area_name->headerCellClass() ?>"><span id="elh_area_area_name" class="area_area_name"><?php echo $area_delete->area_name->caption() ?></span></th>
<?php } ?>
<?php if ($area_delete->city_name->Visible) { // city_name ?>
		<th class="<?php echo $area_delete->city_name->headerCellClass() ?>"><span id="elh_area_city_name" class="area_city_name"><?php echo $area_delete->city_name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$area_delete->RecordCount = 0;
$i = 0;
while (!$area_delete->Recordset->EOF) {
	$area_delete->RecordCount++;
	$area_delete->RowCount++;

	// Set row properties
	$area->resetAttributes();
	$area->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$area_delete->loadRowValues($area_delete->Recordset);

	// Render row
	$area_delete->renderRow();
?>
	<tr <?php echo $area->rowAttributes() ?>>
<?php if ($area_delete->area_id->Visible) { // area_id ?>
		<td <?php echo $area_delete->area_id->cellAttributes() ?>>
<span id="el<?php echo $area_delete->RowCount ?>_area_area_id" class="area_area_id">
<span<?php echo $area_delete->area_id->viewAttributes() ?>><?php echo $area_delete->area_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($area_delete->area_name->Visible) { // area_name ?>
		<td <?php echo $area_delete->area_name->cellAttributes() ?>>
<span id="el<?php echo $area_delete->RowCount ?>_area_area_name" class="area_area_name">
<span<?php echo $area_delete->area_name->viewAttributes() ?>><?php echo $area_delete->area_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($area_delete->city_name->Visible) { // city_name ?>
		<td <?php echo $area_delete->city_name->cellAttributes() ?>>
<span id="el<?php echo $area_delete->RowCount ?>_area_city_name" class="area_city_name">
<span<?php echo $area_delete->city_name->viewAttributes() ?>><?php echo $area_delete->city_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$area_delete->Recordset->moveNext();
}
$area_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $area_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$area_delete->showPageFooter();
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
$area_delete->terminate();
?>