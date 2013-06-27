<?php /* Smarty version 2.6.16, created on 2008-03-30 17:57:57
         compiled from forms/form.loginAjax.tpl.php */ ?>
<input id='sUsername' name="sUsername" size='11' maxlength='64' type='text' class='<?php echo $this->_config[0]['vars']['INPUT_DEFAULT_CLASS']; ?>
' value='<?php echo $this->_config[0]['vars']['USERNAME']; ?>
' <?php echo 'onfocus="clearInput(\'sUsername\')"'; ?>
/> 
<input id='sPassword' name="sPassword" size='11' maxlength='64' type='password' class='<?php echo $this->_config[0]['vars']['INPUT_DEFAULT_CLASS']; ?>
' value='<?php echo $this->_config[0]['vars']['PASSWORD']; ?>
' <?php echo 'onfocus="clearInput(\'sPassword\')"'; ?>
/>
<input name='sRedirect' type='hidden' value='<?php echo $this->_tpl_vars['g_sPage']; ?>
' />
<input type='submit' value='<?php echo $this->_config[0]['vars']['SUBMIT']; ?>
' class='<?php echo $this->_config[0]['vars']['INPUT_SUBMIT_DEFAULT']; ?>
' />