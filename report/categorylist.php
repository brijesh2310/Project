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
$category_list = new category_list();

// Run the page
$category_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$category_list->isExport()) { ?>
<script>
var fcategorylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcategorylist = currentForm = new ew.Form("fcategorylist", "list");
	fcategorylist.formKeyCountName = '<?php echo $category_list->FormKeyCountName ?>';
	loadjs.done("fcategorylist");
});
var fcategorylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcategorylistsrch = currentSearchForm = new ew.Form("fcategorylistsrch");

	// Dynamic selection lists
	// Filters

	fcategorylistsrch.filterList = <?php echo $category_list->getFilterList() ?>;
	loadjs.done("fcategorylistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$category_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($category_list->TotalRecords > 0 && $category_list->ExportOptions->visible()) { ?>
<?php $category_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($category_list->ImportOptions->visible()) { ?>
<?php $category_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($category_list->SearchOptions->visible()) { ?>
<?php $category_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($category_list->FilterOptions->visible()) { ?>
<?php $category_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$category_list->renderOtherOptions();
?>
<?php if (!$category_list->isExport() && !$category->CurrentAction) { ?>
<form name="fcategorylistsrch" id="fcategorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcategorylistsrch-search-panel" class="<?php echo $category_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="category">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $category_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($category_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($category_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $category_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $category_list->showPageHeader(); ?>
<?php
$category_list->showMessage();
?>
<?php if ($category_list->TotalRecords > 0 || $category->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($category_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> category">
<form name="fcategorylist" id="fcategorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<div id="gmp_category" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($category_list->TotalRecords > 0 || $category_list->isGridEdit()) { ?>
<table id="tbl_categorylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$category->RowType = ROWTYPE_HEADER;

// Render list options
$category_list->renderListOptions();

// Render list options (header, left)
$category_list->ListOptions->render("header", "left");
?>
<?php if ($category_list->category_id->Visible) { // category_id ?>
	<?php if ($category_list->SortUrl($category_list->category_id) == "") { ?>
		<th data-name="category_id" class="<?php echo $category_list->category_id->headerCellClass() ?>"><div id="elh_category_category_id" class="category_category_id"><div class="ew-table-header-caption"><?php echo $category_list->category_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="category_id" class="<?php echo $category_list->category_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $category_list->SortUrl($category_list->category_id) ?>', 1);"><div id="elh_category_category_id" class="category_category_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $category_list->category_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($category_list->category_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($category_list->category_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($category_list->category_name->Visible) { // category_name ?>
	<?php if ($category_list->SortUrl($category_list->category_name) == "") { ?>
		<th data-name="category_name" class="<?php echo $category_list->category_name->headerCellClass() ?>"><div id="elh_category_category_name" class="category_category_name"><div class="ew-table-header-caption"><?php echo $category_list->category_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="category_name" class="<?php echo $category_list->category_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $category_list->SortUrl($category_list->category_name) ?>', 1);"><div id="elh_category_category_name" class="category_category_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $category_list->category_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($category_list->category_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($category_list->category_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($category_list->category_img->Visible) { // category_img ?>
	<?php if ($category_list->SortUrl($category_list->category_img) == "") { ?>
		<th data-name="category_img" class="<?php echo $category_list->category_img->headerCellClass() ?>"><div id="elh_category_category_img" class="category_category_img"><div class="ew-table-header-caption"><?php echo $category_list->category_img->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="category_img" class="<?php echo $category_list->category_img->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $category_list->SortUrl($category_list->category_img) ?>', 1);"><div id="elh_category_category_img" class="category_category_img">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $category_list->category_img->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($category_list->category_img->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($category_list->category_img->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$category_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($category_list->ExportAll && $category_list->isExport()) {
	$category_list->StopRecord = $category_list->TotalRecords;
} else {

	// Set the last record to display
	if ($category_list->TotalRecords > $category_list->StartRecord + $category_list->DisplayRecords - 1)
		$category_list->StopRecord = $category_list->StartRecord + $category_list->DisplayRecords - 1;
	else
		$category_list->StopRecord = $category_list->TotalRecords;
}
$category_list->RecordCount = $category_list->StartRecord - 1;
if ($category_list->Recordset && !$category_list->Recordset->EOF) {
	$category_list->Recordset->moveFirst();
	$selectLimit = $category_list->UseSelectLimit;
	if (!$selectLimit && $category_list->StartRecord > 1)
		$category_list->Recordset->move($category_list->StartRecord - 1);
} elseif (!$category->AllowAddDeleteRow && $category_list->StopRecord == 0) {
	$category_list->StopRecord = $category->GridAddRowCount;
}

// Initialize aggregate
$category->RowType = ROWTYPE_AGGREGATEINIT;
$category->resetAttributes();
$category_list->renderRow();
while ($category_list->RecordCount < $category_list->StopRecord) {
	$category_list->RecordCount++;
	if ($category_list->RecordCount >= $category_list->StartRecord) {
		$category_list->RowCount++;

		// Set up key count
		$category_list->KeyCount = $category_list->RowIndex;

		// Init row class and style
		$category->resetAttributes();
		$category->CssClass = "";
		if ($category_list->isGridAdd()) {
		} else {
			$category_list->loadRowValues($category_list->Recordset); // Load row values
		}
		$category->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$category->RowAttrs->merge(["data-rowindex" => $category_list->RowCount, "id" => "r" . $category_list->RowCount . "_category", "data-rowtype" => $category->RowType]);

		// Render row
		$category_list->renderRow();

		// Render list options
		$category_list->renderListOptions();
?>
	<tr <?php echo $category->rowAttributes() ?>>
<?php

// Render list options (body, left)
$category_list->ListOptions->render("body", "left", $category_list->RowCount);
?>
	<?php if ($category_list->category_id->Visible) { // category_id ?>
		<td data-name="category_id" <?php echo $category_list->category_id->cellAttributes() ?>>
<span id="el<?php echo $category_list->RowCount ?>_category_category_id">
<span<?php echo $category_list->category_id->viewAttributes() ?>><?php echo $category_list->category_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($category_list->category_name->Visible) { // category_name ?>
		<td data-name="category_name" <?php echo $category_list->category_name->cellAttributes() ?>>
<span id="el<?php echo $category_list->RowCount ?>_category_category_name">
<span<?php echo $category_list->category_name->viewAttributes() ?>><?php echo $category_list->category_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($category_list->category_img->Visible) { // category_img ?>
		<td data-name="category_img" <?php echo $category_list->category_img->cellAttributes() ?>>
<span id="el<?php echo $category_list->RowCount ?>_category_category_img">
<span<?php echo $category_list->category_img->viewAttributes() ?>><?php echo $category_list->category_img->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$category_list->ListOptions->render("body", "right", $category_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$category_list->isGridAdd())
		$category_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$category->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($category_list->Recordset)
	$category_list->Recordset->Close();
?>
<?php if (!$category_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$category_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $category_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $category_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($category_list->TotalRecords == 0 && !$category->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $category_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$category_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$category_list->isExport()) { ?>
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
$category_list->terminate();
?>