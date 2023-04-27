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
$view1_list = new view1_list();

// Run the page
$view1_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$view1_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$view1_list->isExport()) { ?>
<script>
var fview1list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fview1list = currentForm = new ew.Form("fview1list", "list");
	fview1list.formKeyCountName = '<?php echo $view1_list->FormKeyCountName ?>';
	loadjs.done("fview1list");
});
var fview1listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fview1listsrch = currentSearchForm = new ew.Form("fview1listsrch");

	// Dynamic selection lists
	// Filters

	fview1listsrch.filterList = <?php echo $view1_list->getFilterList() ?>;
	loadjs.done("fview1listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$view1_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($view1_list->TotalRecords > 0 && $view1_list->ExportOptions->visible()) { ?>
<?php $view1_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($view1_list->ImportOptions->visible()) { ?>
<?php $view1_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($view1_list->SearchOptions->visible()) { ?>
<?php $view1_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($view1_list->FilterOptions->visible()) { ?>
<?php $view1_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$view1_list->renderOtherOptions();
?>
<?php if (!$view1_list->isExport() && !$view1->CurrentAction) { ?>
<form name="fview1listsrch" id="fview1listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fview1listsrch-search-panel" class="<?php echo $view1_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="view1">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $view1_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($view1_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($view1_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $view1_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($view1_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($view1_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($view1_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($view1_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $view1_list->showPageHeader(); ?>
<?php
$view1_list->showMessage();
?>
<?php if ($view1_list->TotalRecords > 0 || $view1->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($view1_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> view1">
<form name="fview1list" id="fview1list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="view1">
<div id="gmp_view1" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($view1_list->TotalRecords > 0 || $view1_list->isGridEdit()) { ?>
<table id="tbl_view1list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$view1->RowType = ROWTYPE_HEADER;

// Render list options
$view1_list->renderListOptions();

// Render list options (header, left)
$view1_list->ListOptions->render("header", "left");
?>
<?php if ($view1_list->id->Visible) { // id ?>
	<?php if ($view1_list->SortUrl($view1_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $view1_list->id->headerCellClass() ?>"><div id="elh_view1_id" class="view1_id"><div class="ew-table-header-caption"><?php echo $view1_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $view1_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->id) ?>', 1);"><div id="elh_view1_id" class="view1_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($view1_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->name->Visible) { // name ?>
	<?php if ($view1_list->SortUrl($view1_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $view1_list->name->headerCellClass() ?>"><div id="elh_view1_name" class="view1_name"><div class="ew-table-header-caption"><?php echo $view1_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $view1_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->name) ?>', 1);"><div id="elh_view1_name" class="view1_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->_email->Visible) { // email ?>
	<?php if ($view1_list->SortUrl($view1_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $view1_list->_email->headerCellClass() ?>"><div id="elh_view1__email" class="view1__email"><div class="ew-table-header-caption"><?php echo $view1_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $view1_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->_email) ?>', 1);"><div id="elh_view1__email" class="view1__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->password->Visible) { // password ?>
	<?php if ($view1_list->SortUrl($view1_list->password) == "") { ?>
		<th data-name="password" class="<?php echo $view1_list->password->headerCellClass() ?>"><div id="elh_view1_password" class="view1_password"><div class="ew-table-header-caption"><?php echo $view1_list->password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="password" class="<?php echo $view1_list->password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->password) ?>', 1);"><div id="elh_view1_password" class="view1_password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->password->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->password->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->password->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->address->Visible) { // address ?>
	<?php if ($view1_list->SortUrl($view1_list->address) == "") { ?>
		<th data-name="address" class="<?php echo $view1_list->address->headerCellClass() ?>"><div id="elh_view1_address" class="view1_address"><div class="ew-table-header-caption"><?php echo $view1_list->address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="address" class="<?php echo $view1_list->address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->address) ?>', 1);"><div id="elh_view1_address" class="view1_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->mobile->Visible) { // mobile ?>
	<?php if ($view1_list->SortUrl($view1_list->mobile) == "") { ?>
		<th data-name="mobile" class="<?php echo $view1_list->mobile->headerCellClass() ?>"><div id="elh_view1_mobile" class="view1_mobile"><div class="ew-table-header-caption"><?php echo $view1_list->mobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mobile" class="<?php echo $view1_list->mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->mobile) ?>', 1);"><div id="elh_view1_mobile" class="view1_mobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->mobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view1_list->mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$view1_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($view1_list->ExportAll && $view1_list->isExport()) {
	$view1_list->StopRecord = $view1_list->TotalRecords;
} else {

	// Set the last record to display
	if ($view1_list->TotalRecords > $view1_list->StartRecord + $view1_list->DisplayRecords - 1)
		$view1_list->StopRecord = $view1_list->StartRecord + $view1_list->DisplayRecords - 1;
	else
		$view1_list->StopRecord = $view1_list->TotalRecords;
}
$view1_list->RecordCount = $view1_list->StartRecord - 1;
if ($view1_list->Recordset && !$view1_list->Recordset->EOF) {
	$view1_list->Recordset->moveFirst();
	$selectLimit = $view1_list->UseSelectLimit;
	if (!$selectLimit && $view1_list->StartRecord > 1)
		$view1_list->Recordset->move($view1_list->StartRecord - 1);
} elseif (!$view1->AllowAddDeleteRow && $view1_list->StopRecord == 0) {
	$view1_list->StopRecord = $view1->GridAddRowCount;
}

// Initialize aggregate
$view1->RowType = ROWTYPE_AGGREGATEINIT;
$view1->resetAttributes();
$view1_list->renderRow();
while ($view1_list->RecordCount < $view1_list->StopRecord) {
	$view1_list->RecordCount++;
	if ($view1_list->RecordCount >= $view1_list->StartRecord) {
		$view1_list->RowCount++;

		// Set up key count
		$view1_list->KeyCount = $view1_list->RowIndex;

		// Init row class and style
		$view1->resetAttributes();
		$view1->CssClass = "";
		if ($view1_list->isGridAdd()) {
		} else {
			$view1_list->loadRowValues($view1_list->Recordset); // Load row values
		}
		$view1->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$view1->RowAttrs->merge(["data-rowindex" => $view1_list->RowCount, "id" => "r" . $view1_list->RowCount . "_view1", "data-rowtype" => $view1->RowType]);

		// Render row
		$view1_list->renderRow();

		// Render list options
		$view1_list->renderListOptions();
?>
	<tr <?php echo $view1->rowAttributes() ?>>
<?php

// Render list options (body, left)
$view1_list->ListOptions->render("body", "left", $view1_list->RowCount);
?>
	<?php if ($view1_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $view1_list->id->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_id">
<span<?php echo $view1_list->id->viewAttributes() ?>><?php echo $view1_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $view1_list->name->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_name">
<span<?php echo $view1_list->name->viewAttributes() ?>><?php echo $view1_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $view1_list->_email->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1__email">
<span<?php echo $view1_list->_email->viewAttributes() ?>><?php echo $view1_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->password->Visible) { // password ?>
		<td data-name="password" <?php echo $view1_list->password->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_password">
<span<?php echo $view1_list->password->viewAttributes() ?>><?php echo $view1_list->password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->address->Visible) { // address ?>
		<td data-name="address" <?php echo $view1_list->address->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_address">
<span<?php echo $view1_list->address->viewAttributes() ?>><?php echo $view1_list->address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->mobile->Visible) { // mobile ?>
		<td data-name="mobile" <?php echo $view1_list->mobile->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_mobile">
<span<?php echo $view1_list->mobile->viewAttributes() ?>><?php echo $view1_list->mobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view1_list->ListOptions->render("body", "right", $view1_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$view1_list->isGridAdd())
		$view1_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$view1->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($view1_list->Recordset)
	$view1_list->Recordset->Close();
?>
<?php if (!$view1_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$view1_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view1_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view1_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($view1_list->TotalRecords == 0 && !$view1->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $view1_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$view1_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$view1_list->isExport()) { ?>
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
$view1_list->terminate();
?>