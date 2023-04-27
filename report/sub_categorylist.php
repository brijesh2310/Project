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
$sub_category_list = new sub_category_list();

// Run the page
$sub_category_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sub_category_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sub_category_list->isExport()) { ?>
<script>
var fsub_categorylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsub_categorylist = currentForm = new ew.Form("fsub_categorylist", "list");
	fsub_categorylist.formKeyCountName = '<?php echo $sub_category_list->FormKeyCountName ?>';
	loadjs.done("fsub_categorylist");
});
var fsub_categorylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsub_categorylistsrch = currentSearchForm = new ew.Form("fsub_categorylistsrch");

	// Dynamic selection lists
	// Filters

	fsub_categorylistsrch.filterList = <?php echo $sub_category_list->getFilterList() ?>;
	loadjs.done("fsub_categorylistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sub_category_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sub_category_list->TotalRecords > 0 && $sub_category_list->ExportOptions->visible()) { ?>
<?php $sub_category_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sub_category_list->ImportOptions->visible()) { ?>
<?php $sub_category_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($sub_category_list->SearchOptions->visible()) { ?>
<?php $sub_category_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($sub_category_list->FilterOptions->visible()) { ?>
<?php $sub_category_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sub_category_list->renderOtherOptions();
?>
<?php if (!$sub_category_list->isExport() && !$sub_category->CurrentAction) { ?>
<form name="fsub_categorylistsrch" id="fsub_categorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsub_categorylistsrch-search-panel" class="<?php echo $sub_category_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="sub_category">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $sub_category_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($sub_category_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($sub_category_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $sub_category_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($sub_category_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($sub_category_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($sub_category_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($sub_category_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $sub_category_list->showPageHeader(); ?>
<?php
$sub_category_list->showMessage();
?>
<?php if ($sub_category_list->TotalRecords > 0 || $sub_category->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($sub_category_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sub_category">
<form name="fsub_categorylist" id="fsub_categorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sub_category">
<div id="gmp_sub_category" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($sub_category_list->TotalRecords > 0 || $sub_category_list->isGridEdit()) { ?>
<table id="tbl_sub_categorylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$sub_category->RowType = ROWTYPE_HEADER;

// Render list options
$sub_category_list->renderListOptions();

// Render list options (header, left)
$sub_category_list->ListOptions->render("header", "left");
?>
<?php if ($sub_category_list->subcategory_id->Visible) { // subcategory_id ?>
	<?php if ($sub_category_list->SortUrl($sub_category_list->subcategory_id) == "") { ?>
		<th data-name="subcategory_id" class="<?php echo $sub_category_list->subcategory_id->headerCellClass() ?>"><div id="elh_sub_category_subcategory_id" class="sub_category_subcategory_id"><div class="ew-table-header-caption"><?php echo $sub_category_list->subcategory_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subcategory_id" class="<?php echo $sub_category_list->subcategory_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sub_category_list->SortUrl($sub_category_list->subcategory_id) ?>', 1);"><div id="elh_sub_category_subcategory_id" class="sub_category_subcategory_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sub_category_list->subcategory_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($sub_category_list->subcategory_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sub_category_list->subcategory_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sub_category_list->subcategory_name->Visible) { // subcategory_name ?>
	<?php if ($sub_category_list->SortUrl($sub_category_list->subcategory_name) == "") { ?>
		<th data-name="subcategory_name" class="<?php echo $sub_category_list->subcategory_name->headerCellClass() ?>"><div id="elh_sub_category_subcategory_name" class="sub_category_subcategory_name"><div class="ew-table-header-caption"><?php echo $sub_category_list->subcategory_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subcategory_name" class="<?php echo $sub_category_list->subcategory_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sub_category_list->SortUrl($sub_category_list->subcategory_name) ?>', 1);"><div id="elh_sub_category_subcategory_name" class="sub_category_subcategory_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sub_category_list->subcategory_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sub_category_list->subcategory_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sub_category_list->subcategory_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sub_category_list->subcategory_img->Visible) { // subcategory_img ?>
	<?php if ($sub_category_list->SortUrl($sub_category_list->subcategory_img) == "") { ?>
		<th data-name="subcategory_img" class="<?php echo $sub_category_list->subcategory_img->headerCellClass() ?>"><div id="elh_sub_category_subcategory_img" class="sub_category_subcategory_img"><div class="ew-table-header-caption"><?php echo $sub_category_list->subcategory_img->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subcategory_img" class="<?php echo $sub_category_list->subcategory_img->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sub_category_list->SortUrl($sub_category_list->subcategory_img) ?>', 1);"><div id="elh_sub_category_subcategory_img" class="sub_category_subcategory_img">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sub_category_list->subcategory_img->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sub_category_list->subcategory_img->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sub_category_list->subcategory_img->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sub_category_list->category_name->Visible) { // category_name ?>
	<?php if ($sub_category_list->SortUrl($sub_category_list->category_name) == "") { ?>
		<th data-name="category_name" class="<?php echo $sub_category_list->category_name->headerCellClass() ?>"><div id="elh_sub_category_category_name" class="sub_category_category_name"><div class="ew-table-header-caption"><?php echo $sub_category_list->category_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="category_name" class="<?php echo $sub_category_list->category_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sub_category_list->SortUrl($sub_category_list->category_name) ?>', 1);"><div id="elh_sub_category_category_name" class="sub_category_category_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sub_category_list->category_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sub_category_list->category_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sub_category_list->category_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$sub_category_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($sub_category_list->ExportAll && $sub_category_list->isExport()) {
	$sub_category_list->StopRecord = $sub_category_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sub_category_list->TotalRecords > $sub_category_list->StartRecord + $sub_category_list->DisplayRecords - 1)
		$sub_category_list->StopRecord = $sub_category_list->StartRecord + $sub_category_list->DisplayRecords - 1;
	else
		$sub_category_list->StopRecord = $sub_category_list->TotalRecords;
}
$sub_category_list->RecordCount = $sub_category_list->StartRecord - 1;
if ($sub_category_list->Recordset && !$sub_category_list->Recordset->EOF) {
	$sub_category_list->Recordset->moveFirst();
	$selectLimit = $sub_category_list->UseSelectLimit;
	if (!$selectLimit && $sub_category_list->StartRecord > 1)
		$sub_category_list->Recordset->move($sub_category_list->StartRecord - 1);
} elseif (!$sub_category->AllowAddDeleteRow && $sub_category_list->StopRecord == 0) {
	$sub_category_list->StopRecord = $sub_category->GridAddRowCount;
}

// Initialize aggregate
$sub_category->RowType = ROWTYPE_AGGREGATEINIT;
$sub_category->resetAttributes();
$sub_category_list->renderRow();
while ($sub_category_list->RecordCount < $sub_category_list->StopRecord) {
	$sub_category_list->RecordCount++;
	if ($sub_category_list->RecordCount >= $sub_category_list->StartRecord) {
		$sub_category_list->RowCount++;

		// Set up key count
		$sub_category_list->KeyCount = $sub_category_list->RowIndex;

		// Init row class and style
		$sub_category->resetAttributes();
		$sub_category->CssClass = "";
		if ($sub_category_list->isGridAdd()) {
		} else {
			$sub_category_list->loadRowValues($sub_category_list->Recordset); // Load row values
		}
		$sub_category->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sub_category->RowAttrs->merge(["data-rowindex" => $sub_category_list->RowCount, "id" => "r" . $sub_category_list->RowCount . "_sub_category", "data-rowtype" => $sub_category->RowType]);

		// Render row
		$sub_category_list->renderRow();

		// Render list options
		$sub_category_list->renderListOptions();
?>
	<tr <?php echo $sub_category->rowAttributes() ?>>
<?php

// Render list options (body, left)
$sub_category_list->ListOptions->render("body", "left", $sub_category_list->RowCount);
?>
	<?php if ($sub_category_list->subcategory_id->Visible) { // subcategory_id ?>
		<td data-name="subcategory_id" <?php echo $sub_category_list->subcategory_id->cellAttributes() ?>>
<span id="el<?php echo $sub_category_list->RowCount ?>_sub_category_subcategory_id">
<span<?php echo $sub_category_list->subcategory_id->viewAttributes() ?>><?php echo $sub_category_list->subcategory_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sub_category_list->subcategory_name->Visible) { // subcategory_name ?>
		<td data-name="subcategory_name" <?php echo $sub_category_list->subcategory_name->cellAttributes() ?>>
<span id="el<?php echo $sub_category_list->RowCount ?>_sub_category_subcategory_name">
<span<?php echo $sub_category_list->subcategory_name->viewAttributes() ?>><?php echo $sub_category_list->subcategory_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sub_category_list->subcategory_img->Visible) { // subcategory_img ?>
		<td data-name="subcategory_img" <?php echo $sub_category_list->subcategory_img->cellAttributes() ?>>
<span id="el<?php echo $sub_category_list->RowCount ?>_sub_category_subcategory_img">
<span<?php echo $sub_category_list->subcategory_img->viewAttributes() ?>><?php echo $sub_category_list->subcategory_img->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sub_category_list->category_name->Visible) { // category_name ?>
		<td data-name="category_name" <?php echo $sub_category_list->category_name->cellAttributes() ?>>
<span id="el<?php echo $sub_category_list->RowCount ?>_sub_category_category_name">
<span<?php echo $sub_category_list->category_name->viewAttributes() ?>><?php echo $sub_category_list->category_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sub_category_list->ListOptions->render("body", "right", $sub_category_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$sub_category_list->isGridAdd())
		$sub_category_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$sub_category->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sub_category_list->Recordset)
	$sub_category_list->Recordset->Close();
?>
<?php if (!$sub_category_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$sub_category_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sub_category_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sub_category_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($sub_category_list->TotalRecords == 0 && !$sub_category->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sub_category_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sub_category_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sub_category_list->isExport()) { ?>
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
$sub_category_list->terminate();
?>