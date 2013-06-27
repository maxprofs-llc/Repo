<?php /* Smarty version 2.6.16, created on 2008-03-30 05:39:28
         compiled from recycled/gameStats.tpl.php */ ?>
<b><?php echo $this->_config[0]['vars']['TOTAL_ROUNDS']; ?>
</b>: <?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['stats']['no_of_played_entry_rounds']; ?>
 /	<b><?php echo $this->_config[0]['vars']['MAX']; ?>
</b>: <?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['stats']['score_highest_output']; ?>
 / <b><?php echo $this->_config[0]['vars']['MIN']; ?>
:</b> <?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['stats']['score_lowest_output']; ?>
 / <b><?php echo $this->_config[0]['vars']['AVERAGE']; ?>
:</b> <?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['stats']['score_average_output']; ?>
 / <b><?php echo $this->_config[0]['vars']['MEDIAN']; ?>
</b>: <?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['stats']['score_median_output']; ?>