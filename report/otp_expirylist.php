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
$otp_expiry_list = new otp_expiry_list();

// Run the page
$otp_expiry_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$otp_expiry_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$otp_expiry_list->isExport()) { ?>
<script>
var fotp_expirylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fotp_expirylist = currentForm = new ew.Form("fotp_expirylist", "list");
	fotp_expirylist.formKeyCountName = '<?php echo $otp_expiry_list->FormKeyCountName ?>';
	loadjs.done("fotp_expirylist");
});
var fotp_expirylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fotp_expirylistsrch = currentSearchForm = new ew.Form("fotp_expirylistsrch");

	// Dynamic selection lists
	// Filters

	fotp_expirylistsrch.filterList = <?php echo $otp_expiry_list->getFilterList() ?>;
	loadjs.done("fotp_expirylistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$otp_expiry_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($otp_expiry_list->TotalRecords > 0 && $otp_expiry_list->ExportOptions->visible()) { ?>
<?php $otp_expiry_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($otp_expiry_list->ImportOptions->visible()) { ?>
<?php $otp_expiry_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($otp_expiry_list->SearchOptions->visible()) { ?>
<?php $otp_expiry_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($otp_expiry_list->FilterOptions->visible()) { ?>
<?php $otp_expiry_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$otp_expiry_list->renderOtherOptions();
?>
<?php if (!$otp_expiry_list->isExport() && !$otp_expiry->CurrentAction) { ?>
<form name="fotp_expirylistsrch" id="fotp_expirylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fotp_expirylistsrch-search-panel" class="<?php echo $otp_expiry_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="otp_expiry">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $otp_expiry_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($otp_expiry_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($otp_expiry_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $otp_expiry_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($otp_expiry_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($otp_expiry_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($otp_expiry_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($otp_expiry_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $otp_expiry_list->showPageHeader(); ?>
<?php
$otp_expiry_list->showMessage();
?>
<?php if ($otp_expiry_list->TotalRecords > 0 || $otp_expiry->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($otp_expiry_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> otp_expiry">
<form name="fotp_expirylist" id="fotp_expirylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="otp_expiry">
<div id="gmp_otp_expiry" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($otp_expiry_list->TotalRecords > 0 || $otp_expiry_list->isGridEdit()) { ?>
<table id="tbl_otp_expirylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$otp_expiry->RowType = ROWTYPE_HEADER;

// Render list options
$otp_expiry_list->renderListOptions();

// Render list options (header, left)
$otp_expiry_list->ListOptions->render("header", "left");
?>
<?php if ($otp_expiry_list->otp_id->Visible) { // otp_id ?>
	<?php if ($otp_expiry_list->SortUrl($otp_expiry_list->otp_id) == "") { ?>
		<th data-name="otp_id" class="<?php echo $otp_expiry_list->otp_id->headerCellClass() ?>"><div id="elh_otp_expiry_otp_id" class="otp_expiry_otp_id"><div class="ew-table-header-caption"><?php echo $otp_expiry_list->otp_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otp_id" class="<?php echo $otp_expiry_list->otp_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $otp_expiry_list->SortUrl($otp_expiry_list->otp_id) ?>', 1);"><div id="elh_otp_expiry_otp_id" class="otp_expiry_otp_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $otp_expiry_list->otp_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($otp_expiry_list->otp_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($otp_expiry_list->otp_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($otp_expiry_list->otp->Visible) { // otp ?>
	<?php if ($otp_expiry_list->SortUrl($otp_expiry_list->otp) == "") { ?>
		<th data-name="otp" class="<?php echo $otp_expiry_list->otp->headerCellClass() ?>"><div id="elh_otp_expiry_otp" class="otp_expiry_otp"><div class="ew-table-header-caption"><?php echo $otp_expiry_list->otp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otp" class="<?php echo $otp_expiry_list->otp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $otp_expiry_list->SortUrl($otp_expiry_list->otp) ?>', 1);"><div id="elh_otp_expiry_otp" class="otp_expiry_otp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $otp_expiry_list->otp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($otp_expiry_list->otp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($otp_expiry_list->otp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($otp_expiry_list->_email->Visible) { // email ?>
	<?php if ($otp_expiry_list->SortUrl($otp_expiry_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $otp_expiry_list->_email->headerCellClass() ?>"><div id="elh_otp_expiry__email" class="otp_expiry__email"><div class="ew-table-header-caption"><?php echo $otp_expiry_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $otp_expiry_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $otp_expiry_list->SortUrl($otp_expiry_list->_email) ?>', 1);"><div id="elh_otp_expiry__email" class="otp_expiry__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $otp_expiry_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($otp_expiry_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($otp_expiry_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$otp_expiry_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($otp_expiry_list->ExportAll && $otp_expiry_list->isExport()) {
	$otp_expiry_list->StopRecord = $otp_expiry_list->TotalRecords;
} else {

	// Set the last record to display
	if ($otp_expiry_list->TotalRecords > $otp_expiry_list->StartRecord + $otp_expiry_list->DisplayRecords - 1)
		$otp_expiry_list->StopRecord = $otp_expiry_list->StartRecord + $otp_expiry_list->DisplayRecords - 1;
	else
		$otp_expiry_list->StopRecord = $otp_expiry_list->TotalRecords;
}
$otp_expiry_list->RecordCount = $otp_expiry_list->StartRecord - 1;
if ($otp_expiry_list->Recordset && !$otp_expiry_list->Recordset->EOF) {
	$otp_expiry_list->Recordset->moveFirst();
	$selectLimit = $otp_expiry_list->UseSelectLimit;
	if (!$selectLimit && $otp_expiry_list->StartRecord > 1)
		$otp_expiry_list->Recordset->move($otp_expiry_list->StartRecord - 1);
} elseif (!$otp_expiry->AllowAddDeleteRow && $otp_expiry_list->StopRecord == 0) {
	$otp_expiry_list->StopRecord = $otp_expiry->GridAddRowCount;
}

// Initialize aggregate
$otp_expiry->RowType = ROWTYPE_AGGREGATEINIT;
$otp_expiry->resetAttributes();
$otp_expiry_list->renderRow();
while ($otp_expiry_list->RecordCount < $otp_expiry_list->StopRecord) {
	$otp_expiry_list->RecordCount++;
	if ($otp_expiry_list->RecordCount >= $otp_expiry_list->StartRecord) {
		$otp_expiry_list->RowCount++;

		// Set up key count
		$otp_expiry_list->KeyCount = $otp_expiry_list->RowIndex;

		// Init row class and style
		$otp_expiry->resetAttributes();
		$otp_expiry->CssClass = "";
		if ($otp_expiry_list->isGridAdd()) {
		} else {
			$otp_expiry_list->loadRowValues($otp_expiry_list->Recordset); // Load row values
		}
		$otp_expiry->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$otp_expiry->RowAttrs->merge(["data-rowindex" => $otp_expiry_list->RowCount, "id" => "r" . $otp_expiry_list->RowCount . "_otp_expiry", "data-rowtype" => $otp_expiry->RowType]);

		// Render row
		$otp_expiry_list->renderRow();

		// Render list options
		$otp_expiry_list->renderListOptions();
?>
	<tr <?php echo $otp_expiry->rowAttributes() ?>>
<?php

// Render list options (body, left)
$otp_expiry_list->ListOptions->render("body", "left", $otp_expiry_list->RowCount);
?>
	<?php if ($otp_expiry_list->otp_id->Visible) { // otp_id ?>
		<td data-name="otp_id" <?php echo $otp_expiry_list->otp_id->cellAttributes() ?>>
<span id="el<?php echo $otp_expiry_list->RowCount ?>_otp_expiry_otp_id">
<span<?php echo $otp_expiry_list->otp_id->viewAttributes() ?>><?php echo $otp_expiry_list->otp_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($otp_expiry_list->otp->Visible) { // otp ?>
		<td data-name="otp" <?php echo $otp_expiry_list->otp->cellAttributes() ?>>
<span id="el<?php echo $otp_expiry_list->RowCount ?>_otp_expiry_otp">
<span<?php echo $otp_expiry_list->otp->viewAttributes() ?>><?php echo $otp_expiry_list->otp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($otp_expiry_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $otp_expiry_list->_email->cellAttributes() ?>>
<span id="el<?php echo $otp_expiry_list->RowCount ?>_otp_expiry__email">
<span<?php echo $otp_expiry_list->_email->viewAttributes() ?>><?php echo $otp_expiry_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$otp_expiry_list->ListOptions->render("body", "right", $otp_expiry_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$otp_expiry_list->isGridAdd())
		$otp_expiry_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$otp_expiry->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($otp_expiry_list->Recordset)
	$otp_expiry_list->Recordset->Close();
?>
<?php if (!$otp_expiry_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$otp_expiry_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $otp_expiry_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $otp_expiry_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($otp_expiry_list->TotalRecords == 0 && !$otp_expiry->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $otp_expiry_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$otp_expiry_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$otp_expiry_list->isExport()) { ?>
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
$otp_expiry_list->terminate();
?>