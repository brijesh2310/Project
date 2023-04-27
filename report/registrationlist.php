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
$registration_list = new registration_list();

// Run the page
$registration_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$registration_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$registration_list->isExport()) { ?>
<script>
var fregistrationlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fregistrationlist = currentForm = new ew.Form("fregistrationlist", "list");
	fregistrationlist.formKeyCountName = '<?php echo $registration_list->FormKeyCountName ?>';
	loadjs.done("fregistrationlist");
});
var fregistrationlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fregistrationlistsrch = currentSearchForm = new ew.Form("fregistrationlistsrch");

	// Dynamic selection lists
	// Filters

	fregistrationlistsrch.filterList = <?php echo $registration_list->getFilterList() ?>;
	loadjs.done("fregistrationlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$registration_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($registration_list->TotalRecords > 0 && $registration_list->ExportOptions->visible()) { ?>
<?php $registration_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($registration_list->ImportOptions->visible()) { ?>
<?php $registration_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($registration_list->SearchOptions->visible()) { ?>
<?php $registration_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($registration_list->FilterOptions->visible()) { ?>
<?php $registration_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$registration_list->renderOtherOptions();
?>
<?php if (!$registration_list->isExport() && !$registration->CurrentAction) { ?>
<form name="fregistrationlistsrch" id="fregistrationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fregistrationlistsrch-search-panel" class="<?php echo $registration_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="registration">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $registration_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($registration_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($registration_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $registration_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($registration_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($registration_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($registration_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($registration_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $registration_list->showPageHeader(); ?>
<?php
$registration_list->showMessage();
?>
<?php if ($registration_list->TotalRecords > 0 || $registration->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($registration_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> registration">
<form name="fregistrationlist" id="fregistrationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="registration">
<div id="gmp_registration" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($registration_list->TotalRecords > 0 || $registration_list->isGridEdit()) { ?>
<table id="tbl_registrationlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$registration->RowType = ROWTYPE_HEADER;

// Render list options
$registration_list->renderListOptions();

// Render list options (header, left)
$registration_list->ListOptions->render("header", "left");
?>
<?php if ($registration_list->registration_id->Visible) { // registration_id ?>
	<?php if ($registration_list->SortUrl($registration_list->registration_id) == "") { ?>
		<th data-name="registration_id" class="<?php echo $registration_list->registration_id->headerCellClass() ?>"><div id="elh_registration_registration_id" class="registration_registration_id"><div class="ew-table-header-caption"><?php echo $registration_list->registration_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="registration_id" class="<?php echo $registration_list->registration_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $registration_list->SortUrl($registration_list->registration_id) ?>', 1);"><div id="elh_registration_registration_id" class="registration_registration_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $registration_list->registration_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($registration_list->registration_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($registration_list->registration_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($registration_list->name->Visible) { // name ?>
	<?php if ($registration_list->SortUrl($registration_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $registration_list->name->headerCellClass() ?>"><div id="elh_registration_name" class="registration_name"><div class="ew-table-header-caption"><?php echo $registration_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $registration_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $registration_list->SortUrl($registration_list->name) ?>', 1);"><div id="elh_registration_name" class="registration_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $registration_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($registration_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($registration_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($registration_list->_email->Visible) { // email ?>
	<?php if ($registration_list->SortUrl($registration_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $registration_list->_email->headerCellClass() ?>"><div id="elh_registration__email" class="registration__email"><div class="ew-table-header-caption"><?php echo $registration_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $registration_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $registration_list->SortUrl($registration_list->_email) ?>', 1);"><div id="elh_registration__email" class="registration__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $registration_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($registration_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($registration_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($registration_list->password->Visible) { // password ?>
	<?php if ($registration_list->SortUrl($registration_list->password) == "") { ?>
		<th data-name="password" class="<?php echo $registration_list->password->headerCellClass() ?>"><div id="elh_registration_password" class="registration_password"><div class="ew-table-header-caption"><?php echo $registration_list->password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="password" class="<?php echo $registration_list->password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $registration_list->SortUrl($registration_list->password) ?>', 1);"><div id="elh_registration_password" class="registration_password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $registration_list->password->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($registration_list->password->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($registration_list->password->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($registration_list->address->Visible) { // address ?>
	<?php if ($registration_list->SortUrl($registration_list->address) == "") { ?>
		<th data-name="address" class="<?php echo $registration_list->address->headerCellClass() ?>"><div id="elh_registration_address" class="registration_address"><div class="ew-table-header-caption"><?php echo $registration_list->address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="address" class="<?php echo $registration_list->address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $registration_list->SortUrl($registration_list->address) ?>', 1);"><div id="elh_registration_address" class="registration_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $registration_list->address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($registration_list->address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($registration_list->address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($registration_list->city->Visible) { // city ?>
	<?php if ($registration_list->SortUrl($registration_list->city) == "") { ?>
		<th data-name="city" class="<?php echo $registration_list->city->headerCellClass() ?>"><div id="elh_registration_city" class="registration_city"><div class="ew-table-header-caption"><?php echo $registration_list->city->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="city" class="<?php echo $registration_list->city->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $registration_list->SortUrl($registration_list->city) ?>', 1);"><div id="elh_registration_city" class="registration_city">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $registration_list->city->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($registration_list->city->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($registration_list->city->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($registration_list->area->Visible) { // area ?>
	<?php if ($registration_list->SortUrl($registration_list->area) == "") { ?>
		<th data-name="area" class="<?php echo $registration_list->area->headerCellClass() ?>"><div id="elh_registration_area" class="registration_area"><div class="ew-table-header-caption"><?php echo $registration_list->area->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="area" class="<?php echo $registration_list->area->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $registration_list->SortUrl($registration_list->area) ?>', 1);"><div id="elh_registration_area" class="registration_area">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $registration_list->area->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($registration_list->area->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($registration_list->area->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($registration_list->postalcode->Visible) { // postalcode ?>
	<?php if ($registration_list->SortUrl($registration_list->postalcode) == "") { ?>
		<th data-name="postalcode" class="<?php echo $registration_list->postalcode->headerCellClass() ?>"><div id="elh_registration_postalcode" class="registration_postalcode"><div class="ew-table-header-caption"><?php echo $registration_list->postalcode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="postalcode" class="<?php echo $registration_list->postalcode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $registration_list->SortUrl($registration_list->postalcode) ?>', 1);"><div id="elh_registration_postalcode" class="registration_postalcode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $registration_list->postalcode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($registration_list->postalcode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($registration_list->postalcode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($registration_list->gender->Visible) { // gender ?>
	<?php if ($registration_list->SortUrl($registration_list->gender) == "") { ?>
		<th data-name="gender" class="<?php echo $registration_list->gender->headerCellClass() ?>"><div id="elh_registration_gender" class="registration_gender"><div class="ew-table-header-caption"><?php echo $registration_list->gender->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gender" class="<?php echo $registration_list->gender->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $registration_list->SortUrl($registration_list->gender) ?>', 1);"><div id="elh_registration_gender" class="registration_gender">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $registration_list->gender->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($registration_list->gender->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($registration_list->gender->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($registration_list->mobile->Visible) { // mobile ?>
	<?php if ($registration_list->SortUrl($registration_list->mobile) == "") { ?>
		<th data-name="mobile" class="<?php echo $registration_list->mobile->headerCellClass() ?>"><div id="elh_registration_mobile" class="registration_mobile"><div class="ew-table-header-caption"><?php echo $registration_list->mobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mobile" class="<?php echo $registration_list->mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $registration_list->SortUrl($registration_list->mobile) ?>', 1);"><div id="elh_registration_mobile" class="registration_mobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $registration_list->mobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($registration_list->mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($registration_list->mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$registration_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($registration_list->ExportAll && $registration_list->isExport()) {
	$registration_list->StopRecord = $registration_list->TotalRecords;
} else {

	// Set the last record to display
	if ($registration_list->TotalRecords > $registration_list->StartRecord + $registration_list->DisplayRecords - 1)
		$registration_list->StopRecord = $registration_list->StartRecord + $registration_list->DisplayRecords - 1;
	else
		$registration_list->StopRecord = $registration_list->TotalRecords;
}
$registration_list->RecordCount = $registration_list->StartRecord - 1;
if ($registration_list->Recordset && !$registration_list->Recordset->EOF) {
	$registration_list->Recordset->moveFirst();
	$selectLimit = $registration_list->UseSelectLimit;
	if (!$selectLimit && $registration_list->StartRecord > 1)
		$registration_list->Recordset->move($registration_list->StartRecord - 1);
} elseif (!$registration->AllowAddDeleteRow && $registration_list->StopRecord == 0) {
	$registration_list->StopRecord = $registration->GridAddRowCount;
}

// Initialize aggregate
$registration->RowType = ROWTYPE_AGGREGATEINIT;
$registration->resetAttributes();
$registration_list->renderRow();
while ($registration_list->RecordCount < $registration_list->StopRecord) {
	$registration_list->RecordCount++;
	if ($registration_list->RecordCount >= $registration_list->StartRecord) {
		$registration_list->RowCount++;

		// Set up key count
		$registration_list->KeyCount = $registration_list->RowIndex;

		// Init row class and style
		$registration->resetAttributes();
		$registration->CssClass = "";
		if ($registration_list->isGridAdd()) {
		} else {
			$registration_list->loadRowValues($registration_list->Recordset); // Load row values
		}
		$registration->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$registration->RowAttrs->merge(["data-rowindex" => $registration_list->RowCount, "id" => "r" . $registration_list->RowCount . "_registration", "data-rowtype" => $registration->RowType]);

		// Render row
		$registration_list->renderRow();

		// Render list options
		$registration_list->renderListOptions();
?>
	<tr <?php echo $registration->rowAttributes() ?>>
<?php

// Render list options (body, left)
$registration_list->ListOptions->render("body", "left", $registration_list->RowCount);
?>
	<?php if ($registration_list->registration_id->Visible) { // registration_id ?>
		<td data-name="registration_id" <?php echo $registration_list->registration_id->cellAttributes() ?>>
<span id="el<?php echo $registration_list->RowCount ?>_registration_registration_id">
<span<?php echo $registration_list->registration_id->viewAttributes() ?>><?php echo $registration_list->registration_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($registration_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $registration_list->name->cellAttributes() ?>>
<span id="el<?php echo $registration_list->RowCount ?>_registration_name">
<span<?php echo $registration_list->name->viewAttributes() ?>><?php echo $registration_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($registration_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $registration_list->_email->cellAttributes() ?>>
<span id="el<?php echo $registration_list->RowCount ?>_registration__email">
<span<?php echo $registration_list->_email->viewAttributes() ?>><?php echo $registration_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($registration_list->password->Visible) { // password ?>
		<td data-name="password" <?php echo $registration_list->password->cellAttributes() ?>>
<span id="el<?php echo $registration_list->RowCount ?>_registration_password">
<span<?php echo $registration_list->password->viewAttributes() ?>><?php echo $registration_list->password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($registration_list->address->Visible) { // address ?>
		<td data-name="address" <?php echo $registration_list->address->cellAttributes() ?>>
<span id="el<?php echo $registration_list->RowCount ?>_registration_address">
<span<?php echo $registration_list->address->viewAttributes() ?>><?php echo $registration_list->address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($registration_list->city->Visible) { // city ?>
		<td data-name="city" <?php echo $registration_list->city->cellAttributes() ?>>
<span id="el<?php echo $registration_list->RowCount ?>_registration_city">
<span<?php echo $registration_list->city->viewAttributes() ?>><?php echo $registration_list->city->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($registration_list->area->Visible) { // area ?>
		<td data-name="area" <?php echo $registration_list->area->cellAttributes() ?>>
<span id="el<?php echo $registration_list->RowCount ?>_registration_area">
<span<?php echo $registration_list->area->viewAttributes() ?>><?php echo $registration_list->area->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($registration_list->postalcode->Visible) { // postalcode ?>
		<td data-name="postalcode" <?php echo $registration_list->postalcode->cellAttributes() ?>>
<span id="el<?php echo $registration_list->RowCount ?>_registration_postalcode">
<span<?php echo $registration_list->postalcode->viewAttributes() ?>><?php echo $registration_list->postalcode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($registration_list->gender->Visible) { // gender ?>
		<td data-name="gender" <?php echo $registration_list->gender->cellAttributes() ?>>
<span id="el<?php echo $registration_list->RowCount ?>_registration_gender">
<span<?php echo $registration_list->gender->viewAttributes() ?>><?php echo $registration_list->gender->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($registration_list->mobile->Visible) { // mobile ?>
		<td data-name="mobile" <?php echo $registration_list->mobile->cellAttributes() ?>>
<span id="el<?php echo $registration_list->RowCount ?>_registration_mobile">
<span<?php echo $registration_list->mobile->viewAttributes() ?>><?php echo $registration_list->mobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$registration_list->ListOptions->render("body", "right", $registration_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$registration_list->isGridAdd())
		$registration_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$registration->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($registration_list->Recordset)
	$registration_list->Recordset->Close();
?>
<?php if (!$registration_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$registration_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $registration_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $registration_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($registration_list->TotalRecords == 0 && !$registration->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $registration_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$registration_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$registration_list->isExport()) { ?>
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
$registration_list->terminate();
?>