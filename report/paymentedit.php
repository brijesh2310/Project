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
$payment_edit = new payment_edit();

// Run the page
$payment_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payment_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpaymentedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpaymentedit = currentForm = new ew.Form("fpaymentedit", "edit");

	// Validate form
	fpaymentedit.validate = function() {
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
			<?php if ($payment_edit->a_id->Required) { ?>
				elm = this.getElements("x" + infix + "_a_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->a_id->caption(), $payment_edit->a_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_edit->o_id->Required) { ?>
				elm = this.getElements("x" + infix + "_o_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->o_id->caption(), $payment_edit->o_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->name->caption(), $payment_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->_email->caption(), $payment_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_edit->mobile_no->Required) { ?>
				elm = this.getElements("x" + infix + "_mobile_no");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->mobile_no->caption(), $payment_edit->mobile_no->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_mobile_no");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payment_edit->mobile_no->errorMessage()) ?>");
			<?php if ($payment_edit->billing_address->Required) { ?>
				elm = this.getElements("x" + infix + "_billing_address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->billing_address->caption(), $payment_edit->billing_address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_edit->shipping_address->Required) { ?>
				elm = this.getElements("x" + infix + "_shipping_address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->shipping_address->caption(), $payment_edit->shipping_address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_edit->city->Required) { ?>
				elm = this.getElements("x" + infix + "_city");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->city->caption(), $payment_edit->city->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_edit->state->Required) { ?>
				elm = this.getElements("x" + infix + "_state");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->state->caption(), $payment_edit->state->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_edit->pincode->Required) { ?>
				elm = this.getElements("x" + infix + "_pincode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->pincode->caption(), $payment_edit->pincode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pincode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payment_edit->pincode->errorMessage()) ?>");
			<?php if ($payment_edit->payment_method->Required) { ?>
				elm = this.getElements("x" + infix + "_payment_method");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->payment_method->caption(), $payment_edit->payment_method->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_edit->card_no->Required) { ?>
				elm = this.getElements("x" + infix + "_card_no");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->card_no->caption(), $payment_edit->card_no->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_card_no");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payment_edit->card_no->errorMessage()) ?>");
			<?php if ($payment_edit->expiry_date->Required) { ?>
				elm = this.getElements("x" + infix + "_expiry_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->expiry_date->caption(), $payment_edit->expiry_date->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_edit->order_date->Required) { ?>
				elm = this.getElements("x" + infix + "_order_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->order_date->caption(), $payment_edit->order_date->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_edit->product_name->Required) { ?>
				elm = this.getElements("x" + infix + "_product_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->product_name->caption(), $payment_edit->product_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_edit->product_quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_product_quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->product_quantity->caption(), $payment_edit->product_quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_product_quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payment_edit->product_quantity->errorMessage()) ?>");
			<?php if ($payment_edit->product_price->Required) { ?>
				elm = this.getElements("x" + infix + "_product_price");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->product_price->caption(), $payment_edit->product_price->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_product_price");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payment_edit->product_price->errorMessage()) ?>");
			<?php if ($payment_edit->total_price->Required) { ?>
				elm = this.getElements("x" + infix + "_total_price");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_edit->total_price->caption(), $payment_edit->total_price->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_price");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payment_edit->total_price->errorMessage()) ?>");

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
	fpaymentedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpaymentedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpaymentedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payment_edit->showPageHeader(); ?>
<?php
$payment_edit->showMessage();
?>
<form name="fpaymentedit" id="fpaymentedit" class="<?php echo $payment_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payment">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$payment_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($payment_edit->a_id->Visible) { // a_id ?>
	<div id="r_a_id" class="form-group row">
		<label id="elh_payment_a_id" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->a_id->caption() ?><?php echo $payment_edit->a_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->a_id->cellAttributes() ?>>
<span id="el_payment_a_id">
<span<?php echo $payment_edit->a_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payment_edit->a_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="payment" data-field="x_a_id" name="x_a_id" id="x_a_id" value="<?php echo HtmlEncode($payment_edit->a_id->CurrentValue) ?>">
<?php echo $payment_edit->a_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->o_id->Visible) { // o_id ?>
	<div id="r_o_id" class="form-group row">
		<label id="elh_payment_o_id" for="x_o_id" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->o_id->caption() ?><?php echo $payment_edit->o_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->o_id->cellAttributes() ?>>
<span id="el_payment_o_id">
<input type="text" data-table="payment" data-field="x_o_id" name="x_o_id" id="x_o_id" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($payment_edit->o_id->getPlaceHolder()) ?>" value="<?php echo $payment_edit->o_id->EditValue ?>"<?php echo $payment_edit->o_id->editAttributes() ?>>
</span>
<?php echo $payment_edit->o_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_payment_name" for="x_name" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->name->caption() ?><?php echo $payment_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->name->cellAttributes() ?>>
<span id="el_payment_name">
<input type="text" data-table="payment" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payment_edit->name->getPlaceHolder()) ?>" value="<?php echo $payment_edit->name->EditValue ?>"<?php echo $payment_edit->name->editAttributes() ?>>
</span>
<?php echo $payment_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_payment__email" for="x__email" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->_email->caption() ?><?php echo $payment_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->_email->cellAttributes() ?>>
<span id="el_payment__email">
<input type="text" data-table="payment" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payment_edit->_email->getPlaceHolder()) ?>" value="<?php echo $payment_edit->_email->EditValue ?>"<?php echo $payment_edit->_email->editAttributes() ?>>
</span>
<?php echo $payment_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->mobile_no->Visible) { // mobile_no ?>
	<div id="r_mobile_no" class="form-group row">
		<label id="elh_payment_mobile_no" for="x_mobile_no" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->mobile_no->caption() ?><?php echo $payment_edit->mobile_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->mobile_no->cellAttributes() ?>>
<span id="el_payment_mobile_no">
<input type="text" data-table="payment" data-field="x_mobile_no" name="x_mobile_no" id="x_mobile_no" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($payment_edit->mobile_no->getPlaceHolder()) ?>" value="<?php echo $payment_edit->mobile_no->EditValue ?>"<?php echo $payment_edit->mobile_no->editAttributes() ?>>
</span>
<?php echo $payment_edit->mobile_no->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->billing_address->Visible) { // billing_address ?>
	<div id="r_billing_address" class="form-group row">
		<label id="elh_payment_billing_address" for="x_billing_address" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->billing_address->caption() ?><?php echo $payment_edit->billing_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->billing_address->cellAttributes() ?>>
<span id="el_payment_billing_address">
<input type="text" data-table="payment" data-field="x_billing_address" name="x_billing_address" id="x_billing_address" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($payment_edit->billing_address->getPlaceHolder()) ?>" value="<?php echo $payment_edit->billing_address->EditValue ?>"<?php echo $payment_edit->billing_address->editAttributes() ?>>
</span>
<?php echo $payment_edit->billing_address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->shipping_address->Visible) { // shipping_address ?>
	<div id="r_shipping_address" class="form-group row">
		<label id="elh_payment_shipping_address" for="x_shipping_address" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->shipping_address->caption() ?><?php echo $payment_edit->shipping_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->shipping_address->cellAttributes() ?>>
<span id="el_payment_shipping_address">
<input type="text" data-table="payment" data-field="x_shipping_address" name="x_shipping_address" id="x_shipping_address" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($payment_edit->shipping_address->getPlaceHolder()) ?>" value="<?php echo $payment_edit->shipping_address->EditValue ?>"<?php echo $payment_edit->shipping_address->editAttributes() ?>>
</span>
<?php echo $payment_edit->shipping_address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->city->Visible) { // city ?>
	<div id="r_city" class="form-group row">
		<label id="elh_payment_city" for="x_city" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->city->caption() ?><?php echo $payment_edit->city->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->city->cellAttributes() ?>>
<span id="el_payment_city">
<input type="text" data-table="payment" data-field="x_city" name="x_city" id="x_city" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($payment_edit->city->getPlaceHolder()) ?>" value="<?php echo $payment_edit->city->EditValue ?>"<?php echo $payment_edit->city->editAttributes() ?>>
</span>
<?php echo $payment_edit->city->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->state->Visible) { // state ?>
	<div id="r_state" class="form-group row">
		<label id="elh_payment_state" for="x_state" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->state->caption() ?><?php echo $payment_edit->state->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->state->cellAttributes() ?>>
<span id="el_payment_state">
<input type="text" data-table="payment" data-field="x_state" name="x_state" id="x_state" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($payment_edit->state->getPlaceHolder()) ?>" value="<?php echo $payment_edit->state->EditValue ?>"<?php echo $payment_edit->state->editAttributes() ?>>
</span>
<?php echo $payment_edit->state->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->pincode->Visible) { // pincode ?>
	<div id="r_pincode" class="form-group row">
		<label id="elh_payment_pincode" for="x_pincode" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->pincode->caption() ?><?php echo $payment_edit->pincode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->pincode->cellAttributes() ?>>
<span id="el_payment_pincode">
<input type="text" data-table="payment" data-field="x_pincode" name="x_pincode" id="x_pincode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($payment_edit->pincode->getPlaceHolder()) ?>" value="<?php echo $payment_edit->pincode->EditValue ?>"<?php echo $payment_edit->pincode->editAttributes() ?>>
</span>
<?php echo $payment_edit->pincode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->payment_method->Visible) { // payment_method ?>
	<div id="r_payment_method" class="form-group row">
		<label id="elh_payment_payment_method" for="x_payment_method" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->payment_method->caption() ?><?php echo $payment_edit->payment_method->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->payment_method->cellAttributes() ?>>
<span id="el_payment_payment_method">
<input type="text" data-table="payment" data-field="x_payment_method" name="x_payment_method" id="x_payment_method" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($payment_edit->payment_method->getPlaceHolder()) ?>" value="<?php echo $payment_edit->payment_method->EditValue ?>"<?php echo $payment_edit->payment_method->editAttributes() ?>>
</span>
<?php echo $payment_edit->payment_method->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->card_no->Visible) { // card_no ?>
	<div id="r_card_no" class="form-group row">
		<label id="elh_payment_card_no" for="x_card_no" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->card_no->caption() ?><?php echo $payment_edit->card_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->card_no->cellAttributes() ?>>
<span id="el_payment_card_no">
<input type="text" data-table="payment" data-field="x_card_no" name="x_card_no" id="x_card_no" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($payment_edit->card_no->getPlaceHolder()) ?>" value="<?php echo $payment_edit->card_no->EditValue ?>"<?php echo $payment_edit->card_no->editAttributes() ?>>
</span>
<?php echo $payment_edit->card_no->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->expiry_date->Visible) { // expiry_date ?>
	<div id="r_expiry_date" class="form-group row">
		<label id="elh_payment_expiry_date" for="x_expiry_date" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->expiry_date->caption() ?><?php echo $payment_edit->expiry_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->expiry_date->cellAttributes() ?>>
<span id="el_payment_expiry_date">
<input type="text" data-table="payment" data-field="x_expiry_date" name="x_expiry_date" id="x_expiry_date" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($payment_edit->expiry_date->getPlaceHolder()) ?>" value="<?php echo $payment_edit->expiry_date->EditValue ?>"<?php echo $payment_edit->expiry_date->editAttributes() ?>>
</span>
<?php echo $payment_edit->expiry_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->order_date->Visible) { // order_date ?>
	<div id="r_order_date" class="form-group row">
		<label id="elh_payment_order_date" for="x_order_date" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->order_date->caption() ?><?php echo $payment_edit->order_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->order_date->cellAttributes() ?>>
<span id="el_payment_order_date">
<input type="text" data-table="payment" data-field="x_order_date" name="x_order_date" id="x_order_date" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($payment_edit->order_date->getPlaceHolder()) ?>" value="<?php echo $payment_edit->order_date->EditValue ?>"<?php echo $payment_edit->order_date->editAttributes() ?>>
</span>
<?php echo $payment_edit->order_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->product_name->Visible) { // product_name ?>
	<div id="r_product_name" class="form-group row">
		<label id="elh_payment_product_name" for="x_product_name" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->product_name->caption() ?><?php echo $payment_edit->product_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->product_name->cellAttributes() ?>>
<span id="el_payment_product_name">
<input type="text" data-table="payment" data-field="x_product_name" name="x_product_name" id="x_product_name" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($payment_edit->product_name->getPlaceHolder()) ?>" value="<?php echo $payment_edit->product_name->EditValue ?>"<?php echo $payment_edit->product_name->editAttributes() ?>>
</span>
<?php echo $payment_edit->product_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->product_quantity->Visible) { // product_quantity ?>
	<div id="r_product_quantity" class="form-group row">
		<label id="elh_payment_product_quantity" for="x_product_quantity" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->product_quantity->caption() ?><?php echo $payment_edit->product_quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->product_quantity->cellAttributes() ?>>
<span id="el_payment_product_quantity">
<input type="text" data-table="payment" data-field="x_product_quantity" name="x_product_quantity" id="x_product_quantity" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($payment_edit->product_quantity->getPlaceHolder()) ?>" value="<?php echo $payment_edit->product_quantity->EditValue ?>"<?php echo $payment_edit->product_quantity->editAttributes() ?>>
</span>
<?php echo $payment_edit->product_quantity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->product_price->Visible) { // product_price ?>
	<div id="r_product_price" class="form-group row">
		<label id="elh_payment_product_price" for="x_product_price" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->product_price->caption() ?><?php echo $payment_edit->product_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->product_price->cellAttributes() ?>>
<span id="el_payment_product_price">
<input type="text" data-table="payment" data-field="x_product_price" name="x_product_price" id="x_product_price" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($payment_edit->product_price->getPlaceHolder()) ?>" value="<?php echo $payment_edit->product_price->EditValue ?>"<?php echo $payment_edit->product_price->editAttributes() ?>>
</span>
<?php echo $payment_edit->product_price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_edit->total_price->Visible) { // total_price ?>
	<div id="r_total_price" class="form-group row">
		<label id="elh_payment_total_price" for="x_total_price" class="<?php echo $payment_edit->LeftColumnClass ?>"><?php echo $payment_edit->total_price->caption() ?><?php echo $payment_edit->total_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_edit->RightColumnClass ?>"><div <?php echo $payment_edit->total_price->cellAttributes() ?>>
<span id="el_payment_total_price">
<input type="text" data-table="payment" data-field="x_total_price" name="x_total_price" id="x_total_price" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($payment_edit->total_price->getPlaceHolder()) ?>" value="<?php echo $payment_edit->total_price->EditValue ?>"<?php echo $payment_edit->total_price->editAttributes() ?>>
</span>
<?php echo $payment_edit->total_price->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$payment_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payment_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payment_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$payment_edit->showPageFooter();
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
$payment_edit->terminate();
?>