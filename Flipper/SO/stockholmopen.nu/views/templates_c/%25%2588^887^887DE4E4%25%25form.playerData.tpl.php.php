<?php /* Smarty version 2.6.16, created on 2008-03-30 04:35:33
         compiled from forms/form.playerData.tpl.php */ ?>
<?php echo '
<script type="text/javascript" src="javascript/isValidEmail.js"></script>

<script type="text/javascript">
	function checkNotNull(sInput)
	{
		var sValue = eval("document.getElementById(\'"+sInput+"\').value");
		var iLength = sValue.length;
		var bNotNull = false;

		if(iLength > 0)
			bNotNull = true;
		
		// TODO: this HAS to be replaced of vars in the divs and in the var to the php-file
		// can\'t get the hang of the syntax now, d-oh!
		if(sInput == "sInitials")
		{
			if(bNotNull == true)
			{
				new Element.show(\'initialsOK\');
				new Element.hide(\'initialsNotOK\');
			}
			else
			{
				new Element.show(\'initialsNotOK\');
				new Element.hide(\'initialsOK\');
			}
		}

		if(sInput == "sFirstName")
		{
			if(bNotNull == true)
			{
				new Element.show(\'firstnameOK\');
				new Element.hide(\'firstnameNotOK\');
			}
			else
			{
				new Element.show(\'firstnameNotOK\');
				new Element.hide(\'firstnameOK\');
			}
		}
		
		if(sInput == "sLastName")
		{
			if(bNotNull == true)
			{
				new Element.show(\'lastnameOK\');
				new Element.hide(\'lastnameNotOK\');
			}
			else
			{
				new Element.show(\'lastnameNotOK\');
				new Element.hide(\'lastnameOK\');
			}
		}		

		if(sInput == "iYearBorn")
		{
			if(bNotNull == true)
			{
				new Element.show(\'yearBornOK\');
				new Element.hide(\'yearBornNotOK\');
			}
			else
			{
				new Element.show(\'yearBornNotOK\');
				new Element.hide(\'yearBornOK\');
			}
		}		
		
		if(sInput == "iGender")
		{
			if(bNotNull == true)
			{
				new Element.show(\'genderOK\');
				new Element.hide(\'genderNotOK\');
			}
			else
			{
				new Element.show(\'genderNotOK\');
				new Element.hide(\'genderOK\');
			}
		}		

		if(sInput == "iCountry")
		{
			if(bNotNull == true)
			{
				new Element.show(\'countryOK\');
				new Element.hide(\'countryNotOK\');
			}
			else
			{
				new Element.show(\'countryNotOK\');
				new Element.hide(\'countryOK\');
			}
		}

		if(sInput == "iDivision")
		{
			if(bNotNull == true)
			{
				new Element.show(\'divisionOK\');
				new Element.hide(\'divisionNotOK\');
			}
			else
			{
				new Element.show(\'divisionNotOK\');
				new Element.hide(\'divisionOK\');
			}
		}
	}
	
	
	function checkEmail()
	{
		var sEmail = $F(\'sEmail\');
		var bEmailOK = false;
		
		if(isValidEmail(sEmail))
			bEmailOK = true;
		
		if(bEmailOK == true)
		{
			new Element.show(\'emailOK\');
			new Element.hide(\'emailNotOK\');
		}
		else
		{
			new Element.show(\'emailNotOK\');
			new Element.hide(\'emailOK\');
		}
	}
	
	womOn();
</script>
'; ?>


<?php if ($this->_tpl_vars['bIsCompleted']): ?>
	<?php if ($this->_tpl_vars['iIDEdit'] == null): ?>
		<?php echo $this->_config[0]['vars']['REGISTER_PLAYER_REGISTERED']; ?>

	<?php else: ?>
		<?php echo $this->_config[0]['vars']['ADMIN_EDIT_PLAYER_EDITED']; ?>
	
	<?php endif; ?>	
<?php endif; ?>

<?php if ($this->_tpl_vars['bHasErrors']): ?>
	<div class='highLight'>
		<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b>
		<br />
		<?php if ($this->_tpl_vars['bReqFieldsMissing']): ?>
			- <?php echo $this->_config[0]['vars']['FIELDS_MISSING_FORM']; ?>
<br />
		<?php endif; ?>
		<?php if ($this->_tpl_vars['aCustomErrors']['invalidEmail']): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_EMAIL']; ?>
<br />
		<?php endif; ?>
	
		<!-- just for some, eventual invalid posted valued -->
		<?php if ($this->_tpl_vars['aCustomErrors']['invalidYear']): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_YEAR']; ?>
<br />
		<?php endif; ?>

		<?php if ($this->_tpl_vars['aCustomErrors']['invalidGender']): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_GENDER']; ?>
<br />
		<?php endif; ?>
	
		<?php if ($this->_tpl_vars['aCustomErrors']['invalidCountry']): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_COUNTRY']; ?>
<br />
		<?php endif; ?>
	
		<?php if ($this->_tpl_vars['aCustomErrors']['invalidDivision']): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_DIVISION']; ?>
<br />
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['aCustomErrors']['tooOldForJuniors']): ?>
			- <?php echo $this->_config[0]['vars']['TOO_OLD_FOR_JUNIORS']; ?>
<br />
		<?php endif; ?>
				
	</div>		
<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayForm']): ?>
	<?php if ($this->_tpl_vars['bIsStart']): ?>
		<?php echo $this->_config[0]['vars']['FIELDS_MARKED_REQUIRED']; ?>

	<?php endif; ?>
<br />

	<?php echo $this->_tpl_vars['sFormStart']; ?>

	<table class='formTable'>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['HIGH_SCORE_INITIALS']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sInitials']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sInitials']['verValue']; ?>
</td>
			<td class='inputCheck'>
			<div id='initialsOK' style='display:none'>
				<img src='images/icons/OK.gif' alt='' />
			</div>

			<div id='initialsNotOK' style='display:none'>
				<img src='images/icons/notOK.gif' alt='' />
			</div>
			</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['FIRSTNAME']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sFirstName']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sFirstName']['verValue']; ?>
</td>
			<td class='inputCheck'>
			<div id='firstnameOK' style='display:none'>
				<img src='images/icons/OK.gif' alt='' />
			</div>

			<div id='firstnameNotOK' style='display:none'>
				<img src='images/icons/notOK.gif' alt='' />
			</div>
			</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['LASTNAME']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sLastName']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sLastName']['verValue']; ?>
</td>
			<td class='inputCheck'>
			<div id='lastnameOK' style='display:none'>
				<img src='images/icons/OK.gif' alt='' />
			</div>

			<div id='lastnameNotOK' style='display:none'>
				<img src='images/icons/notOK.gif' alt='' />
			</div>
			</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['YEAR_OF_BIRTH']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['iYearBorn']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['iYearBorn']['verValue']; ?>
</td>
			<td class='inputCheck'>
			<div id='yearBornOK' style='display:none'>
				<img src='images/icons/OK.gif' alt='' />
			</div>

			<div id='yearBornNotOK' style='display:none'>
				<img src='images/icons/notOK.gif' alt='' />
			</div>			
			</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['GENDER']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['iGender']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['iGender']['verValue']; ?>
</td>
			<td class='inputCheck'>
			<div id='genderOK' style='display:none'>
				<img src='images/icons/OK.gif' alt='' />
			</div>

			<div id='genderNotOK' style='display:none'>
				<img src='images/icons/notOK.gif' alt='' />
			</div>			
			</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['EMAIL']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sEmail']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sEmail']['verValue']; ?>
</td>
			<td class='inputCheck'>
			<div id='emailOK' style='display:none'>
				<img src='images/icons/OK.gif' alt='' />
			</div>

			<div id='emailNotOK' style='display:none'>
				<img src='images/icons/notOK.gif' alt='' />
			</div>			
			</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['PHONE']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sPhone']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sPhone']['verValue']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['MOBILE_PHONE']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sMobilePhone']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sMobilePhone']['verValue']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['COUNTRY']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['iCountry']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['iCountry']['verValue']; ?>
</td>
			<td class='inputCheck'>
			<div id='countryOK' style='display:none'>
				<img src='images/icons/OK.gif' alt='' />
			</div>

			<div id='countryNotOK' style='display:none'>
				<img src='images/icons/notOK.gif' alt='' />
			</div>			
			</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['ADDRESS_STREET']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sAddressStreet']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sAddressStreet']['verValue']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['ADDRESS_ZIP']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sAddressZip']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sAddressZip']['verValue']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['ADDRESS_CITY']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sAddressCity']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sAddressCity']['verValue']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['ADDRESS_REGION']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sAddressRegion']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sAddressRegion']['verValue']; ?>
</td>
		</tr>
		<?php if ($this->_tpl_vars['bDivisionsActive'] == true): ?>
						<tr>
				<td class='inputLabel'><?php echo $this->_config[0]['vars']['DIVISION']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
				<td><?php echo $this->_tpl_vars['aInputs']['iDivision']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['iDivision']['verValue']; ?>
</td>
				<td class='inputCheck'>
				<div id='divisionOK' style='display:none'>
					<img src='images/icons/OK.gif' alt='' />
				</div>
	
				<div id='divisionNotOK' style='display:none'>
					<img src='images/icons/notOK.gif' alt='' />
				</div>					
				</td>
			</tr>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['aInputs']['sMainTournament']['input'] != null): ?>
			<tr>
				<td class='inputLabel'><?php echo $this->_config[0]['vars']['ENTER']; ?>
 A <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</td>
				<td><?php echo $this->_tpl_vars['aInputs']['sMainTournament']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sMainTournament']['verValue']; ?>
</td>
			</tr>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['aInputs']['sClassics']['input'] != null): ?>
			<tr>
				<td class='inputLabel'><?php echo $this->_config[0]['vars']['ENTER']; ?>
 <?php echo $this->_config[0]['vars']['CLASSICS']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</td>
				<td><?php echo $this->_tpl_vars['aInputs']['sClassics']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sClassics']['verValue']; ?>
</td>
			</tr>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['aInputs']['sJuniors']['input'] != null): ?>
			<tr>
				<td class='inputLabel'><?php echo $this->_config[0]['vars']['ENTER']; ?>
 <?php echo $this->_config[0]['vars']['JUNIORS']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</td>
				<td><?php echo $this->_tpl_vars['aInputs']['sJuniors']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sJuniors']['verValue']; ?>
</td>
			</tr>
		<?php endif; ?>
		
		
				<?php if ($this->_tpl_vars['aInputs']['iIDEdit']['input'] != null): ?>
			<tr>
				<td></td>
				<td><?php echo $this->_tpl_vars['aInputs']['iIDEdit']['input']; ?>
</td>
			</tr>
		<?php endif; ?>
		
		<tr>
			<td></td>
			<td><?php echo $this->_tpl_vars['sButtons']; ?>
</td>
		</tr>
	</table>
	<?php echo $this->_tpl_vars['sFormEnd']; ?>

<?php endif; ?>