<?php
// No direct access
defined('_JEXEC') or die;
JHtml::stylesheet($root.'./modules/mod_virtuemart_bulkaddtocart/css/styl.css')    ;
?>
<form method="post">
<fieldset>
<br /><p class="chyba"><?=$urlcart?></p>

__<input type='text' class='inputtable' value="<?php echo JText::_('MOD_VIRTUEMART_BULKADDTOCART_PRODUCT_SKU'); ?>"  readonly> 
<input type='text' class='inputtable' value="<?php echo JText::_('MOD_VIRTUEMART_BULKADDTOCART_QTY'); ?>"  readonly> <br/>
<?php
$c = 1;
 if($clear_values==1) unset($return_values);
do {
	$value_sku=$return_values[$c-1]['sku'];
	$value_qty=$return_values[$c-1]['qty']
?>
<?= $c ?>.
<input type='text' class='inputtable' name='id<?= $c ?>' value='<?=$value_sku?>' minlength="3" maxlength="16" '>
<input type='number' class='inputtable' name='pocet<?= $c ?>' value='<?=$value_qty?>' min="1" max="9999">
<br />

<?php
$c++;
}
while($c<16);
?>
</fieldset>
			<input type="submit" name="odesli"  class="tlacitko" value="<?php echo JText::_('MOD_VIRTUEMART_BULKADDTOCART_ADD_TO_CART'); ?>" >
	<!--		<input type="submit" name="kontrola" class="kontrolni_tlacitko" value="Kontrola"> -->
			<input type="submit" name="zrus"  class="mazaci_tlacitko" onclick="if(confirm('Smazat položky z formuláře ?')){}else{return false;};" value="<?php echo JText::_('MOD_VIRTUEMART_BULKADDTOCART_CLEAR_FORM'); ?>" > 


			
</form>
