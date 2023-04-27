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
$cart_add = new cart_add();

// Run the page
$cart_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cart_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcartadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcartadd = currentForm = new ew.Form("fcartadd", "add");

	// Validate form
	fcartadd.validate = function() {
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
			<?php if ($cart_add->product_id->Required) { ?>
				elm = this.getElements("x" + infix + "_product_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cart_add->product_id->caption(), $cart_add->product_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_product_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cart_add->product_id->errorMessage()) ?>");
			<?php if ($cart_add->quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cart_add->quantity->caption(), $cart_add->quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cart_add->quantity->errorMessage()) ?>");

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
	fcartadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcartadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcartadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cart_add->showPageHeader(); ?>
<?php
$cart_add->showMessage();
?>
<form name="fcartadd" id="fcartadd" class="<?php echo $cart_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cart">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$cart_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($cart_add->product_id->Visible) { // product_id ?>
	<div id="r_product_id" class="form-group row">
		<label id="elh_cart_product_id" for="x_product_id" class="<?php echo $cart_add->LeftColumnClass ?>"><?php echo $cart_add->product_id->caption() ?><?php echo $cart_add->product_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cart_add->RightColumnClass ?>"><div <?php echo $cart_add->product_id->cellAttributes() ?>>
<span id="el_cart_product_id">
<input type="text" data-table="cart" data-field="x_product_id" name="x_product_id" id="x_product_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($cart_add->product_id->getPlaceHolder()) ?>" value="<?php echo $cart_add->product_id->EditValue ?>"<?php echo $cart_add->product_id->editAttributes() ?>>
</span>
<?php echo $cart_add->product_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cart_add->quantity->Visible) { // quantity ?>
	<div id="r_quantity" class="form-group row">
		<label id="elh_cart_quantity" for="x_quantity" class="<?php echo $cart_add->LeftColumnClass ?>"><?php echo $cart_add->quantity->caption() ?><?php echo $cart_add->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cart_add->RightColumnClass ?>"><div <?php echo $cart_add->quantity->cellAttributes() ?>>
<span id="el_cart_quantity">
<input type="text" data-table="cart" data-field="x_quantity" name="x_quantity" id="x_quantity" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($cart_add->quantity->getPlaceHolder()) ?>" value="<?php echo $cart_add->quantity->EditValue ?>"<?php echo $cart_add->quantity->editAttributes() ?>>
</span>
<?php echo $cart_add->quantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cart_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cart_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cart_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cart_add->showPageFooter();
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
$cart_add->terminate();
?>