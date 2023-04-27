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
$sub_category_delete = new sub_category_delete();

// Run the page
$sub_category_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sub_category_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsub_categorydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsub_categorydelete = currentForm = new ew.Form("fsub_categorydelete", "delete");
	loadjs.done("fsub_categorydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sub_category_delete->showPageHeader(); ?>
<?php
$sub_category_delete->showMessage();
?>
<form name="fsub_categorydelete" id="fsub_categorydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sub_category">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($sub_category_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($sub_category_delete->subcategory_id->Visible) { // subcategory_id ?>
		<th class="<?php echo $sub_category_delete->subcategory_id->headerCellClass() ?>"><span id="elh_sub_category_subcategory_id" class="sub_category_subcategory_id"><?php echo $sub_category_delete->subcategory_id->caption() ?></span></th>
<?php } ?>
<?php if ($sub_category_delete->subcategory_name->Visible) { // subcategory_name ?>
		<th class="<?php echo $sub_category_delete->subcategory_name->headerCellClass() ?>"><span id="elh_sub_category_subcategory_name" class="sub_category_subcategory_name"><?php echo $sub_category_delete->subcategory_name->caption() ?></span></th>
<?php } ?>
<?php if ($sub_category_delete->subcategory_img->Visible) { // subcategory_img ?>
		<th class="<?php echo $sub_category_delete->subcategory_img->headerCellClass() ?>"><span id="elh_sub_category_subcategory_img" class="sub_category_subcategory_img"><?php echo $sub_category_delete->subcategory_img->caption() ?></span></th>
<?php } ?>
<?php if ($sub_category_delete->category_name->Visible) { // category_name ?>
		<th class="<?php echo $sub_category_delete->category_name->headerCellClass() ?>"><span id="elh_sub_category_category_name" class="sub_category_category_name"><?php echo $sub_category_delete->category_name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$sub_category_delete->RecordCount = 0;
$i = 0;
while (!$sub_category_delete->Recordset->EOF) {
	$sub_category_delete->RecordCount++;
	$sub_category_delete->RowCount++;

	// Set row properties
	$sub_category->resetAttributes();
	$sub_category->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$sub_category_delete->loadRowValues($sub_category_delete->Recordset);

	// Render row
	$sub_category_delete->renderRow();
?>
	<tr <?php echo $sub_category->rowAttributes() ?>>
<?php if ($sub_category_delete->subcategory_id->Visible) { // subcategory_id ?>
		<td <?php echo $sub_category_delete->subcategory_id->cellAttributes() ?>>
<span id="el<?php echo $sub_category_delete->RowCount ?>_sub_category_subcategory_id" class="sub_category_subcategory_id">
<span<?php echo $sub_category_delete->subcategory_id->viewAttributes() ?>><?php echo $sub_category_delete->subcategory_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sub_category_delete->subcategory_name->Visible) { // subcategory_name ?>
		<td <?php echo $sub_category_delete->subcategory_name->cellAttributes() ?>>
<span id="el<?php echo $sub_category_delete->RowCount ?>_sub_category_subcategory_name" class="sub_category_subcategory_name">
<span<?php echo $sub_category_delete->subcategory_name->viewAttributes() ?>><?php echo $sub_category_delete->subcategory_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sub_category_delete->subcategory_img->Visible) { // subcategory_img ?>
		<td <?php echo $sub_category_delete->subcategory_img->cellAttributes() ?>>
<span id="el<?php echo $sub_category_delete->RowCount ?>_sub_category_subcategory_img" class="sub_category_subcategory_img">
<span<?php echo $sub_category_delete->subcategory_img->viewAttributes() ?>><?php echo $sub_category_delete->subcategory_img->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sub_category_delete->category_name->Visible) { // category_name ?>
		<td <?php echo $sub_category_delete->category_name->cellAttributes() ?>>
<span id="el<?php echo $sub_category_delete->RowCount ?>_sub_category_category_name" class="sub_category_category_name">
<span<?php echo $sub_category_delete->category_name->viewAttributes() ?>><?php echo $sub_category_delete->category_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$sub_category_delete->Recordset->moveNext();
}
$sub_category_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sub_category_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$sub_category_delete->showPageFooter();
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
$sub_category_delete->terminate();
?>