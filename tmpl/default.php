<?php
 /**
 * @package mod_currency_nbu
 * @author Rybalko Igor
 * @version 1.0
 * @copyright (C) 2016 http://wolfweb.com.ua
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 *
*/
 
defined('_JEXEC') or die('Restricted access'); ?>

<div class="modcurr<?php echo $moduleclass_sfx; ?>">
	<ul>
		<li>USD: <?php echo $data['usd']; ?></li>
		<li>EUR: <?php echo $data['eur']; ?></li>
		<li>RUB: <?php echo $data['rub']; ?></li>
	</ul>
	<div class="datecurr">
		<?php echo $data['date']; ?>
	</div>	
</div>