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
$category_delete = new category_delete();

// Run the page
$category_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcategorydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcategorydelete = currentForm = new ew.Form("fcategorydelete", "delete");
	loadjs.done("fcategorydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $category_delete->showPageHeader(); ?>
<?php
$category_delete->showMessage();
?>
<form name="fcategorydelete" id="fcategorydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($category_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($category_delete->category_id->Visible) { // category_id ?>
		<th class="<?php echo $category_delete->category_id->headerCellClass() ?>"><span id="elh_category_category_id" class="category_category_id"><?php echo $category_delete->category_id->caption() ?></span></th>
<?php } ?>
<?php if ($category_delete->category_name->Visible) { // category_name ?>
		<th class="<?php echo $category_delete->category_name->headerCellClass() ?>"><span id="elh_category_category_name" class="category_category_name"><?php echo $category_delete->category_name->caption() ?></span></th>
<?php } ?>
<?php if ($category_delete->category_img->Visible) { // category_img ?>
		<th class="<?php echo $category_delete->category_img->headerCellClass() ?>"><span id="elh_category_category_img" class="category_category_img"><?php echo $category_delete->category_img->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$category_delete->RecordCount = 0;
$i = 0;
while (!$category_delete->Recordset->EOF) {
	$category_delete->RecordCount++;
	$category_delete->RowCount++;

	// Set row properties
	$category->resetAttributes();
	$category->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$category_delete->loadRowValues($category_delete->Recordset);

	// Render row
	$category_delete->renderRow();
?>
	<tr <?php echo $category->rowAttributes() ?>>
<?php if ($category_delete->category_id->Visible) { // category_id ?>
		<td <?php echo $category_delete->category_id->cellAttributes() ?>>
<span id="el<?php echo $category_delete->RowCount ?>_category_category_id" class="category_category_id">
<span<?php echo $category_delete->category_id->viewAttributes() ?>><?php echo $category_delete->category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($category_delete->category_name->Visible) { // category_name ?>
		<td <?php echo $category_delete->category_name->cellAttributes() ?>>
<span id="el<?php echo $category_delete->RowCount ?>_category_category_name" class="category_category_name">
<span<?php echo $category_delete->category_name->viewAttributes() ?>><?php echo $category_delete->category_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($category_delete->category_img->Visible) { // category_img ?>
		<td <?php echo $category_delete->category_img->cellAttributes() ?>>
<span id="el<?php echo $category_delete->RowCount ?>_category_category_img" class="category_category_img">
<span<?php echo $category_delete->category_img->viewAttributes() ?>><?php echo $category_delete->category_img->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$category_delete->Recordset->moveNext();
}
$category_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $category_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$category_delete->showPageFooter();
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
$category_delete->terminate();
?>