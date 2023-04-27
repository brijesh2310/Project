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
$area_view = new area_view();

// Run the page
$area_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$area_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$area_view->isExport()) { ?>
<script>
var fareaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fareaview = currentForm = new ew.Form("fareaview", "view");
	loadjs.done("fareaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$area_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $area_view->ExportOptions->render("body") ?>
<?php $area_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $area_view->showPageHeader(); ?>
<?php
$area_view->showMessage();
?>
<form name="fareaview" id="fareaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="area">
<input type="hidden" name="modal" value="<?php echo (int)$area_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($area_view->area_id->Visible) { // area_id ?>
	<tr id="r_area_id">
		<td class="<?php echo $area_view->TableLeftColumnClass ?>"><span id="elh_area_area_id"><?php echo $area_view->area_id->caption() ?></span></td>
		<td data-name="area_id" <?php echo $area_view->area_id->cellAttributes() ?>>
<span id="el_area_area_id">
<span<?php echo $area_view->area_id->viewAttributes() ?>><?php echo $area_view->area_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($area_view->area_name->Visible) { // area_name ?>
	<tr id="r_area_name">
		<td class="<?php echo $area_view->TableLeftColumnClass ?>"><span id="elh_area_area_name"><?php echo $area_view->area_name->caption() ?></span></td>
		<td data-name="area_name" <?php echo $area_view->area_name->cellAttributes() ?>>
<span id="el_area_area_name">
<span<?php echo $area_view->area_name->viewAttributes() ?>><?php echo $area_view->area_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($area_view->city_name->Visible) { // city_name ?>
	<tr id="r_city_name">
		<td class="<?php echo $area_view->TableLeftColumnClass ?>"><span id="elh_area_city_name"><?php echo $area_view->city_name->caption() ?></span></td>
		<td data-name="city_name" <?php echo $area_view->city_name->cellAttributes() ?>>
<span id="el_area_city_name">
<span<?php echo $area_view->city_name->viewAttributes() ?>><?php echo $area_view->city_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$area_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$area_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$area_view->terminate();
?>