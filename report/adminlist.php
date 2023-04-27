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
$admin_list = new admin_list();

// Run the page
$admin_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$admin_list->isExport()) { ?>
<script>
var fadminlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fadminlist = currentForm = new ew.Form("fadminlist", "list");
	fadminlist.formKeyCountName = '<?php echo $admin_list->FormKeyCountName ?>';
	loadjs.done("fadminlist");
});
var fadminlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fadminlistsrch = currentSearchForm = new ew.Form("fadminlistsrch");

	// Dynamic selection lists
	// Filters

	fadminlistsrch.filterList = <?php echo $admin_list->getFilterList() ?>;
	loadjs.done("fadminlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$admin_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($admin_list->TotalRecords > 0 && $admin_list->ExportOptions->visible()) { ?>
<?php $admin_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($admin_list->ImportOptions->visible()) { ?>
<?php $admin_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($admin_list->SearchOptions->visible()) { ?>
<?php $admin_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($admin_list->FilterOptions->visible()) { ?>
<?php $admin_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$admin_list->renderOtherOptions();
?>
<?php if (!$admin_list->isExport() && !$admin->CurrentAction) { ?>
<form name="fadminlistsrch" id="fadminlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fadminlistsrch-search-panel" class="<?php echo $admin_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="admin">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $admin_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($admin_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($admin_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $admin_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($admin_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($admin_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($admin_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($admin_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $admin_list->showPageHeader(); ?>
<?php
$admin_list->showMessage();
?>
<?php if ($admin_list->TotalRecords > 0 || $admin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($admin_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> admin">
<form name="fadminlist" id="fadminlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<div id="gmp_admin" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($admin_list->TotalRecords > 0 || $admin_list->isGridEdit()) { ?>
<table id="tbl_adminlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$admin->RowType = ROWTYPE_HEADER;

// Render list options
$admin_list->renderListOptions();

// Render list options (header, left)
$admin_list->ListOptions->render("header", "left");
?>
<?php if ($admin_list->id->Visible) { // id ?>
	<?php if ($admin_list->SortUrl($admin_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $admin_list->id->headerCellClass() ?>"><div id="elh_admin_id" class="admin_id"><div class="ew-table-header-caption"><?php echo $admin_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $admin_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $admin_list->SortUrl($admin_list->id) ?>', 1);"><div id="elh_admin_id" class="admin_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $admin_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($admin_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($admin_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($admin_list->name->Visible) { // name ?>
	<?php if ($admin_list->SortUrl($admin_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $admin_list->name->headerCellClass() ?>"><div id="elh_admin_name" class="admin_name"><div class="ew-table-header-caption"><?php echo $admin_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $admin_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $admin_list->SortUrl($admin_list->name) ?>', 1);"><div id="elh_admin_name" class="admin_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $admin_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($admin_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($admin_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($admin_list->_email->Visible) { // email ?>
	<?php if ($admin_list->SortUrl($admin_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $admin_list->_email->headerCellClass() ?>"><div id="elh_admin__email" class="admin__email"><div class="ew-table-header-caption"><?php echo $admin_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $admin_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $admin_list->SortUrl($admin_list->_email) ?>', 1);"><div id="elh_admin__email" class="admin__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $admin_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($admin_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($admin_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($admin_list->password->Visible) { // password ?>
	<?php if ($admin_list->SortUrl($admin_list->password) == "") { ?>
		<th data-name="password" class="<?php echo $admin_list->password->headerCellClass() ?>"><div id="elh_admin_password" class="admin_password"><div class="ew-table-header-caption"><?php echo $admin_list->password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="password" class="<?php echo $admin_list->password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $admin_list->SortUrl($admin_list->password) ?>', 1);"><div id="elh_admin_password" class="admin_password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $admin_list->password->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($admin_list->password->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($admin_list->password->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($admin_list->address->Visible) { // address ?>
	<?php if ($admin_list->SortUrl($admin_list->address) == "") { ?>
		<th data-name="address" class="<?php echo $admin_list->address->headerCellClass() ?>"><div id="elh_admin_address" class="admin_address"><div class="ew-table-header-caption"><?php echo $admin_list->address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="address" class="<?php echo $admin_list->address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $admin_list->SortUrl($admin_list->address) ?>', 1);"><div id="elh_admin_address" class="admin_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $admin_list->address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($admin_list->address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($admin_list->address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($admin_list->mobile->Visible) { // mobile ?>
	<?php if ($admin_list->SortUrl($admin_list->mobile) == "") { ?>
		<th data-name="mobile" class="<?php echo $admin_list->mobile->headerCellClass() ?>"><div id="elh_admin_mobile" class="admin_mobile"><div class="ew-table-header-caption"><?php echo $admin_list->mobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mobile" class="<?php echo $admin_list->mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $admin_list->SortUrl($admin_list->mobile) ?>', 1);"><div id="elh_admin_mobile" class="admin_mobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $admin_list->mobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($admin_list->mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($admin_list->mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$admin_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($admin_list->ExportAll && $admin_list->isExport()) {
	$admin_list->StopRecord = $admin_list->TotalRecords;
} else {

	// Set the last record to display
	if ($admin_list->TotalRecords > $admin_list->StartRecord + $admin_list->DisplayRecords - 1)
		$admin_list->StopRecord = $admin_list->StartRecord + $admin_list->DisplayRecords - 1;
	else
		$admin_list->StopRecord = $admin_list->TotalRecords;
}
$admin_list->RecordCount = $admin_list->StartRecord - 1;
if ($admin_list->Recordset && !$admin_list->Recordset->EOF) {
	$admin_list->Recordset->moveFirst();
	$selectLimit = $admin_list->UseSelectLimit;
	if (!$selectLimit && $admin_list->StartRecord > 1)
		$admin_list->Recordset->move($admin_list->StartRecord - 1);
} elseif (!$admin->AllowAddDeleteRow && $admin_list->StopRecord == 0) {
	$admin_list->StopRecord = $admin->GridAddRowCount;
}

// Initialize aggregate
$admin->RowType = ROWTYPE_AGGREGATEINIT;
$admin->resetAttributes();
$admin_list->renderRow();
while ($admin_list->RecordCount < $admin_list->StopRecord) {
	$admin_list->RecordCount++;
	if ($admin_list->RecordCount >= $admin_list->StartRecord) {
		$admin_list->RowCount++;

		// Set up key count
		$admin_list->KeyCount = $admin_list->RowIndex;

		// Init row class and style
		$admin->resetAttributes();
		$admin->CssClass = "";
		if ($admin_list->isGridAdd()) {
		} else {
			$admin_list->loadRowValues($admin_list->Recordset); // Load row values
		}
		$admin->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$admin->RowAttrs->merge(["data-rowindex" => $admin_list->RowCount, "id" => "r" . $admin_list->RowCount . "_admin", "data-rowtype" => $admin->RowType]);

		// Render row
		$admin_list->renderRow();

		// Render list options
		$admin_list->renderListOptions();
?>
	<tr <?php echo $admin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$admin_list->ListOptions->render("body", "left", $admin_list->RowCount);
?>
	<?php if ($admin_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $admin_list->id->cellAttributes() ?>>
<span id="el<?php echo $admin_list->RowCount ?>_admin_id">
<span<?php echo $admin_list->id->viewAttributes() ?>><?php echo $admin_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($admin_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $admin_list->name->cellAttributes() ?>>
<span id="el<?php echo $admin_list->RowCount ?>_admin_name">
<span<?php echo $admin_list->name->viewAttributes() ?>><?php echo $admin_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($admin_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $admin_list->_email->cellAttributes() ?>>
<span id="el<?php echo $admin_list->RowCount ?>_admin__email">
<span<?php echo $admin_list->_email->viewAttributes() ?>><?php echo $admin_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($admin_list->password->Visible) { // password ?>
		<td data-name="password" <?php echo $admin_list->password->cellAttributes() ?>>
<span id="el<?php echo $admin_list->RowCount ?>_admin_password">
<span<?php echo $admin_list->password->viewAttributes() ?>><?php echo $admin_list->password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($admin_list->address->Visible) { // address ?>
		<td data-name="address" <?php echo $admin_list->address->cellAttributes() ?>>
<span id="el<?php echo $admin_list->RowCount ?>_admin_address">
<span<?php echo $admin_list->address->viewAttributes() ?>><?php echo $admin_list->address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($admin_list->mobile->Visible) { // mobile ?>
		<td data-name="mobile" <?php echo $admin_list->mobile->cellAttributes() ?>>
<span id="el<?php echo $admin_list->RowCount ?>_admin_mobile">
<span<?php echo $admin_list->mobile->viewAttributes() ?>><?php echo $admin_list->mobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$admin_list->ListOptions->render("body", "right", $admin_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$admin_list->isGridAdd())
		$admin_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$admin->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($admin_list->Recordset)
	$admin_list->Recordset->Close();
?>
<?php if (!$admin_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$admin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $admin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $admin_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($admin_list->TotalRecords == 0 && !$admin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $admin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$admin_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$admin_list->isExport()) { ?>
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
$admin_list->terminate();
?>