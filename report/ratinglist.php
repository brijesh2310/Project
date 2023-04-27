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
$rating_list = new rating_list();

// Run the page
$rating_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rating_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rating_list->isExport()) { ?>
<script>
var fratinglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fratinglist = currentForm = new ew.Form("fratinglist", "list");
	fratinglist.formKeyCountName = '<?php echo $rating_list->FormKeyCountName ?>';
	loadjs.done("fratinglist");
});
var fratinglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fratinglistsrch = currentSearchForm = new ew.Form("fratinglistsrch");

	// Dynamic selection lists
	// Filters

	fratinglistsrch.filterList = <?php echo $rating_list->getFilterList() ?>;
	loadjs.done("fratinglistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$rating_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($rating_list->TotalRecords > 0 && $rating_list->ExportOptions->visible()) { ?>
<?php $rating_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($rating_list->ImportOptions->visible()) { ?>
<?php $rating_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($rating_list->SearchOptions->visible()) { ?>
<?php $rating_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($rating_list->FilterOptions->visible()) { ?>
<?php $rating_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$rating_list->renderOtherOptions();
?>
<?php if (!$rating_list->isExport() && !$rating->CurrentAction) { ?>
<form name="fratinglistsrch" id="fratinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fratinglistsrch-search-panel" class="<?php echo $rating_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="rating">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $rating_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($rating_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($rating_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $rating_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($rating_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($rating_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($rating_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($rating_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $rating_list->showPageHeader(); ?>
<?php
$rating_list->showMessage();
?>
<?php if ($rating_list->TotalRecords > 0 || $rating->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($rating_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rating">
<form name="fratinglist" id="fratinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rating">
<div id="gmp_rating" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($rating_list->TotalRecords > 0 || $rating_list->isGridEdit()) { ?>
<table id="tbl_ratinglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$rating->RowType = ROWTYPE_HEADER;

// Render list options
$rating_list->renderListOptions();

// Render list options (header, left)
$rating_list->ListOptions->render("header", "left");
?>
<?php if ($rating_list->id->Visible) { // id ?>
	<?php if ($rating_list->SortUrl($rating_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $rating_list->id->headerCellClass() ?>"><div id="elh_rating_id" class="rating_id"><div class="ew-table-header-caption"><?php echo $rating_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $rating_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rating_list->SortUrl($rating_list->id) ?>', 1);"><div id="elh_rating_id" class="rating_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rating_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rating_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rating_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rating_list->name->Visible) { // name ?>
	<?php if ($rating_list->SortUrl($rating_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $rating_list->name->headerCellClass() ?>"><div id="elh_rating_name" class="rating_name"><div class="ew-table-header-caption"><?php echo $rating_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $rating_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rating_list->SortUrl($rating_list->name) ?>', 1);"><div id="elh_rating_name" class="rating_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rating_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rating_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rating_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rating_list->_email->Visible) { // email ?>
	<?php if ($rating_list->SortUrl($rating_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $rating_list->_email->headerCellClass() ?>"><div id="elh_rating__email" class="rating__email"><div class="ew-table-header-caption"><?php echo $rating_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $rating_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rating_list->SortUrl($rating_list->_email) ?>', 1);"><div id="elh_rating__email" class="rating__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rating_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rating_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rating_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rating_list->rate->Visible) { // rate ?>
	<?php if ($rating_list->SortUrl($rating_list->rate) == "") { ?>
		<th data-name="rate" class="<?php echo $rating_list->rate->headerCellClass() ?>"><div id="elh_rating_rate" class="rating_rate"><div class="ew-table-header-caption"><?php echo $rating_list->rate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rate" class="<?php echo $rating_list->rate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rating_list->SortUrl($rating_list->rate) ?>', 1);"><div id="elh_rating_rate" class="rating_rate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rating_list->rate->caption() ?></span><span class="ew-table-header-sort"><?php if ($rating_list->rate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rating_list->rate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rating_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rating_list->ExportAll && $rating_list->isExport()) {
	$rating_list->StopRecord = $rating_list->TotalRecords;
} else {

	// Set the last record to display
	if ($rating_list->TotalRecords > $rating_list->StartRecord + $rating_list->DisplayRecords - 1)
		$rating_list->StopRecord = $rating_list->StartRecord + $rating_list->DisplayRecords - 1;
	else
		$rating_list->StopRecord = $rating_list->TotalRecords;
}
$rating_list->RecordCount = $rating_list->StartRecord - 1;
if ($rating_list->Recordset && !$rating_list->Recordset->EOF) {
	$rating_list->Recordset->moveFirst();
	$selectLimit = $rating_list->UseSelectLimit;
	if (!$selectLimit && $rating_list->StartRecord > 1)
		$rating_list->Recordset->move($rating_list->StartRecord - 1);
} elseif (!$rating->AllowAddDeleteRow && $rating_list->StopRecord == 0) {
	$rating_list->StopRecord = $rating->GridAddRowCount;
}

// Initialize aggregate
$rating->RowType = ROWTYPE_AGGREGATEINIT;
$rating->resetAttributes();
$rating_list->renderRow();
while ($rating_list->RecordCount < $rating_list->StopRecord) {
	$rating_list->RecordCount++;
	if ($rating_list->RecordCount >= $rating_list->StartRecord) {
		$rating_list->RowCount++;

		// Set up key count
		$rating_list->KeyCount = $rating_list->RowIndex;

		// Init row class and style
		$rating->resetAttributes();
		$rating->CssClass = "";
		if ($rating_list->isGridAdd()) {
		} else {
			$rating_list->loadRowValues($rating_list->Recordset); // Load row values
		}
		$rating->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$rating->RowAttrs->merge(["data-rowindex" => $rating_list->RowCount, "id" => "r" . $rating_list->RowCount . "_rating", "data-rowtype" => $rating->RowType]);

		// Render row
		$rating_list->renderRow();

		// Render list options
		$rating_list->renderListOptions();
?>
	<tr <?php echo $rating->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rating_list->ListOptions->render("body", "left", $rating_list->RowCount);
?>
	<?php if ($rating_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $rating_list->id->cellAttributes() ?>>
<span id="el<?php echo $rating_list->RowCount ?>_rating_id">
<span<?php echo $rating_list->id->viewAttributes() ?>><?php echo $rating_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rating_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $rating_list->name->cellAttributes() ?>>
<span id="el<?php echo $rating_list->RowCount ?>_rating_name">
<span<?php echo $rating_list->name->viewAttributes() ?>><?php echo $rating_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rating_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $rating_list->_email->cellAttributes() ?>>
<span id="el<?php echo $rating_list->RowCount ?>_rating__email">
<span<?php echo $rating_list->_email->viewAttributes() ?>><?php echo $rating_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rating_list->rate->Visible) { // rate ?>
		<td data-name="rate" <?php echo $rating_list->rate->cellAttributes() ?>>
<span id="el<?php echo $rating_list->RowCount ?>_rating_rate">
<span<?php echo $rating_list->rate->viewAttributes() ?>><?php echo $rating_list->rate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rating_list->ListOptions->render("body", "right", $rating_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$rating_list->isGridAdd())
		$rating_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$rating->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($rating_list->Recordset)
	$rating_list->Recordset->Close();
?>
<?php if (!$rating_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$rating_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rating_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rating_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($rating_list->TotalRecords == 0 && !$rating->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $rating_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$rating_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rating_list->isExport()) { ?>
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
$rating_list->terminate();
?>