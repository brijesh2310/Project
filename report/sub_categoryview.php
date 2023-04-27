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
$sub_category_view = new sub_category_view();

// Run the page
$sub_category_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sub_category_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sub_category_view->isExport()) { ?>
<script>
var fsub_categoryview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsub_categoryview = currentForm = new ew.Form("fsub_categoryview", "view");
	loadjs.done("fsub_categoryview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sub_category_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $sub_category_view->ExportOptions->render("body") ?>
<?php $sub_category_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $sub_category_view->showPageHeader(); ?>
<?php
$sub_category_view->showMessage();
?>
<form name="fsub_categoryview" id="fsub_categoryview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sub_category">
<input type="hidden" name="modal" value="<?php echo (int)$sub_category_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($sub_category_view->subcategory_id->Visible) { // subcategory_id ?>
	<tr id="r_subcategory_id">
		<td class="<?php echo $sub_category_view->TableLeftColumnClass ?>"><span id="elh_sub_category_subcategory_id"><?php echo $sub_category_view->subcategory_id->caption() ?></span></td>
		<td data-name="subcategory_id" <?php echo $sub_category_view->subcategory_id->cellAttributes() ?>>
<span id="el_sub_category_subcategory_id">
<span<?php echo $sub_category_view->subcategory_id->viewAttributes() ?>><?php echo $sub_category_view->subcategory_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sub_category_view->subcategory_name->Visible) { // subcategory_name ?>
	<tr id="r_subcategory_name">
		<td class="<?php echo $sub_category_view->TableLeftColumnClass ?>"><span id="elh_sub_category_subcategory_name"><?php echo $sub_category_view->subcategory_name->caption() ?></span></td>
		<td data-name="subcategory_name" <?php echo $sub_category_view->subcategory_name->cellAttributes() ?>>
<span id="el_sub_category_subcategory_name">
<span<?php echo $sub_category_view->subcategory_name->viewAttributes() ?>><?php echo $sub_category_view->subcategory_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sub_category_view->subcategory_img->Visible) { // subcategory_img ?>
	<tr id="r_subcategory_img">
		<td class="<?php echo $sub_category_view->TableLeftColumnClass ?>"><span id="elh_sub_category_subcategory_img"><?php echo $sub_category_view->subcategory_img->caption() ?></span></td>
		<td data-name="subcategory_img" <?php echo $sub_category_view->subcategory_img->cellAttributes() ?>>
<span id="el_sub_category_subcategory_img">
<span<?php echo $sub_category_view->subcategory_img->viewAttributes() ?>><?php echo $sub_category_view->subcategory_img->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sub_category_view->category_name->Visible) { // category_name ?>
	<tr id="r_category_name">
		<td class="<?php echo $sub_category_view->TableLeftColumnClass ?>"><span id="elh_sub_category_category_name"><?php echo $sub_category_view->category_name->caption() ?></span></td>
		<td data-name="category_name" <?php echo $sub_category_view->category_name->cellAttributes() ?>>
<span id="el_sub_category_category_name">
<span<?php echo $sub_category_view->category_name->viewAttributes() ?>><?php echo $sub_category_view->category_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$sub_category_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sub_category_view->isExport()) { ?>
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
$sub_category_view->terminate();
?>