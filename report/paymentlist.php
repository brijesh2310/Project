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
$payment_list = new payment_list();

// Run the page
$payment_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payment_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payment_list->isExport()) { ?>
<script>
var fpaymentlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpaymentlist = currentForm = new ew.Form("fpaymentlist", "list");
	fpaymentlist.formKeyCountName = '<?php echo $payment_list->FormKeyCountName ?>';
	loadjs.done("fpaymentlist");
});
var fpaymentlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpaymentlistsrch = currentSearchForm = new ew.Form("fpaymentlistsrch");

	// Dynamic selection lists
	// Filters

	fpaymentlistsrch.filterList = <?php echo $payment_list->getFilterList() ?>;
	loadjs.done("fpaymentlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$payment_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($payment_list->TotalRecords > 0 && $payment_list->ExportOptions->visible()) { ?>
<?php $payment_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($payment_list->ImportOptions->visible()) { ?>
<?php $payment_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($payment_list->SearchOptions->visible()) { ?>
<?php $payment_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($payment_list->FilterOptions->visible()) { ?>
<?php $payment_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$payment_list->renderOtherOptions();
?>
<?php if (!$payment_list->isExport() && !$payment->CurrentAction) { ?>
<form name="fpaymentlistsrch" id="fpaymentlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpaymentlistsrch-search-panel" class="<?php echo $payment_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="payment">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $payment_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($payment_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($payment_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $payment_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($payment_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($payment_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($payment_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($payment_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $payment_list->showPageHeader(); ?>
<?php
$payment_list->showMessage();
?>
<?php if ($payment_list->TotalRecords > 0 || $payment->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payment_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payment">
<form name="fpaymentlist" id="fpaymentlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payment">
<div id="gmp_payment" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($payment_list->TotalRecords > 0 || $payment_list->isGridEdit()) { ?>
<table id="tbl_paymentlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payment->RowType = ROWTYPE_HEADER;

// Render list options
$payment_list->renderListOptions();

// Render list options (header, left)
$payment_list->ListOptions->render("header", "left");
?>
<?php if ($payment_list->a_id->Visible) { // a_id ?>
	<?php if ($payment_list->SortUrl($payment_list->a_id) == "") { ?>
		<th data-name="a_id" class="<?php echo $payment_list->a_id->headerCellClass() ?>"><div id="elh_payment_a_id" class="payment_a_id"><div class="ew-table-header-caption"><?php echo $payment_list->a_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="a_id" class="<?php echo $payment_list->a_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->a_id) ?>', 1);"><div id="elh_payment_a_id" class="payment_a_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->a_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list->a_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->a_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->o_id->Visible) { // o_id ?>
	<?php if ($payment_list->SortUrl($payment_list->o_id) == "") { ?>
		<th data-name="o_id" class="<?php echo $payment_list->o_id->headerCellClass() ?>"><div id="elh_payment_o_id" class="payment_o_id"><div class="ew-table-header-caption"><?php echo $payment_list->o_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="o_id" class="<?php echo $payment_list->o_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->o_id) ?>', 1);"><div id="elh_payment_o_id" class="payment_o_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->o_id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list->o_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->o_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->name->Visible) { // name ?>
	<?php if ($payment_list->SortUrl($payment_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $payment_list->name->headerCellClass() ?>"><div id="elh_payment_name" class="payment_name"><div class="ew-table-header-caption"><?php echo $payment_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $payment_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->name) ?>', 1);"><div id="elh_payment_name" class="payment_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->_email->Visible) { // email ?>
	<?php if ($payment_list->SortUrl($payment_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $payment_list->_email->headerCellClass() ?>"><div id="elh_payment__email" class="payment__email"><div class="ew-table-header-caption"><?php echo $payment_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $payment_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->_email) ?>', 1);"><div id="elh_payment__email" class="payment__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->mobile_no->Visible) { // mobile_no ?>
	<?php if ($payment_list->SortUrl($payment_list->mobile_no) == "") { ?>
		<th data-name="mobile_no" class="<?php echo $payment_list->mobile_no->headerCellClass() ?>"><div id="elh_payment_mobile_no" class="payment_mobile_no"><div class="ew-table-header-caption"><?php echo $payment_list->mobile_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mobile_no" class="<?php echo $payment_list->mobile_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->mobile_no) ?>', 1);"><div id="elh_payment_mobile_no" class="payment_mobile_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->mobile_no->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list->mobile_no->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->mobile_no->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->billing_address->Visible) { // billing_address ?>
	<?php if ($payment_list->SortUrl($payment_list->billing_address) == "") { ?>
		<th data-name="billing_address" class="<?php echo $payment_list->billing_address->headerCellClass() ?>"><div id="elh_payment_billing_address" class="payment_billing_address"><div class="ew-table-header-caption"><?php echo $payment_list->billing_address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="billing_address" class="<?php echo $payment_list->billing_address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->billing_address) ?>', 1);"><div id="elh_payment_billing_address" class="payment_billing_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->billing_address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list->billing_address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->billing_address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->shipping_address->Visible) { // shipping_address ?>
	<?php if ($payment_list->SortUrl($payment_list->shipping_address) == "") { ?>
		<th data-name="shipping_address" class="<?php echo $payment_list->shipping_address->headerCellClass() ?>"><div id="elh_payment_shipping_address" class="payment_shipping_address"><div class="ew-table-header-caption"><?php echo $payment_list->shipping_address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="shipping_address" class="<?php echo $payment_list->shipping_address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->shipping_address) ?>', 1);"><div id="elh_payment_shipping_address" class="payment_shipping_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->shipping_address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list->shipping_address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->shipping_address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->city->Visible) { // city ?>
	<?php if ($payment_list->SortUrl($payment_list->city) == "") { ?>
		<th data-name="city" class="<?php echo $payment_list->city->headerCellClass() ?>"><div id="elh_payment_city" class="payment_city"><div class="ew-table-header-caption"><?php echo $payment_list->city->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="city" class="<?php echo $payment_list->city->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->city) ?>', 1);"><div id="elh_payment_city" class="payment_city">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->city->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list->city->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->city->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->state->Visible) { // state ?>
	<?php if ($payment_list->SortUrl($payment_list->state) == "") { ?>
		<th data-name="state" class="<?php echo $payment_list->state->headerCellClass() ?>"><div id="elh_payment_state" class="payment_state"><div class="ew-table-header-caption"><?php echo $payment_list->state->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="state" class="<?php echo $payment_list->state->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->state) ?>', 1);"><div id="elh_payment_state" class="payment_state">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->state->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list->state->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->state->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->pincode->Visible) { // pincode ?>
	<?php if ($payment_list->SortUrl($payment_list->pincode) == "") { ?>
		<th data-name="pincode" class="<?php echo $payment_list->pincode->headerCellClass() ?>"><div id="elh_payment_pincode" class="payment_pincode"><div class="ew-table-header-caption"><?php echo $payment_list->pincode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pincode" class="<?php echo $payment_list->pincode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->pincode) ?>', 1);"><div id="elh_payment_pincode" class="payment_pincode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->pincode->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list->pincode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->pincode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->payment_method->Visible) { // payment_method ?>
	<?php if ($payment_list->SortUrl($payment_list->payment_method) == "") { ?>
		<th data-name="payment_method" class="<?php echo $payment_list->payment_method->headerCellClass() ?>"><div id="elh_payment_payment_method" class="payment_payment_method"><div class="ew-table-header-caption"><?php echo $payment_list->payment_method->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="payment_method" class="<?php echo $payment_list->payment_method->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->payment_method) ?>', 1);"><div id="elh_payment_payment_method" class="payment_payment_method">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->payment_method->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list->payment_method->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->payment_method->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->card_no->Visible) { // card_no ?>
	<?php if ($payment_list->SortUrl($payment_list->card_no) == "") { ?>
		<th data-name="card_no" class="<?php echo $payment_list->card_no->headerCellClass() ?>"><div id="elh_payment_card_no" class="payment_card_no"><div class="ew-table-header-caption"><?php echo $payment_list->card_no->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="card_no" class="<?php echo $payment_list->card_no->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->card_no) ?>', 1);"><div id="elh_payment_card_no" class="payment_card_no">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->card_no->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list->card_no->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->card_no->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->expiry_date->Visible) { // expiry_date ?>
	<?php if ($payment_list->SortUrl($payment_list->expiry_date) == "") { ?>
		<th data-name="expiry_date" class="<?php echo $payment_list->expiry_date->headerCellClass() ?>"><div id="elh_payment_expiry_date" class="payment_expiry_date"><div class="ew-table-header-caption"><?php echo $payment_list->expiry_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="expiry_date" class="<?php echo $payment_list->expiry_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->expiry_date) ?>', 1);"><div id="elh_payment_expiry_date" class="payment_expiry_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->expiry_date->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list->expiry_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->expiry_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->order_date->Visible) { // order_date ?>
	<?php if ($payment_list->SortUrl($payment_list->order_date) == "") { ?>
		<th data-name="order_date" class="<?php echo $payment_list->order_date->headerCellClass() ?>"><div id="elh_payment_order_date" class="payment_order_date"><div class="ew-table-header-caption"><?php echo $payment_list->order_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="order_date" class="<?php echo $payment_list->order_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->order_date) ?>', 1);"><div id="elh_payment_order_date" class="payment_order_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->order_date->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list->order_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->order_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->product_name->Visible) { // product_name ?>
	<?php if ($payment_list->SortUrl($payment_list->product_name) == "") { ?>
		<th data-name="product_name" class="<?php echo $payment_list->product_name->headerCellClass() ?>"><div id="elh_payment_product_name" class="payment_product_name"><div class="ew-table-header-caption"><?php echo $payment_list->product_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_name" class="<?php echo $payment_list->product_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->product_name) ?>', 1);"><div id="elh_payment_product_name" class="payment_product_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->product_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list->product_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->product_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->product_quantity->Visible) { // product_quantity ?>
	<?php if ($payment_list->SortUrl($payment_list->product_quantity) == "") { ?>
		<th data-name="product_quantity" class="<?php echo $payment_list->product_quantity->headerCellClass() ?>"><div id="elh_payment_product_quantity" class="payment_product_quantity"><div class="ew-table-header-caption"><?php echo $payment_list->product_quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_quantity" class="<?php echo $payment_list->product_quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->product_quantity) ?>', 1);"><div id="elh_payment_product_quantity" class="payment_product_quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->product_quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list->product_quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->product_quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->product_price->Visible) { // product_price ?>
	<?php if ($payment_list->SortUrl($payment_list->product_price) == "") { ?>
		<th data-name="product_price" class="<?php echo $payment_list->product_price->headerCellClass() ?>"><div id="elh_payment_product_price" class="payment_product_price"><div class="ew-table-header-caption"><?php echo $payment_list->product_price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_price" class="<?php echo $payment_list->product_price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->product_price) ?>', 1);"><div id="elh_payment_product_price" class="payment_product_price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->product_price->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list->product_price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->product_price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list->total_price->Visible) { // total_price ?>
	<?php if ($payment_list->SortUrl($payment_list->total_price) == "") { ?>
		<th data-name="total_price" class="<?php echo $payment_list->total_price->headerCellClass() ?>"><div id="elh_payment_total_price" class="payment_total_price"><div class="ew-table-header-caption"><?php echo $payment_list->total_price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_price" class="<?php echo $payment_list->total_price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list->SortUrl($payment_list->total_price) ?>', 1);"><div id="elh_payment_total_price" class="payment_total_price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list->total_price->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list->total_price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list->total_price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payment_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($payment_list->ExportAll && $payment_list->isExport()) {
	$payment_list->StopRecord = $payment_list->TotalRecords;
} else {

	// Set the last record to display
	if ($payment_list->TotalRecords > $payment_list->StartRecord + $payment_list->DisplayRecords - 1)
		$payment_list->StopRecord = $payment_list->StartRecord + $payment_list->DisplayRecords - 1;
	else
		$payment_list->StopRecord = $payment_list->TotalRecords;
}
$payment_list->RecordCount = $payment_list->StartRecord - 1;
if ($payment_list->Recordset && !$payment_list->Recordset->EOF) {
	$payment_list->Recordset->moveFirst();
	$selectLimit = $payment_list->UseSelectLimit;
	if (!$selectLimit && $payment_list->StartRecord > 1)
		$payment_list->Recordset->move($payment_list->StartRecord - 1);
} elseif (!$payment->AllowAddDeleteRow && $payment_list->StopRecord == 0) {
	$payment_list->StopRecord = $payment->GridAddRowCount;
}

// Initialize aggregate
$payment->RowType = ROWTYPE_AGGREGATEINIT;
$payment->resetAttributes();
$payment_list->renderRow();
while ($payment_list->RecordCount < $payment_list->StopRecord) {
	$payment_list->RecordCount++;
	if ($payment_list->RecordCount >= $payment_list->StartRecord) {
		$payment_list->RowCount++;

		// Set up key count
		$payment_list->KeyCount = $payment_list->RowIndex;

		// Init row class and style
		$payment->resetAttributes();
		$payment->CssClass = "";
		if ($payment_list->isGridAdd()) {
		} else {
			$payment_list->loadRowValues($payment_list->Recordset); // Load row values
		}
		$payment->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$payment->RowAttrs->merge(["data-rowindex" => $payment_list->RowCount, "id" => "r" . $payment_list->RowCount . "_payment", "data-rowtype" => $payment->RowType]);

		// Render row
		$payment_list->renderRow();

		// Render list options
		$payment_list->renderListOptions();
?>
	<tr <?php echo $payment->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payment_list->ListOptions->render("body", "left", $payment_list->RowCount);
?>
	<?php if ($payment_list->a_id->Visible) { // a_id ?>
		<td data-name="a_id" <?php echo $payment_list->a_id->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_a_id">
<span<?php echo $payment_list->a_id->viewAttributes() ?>><?php echo $payment_list->a_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->o_id->Visible) { // o_id ?>
		<td data-name="o_id" <?php echo $payment_list->o_id->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_o_id">
<span<?php echo $payment_list->o_id->viewAttributes() ?>><?php echo $payment_list->o_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $payment_list->name->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_name">
<span<?php echo $payment_list->name->viewAttributes() ?>><?php echo $payment_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $payment_list->_email->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment__email">
<span<?php echo $payment_list->_email->viewAttributes() ?>><?php echo $payment_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->mobile_no->Visible) { // mobile_no ?>
		<td data-name="mobile_no" <?php echo $payment_list->mobile_no->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_mobile_no">
<span<?php echo $payment_list->mobile_no->viewAttributes() ?>><?php echo $payment_list->mobile_no->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->billing_address->Visible) { // billing_address ?>
		<td data-name="billing_address" <?php echo $payment_list->billing_address->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_billing_address">
<span<?php echo $payment_list->billing_address->viewAttributes() ?>><?php echo $payment_list->billing_address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->shipping_address->Visible) { // shipping_address ?>
		<td data-name="shipping_address" <?php echo $payment_list->shipping_address->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_shipping_address">
<span<?php echo $payment_list->shipping_address->viewAttributes() ?>><?php echo $payment_list->shipping_address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->city->Visible) { // city ?>
		<td data-name="city" <?php echo $payment_list->city->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_city">
<span<?php echo $payment_list->city->viewAttributes() ?>><?php echo $payment_list->city->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->state->Visible) { // state ?>
		<td data-name="state" <?php echo $payment_list->state->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_state">
<span<?php echo $payment_list->state->viewAttributes() ?>><?php echo $payment_list->state->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->pincode->Visible) { // pincode ?>
		<td data-name="pincode" <?php echo $payment_list->pincode->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_pincode">
<span<?php echo $payment_list->pincode->viewAttributes() ?>><?php echo $payment_list->pincode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->payment_method->Visible) { // payment_method ?>
		<td data-name="payment_method" <?php echo $payment_list->payment_method->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_payment_method">
<span<?php echo $payment_list->payment_method->viewAttributes() ?>><?php echo $payment_list->payment_method->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->card_no->Visible) { // card_no ?>
		<td data-name="card_no" <?php echo $payment_list->card_no->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_card_no">
<span<?php echo $payment_list->card_no->viewAttributes() ?>><?php echo $payment_list->card_no->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->expiry_date->Visible) { // expiry_date ?>
		<td data-name="expiry_date" <?php echo $payment_list->expiry_date->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_expiry_date">
<span<?php echo $payment_list->expiry_date->viewAttributes() ?>><?php echo $payment_list->expiry_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->order_date->Visible) { // order_date ?>
		<td data-name="order_date" <?php echo $payment_list->order_date->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_order_date">
<span<?php echo $payment_list->order_date->viewAttributes() ?>><?php echo $payment_list->order_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->product_name->Visible) { // product_name ?>
		<td data-name="product_name" <?php echo $payment_list->product_name->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_product_name">
<span<?php echo $payment_list->product_name->viewAttributes() ?>><?php echo $payment_list->product_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->product_quantity->Visible) { // product_quantity ?>
		<td data-name="product_quantity" <?php echo $payment_list->product_quantity->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_product_quantity">
<span<?php echo $payment_list->product_quantity->viewAttributes() ?>><?php echo $payment_list->product_quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->product_price->Visible) { // product_price ?>
		<td data-name="product_price" <?php echo $payment_list->product_price->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_product_price">
<span<?php echo $payment_list->product_price->viewAttributes() ?>><?php echo $payment_list->product_price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list->total_price->Visible) { // total_price ?>
		<td data-name="total_price" <?php echo $payment_list->total_price->cellAttributes() ?>>
<span id="el<?php echo $payment_list->RowCount ?>_payment_total_price">
<span<?php echo $payment_list->total_price->viewAttributes() ?>><?php echo $payment_list->total_price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payment_list->ListOptions->render("body", "right", $payment_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$payment_list->isGridAdd())
		$payment_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$payment->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payment_list->Recordset)
	$payment_list->Recordset->Close();
?>
<?php if (!$payment_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$payment_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payment_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payment_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payment_list->TotalRecords == 0 && !$payment->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payment_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$payment_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payment_list->isExport()) { ?>
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
$payment_list->terminate();
?>