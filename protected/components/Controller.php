<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * The constants for payment transaction for Payson and Paymill
     */
    const ADDED_TO_CART=1; //  'When the item is first added to Cart. Cart will only display items in this '
    const PAYSON_FORWARDED=2;
    const PAYSON_RETURN_OK=3;
    const PAYSON_RETURN_FAIL=4;
    const PAYSON_RETURN_CANCEL=5;
    const IPN_STATUS_OK=6;
    const IPN_STATUS_FAIL=7;
    const IPN_CCODE_OK=8;
    const IPN_CCODE_FAIL=9;
    const IPN_AMOUNT_OK=10;
    const IPN_AMOUNT_FAIL=11;
    public $STATUS = array(1=>'ADDED_TO_CART',2=>'PAYSON_FORWARDED',3=>'PAYSON_RETURN_OK',4=>'PAYSON_RETURN_FAIL',5=>'PAYSON_RETURN_CANCEL',6=>'IPN_STATUS_OK',7=>'IPN_STATUS_FAIL',8=>'IPN_CCODE_OK',9=>'IPN_CCODE_FAIL',10=>'IPN_AMOUNT_OK',11=>'IPN_AMOUNT_FAIL');

	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
    
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
    
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
}