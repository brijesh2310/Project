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
$product_edit = new product_edit();

// Run the page
$product_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproductedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproductedit = currentForm = new ew.Form("fproductedit", "edit");

	// Validate form
	fproductedit.validate = function() {
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
			<?php if ($product_edit->product_id->Required) { ?>
				elm = this.getElements("x" + infix + "_product_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->product_id->caption(), $product_edit->product_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_edit->product_code->Required) { ?>
				elm = this.getElements("x" + infix + "_product_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->product_code->caption(), $product_edit->product_code->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_edit->product_name->Required) { ?>
				elm = this.getElements("x" + infix + "_product_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->product_name->caption(), $product_edit->product_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_edit->product_price->Required) { ?>
				elm = this.getElements("x" + infix + "_product_price");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->product_price->caption(), $product_edit->product_price->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_product_price");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($product_edit->product_price->errorMessage()) ?>");
			<?php if ($product_edit->product_img->Required) { ?>
				elm = this.getElements("x" + infix + "_product_img");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->product_img->caption(), $product_edit->product_img->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_edit->product_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_product_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->product_desc->caption(), $product_edit->product_desc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_edit->subcategory_name->Required) { ?>
				elm = this.getElements("x" + infix + "_subcategory_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->subcategory_name->caption(), $product_edit->subcategory_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($product_edit->category_name->Required) { ?>
				elm = this.getElements("x" + infix + "_category_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $product_edit->category_name->caption(), $product_edit->category_name->RequiredErrorMessage)) ?>");
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
	fproductedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproductedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproductedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $product_edit->showPageHeader(); ?>
<?php
$product_edit->showMessage();
?>
<form name="fproductedit" id="fproductedit" class="<?php echo $product_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$product_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($product_edit->product_id->Visible) { // product_id ?>
	<div id="r_product_id" class="form-group row">
		<label id="elh_product_product_id" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->product_id->caption() ?><?php echo $product_edit->product_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->product_id->cellAttributes() ?>>
<span id="el_product_product_id">
<span<?php echo $product_edit->product_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($product_edit->product_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="product" data-field="x_product_id" name="x_product_id" id="x_product_id" value="<?php echo HtmlEncode($product_edit->product_id->CurrentValue) ?>">
<?php echo $product_edit->product_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->product_code->Visible) { // product_code ?>
	<div id="r_product_code" class="form-group row">
		<label id="elh_product_product_code" for="x_product_code" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->product_code->caption() ?><?php echo $product_edit->product_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->product_code->cellAttributes() ?>>
<span id="el_product_product_code">
<input type="text" data-table="product" data-field="x_product_code" name="x_product_code" id="x_product_code" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($product_edit->product_code->getPlaceHolder()) ?>" value="<?php echo $product_edit->product_code->EditValue ?>"<?php echo $product_edit->product_code->editAttributes() ?>>
</span>
<?php echo $product_edit->product_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->product_name->Visible) { // product_name ?>
	<div id="r_product_name" class="form-group row">
		<label id="elh_product_product_name" for="x_product_name" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->product_name->caption() ?><?php echo $product_edit->product_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->product_name->cellAttributes() ?>>
<span id="el_product_product_name">
<input type="text" data-table="product" data-field="x_product_name" name="x_product_name" id="x_product_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($product_edit->product_name->getPlaceHolder()) ?>" value="<?php echo $product_edit->product_name->EditValue ?>"<?php echo $product_edit->product_name->editAttributes() ?>>
</span>
<?php echo $product_edit->product_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->product_price->Visible) { // product_price ?>
	<div id="r_product_price" class="form-group row">
		<label id="elh_product_product_price" for="x_product_price" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->product_price->caption() ?><?php echo $product_edit->product_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->product_price->cellAttributes() ?>>
<span id="el_product_product_price">
<input type="text" data-table="product" data-field="x_product_price" name="x_product_price" id="x_product_price" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($product_edit->product_price->getPlaceHolder()) ?>" value="<?php echo $product_edit->product_price->EditValue ?>"<?php echo $product_edit->product_price->editAttributes() ?>>
</span>
<?php echo $product_edit->product_price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->product_img->Visible) { // product_img ?>
	<div id="r_product_img" class="form-group row">
		<label id="elh_product_product_img" for="x_product_img" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->product_img->caption() ?><?php echo $product_edit->product_img->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->product_img->cellAttributes() ?>>
<span id="el_product_product_img">
<input type="text" data-table="product" data-field="x_product_img" name="x_product_img" id="x_product_img" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($product_edit->product_img->getPlaceHolder()) ?>" value="<?php echo $product_edit->product_img->EditValue ?>"<?php echo $product_edit->product_img->editAttributes() ?>>
</span>
<?php echo $product_edit->product_img->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->product_desc->Visible) { // product_desc ?>
	<div id="r_product_desc" class="form-group row">
		<label id="elh_product_product_desc" for="x_product_desc" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->product_desc->caption() ?><?php echo $product_edit->product_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->product_desc->cellAttributes() ?>>
<span id="el_product_product_desc">
<input type="text" data-table="product" data-field="x_product_desc" name="x_product_desc" id="x_product_desc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($product_edit->product_desc->getPlaceHolder()) ?>" value="<?php echo $product_edit->product_desc->EditValue ?>"<?php echo $product_edit->product_desc->editAttributes() ?>>
</span>
<?php echo $product_edit->product_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->subcategory_name->Visible) { // subcategory_name ?>
	<div id="r_subcategory_name" class="form-group row">
		<label id="elh_product_subcategory_name" for="x_subcategory_name" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->subcategory_name->caption() ?><?php echo $product_edit->subcategory_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->subcategory_name->cellAttributes() ?>>
<span id="el_product_subcategory_name">
<input type="text" data-table="product" data-field="x_subcategory_name" name="x_subcategory_name" id="x_subcategory_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($product_edit->subcategory_name->getPlaceHolder()) ?>" value="<?php echo $product_edit->subcategory_name->EditValue ?>"<?php echo $product_edit->subcategory_name->editAttributes() ?>>
</span>
<?php echo $product_edit->subcategory_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($product_edit->category_name->Visible) { // category_name ?>
	<div id="r_category_name" class="form-group row">
		<label id="elh_product_category_name" for="x_category_name" class="<?php echo $product_edit->LeftColumnClass ?>"><?php echo $product_edit->category_name->caption() ?><?php echo $product_edit->category_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $product_edit->RightColumnClass ?>"><div <?php echo $product_edit->category_name->cellAttributes() ?>>
<span id="el_product_category_name">
<input type="text" data-table="product" data-field="x_category_name" name="x_category_name" id="x_category_name" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($product_edit->category_name->getPlaceHolder()) ?>" value="<?php echo $product_edit->category_name->EditValue ?>"<?php echo $product_edit->category_name->editAttributes() ?>>
</span>
<?php echo $product_edit->category_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$product_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $product_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $product_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$product_edit->showPageFooter();
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
$product_edit->terminate();
?>