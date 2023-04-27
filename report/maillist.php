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
$mail_list = new mail_list();

// Run the page
$mail_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mail_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$mail_list->isExport()) { ?>
<script>
var fmaillist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmaillist = currentForm = new ew.Form("fmaillist", "list");
	fmaillist.formKeyCountName = '<?php echo $mail_list->FormKeyCountName ?>';
	loadjs.done("fmaillist");
});
var fmaillistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmaillistsrch = currentSearchForm = new ew.Form("fmaillistsrch");

	// Dynamic selection lists
	// Filters

	fmaillistsrch.filterList = <?php echo $mail_list->getFilterList() ?>;
	loadjs.done("fmaillistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$mail_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($mail_list->TotalRecords > 0 && $mail_list->ExportOptions->visible()) { ?>
<?php $mail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($mail_list->ImportOptions->visible()) { ?>
<?php $mail_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($mail_list->SearchOptions->visible()) { ?>
<?php $mail_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($mail_list->FilterOptions->visible()) { ?>
<?php $mail_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$mail_list->renderOtherOptions();
?>
<?php if (!$mail_list->isExport() && !$mail->CurrentAction) { ?>
<form name="fmaillistsrch" id="fmaillistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmaillistsrch-search-panel" class="<?php echo $mail_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="mail">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $mail_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($mail_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($mail_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $mail_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($mail_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($mail_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($mail_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($mail_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $mail_list->showPageHeader(); ?>
<?php
$mail_list->showMessage();
?>
<?php if ($mail_list->TotalRecords > 0 || $mail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($mail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> mail">
<form name="fmaillist" id="fmaillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mail">
<div id="gmp_mail" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($mail_list->TotalRecords > 0 || $mail_list->isGridEdit()) { ?>
<table id="tbl_maillist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$mail->RowType = ROWTYPE_HEADER;

// Render list options
$mail_list->renderListOptions();

// Render list options (header, left)
$mail_list->ListOptions->render("header", "left");
?>
<?php if ($mail_list->id->Visible) { // id ?>
	<?php if ($mail_list->SortUrl($mail_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $mail_list->id->headerCellClass() ?>"><div id="elh_mail_id" class="mail_id"><div class="ew-table-header-caption"><?php echo $mail_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $mail_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mail_list->SortUrl($mail_list->id) ?>', 1);"><div id="elh_mail_id" class="mail_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mail_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($mail_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mail_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mail_list->name->Visible) { // name ?>
	<?php if ($mail_list->SortUrl($mail_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $mail_list->name->headerCellClass() ?>"><div id="elh_mail_name" class="mail_name"><div class="ew-table-header-caption"><?php echo $mail_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $mail_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mail_list->SortUrl($mail_list->name) ?>', 1);"><div id="elh_mail_name" class="mail_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mail_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($mail_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mail_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mail_list->_email->Visible) { // email ?>
	<?php if ($mail_list->SortUrl($mail_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $mail_list->_email->headerCellClass() ?>"><div id="elh_mail__email" class="mail__email"><div class="ew-table-header-caption"><?php echo $mail_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $mail_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mail_list->SortUrl($mail_list->_email) ?>', 1);"><div id="elh_mail__email" class="mail__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mail_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($mail_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mail_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mail_list->telephone->Visible) { // telephone ?>
	<?php if ($mail_list->SortUrl($mail_list->telephone) == "") { ?>
		<th data-name="telephone" class="<?php echo $mail_list->telephone->headerCellClass() ?>"><div id="elh_mail_telephone" class="mail_telephone"><div class="ew-table-header-caption"><?php echo $mail_list->telephone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telephone" class="<?php echo $mail_list->telephone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mail_list->SortUrl($mail_list->telephone) ?>', 1);"><div id="elh_mail_telephone" class="mail_telephone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mail_list->telephone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($mail_list->telephone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mail_list->telephone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mail_list->message->Visible) { // message ?>
	<?php if ($mail_list->SortUrl($mail_list->message) == "") { ?>
		<th data-name="message" class="<?php echo $mail_list->message->headerCellClass() ?>"><div id="elh_mail_message" class="mail_message"><div class="ew-table-header-caption"><?php echo $mail_list->message->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="message" class="<?php echo $mail_list->message->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mail_list->SortUrl($mail_list->message) ?>', 1);"><div id="elh_mail_message" class="mail_message">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mail_list->message->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($mail_list->message->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mail_list->message->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$mail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($mail_list->ExportAll && $mail_list->isExport()) {
	$mail_list->StopRecord = $mail_list->TotalRecords;
} else {

	// Set the last record to display
	if ($mail_list->TotalRecords > $mail_list->StartRecord + $mail_list->DisplayRecords - 1)
		$mail_list->StopRecord = $mail_list->StartRecord + $mail_list->DisplayRecords - 1;
	else
		$mail_list->StopRecord = $mail_list->TotalRecords;
}
$mail_list->RecordCount = $mail_list->StartRecord - 1;
if ($mail_list->Recordset && !$mail_list->Recordset->EOF) {
	$mail_list->Recordset->moveFirst();
	$selectLimit = $mail_list->UseSelectLimit;
	if (!$selectLimit && $mail_list->StartRecord > 1)
		$mail_list->Recordset->move($mail_list->StartRecord - 1);
} elseif (!$mail->AllowAddDeleteRow && $mail_list->StopRecord == 0) {
	$mail_list->StopRecord = $mail->GridAddRowCount;
}

// Initialize aggregate
$mail->RowType = ROWTYPE_AGGREGATEINIT;
$mail->resetAttributes();
$mail_list->renderRow();
while ($mail_list->RecordCount < $mail_list->StopRecord) {
	$mail_list->RecordCount++;
	if ($mail_list->RecordCount >= $mail_list->StartRecord) {
		$mail_list->RowCount++;

		// Set up key count
		$mail_list->KeyCount = $mail_list->RowIndex;

		// Init row class and style
		$mail->resetAttributes();
		$mail->CssClass = "";
		if ($mail_list->isGridAdd()) {
		} else {
			$mail_list->loadRowValues($mail_list->Recordset); // Load row values
		}
		$mail->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$mail->RowAttrs->merge(["data-rowindex" => $mail_list->RowCount, "id" => "r" . $mail_list->RowCount . "_mail", "data-rowtype" => $mail->RowType]);

		// Render row
		$mail_list->renderRow();

		// Render list options
		$mail_list->renderListOptions();
?>
	<tr <?php echo $mail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$mail_list->ListOptions->render("body", "left", $mail_list->RowCount);
?>
	<?php if ($mail_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $mail_list->id->cellAttributes() ?>>
<span id="el<?php echo $mail_list->RowCount ?>_mail_id">
<span<?php echo $mail_list->id->viewAttributes() ?>><?php echo $mail_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mail_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $mail_list->name->cellAttributes() ?>>
<span id="el<?php echo $mail_list->RowCount ?>_mail_name">
<span<?php echo $mail_list->name->viewAttributes() ?>><?php echo $mail_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mail_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $mail_list->_email->cellAttributes() ?>>
<span id="el<?php echo $mail_list->RowCount ?>_mail__email">
<span<?php echo $mail_list->_email->viewAttributes() ?>><?php echo $mail_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mail_list->telephone->Visible) { // telephone ?>
		<td data-name="telephone" <?php echo $mail_list->telephone->cellAttributes() ?>>
<span id="el<?php echo $mail_list->RowCount ?>_mail_telephone">
<span<?php echo $mail_list->telephone->viewAttributes() ?>><?php echo $mail_list->telephone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mail_list->message->Visible) { // message ?>
		<td data-name="message" <?php echo $mail_list->message->cellAttributes() ?>>
<span id="el<?php echo $mail_list->RowCount ?>_mail_message">
<span<?php echo $mail_list->message->viewAttributes() ?>><?php echo $mail_list->message->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$mail_list->ListOptions->render("body", "right", $mail_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$mail_list->isGridAdd())
		$mail_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$mail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($mail_list->Recordset)
	$mail_list->Recordset->Close();
?>
<?php if (!$mail_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$mail_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $mail_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $mail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($mail_list->TotalRecords == 0 && !$mail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $mail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$mail_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$mail_list->isExport()) { ?>
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
$mail_list->terminate();
?>