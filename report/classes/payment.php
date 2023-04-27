<?php namespace PHPMaker2020\project1; ?>
<?php

/**
 * Table class for payment
 */
class payment extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $a_id;
	public $o_id;
	public $name;
	public $_email;
	public $mobile_no;
	public $billing_address;
	public $shipping_address;
	public $city;
	public $state;
	public $pincode;
	public $payment_method;
	public $card_no;
	public $expiry_date;
	public $order_date;
	public $product_name;
	public $product_quantity;
	public $product_price;
	public $total_price;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'payment';
		$this->TableName = 'payment';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`payment`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// a_id
		$this->a_id = new DbField('payment', 'payment', 'x_a_id', 'a_id', '`a_id`', '`a_id`', 3, 11, -1, FALSE, '`a_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->a_id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->a_id->IsPrimaryKey = TRUE; // Primary key field
		$this->a_id->Sortable = TRUE; // Allow sort
		$this->a_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['a_id'] = &$this->a_id;

		// o_id
		$this->o_id = new DbField('payment', 'payment', 'x_o_id', 'o_id', '`o_id`', '`o_id`', 200, 50, -1, FALSE, '`o_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->o_id->Nullable = FALSE; // NOT NULL field
		$this->o_id->Required = TRUE; // Required field
		$this->o_id->Sortable = TRUE; // Allow sort
		$this->fields['o_id'] = &$this->o_id;

		// name
		$this->name = new DbField('payment', 'payment', 'x_name', 'name', '`name`', '`name`', 200, 100, -1, FALSE, '`name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->name->Nullable = FALSE; // NOT NULL field
		$this->name->Required = TRUE; // Required field
		$this->name->Sortable = TRUE; // Allow sort
		$this->fields['name'] = &$this->name;

		// email
		$this->_email = new DbField('payment', 'payment', 'x__email', 'email', '`email`', '`email`', 200, 100, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Nullable = FALSE; // NOT NULL field
		$this->_email->Required = TRUE; // Required field
		$this->_email->Sortable = TRUE; // Allow sort
		$this->fields['email'] = &$this->_email;

		// mobile_no
		$this->mobile_no = new DbField('payment', 'payment', 'x_mobile_no', 'mobile_no', '`mobile_no`', '`mobile_no`', 3, 10, -1, FALSE, '`mobile_no`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->mobile_no->Nullable = FALSE; // NOT NULL field
		$this->mobile_no->Required = TRUE; // Required field
		$this->mobile_no->Sortable = TRUE; // Allow sort
		$this->mobile_no->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['mobile_no'] = &$this->mobile_no;

		// billing_address
		$this->billing_address = new DbField('payment', 'payment', 'x_billing_address', 'billing_address', '`billing_address`', '`billing_address`', 200, 200, -1, FALSE, '`billing_address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->billing_address->Nullable = FALSE; // NOT NULL field
		$this->billing_address->Required = TRUE; // Required field
		$this->billing_address->Sortable = TRUE; // Allow sort
		$this->fields['billing_address'] = &$this->billing_address;

		// shipping_address
		$this->shipping_address = new DbField('payment', 'payment', 'x_shipping_address', 'shipping_address', '`shipping_address`', '`shipping_address`', 200, 200, -1, FALSE, '`shipping_address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->shipping_address->Nullable = FALSE; // NOT NULL field
		$this->shipping_address->Required = TRUE; // Required field
		$this->shipping_address->Sortable = TRUE; // Allow sort
		$this->fields['shipping_address'] = &$this->shipping_address;

		// city
		$this->city = new DbField('payment', 'payment', 'x_city', 'city', '`city`', '`city`', 200, 50, -1, FALSE, '`city`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->city->Nullable = FALSE; // NOT NULL field
		$this->city->Required = TRUE; // Required field
		$this->city->Sortable = TRUE; // Allow sort
		$this->fields['city'] = &$this->city;

		// state
		$this->state = new DbField('payment', 'payment', 'x_state', 'state', '`state`', '`state`', 200, 50, -1, FALSE, '`state`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->state->Nullable = FALSE; // NOT NULL field
		$this->state->Required = TRUE; // Required field
		$this->state->Sortable = TRUE; // Allow sort
		$this->fields['state'] = &$this->state;

		// pincode
		$this->pincode = new DbField('payment', 'payment', 'x_pincode', 'pincode', '`pincode`', '`pincode`', 3, 10, -1, FALSE, '`pincode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pincode->Nullable = FALSE; // NOT NULL field
		$this->pincode->Required = TRUE; // Required field
		$this->pincode->Sortable = TRUE; // Allow sort
		$this->pincode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pincode'] = &$this->pincode;

		// payment_method
		$this->payment_method = new DbField('payment', 'payment', 'x_payment_method', 'payment_method', '`payment_method`', '`payment_method`', 200, 50, -1, FALSE, '`payment_method`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->payment_method->Nullable = FALSE; // NOT NULL field
		$this->payment_method->Required = TRUE; // Required field
		$this->payment_method->Sortable = TRUE; // Allow sort
		$this->fields['payment_method'] = &$this->payment_method;

		// card_no
		$this->card_no = new DbField('payment', 'payment', 'x_card_no', 'card_no', '`card_no`', '`card_no`', 3, 20, -1, FALSE, '`card_no`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->card_no->Nullable = FALSE; // NOT NULL field
		$this->card_no->Required = TRUE; // Required field
		$this->card_no->Sortable = TRUE; // Allow sort
		$this->card_no->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['card_no'] = &$this->card_no;

		// expiry_date
		$this->expiry_date = new DbField('payment', 'payment', 'x_expiry_date', 'expiry_date', '`expiry_date`', '`expiry_date`', 200, 20, -1, FALSE, '`expiry_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->expiry_date->Nullable = FALSE; // NOT NULL field
		$this->expiry_date->Required = TRUE; // Required field
		$this->expiry_date->Sortable = TRUE; // Allow sort
		$this->fields['expiry_date'] = &$this->expiry_date;

		// order_date
		$this->order_date = new DbField('payment', 'payment', 'x_order_date', 'order_date', '`order_date`', '`order_date`', 200, 10, -1, FALSE, '`order_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->order_date->Nullable = FALSE; // NOT NULL field
		$this->order_date->Required = TRUE; // Required field
		$this->order_date->Sortable = TRUE; // Allow sort
		$this->fields['order_date'] = &$this->order_date;

		// product_name
		$this->product_name = new DbField('payment', 'payment', 'x_product_name', 'product_name', '`product_name`', '`product_name`', 200, 150, -1, FALSE, '`product_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->product_name->Nullable = FALSE; // NOT NULL field
		$this->product_name->Required = TRUE; // Required field
		$this->product_name->Sortable = TRUE; // Allow sort
		$this->fields['product_name'] = &$this->product_name;

		// product_quantity
		$this->product_quantity = new DbField('payment', 'payment', 'x_product_quantity', 'product_quantity', '`product_quantity`', '`product_quantity`', 3, 200, -1, FALSE, '`product_quantity`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->product_quantity->Nullable = FALSE; // NOT NULL field
		$this->product_quantity->Required = TRUE; // Required field
		$this->product_quantity->Sortable = TRUE; // Allow sort
		$this->product_quantity->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['product_quantity'] = &$this->product_quantity;

		// product_price
		$this->product_price = new DbField('payment', 'payment', 'x_product_price', 'product_price', '`product_price`', '`product_price`', 3, 20, -1, FALSE, '`product_price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->product_price->Nullable = FALSE; // NOT NULL field
		$this->product_price->Required = TRUE; // Required field
		$this->product_price->Sortable = TRUE; // Allow sort
		$this->product_price->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['product_price'] = &$this->product_price;

		// total_price
		$this->total_price = new DbField('payment', 'payment', 'x_total_price', 'total_price', '`total_price`', '`total_price`', 3, 20, -1, FALSE, '`total_price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_price->Nullable = FALSE; // NOT NULL field
		$this->total_price->Required = TRUE; // Required field
		$this->total_price->Sortable = TRUE; // Allow sort
		$this->total_price->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['total_price'] = &$this->total_price;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`payment`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = Config("USER_ID_ALLOW");
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->a_id->setDbValue($conn->insert_ID());
			$rs['a_id'] = $this->a_id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('a_id', $rs))
				AddFilter($where, QuotedName('a_id', $this->Dbid) . '=' . QuotedValue($rs['a_id'], $this->a_id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->a_id->DbValue = $row['a_id'];
		$this->o_id->DbValue = $row['o_id'];
		$this->name->DbValue = $row['name'];
		$this->_email->DbValue = $row['email'];
		$this->mobile_no->DbValue = $row['mobile_no'];
		$this->billing_address->DbValue = $row['billing_address'];
		$this->shipping_address->DbValue = $row['shipping_address'];
		$this->city->DbValue = $row['city'];
		$this->state->DbValue = $row['state'];
		$this->pincode->DbValue = $row['pincode'];
		$this->payment_method->DbValue = $row['payment_method'];
		$this->card_no->DbValue = $row['card_no'];
		$this->expiry_date->DbValue = $row['expiry_date'];
		$this->order_date->DbValue = $row['order_date'];
		$this->product_name->DbValue = $row['product_name'];
		$this->product_quantity->DbValue = $row['product_quantity'];
		$this->product_price->DbValue = $row['product_price'];
		$this->total_price->DbValue = $row['total_price'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`a_id` = @a_id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('a_id', $row) ? $row['a_id'] : NULL;
		else
			$val = $this->a_id->OldValue !== NULL ? $this->a_id->OldValue : $this->a_id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@a_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "paymentlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "paymentview.php")
			return $Language->phrase("View");
		elseif ($pageName == "paymentedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "paymentadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "paymentlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("paymentview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("paymentview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "paymentadd.php?" . $this->getUrlParm($parm);
		else
			$url = "paymentadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("paymentedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("paymentadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("paymentdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "a_id:" . JsonEncode($this->a_id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->a_id->CurrentValue != NULL) {
			$url .= "a_id=" . urlencode($this->a_id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("a_id") !== NULL)
				$arKeys[] = Param("a_id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->a_id->CurrentValue = $key;
			else
				$this->a_id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->a_id->setDbValue($rs->fields('a_id'));
		$this->o_id->setDbValue($rs->fields('o_id'));
		$this->name->setDbValue($rs->fields('name'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->mobile_no->setDbValue($rs->fields('mobile_no'));
		$this->billing_address->setDbValue($rs->fields('billing_address'));
		$this->shipping_address->setDbValue($rs->fields('shipping_address'));
		$this->city->setDbValue($rs->fields('city'));
		$this->state->setDbValue($rs->fields('state'));
		$this->pincode->setDbValue($rs->fields('pincode'));
		$this->payment_method->setDbValue($rs->fields('payment_method'));
		$this->card_no->setDbValue($rs->fields('card_no'));
		$this->expiry_date->setDbValue($rs->fields('expiry_date'));
		$this->order_date->setDbValue($rs->fields('order_date'));
		$this->product_name->setDbValue($rs->fields('product_name'));
		$this->product_quantity->setDbValue($rs->fields('product_quantity'));
		$this->product_price->setDbValue($rs->fields('product_price'));
		$this->total_price->setDbValue($rs->fields('total_price'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// a_id
		// o_id
		// name
		// email
		// mobile_no
		// billing_address
		// shipping_address
		// city
		// state
		// pincode
		// payment_method
		// card_no
		// expiry_date
		// order_date
		// product_name
		// product_quantity
		// product_price
		// total_price
		// a_id

		$this->a_id->ViewValue = $this->a_id->CurrentValue;
		$this->a_id->ViewCustomAttributes = "";

		// o_id
		$this->o_id->ViewValue = $this->o_id->CurrentValue;
		$this->o_id->ViewCustomAttributes = "";

		// name
		$this->name->ViewValue = $this->name->CurrentValue;
		$this->name->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// mobile_no
		$this->mobile_no->ViewValue = $this->mobile_no->CurrentValue;
		$this->mobile_no->ViewValue = FormatNumber($this->mobile_no->ViewValue, 0, -2, -2, -2);
		$this->mobile_no->ViewCustomAttributes = "";

		// billing_address
		$this->billing_address->ViewValue = $this->billing_address->CurrentValue;
		$this->billing_address->ViewCustomAttributes = "";

		// shipping_address
		$this->shipping_address->ViewValue = $this->shipping_address->CurrentValue;
		$this->shipping_address->ViewCustomAttributes = "";

		// city
		$this->city->ViewValue = $this->city->CurrentValue;
		$this->city->ViewCustomAttributes = "";

		// state
		$this->state->ViewValue = $this->state->CurrentValue;
		$this->state->ViewCustomAttributes = "";

		// pincode
		$this->pincode->ViewValue = $this->pincode->CurrentValue;
		$this->pincode->ViewValue = FormatNumber($this->pincode->ViewValue, 0, -2, -2, -2);
		$this->pincode->ViewCustomAttributes = "";

		// payment_method
		$this->payment_method->ViewValue = $this->payment_method->CurrentValue;
		$this->payment_method->ViewCustomAttributes = "";

		// card_no
		$this->card_no->ViewValue = $this->card_no->CurrentValue;
		$this->card_no->ViewValue = FormatNumber($this->card_no->ViewValue, 0, -2, -2, -2);
		$this->card_no->ViewCustomAttributes = "";

		// expiry_date
		$this->expiry_date->ViewValue = $this->expiry_date->CurrentValue;
		$this->expiry_date->ViewCustomAttributes = "";

		// order_date
		$this->order_date->ViewValue = $this->order_date->CurrentValue;
		$this->order_date->ViewCustomAttributes = "";

		// product_name
		$this->product_name->ViewValue = $this->product_name->CurrentValue;
		$this->product_name->ViewCustomAttributes = "";

		// product_quantity
		$this->product_quantity->ViewValue = $this->product_quantity->CurrentValue;
		$this->product_quantity->ViewValue = FormatNumber($this->product_quantity->ViewValue, 0, -2, -2, -2);
		$this->product_quantity->ViewCustomAttributes = "";

		// product_price
		$this->product_price->ViewValue = $this->product_price->CurrentValue;
		$this->product_price->ViewValue = FormatNumber($this->product_price->ViewValue, 0, -2, -2, -2);
		$this->product_price->ViewCustomAttributes = "";

		// total_price
		$this->total_price->ViewValue = $this->total_price->CurrentValue;
		$this->total_price->ViewValue = FormatNumber($this->total_price->ViewValue, 0, -2, -2, -2);
		$this->total_price->ViewCustomAttributes = "";

		// a_id
		$this->a_id->LinkCustomAttributes = "";
		$this->a_id->HrefValue = "";
		$this->a_id->TooltipValue = "";

		// o_id
		$this->o_id->LinkCustomAttributes = "";
		$this->o_id->HrefValue = "";
		$this->o_id->TooltipValue = "";

		// name
		$this->name->LinkCustomAttributes = "";
		$this->name->HrefValue = "";
		$this->name->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// mobile_no
		$this->mobile_no->LinkCustomAttributes = "";
		$this->mobile_no->HrefValue = "";
		$this->mobile_no->TooltipValue = "";

		// billing_address
		$this->billing_address->LinkCustomAttributes = "";
		$this->billing_address->HrefValue = "";
		$this->billing_address->TooltipValue = "";

		// shipping_address
		$this->shipping_address->LinkCustomAttributes = "";
		$this->shipping_address->HrefValue = "";
		$this->shipping_address->TooltipValue = "";

		// city
		$this->city->LinkCustomAttributes = "";
		$this->city->HrefValue = "";
		$this->city->TooltipValue = "";

		// state
		$this->state->LinkCustomAttributes = "";
		$this->state->HrefValue = "";
		$this->state->TooltipValue = "";

		// pincode
		$this->pincode->LinkCustomAttributes = "";
		$this->pincode->HrefValue = "";
		$this->pincode->TooltipValue = "";

		// payment_method
		$this->payment_method->LinkCustomAttributes = "";
		$this->payment_method->HrefValue = "";
		$this->payment_method->TooltipValue = "";

		// card_no
		$this->card_no->LinkCustomAttributes = "";
		$this->card_no->HrefValue = "";
		$this->card_no->TooltipValue = "";

		// expiry_date
		$this->expiry_date->LinkCustomAttributes = "";
		$this->expiry_date->HrefValue = "";
		$this->expiry_date->TooltipValue = "";

		// order_date
		$this->order_date->LinkCustomAttributes = "";
		$this->order_date->HrefValue = "";
		$this->order_date->TooltipValue = "";

		// product_name
		$this->product_name->LinkCustomAttributes = "";
		$this->product_name->HrefValue = "";
		$this->product_name->TooltipValue = "";

		// product_quantity
		$this->product_quantity->LinkCustomAttributes = "";
		$this->product_quantity->HrefValue = "";
		$this->product_quantity->TooltipValue = "";

		// product_price
		$this->product_price->LinkCustomAttributes = "";
		$this->product_price->HrefValue = "";
		$this->product_price->TooltipValue = "";

		// total_price
		$this->total_price->LinkCustomAttributes = "";
		$this->total_price->HrefValue = "";
		$this->total_price->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// a_id
		$this->a_id->EditAttrs["class"] = "form-control";
		$this->a_id->EditCustomAttributes = "";
		$this->a_id->EditValue = $this->a_id->CurrentValue;
		$this->a_id->ViewCustomAttributes = "";

		// o_id
		$this->o_id->EditAttrs["class"] = "form-control";
		$this->o_id->EditCustomAttributes = "";
		if (!$this->o_id->Raw)
			$this->o_id->CurrentValue = HtmlDecode($this->o_id->CurrentValue);
		$this->o_id->EditValue = $this->o_id->CurrentValue;
		$this->o_id->PlaceHolder = RemoveHtml($this->o_id->caption());

		// name
		$this->name->EditAttrs["class"] = "form-control";
		$this->name->EditCustomAttributes = "";
		if (!$this->name->Raw)
			$this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
		$this->name->EditValue = $this->name->CurrentValue;
		$this->name->PlaceHolder = RemoveHtml($this->name->caption());

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		if (!$this->_email->Raw)
			$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

		// mobile_no
		$this->mobile_no->EditAttrs["class"] = "form-control";
		$this->mobile_no->EditCustomAttributes = "";
		$this->mobile_no->EditValue = $this->mobile_no->CurrentValue;
		$this->mobile_no->PlaceHolder = RemoveHtml($this->mobile_no->caption());

		// billing_address
		$this->billing_address->EditAttrs["class"] = "form-control";
		$this->billing_address->EditCustomAttributes = "";
		if (!$this->billing_address->Raw)
			$this->billing_address->CurrentValue = HtmlDecode($this->billing_address->CurrentValue);
		$this->billing_address->EditValue = $this->billing_address->CurrentValue;
		$this->billing_address->PlaceHolder = RemoveHtml($this->billing_address->caption());

		// shipping_address
		$this->shipping_address->EditAttrs["class"] = "form-control";
		$this->shipping_address->EditCustomAttributes = "";
		if (!$this->shipping_address->Raw)
			$this->shipping_address->CurrentValue = HtmlDecode($this->shipping_address->CurrentValue);
		$this->shipping_address->EditValue = $this->shipping_address->CurrentValue;
		$this->shipping_address->PlaceHolder = RemoveHtml($this->shipping_address->caption());

		// city
		$this->city->EditAttrs["class"] = "form-control";
		$this->city->EditCustomAttributes = "";
		if (!$this->city->Raw)
			$this->city->CurrentValue = HtmlDecode($this->city->CurrentValue);
		$this->city->EditValue = $this->city->CurrentValue;
		$this->city->PlaceHolder = RemoveHtml($this->city->caption());

		// state
		$this->state->EditAttrs["class"] = "form-control";
		$this->state->EditCustomAttributes = "";
		if (!$this->state->Raw)
			$this->state->CurrentValue = HtmlDecode($this->state->CurrentValue);
		$this->state->EditValue = $this->state->CurrentValue;
		$this->state->PlaceHolder = RemoveHtml($this->state->caption());

		// pincode
		$this->pincode->EditAttrs["class"] = "form-control";
		$this->pincode->EditCustomAttributes = "";
		$this->pincode->EditValue = $this->pincode->CurrentValue;
		$this->pincode->PlaceHolder = RemoveHtml($this->pincode->caption());

		// payment_method
		$this->payment_method->EditAttrs["class"] = "form-control";
		$this->payment_method->EditCustomAttributes = "";
		if (!$this->payment_method->Raw)
			$this->payment_method->CurrentValue = HtmlDecode($this->payment_method->CurrentValue);
		$this->payment_method->EditValue = $this->payment_method->CurrentValue;
		$this->payment_method->PlaceHolder = RemoveHtml($this->payment_method->caption());

		// card_no
		$this->card_no->EditAttrs["class"] = "form-control";
		$this->card_no->EditCustomAttributes = "";
		$this->card_no->EditValue = $this->card_no->CurrentValue;
		$this->card_no->PlaceHolder = RemoveHtml($this->card_no->caption());

		// expiry_date
		$this->expiry_date->EditAttrs["class"] = "form-control";
		$this->expiry_date->EditCustomAttributes = "";
		if (!$this->expiry_date->Raw)
			$this->expiry_date->CurrentValue = HtmlDecode($this->expiry_date->CurrentValue);
		$this->expiry_date->EditValue = $this->expiry_date->CurrentValue;
		$this->expiry_date->PlaceHolder = RemoveHtml($this->expiry_date->caption());

		// order_date
		$this->order_date->EditAttrs["class"] = "form-control";
		$this->order_date->EditCustomAttributes = "";
		if (!$this->order_date->Raw)
			$this->order_date->CurrentValue = HtmlDecode($this->order_date->CurrentValue);
		$this->order_date->EditValue = $this->order_date->CurrentValue;
		$this->order_date->PlaceHolder = RemoveHtml($this->order_date->caption());

		// product_name
		$this->product_name->EditAttrs["class"] = "form-control";
		$this->product_name->EditCustomAttributes = "";
		if (!$this->product_name->Raw)
			$this->product_name->CurrentValue = HtmlDecode($this->product_name->CurrentValue);
		$this->product_name->EditValue = $this->product_name->CurrentValue;
		$this->product_name->PlaceHolder = RemoveHtml($this->product_name->caption());

		// product_quantity
		$this->product_quantity->EditAttrs["class"] = "form-control";
		$this->product_quantity->EditCustomAttributes = "";
		$this->product_quantity->EditValue = $this->product_quantity->CurrentValue;
		$this->product_quantity->PlaceHolder = RemoveHtml($this->product_quantity->caption());

		// product_price
		$this->product_price->EditAttrs["class"] = "form-control";
		$this->product_price->EditCustomAttributes = "";
		$this->product_price->EditValue = $this->product_price->CurrentValue;
		$this->product_price->PlaceHolder = RemoveHtml($this->product_price->caption());

		// total_price
		$this->total_price->EditAttrs["class"] = "form-control";
		$this->total_price->EditCustomAttributes = "";
		$this->total_price->EditValue = $this->total_price->CurrentValue;
		$this->total_price->PlaceHolder = RemoveHtml($this->total_price->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->a_id);
					$doc->exportCaption($this->o_id);
					$doc->exportCaption($this->name);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->mobile_no);
					$doc->exportCaption($this->billing_address);
					$doc->exportCaption($this->shipping_address);
					$doc->exportCaption($this->city);
					$doc->exportCaption($this->state);
					$doc->exportCaption($this->pincode);
					$doc->exportCaption($this->payment_method);
					$doc->exportCaption($this->card_no);
					$doc->exportCaption($this->expiry_date);
					$doc->exportCaption($this->order_date);
					$doc->exportCaption($this->product_name);
					$doc->exportCaption($this->product_quantity);
					$doc->exportCaption($this->product_price);
					$doc->exportCaption($this->total_price);
				} else {
					$doc->exportCaption($this->a_id);
					$doc->exportCaption($this->o_id);
					$doc->exportCaption($this->name);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->mobile_no);
					$doc->exportCaption($this->billing_address);
					$doc->exportCaption($this->shipping_address);
					$doc->exportCaption($this->city);
					$doc->exportCaption($this->state);
					$doc->exportCaption($this->pincode);
					$doc->exportCaption($this->payment_method);
					$doc->exportCaption($this->card_no);
					$doc->exportCaption($this->expiry_date);
					$doc->exportCaption($this->order_date);
					$doc->exportCaption($this->product_name);
					$doc->exportCaption($this->product_quantity);
					$doc->exportCaption($this->product_price);
					$doc->exportCaption($this->total_price);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->a_id);
						$doc->exportField($this->o_id);
						$doc->exportField($this->name);
						$doc->exportField($this->_email);
						$doc->exportField($this->mobile_no);
						$doc->exportField($this->billing_address);
						$doc->exportField($this->shipping_address);
						$doc->exportField($this->city);
						$doc->exportField($this->state);
						$doc->exportField($this->pincode);
						$doc->exportField($this->payment_method);
						$doc->exportField($this->card_no);
						$doc->exportField($this->expiry_date);
						$doc->exportField($this->order_date);
						$doc->exportField($this->product_name);
						$doc->exportField($this->product_quantity);
						$doc->exportField($this->product_price);
						$doc->exportField($this->total_price);
					} else {
						$doc->exportField($this->a_id);
						$doc->exportField($this->o_id);
						$doc->exportField($this->name);
						$doc->exportField($this->_email);
						$doc->exportField($this->mobile_no);
						$doc->exportField($this->billing_address);
						$doc->exportField($this->shipping_address);
						$doc->exportField($this->city);
						$doc->exportField($this->state);
						$doc->exportField($this->pincode);
						$doc->exportField($this->payment_method);
						$doc->exportField($this->card_no);
						$doc->exportField($this->expiry_date);
						$doc->exportField($this->order_date);
						$doc->exportField($this->product_name);
						$doc->exportField($this->product_quantity);
						$doc->exportField($this->product_price);
						$doc->exportField($this->total_price);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>