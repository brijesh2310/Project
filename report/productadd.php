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
$product_add = new product_add();

// Run the page
$product_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproductadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproductadd = currentForm = new ew.Form("fproductadd", "add");

	// Validate form
	fproductadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($product_add->product_code->Required) { ?>
				elm = this.getElements("x" + infix + "_product_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_add->product_code->caption(), $product_add->product_code->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_add->product_name->Required) { ?>
				elm = this.getElements("x" + infix + "_product_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_add->product_name->caption(), $product_add->product_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_add->product_price->Required) { ?>
				elm = this.getElements("x" + infix + "_product_price");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_add->product_price->caption(), $product_add->product_price->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_product_price");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($product_add->product_price->errorMessage()) ?>");
			<?php if ($product_add->product_img->Required) { ?>
				elm = this.getElements("x" + infix + "_product_img");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_add->product_img->caption(), $product_add->product_img->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_add->product_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_product_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_add->product_desc->caption(), $product_add->product_desc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_add->subcategory_name->Required) { ?>
				elm = this.getElements("x" + infix + "_subcategory_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_add->subcategory_name->caption(), $product_add->subcategory_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_add->category_name->Required) { ?>
				elm = this.getElements("x" + infix + "_category_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_add->category_name->caption(), $product_add->category_name->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fproductadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproductadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproductadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $product_add->showPageHeader(); ?>
<?php
$product_add->showMessage();
?>
<form name="fproductadd" id="fproductadd" class="<?php echo $product_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$product_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($product_add->product_code->Visible) { // product_code ?>
	<div id="r_product_code" class="form-group row">
		<label id="elh_product_product_code" for="x_product_code" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->product_code->caption() ?><?php echo $product_add->product_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->product_code->cellAttributes() ?>>
<span id="el_product_product_code">
<input type="text" data-table="product" data-field="x_product_code" name="x_product_code" id="x_product_code" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($product_add->product_code->getPlaceHolder()) ?>" value="<?php echo $product_add->product_code->EditValue ?>"<?php echo $product_add->product_code->editAttributes() ?>>
</span>
<?php echo $product_add->product_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_add->product_name->Visible) { // product_name ?>
	<div id="r_product_name" class="form-group row">
		<label id="elh_product_product_name" for="x_product_name" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->product_name->caption() ?><?php echo $product_add->product_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->product_name->cellAttributes() ?>>
<span id="el_product_product_name">
<input type="text" data-table="product" data-field="x_product_name" name="x_product_name" id="x_product_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($product_add->product_name->getPlaceHolder()) ?>" value="<?php echo $product_add->product_name->EditValue ?>"<?php echo $product_add->product_name->editAttributes() ?>>
</span>
<?php echo $product_add->product_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_add->product_price->Visible) { // product_price ?>
	<div id="r_product_price" class="form-group row">
		<label id="elh_product_product_price" for="x_product_price" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->product_price->caption() ?><?php echo $product_add->product_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->product_price->cellAttributes() ?>>
<span id="el_product_product_price">
<input type="text" data-table="product" data-field="x_product_price" name="x_product_price" id="x_product_price" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($product_add->product_price->getPlaceHolder()) ?>" value="<?php echo $product_add->product_price->EditValue ?>"<?php echo $product_add->product_price->editAttributes() ?>>
</span>
<?php echo $product_add->product_price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_add->product_img->Visible) { // product_img ?>
	<div id="r_product_img" class="form-group row">
		<label id="elh_product_product_img" for="x_product_img" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->product_img->caption() ?><?php echo $product_add->product_img->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->product_img->cellAttributes() ?>>
<span id="el_product_product_img">
<input type="text" data-table="product" data-field="x_product_img" name="x_product_img" id="x_product_img" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($product_add->product_img->getPlaceHolder()) ?>" value="<?php echo $product_add->product_img->EditValue ?>"<?php echo $product_add->product_img->editAttributes() ?>>
</span>
<?php echo $product_add->product_img->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_add->product_desc->Visible) { // product_desc ?>
	<div id="r_product_desc" class="form-group row">
		<label id="elh_product_product_desc" for="x_product_desc" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->product_desc->caption() ?><?php echo $product_add->product_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->product_desc->cellAttributes() ?>>
<span id="el_product_product_desc">
<input type="text" data-table="product" data-field="x_product_desc" name="x_product_desc" id="x_product_desc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($product_add->product_desc->getPlaceHolder()) ?>" value="<?php echo $product_add->product_desc->EditValue ?>"<?php echo $product_add->product_desc->editAttributes() ?>>
</span>
<?php echo $product_add->product_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_add->subcategory_name->Visible) { // subcategory_name ?>
	<div id="r_subcategory_name" class="form-group row">
		<label id="elh_product_subcategory_name" for="x_subcategory_name" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->subcategory_name->caption() ?><?php echo $product_add->subcategory_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->subcategory_name->cellAttributes() ?>>
<span id="el_product_subcategory_name">
<input type="text" data-table="product" data-field="x_subcategory_name" name="x_subcategory_name" id="x_subcategory_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($product_add->subcategory_name->getPlaceHolder()) ?>" value="<?php echo $product_add->subcategory_name->EditValue ?>"<?php echo $product_add->subcategory_name->editAttributes() ?>>
</span>
<?php echo $product_add->subcategory_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_add->category_name->Visible) { // category_name ?>
	<div id="r_category_name" class="form-group row">
		<label id="elh_product_category_name" for="x_category_name" class="<?php echo $product_add->LeftColumnClass ?>"><?php echo $product_add->category_name->caption() ?><?php echo $product_add->category_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_add->RightColumnClass ?>"><div <?php echo $product_add->category_name->cellAttributes() ?>>
<span id="el_product_category_name">
<input type="text" data-table="product" data-field="x_category_name" name="x_category_name" id="x_category_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($product_add->category_name->getPlaceHolder()) ?>" value="<?php echo $product_add->category_name->EditValue ?>"<?php echo $product_add->category_name->editAttributes() ?>>
</span>
<?php echo $product_add->category_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$product_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $product_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $product_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$product_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$product_add->terminate();
?>