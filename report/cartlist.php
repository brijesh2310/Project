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
$cart_list = new cart_list();

// Run the page
$cart_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cart_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cart_list->isExport()) { ?>
<script>
var fcartlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcartlist = currentForm = new ew.Form("fcartlist", "list");
	fcartlist.formKeyCountName = '<?php echo $cart_list->FormKeyCountName ?>';
	loadjs.done("fcartlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cart_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cart_list->TotalRecords > 0 && $cart_list->ExportOptions->visible()) { ?>
<?php $cart_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cart_list->ImportOptions->visible()) { ?>
<?php $cart_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cart_list->renderOtherOptions();
?>
<?php $cart_list->showPageHeader(); ?>
<?php
$cart_list->showMessage();
?>
<?php if ($cart_list->TotalRecords > 0 || $cart->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cart_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cart">
<form name="fcartlist" id="fcartlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cart">
<div id="gmp_cart" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cart_list->TotalRecords > 0 || $cart_list->isGridEdit()) { ?>
<table id="tbl_cartlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cart->RowType = ROWTYPE_HEADER;

// Render list options
$cart_list->renderListOptions();

// Render list options (header, left)
$cart_list->ListOptions->render("header", "left");
?>
<?php if ($cart_list->id->Visible) { // id ?>
	<?php if ($cart_list->SortUrl($cart_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $cart_list->id->headerCellClass() ?>"><div id="elh_cart_id" class="cart_id"><div class="ew-table-header-caption"><?php echo $cart_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $cart_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cart_list->SortUrl($cart_list->id) ?>', 1);"><div id="elh_cart_id" class="cart_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cart_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cart_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cart_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cart_list->product_id->Visible) { // product_id ?>
	<?php if ($cart_list->SortUrl($cart_list->product_id) == "") { ?>
		<th data-name="product_id" class="<?php echo $cart_list->product_id->headerCellClass() ?>"><div id="elh_cart_product_id" class="cart_product_id"><div class="ew-table-header-caption"><?php echo $cart_list->product_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_id" class="<?php echo $cart_list->product_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cart_list->SortUrl($cart_list->product_id) ?>', 1);"><div id="elh_cart_product_id" class="cart_product_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cart_list->product_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cart_list->product_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cart_list->product_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cart_list->quantity->Visible) { // quantity ?>
	<?php if ($cart_list->SortUrl($cart_list->quantity) == "") { ?>
		<th data-name="quantity" class="<?php echo $cart_list->quantity->headerCellClass() ?>"><div id="elh_cart_quantity" class="cart_quantity"><div class="ew-table-header-caption"><?php echo $cart_list->quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="quantity" class="<?php echo $cart_list->quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cart_list->SortUrl($cart_list->quantity) ?>', 1);"><div id="elh_cart_quantity" class="cart_quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cart_list->quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($cart_list->quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cart_list->quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cart_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cart_list->ExportAll && $cart_list->isExport()) {
	$cart_list->StopRecord = $cart_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cart_list->TotalRecords > $cart_list->StartRecord + $cart_list->DisplayRecords - 1)
		$cart_list->StopRecord = $cart_list->StartRecord + $cart_list->DisplayRecords - 1;
	else
		$cart_list->StopRecord = $cart_list->TotalRecords;
}
$cart_list->RecordCount = $cart_list->StartRecord - 1;
if ($cart_list->Recordset && !$cart_list->Recordset->EOF) {
	$cart_list->Recordset->moveFirst();
	$selectLimit = $cart_list->UseSelectLimit;
	if (!$selectLimit && $cart_list->StartRecord > 1)
		$cart_list->Recordset->move($cart_list->StartRecord - 1);
} elseif (!$cart->AllowAddDeleteRow && $cart_list->StopRecord == 0) {
	$cart_list->StopRecord = $cart->GridAddRowCount;
}

// Initialize aggregate
$cart->RowType = ROWTYPE_AGGREGATEINIT;
$cart->resetAttributes();
$cart_list->renderRow();
while ($cart_list->RecordCount < $cart_list->StopRecord) {
	$cart_list->RecordCount++;
	if ($cart_list->RecordCount >= $cart_list->StartRecord) {
		$cart_list->RowCount++;

		// Set up key count
		$cart_list->KeyCount = $cart_list->RowIndex;

		// Init row class and style
		$cart->resetAttributes();
		$cart->CssClass = "";
		if ($cart_list->isGridAdd()) {
		} else {
			$cart_list->loadRowValues($cart_list->Recordset); // Load row values
		}
		$cart->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cart->RowAttrs->merge(["data-rowindex" => $cart_list->RowCount, "id" => "r" . $cart_list->RowCount . "_cart", "data-rowtype" => $cart->RowType]);

		// Render row
		$cart_list->renderRow();

		// Render list options
		$cart_list->renderListOptions();
?>
	<tr <?php echo $cart->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cart_list->ListOptions->render("body", "left", $cart_list->RowCount);
?>
	<?php if ($cart_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $cart_list->id->cellAttributes() ?>>
<span id="el<?php echo $cart_list->RowCount ?>_cart_id">
<span<?php echo $cart_list->id->viewAttributes() ?>><?php echo $cart_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cart_list->product_id->Visible) { // product_id ?>
		<td data-name="product_id" <?php echo $cart_list->product_id->cellAttributes() ?>>
<span id="el<?php echo $cart_list->RowCount ?>_cart_product_id">
<span<?php echo $cart_list->product_id->viewAttributes() ?>><?php echo $cart_list->product_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cart_list->quantity->Visible) { // quantity ?>
		<td data-name="quantity" <?php echo $cart_list->quantity->cellAttributes() ?>>
<span id="el<?php echo $cart_list->RowCount ?>_cart_quantity">
<span<?php echo $cart_list->quantity->viewAttributes() ?>><?php echo $cart_list->quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cart_list->ListOptions->render("body", "right", $cart_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cart_list->isGridAdd())
		$cart_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cart->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cart_list->Recordset)
	$cart_list->Recordset->Close();
?>
<?php if (!$cart_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cart_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cart_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cart_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cart_list->TotalRecords == 0 && !$cart->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cart_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cart_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cart_list->isExport()) { ?>
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
$cart_list->terminate();
?>