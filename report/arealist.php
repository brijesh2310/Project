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
$area_list = new area_list();

// Run the page
$area_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$area_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$area_list->isExport()) { ?>
<script>
var farealist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	farealist = currentForm = new ew.Form("farealist", "list");
	farealist.formKeyCountName = '<?php echo $area_list->FormKeyCountName ?>';
	loadjs.done("farealist");
});
var farealistsrch;
loadjs.ready("head", function() {

	// Form object for search
	farealistsrch = currentSearchForm = new ew.Form("farealistsrch");

	// Dynamic selection lists
	// Filters

	farealistsrch.filterList = <?php echo $area_list->getFilterList() ?>;
	loadjs.done("farealistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$area_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($area_list->TotalRecords > 0 && $area_list->ExportOptions->visible()) { ?>
<?php $area_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($area_list->ImportOptions->visible()) { ?>
<?php $area_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($area_list->SearchOptions->visible()) { ?>
<?php $area_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($area_list->FilterOptions->visible()) { ?>
<?php $area_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$area_list->renderOtherOptions();
?>
<?php if (!$area_list->isExport() && !$area->CurrentAction) { ?>
<form name="farealistsrch" id="farealistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="farealistsrch-search-panel" class="<?php echo $area_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="area">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $area_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($area_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($area_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $area_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($area_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($area_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($area_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($area_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $area_list->showPageHeader(); ?>
<?php
$area_list->showMessage();
?>
<?php if ($area_list->TotalRecords > 0 || $area->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($area_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> area">
<form name="farealist" id="farealist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="area">
<div id="gmp_area" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($area_list->TotalRecords > 0 || $area_list->isGridEdit()) { ?>
<table id="tbl_arealist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$area->RowType = ROWTYPE_HEADER;

// Render list options
$area_list->renderListOptions();

// Render list options (header, left)
$area_list->ListOptions->render("header", "left");
?>
<?php if ($area_list->area_id->Visible) { // area_id ?>
	<?php if ($area_list->SortUrl($area_list->area_id) == "") { ?>
		<th data-name="area_id" class="<?php echo $area_list->area_id->headerCellClass() ?>"><div id="elh_area_area_id" class="area_area_id"><div class="ew-table-header-caption"><?php echo $area_list->area_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="area_id" class="<?php echo $area_list->area_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $area_list->SortUrl($area_list->area_id) ?>', 1);"><div id="elh_area_area_id" class="area_area_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $area_list->area_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($area_list->area_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($area_list->area_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($area_list->area_name->Visible) { // area_name ?>
	<?php if ($area_list->SortUrl($area_list->area_name) == "") { ?>
		<th data-name="area_name" class="<?php echo $area_list->area_name->headerCellClass() ?>"><div id="elh_area_area_name" class="area_area_name"><div class="ew-table-header-caption"><?php echo $area_list->area_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="area_name" class="<?php echo $area_list->area_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $area_list->SortUrl($area_list->area_name) ?>', 1);"><div id="elh_area_area_name" class="area_area_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $area_list->area_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($area_list->area_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($area_list->area_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($area_list->city_name->Visible) { // city_name ?>
	<?php if ($area_list->SortUrl($area_list->city_name) == "") { ?>
		<th data-name="city_name" class="<?php echo $area_list->city_name->headerCellClass() ?>"><div id="elh_area_city_name" class="area_city_name"><div class="ew-table-header-caption"><?php echo $area_list->city_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="city_name" class="<?php echo $area_list->city_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $area_list->SortUrl($area_list->city_name) ?>', 1);"><div id="elh_area_city_name" class="area_city_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $area_list->city_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($area_list->city_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($area_list->city_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$area_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($area_list->ExportAll && $area_list->isExport()) {
	$area_list->StopRecord = $area_list->TotalRecords;
} else {

	// Set the last record to display
	if ($area_list->TotalRecords > $area_list->StartRecord + $area_list->DisplayRecords - 1)
		$area_list->StopRecord = $area_list->StartRecord + $area_list->DisplayRecords - 1;
	else
		$area_list->StopRecord = $area_list->TotalRecords;
}
$area_list->RecordCount = $area_list->StartRecord - 1;
if ($area_list->Recordset && !$area_list->Recordset->EOF) {
	$area_list->Recordset->moveFirst();
	$selectLimit = $area_list->UseSelectLimit;
	if (!$selectLimit && $area_list->StartRecord > 1)
		$area_list->Recordset->move($area_list->StartRecord - 1);
} elseif (!$area->AllowAddDeleteRow && $area_list->StopRecord == 0) {
	$area_list->StopRecord = $area->GridAddRowCount;
}

// Initialize aggregate
$area->RowType = ROWTYPE_AGGREGATEINIT;
$area->resetAttributes();
$area_list->renderRow();
while ($area_list->RecordCount < $area_list->StopRecord) {
	$area_list->RecordCount++;
	if ($area_list->RecordCount >= $area_list->StartRecord) {
		$area_list->RowCount++;

		// Set up key count
		$area_list->KeyCount = $area_list->RowIndex;

		// Init row class and style
		$area->resetAttributes();
		$area->CssClass = "";
		if ($area_list->isGridAdd()) {
		} else {
			$area_list->loadRowValues($area_list->Recordset); // Load row values
		}
		$area->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$area->RowAttrs->merge(["data-rowindex" => $area_list->RowCount, "id" => "r" . $area_list->RowCount . "_area", "data-rowtype" => $area->RowType]);

		// Render row
		$area_list->renderRow();

		// Render list options
		$area_list->renderListOptions();
?>
	<tr <?php echo $area->rowAttributes() ?>>
<?php

// Render list options (body, left)
$area_list->ListOptions->render("body", "left", $area_list->RowCount);
?>
	<?php if ($area_list->area_id->Visible) { // area_id ?>
		<td data-name="area_id" <?php echo $area_list->area_id->cellAttributes() ?>>
<span id="el<?php echo $area_list->RowCount ?>_area_area_id">
<span<?php echo $area_list->area_id->viewAttributes() ?>><?php echo $area_list->area_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($area_list->area_name->Visible) { // area_name ?>
		<td data-name="area_name" <?php echo $area_list->area_name->cellAttributes() ?>>
<span id="el<?php echo $area_list->RowCount ?>_area_area_name">
<span<?php echo $area_list->area_name->viewAttributes() ?>><?php echo $area_list->area_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($area_list->city_name->Visible) { // city_name ?>
		<td data-name="city_name" <?php echo $area_list->city_name->cellAttributes() ?>>
<span id="el<?php echo $area_list->RowCount ?>_area_city_name">
<span<?php echo $area_list->city_name->viewAttributes() ?>><?php echo $area_list->city_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$area_list->ListOptions->render("body", "right", $area_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$area_list->isGridAdd())
		$area_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$area->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($area_list->Recordset)
	$area_list->Recordset->Close();
?>
<?php if (!$area_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$area_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $area_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $area_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($area_list->TotalRecords == 0 && !$area->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $area_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$area_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$area_list->isExport()) { ?>
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
$area_list->terminate();
?>