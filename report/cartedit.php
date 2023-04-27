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
$cart_edit = new cart_edit();

// Run the page
$cart_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cart_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcartedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcartedit = currentForm = new ew.Form("fcartedit", "edit");

	// Validate form
	fcartedit.validate = function() {
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
			<?php if ($cart_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cart_edit->id->caption(), $cart_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cart_edit->product_id->Required) { ?>
				elm = this.getElements("x" + infix + "_product_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cart_edit->product_id->caption(), $cart_edit->product_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_product_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cart_edit->product_id->errorMessage()) ?>");
			<?php if ($cart_edit->quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cart_edit->quantity->caption(), $cart_edit->quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cart_edit->quantity->errorMessage()) ?>");

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
	fcartedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcartedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcartedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cart_edit->showPageHeader(); ?>
<?php
$cart_edit->showMessage();
?>
<form name="fcartedit" id="fcartedit" class="<?php echo $cart_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cart">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$cart_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($cart_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_cart_id" class="<?php echo $cart_edit->LeftColumnClass ?>"><?php echo $cart_edit->id->caption() ?><?php echo $cart_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cart_edit->RightColumnClass ?>"><div <?php echo $cart_edit->id->cellAttributes() ?>>
<span id="el_cart_id">
<span<?php echo $cart_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cart_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cart" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($cart_edit->id->CurrentValue) ?>">
<?php echo $cart_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cart_edit->product_id->Visible) { // product_id ?>
	<div id="r_product_id" class="form-group row">
		<label id="elh_cart_product_id" for="x_product_id" class="<?php echo $cart_edit->LeftColumnClass ?>"><?php echo $cart_edit->product_id->caption() ?><?php echo $cart_edit->product_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cart_edit->RightColumnClass ?>"><div <?php echo $cart_edit->product_id->cellAttributes() ?>>
<span id="el_cart_product_id">
<input type="text" data-table="cart" data-field="x_product_id" name="x_product_id" id="x_product_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($cart_edit->product_id->getPlaceHolder()) ?>" value="<?php echo $cart_edit->product_id->EditValue ?>"<?php echo $cart_edit->product_id->editAttributes() ?>>
</span>
<?php echo $cart_edit->product_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cart_edit->quantity->Visible) { // quantity ?>
	<div id="r_quantity" class="form-group row">
		<label id="elh_cart_quantity" for="x_quantity" class="<?php echo $cart_edit->LeftColumnClass ?>"><?php echo $cart_edit->quantity->caption() ?><?php echo $cart_edit->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cart_edit->RightColumnClass ?>"><div <?php echo $cart_edit->quantity->cellAttributes() ?>>
<span id="el_cart_quantity">
<input type="text" data-table="cart" data-field="x_quantity" name="x_quantity" id="x_quantity" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($cart_edit->quantity->getPlaceHolder()) ?>" value="<?php echo $cart_edit->quantity->EditValue ?>"<?php echo $cart_edit->quantity->editAttributes() ?>>
</span>
<?php echo $cart_edit->quantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cart_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cart_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cart_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cart_edit->showPageFooter();
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
$cart_edit->terminate();
?>