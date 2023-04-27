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
$category_view = new category_view();

// Run the page
$category_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$category_view->isExport()) { ?>
<script>
var fcategoryview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcategoryview = currentForm = new ew.Form("fcategoryview", "view");
	loadjs.done("fcategoryview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$category_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $category_view->ExportOptions->render("body") ?>
<?php $category_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $category_view->showPageHeader(); ?>
<?php
$category_view->showMessage();
?>
<form name="fcategoryview" id="fcategoryview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<input type="hidden" name="modal" value="<?php echo (int)$category_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($category_view->category_id->Visible) { // category_id ?>
	<tr id="r_category_id">
		<td class="<?php echo $category_view->TableLeftColumnClass ?>"><span id="elh_category_category_id"><?php echo $category_view->category_id->caption() ?></span></td>
		<td data-name="category_id" <?php echo $category_view->category_id->cellAttributes() ?>>
<span id="el_category_category_id">
<span<?php echo $category_view->category_id->viewAttributes() ?>><?php echo $category_view->category_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($category_view->category_name->Visible) { // category_name ?>
	<tr id="r_category_name">
		<td class="<?php echo $category_view->TableLeftColumnClass ?>"><span id="elh_category_category_name"><?php echo $category_view->category_name->caption() ?></span></td>
		<td data-name="category_name" <?php echo $category_view->category_name->cellAttributes() ?>>
<span id="el_category_category_name">
<span<?php echo $category_view->category_name->viewAttributes() ?>><?php echo $category_view->category_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($category_view->category_img->Visible) { // category_img ?>
	<tr id="r_category_img">
		<td class="<?php echo $category_view->TableLeftColumnClass ?>"><span id="elh_category_category_img"><?php echo $category_view->category_img->caption() ?></span></td>
		<td data-name="category_img" <?php echo $category_view->category_img->cellAttributes() ?>>
<span id="el_category_category_img">
<span<?php echo $category_view->category_img->viewAttributes() ?>><?php echo $category_view->category_img->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$category_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$category_view->isExport()) { ?>
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
$category_view->terminate();
?>