<?php /* Smarty version 2.6.16, created on 2008-06-05 17:50:52
         compiled from recycled/javascript.slide.tpl.php */ ?>
<?php echo '
<script type="text/javascript">
'; ?>


<?php if ($this->_tpl_vars['bNoOutPut'] == 'true'): ?>
	<?php echo 'setTimeout("redirect()",'; ?>
(<?php echo $this->_config[0]['vars']['SLIDE_SPEED_WITHOUT_OUTPUT']; ?>
*1000)<?php echo ');'; ?>

<?php else: ?>
	<?php echo 'setTimeout("redirect()", '; ?>
(<?php echo $this->_config[0]['vars']['SLIDE_SPEED']; ?>
*1000)<?php echo ');'; ?>

<?php endif; ?>

<?php echo '
function redirect()
{
	window.location.href =\'';  echo $this->_tpl_vars['sLocation'];  echo '?bTotalAndGames=';  echo $this->_tpl_vars['bTotalAndGames'];  echo '&iYear=';  echo $this->_tpl_vars['iYear'];  echo '&iStart=';  echo $this->_tpl_vars['iStart'];  echo '&bTotal=';  echo $this->_tpl_vars['bTotal'];  echo '&bGames=';  echo $this->_tpl_vars['bGames'];  echo '&iIndexGame=';  echo $this->_tpl_vars['iIndexGame'];  echo '&iIndexDivision=';  echo $this->_tpl_vars['iIndexDivision'];  echo '&bSwitch=';  echo $this->_tpl_vars['bSwitch'];  echo '&bCustom=';  echo $this->_tpl_vars['bCustom'];  echo '&bStart=';  echo $this->_tpl_vars['bStart'];  echo '\';
}
</script>
'; ?>