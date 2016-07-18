<?php
/**
 * Class represents records from table billing_plan
 * {autogenerated}
 * @property int $plan_id 
 * @property int $product_id 
 * @property string $title 
 * @property string $terms 
 * @property double $first_price 
 * @property string $first_period 
 * @property int $rebill_times 
 * @property double $second_price 
 * @property string $second_period 
 * @property int $disabled 
 * @property int $qty
 * @property bool $variable_qty
 * @package Am_Invoice
 * @see Am_Table
 */
class BillingPlan extends Am_Record_WithData {
    /** @var Product cached */
    protected $_product;

    /** @return Product */
    public function getProduct()
    {
        if ($this->_product && $this->_product->product_id == $this->product_id)
            return $this->_product;
        $this->_product = $this->getDi()->productTable->load($this->product_id, true);
        $this->_product->setBillingPlan($this);
        return $this->_product;
    }
    public function _setProduct(Product $p)
    {
        $this->_product = $p;
    }
    /** @return string saved or caclulated billing terms */
    public function getTerms()
    {
        return $this->terms ? $this->terms : $this->getTermsText();
    }
    /** @return string caclulated billing terms */
    public function getTermsText()
    {
        $tt = new Am_TermsText($this);
        return $tt->getString();
    }
    public function getCurrency($value = null)
    {
        return $this->getProduct()->getCurrency($value);
    }
    public function isFree()
    {
        return !$this->first_price && !$this->second_price;
    }
    public function delete()
    {
        parent::delete();
        $this->_table->getAdapter()->query("DELETE FROM ?_product_upgrade WHERE 
            to_billing_plan_id=?d OR from_billing_plan_id=?d",
                $this->plan_id, $this->plan_id);
    }
}

/**
 * @package Am_Invoice
 */
class BillingPlanTable extends Am_Table_WithData {
    protected $_key = 'plan_id';
    protected $_table = '?_billing_plan';
    protected $_recordClass = 'BillingPlan';
    
    protected $productCache = array();
    protected $useProductCache = true; // disable in admin cp
    
    function toggleProductCache($flag)
    {
        $this->useProductCache = (bool)$flag;
    }
    function getForProduct($product_id, $limit = null, $onlyEnabled = false)
    {
        if ($this->useProductCache)
        {
            $key = "$product_id-$limit-$onlyEnabled";
            if (array_key_exists($key, $this->productCache))
                return $this->productCache[$key];
        }
        $ret = $this->selectObjects(
                "SELECT *
                 FROM ?_billing_plan
                 WHERE product_id=?d
                 {AND (disabled IS NULL OR disabled = ?d )}
                 ORDER BY plan_id
                 {LIMIT ?d}",
                $product_id,
                !$onlyEnabled ? DBSIMPLE_SKIP : 0,
                $limit === null ? DBSIMPLE_SKIP : $limit
            );
        if ($this->useProductCache)
            $this->productCache[$key] = $ret;
        return $ret;
    }
    
    /**
     *  Select All billing plans respecting sort preferencies from aMember CP -> Manage products
     */
    
    function selectAllSorted()
    {
        return $this->selectObjects("SELECT bp.*, p.title as product_title 
                                     FROM $this->_table bp 
                                     INNER JOIN ?_product p USING (product_id)
                                     WHERE p.is_archived=0
                                     ORDER BY 0+sort_order,p.title");
    }

    
    /**
     * return array of product_id-billing_plan_id => Product Title (billing plan terms) 
     */
    public function getProductPlanOptions()
    {
        $ret = array();
        foreach ($this->selectAllSorted() as $p)
        {
            $ret[ $p->product_id . '-' . $p->plan_id ] = 
                $p->product_title . ' (' . $p->getTerms() . ')';
        }
        return $ret;
    }
}
