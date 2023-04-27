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
$rating_delete = new rating_delete();

// Run the page
$rating_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rating_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fratingdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fratingdelete = currentForm = new ew.Form("fratingdelete", "delete");
	loadjs.done("fratingdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rating_delete->showPageHeader(); ?>
<?php
$rating_delete->showMessage();
?>
<form name="fratingdelete" id="fratingdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rating">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($rating_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($rating_delete->id->Visible) { // id ?>
		<th class="<?php echo $rating_delete->id->headerCellClass() ?>"><span id="elh_rating_id" class="rating_id"><?php echo $rating_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($rating_delete->name->Visible) { // name ?>
		<th class="<?php echo $rating_delete->name->headerCellClass() ?>"><span id="elh_rating_name" class="rating_name"><?php echo $rating_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($rating_delete->_email->Visible) { // email ?>
		<th class="<?php echo $rating_delete->_email->headerCellClass() ?>"><span id="elh_rating__email" class="rating__email"><?php echo $rating_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($rating_delete->rate->Visible) { // rate ?>
		<th class="<?php echo $rating_delete->rate->headerCellClass() ?>"><span id="elh_rating_rate" class="rating_rate"><?php echo $rating_delete->rate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$rating_delete->RecordCount = 0;
$i = 0;
while (!$rating_delete->Recordset->EOF) {
	$rating_delete->RecordCount++;
	$rating_delete->RowCount++;

	// Set row properties
	$rating->resetAttributes();
	$rating->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$rating_delete->loadRowValues($rating_delete->Recordset);

	// Render row
	$rating_delete->renderRow();
?>
	<tr <?php echo $rating->rowAttributes() ?>>
<?php if ($rating_delete->id->Visible) { // id ?>
		<td <?php echo $rating_delete->id->cellAttributes() ?>>
<span id="el<?php echo $rating_delete->RowCount ?>_rating_id" class="rating_id">
<span<?php echo $rating_delete->id->viewAttributes() ?>><?php echo $rating_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rating_delete->name->Visible) { // name ?>
		<td <?php echo $rating_delete->name->cellAttributes() ?>>
<span id="el<?php echo $rating_delete->RowCount ?>_rating_name" class="rating_name">
<span<?php echo $rating_delete->name->viewAttributes() ?>><?php echo $rating_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rating_delete->_email->Visible) { // email ?>
		<td <?php echo $rating_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $rating_delete->RowCount ?>_rating__email" class="rating__email">
<span<?php echo $rating_delete->_email->viewAttributes() ?>><?php echo $rating_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rating_delete->rate->Visible) { // rate ?>
		<td <?php echo $rating_delete->rate->cellAttributes() ?>>
<span id="el<?php echo $rating_delete->RowCount ?>_rating_rate" class="rating_rate">
<span<?php echo $rating_delete->rate->viewAttributes() ?>><?php echo $rating_delete->rate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$rating_delete->Recordset->moveNext();
}
$rating_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rating_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$rating_delete->showPageFooter();
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
$rating_delete->terminate();
?>