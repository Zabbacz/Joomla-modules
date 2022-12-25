<?php
/**
 * Helper class for BulkAddToCart module
 * 
 * @subpackage Modules
  * @license        GNU/GPL, see LICENSE.php
 * MOD_VIRTUEMART_BULKADDTOCART is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class ModBulkaAddToCartHelper
{
    public static function getAddtocart($nezarazeno)
  {
  	$clear_values=0;
	$o=1;
	$id="";
	$qty="";
	$url="";
	$nezarazeno=array();
  if (!empty($_POST['odesli'])) 
  {
  	while($o<16){
//			if ($_POST["id".$o]=="") break;
  	    if (strlen($_POST["id".$o])<3 || !is_numeric($_POST["pocet".$o]) || !isset($_POST["pocet".$o]))
  	        {
	$urlcart = JText::_('MOD_VIRTUEMART_BULKADDTOCART_INVALID_DATA')." <br />";
    }
    else
    {
		$db=JFactory::getDBO();
		$mnozstvi=$_POST["pocet".$o];
		$idv ='"'.$_POST["id".$o].'"';
		$query = $db->getQuery(true)
            ->select($db->quoteName('virtuemart_product_id'))
            ->from($db->quoteName('#__virtuemart_products'))
				->where($db->quoteName('product_sku'). ' LIKE '.$idv);
			$db->setQuery($query);
			$rows = $db->loadObjectList();
		if (!$rows) $nezarazeno[]=($_POST["id".$o]);
	foreach ($rows as $item){
      $id="&add_id[]=".$item->virtuemart_product_id;
		$qty="&qadd_".$item->virtuemart_product_id."=".$mnozstvi;
		$url=$url.$id.$qty;
		}
		
}    
$o++;
}
if(($url=="") || ($nezarazeno))	 {
	$urlcart = $urlcart." ".JText::_('MOD_VIRTUEMART_BULKADDTOCART_NO_INSERT')."  <br /> ";
	if ($nezarazeno) $urlcart = $urlcart.JText::_('MOD_VIRTUEMART_BULKADDTOCART_CORRECT_ITEMS')." <br />";
	for ($p = 0; $p < count($nezarazeno); ++$p){
	$urlcart = $urlcart.JText::_('MOD_VIRTUEMART_BULKADDTOCART_ITEM')." ".$nezarazeno[$p]." ".JText::_('MOD_VIRTUEMART_BULKADDTOCART_ITEM_INVALID')."  <br /> ";
	}	
}
			 
	else
 		{
$urlcart="index.php?option=com_virtuemart&view=cart".$url;
header("Location: ".$urlcart);

 		}
}
return $urlcart;

  }
  
    public static function getControl()
  {
	$return_values=array();
	$q = 1;
	while($q<16) {
//		if ($_POST["id".$q]=="") break;
		$qtyc=$_POST["pocet".$q];
		$sku =$_POST["id".$q];
	$return_values[]=array(
		'sku' => $sku,	
		'qty' => $qtyc,
		);
	$q++;
	}
	return $return_values;  
 	}
 	
    public static function getClear()
	{
	  if (!empty($_POST['zrus']))
	  	{
 

$clear_values = 1;

		}
return $clear_values;	

	}	
} 

 