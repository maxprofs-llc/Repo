{literal}
<script type="text/javascript" src="javascript/isValidEmail.js"></script>

<script type="text/javascript">
	function checkNotNull(sInput)
	{
		var sValue = eval("document.getElementById('"+sInput+"').value");
		var iLength = sValue.length;
		var bNotNull = false;

		if(iLength > 0)
			bNotNull = true;
		
		// TODO: this HAS to be replaced of vars in the divs and in the var to the php-file
		// can't get the hang of the syntax now, d-oh!
		if(sInput == "sInitials")
		{
			if(bNotNull == true)
			{
				new Element.show('initialsOK');
				new Element.hide('initialsNotOK');
			}
			else
			{
				new Element.show('initialsNotOK');
				new Element.hide('initialsOK');
			}
		}

		if(sInput == "sFirstName")
		{
			if(bNotNull == true)
			{
				new Element.show('firstnameOK');
				new Element.hide('firstnameNotOK');
			}
			else
			{
				new Element.show('firstnameNotOK');
				new Element.hide('firstnameOK');
			}
		}
		
		if(sInput == "sLastName")
		{
			if(bNotNull == true)
			{
				new Element.show('lastnameOK');
				new Element.hide('lastnameNotOK');
			}
			else
			{
				new Element.show('lastnameNotOK');
				new Element.hide('lastnameOK');
			}
		}		

		if(sInput == "iYearBorn")
		{
			if(bNotNull == true)
			{
				new Element.show('yearBornOK');
				new Element.hide('yearBornNotOK');
			}
			else
			{
				new Element.show('yearBornNotOK');
				new Element.hide('yearBornOK');
			}
		}		
		
		if(sInput == "iGender")
		{
			if(bNotNull == true)
			{
				new Element.show('genderOK');
				new Element.hide('genderNotOK');
			}
			else
			{
				new Element.show('genderNotOK');
				new Element.hide('genderOK');
			}
		}		

		if(sInput == "iCountry")
		{
			if(bNotNull == true)
			{
				new Element.show('countryOK');
				new Element.hide('countryNotOK');
			}
			else
			{
				new Element.show('countryNotOK');
				new Element.hide('countryOK');
			}
		}

		if(sInput == "iDivision")
		{
			if(bNotNull == true)
			{
				new Element.show('divisionOK');
				new Element.hide('divisionNotOK');
			}
			else
			{
				new Element.show('divisionNotOK');
				new Element.hide('divisionOK');
			}
		}
	}
	
	
	function checkEmail()
	{
		var sEmail = $F('sEmail');
		var bEmailOK = false;
		
		if(isValidEmail(sEmail))
			bEmailOK = true;
		
		if(bEmailOK == true)
		{
			new Element.show('emailOK');
			new Element.hide('emailNotOK');
		}
		else
		{
			new Element.show('emailNotOK');
			new Element.hide('emailOK');
		}
	}
	
	womOn();
</script>
{/literal}

{if $bIsCompleted}
	{if $iIDEdit == null}
		{#REGISTER_PLAYER_REGISTERED#}
	{else}
		{#ADMIN_EDIT_PLAYER_EDITED#}	
	{/if}	
{/if}

{if $bHasErrors}
	<div class='highLight'>
		<b class='highLight'>{#ERROR#}</b>
		<br />
		{if $bReqFieldsMissing}
			- {#FIELDS_MISSING_FORM#}<br />
		{/if}
		{if $aCustomErrors.invalidEmail}
			- {#INVALID_EMAIL#}<br />
		{/if}
	
		<!-- just for some, eventual invalid posted valued -->
		{if $aCustomErrors.invalidYear}
			- {#INVALID_YEAR#}<br />
		{/if}

		{if $aCustomErrors.invalidGender}
			- {#INVALID_GENDER#}<br />
		{/if}
	
		{if $aCustomErrors.invalidCountry}
			- {#INVALID_COUNTRY#}<br />
		{/if}
	
		{if $aCustomErrors.invalidDivision}
			- {#INVALID_DIVISION#}<br />
		{/if}
		
		{if $aCustomErrors.tooOldForJuniors}
			- {#TOO_OLD_FOR_JUNIORS#}<br />
		{/if}
				
	</div>		
{/if}

{if $bDisplayForm}
	{if $bIsStart}
		{#FIELDS_MARKED_REQUIRED#}
	{/if}
<br />

	{$sFormStart}
	<table class='formTable'>
		<tr>
			<td class='inputLabel'>{#HIGH_SCORE_INITIALS#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sInitials.input} {$aInputs.sInitials.verValue}</td>
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
			<td class='inputLabel'>{#FIRSTNAME#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sFirstName.input} {$aInputs.sFirstName.verValue}</td>
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
			<td class='inputLabel'>{#LASTNAME#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sLastName.input} {$aInputs.sLastName.verValue}</td>
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
			<td class='inputLabel'>{#YEAR_OF_BIRTH#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.iYearBorn.input} {$aInputs.iYearBorn.verValue}</td>
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
			<td class='inputLabel'>{#GENDER#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.iGender.input} {$aInputs.iGender.verValue}</td>
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
			<td class='inputLabel'>{#EMAIL#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sEmail.input} {$aInputs.sEmail.verValue}</td>
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
			<td class='inputLabel'>{#PHONE#}</td>
			<td>{$aInputs.sPhone.input} {$aInputs.sPhone.verValue}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#MOBILE_PHONE#}</td>
			<td>{$aInputs.sMobilePhone.input} {$aInputs.sMobilePhone.verValue}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#COUNTRY#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.iCountry.input} {$aInputs.iCountry.verValue}</td>
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
			<td class='inputLabel'>{#ADDRESS_STREET#}</td>
			<td>{$aInputs.sAddressStreet.input} {$aInputs.sAddressStreet.verValue}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#ADDRESS_ZIP#}</td>
			<td>{$aInputs.sAddressZip.input} {$aInputs.sAddressZip.verValue}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#ADDRESS_CITY#}</td>
			<td>{$aInputs.sAddressCity.input} {$aInputs.sAddressCity.verValue}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#ADDRESS_REGION#}</td>
			<td>{$aInputs.sAddressRegion.input} {$aInputs.sAddressRegion.verValue}</td>
		</tr>
		{if $bDivisionsActive == true}
			{* TODO IF THERE'S ONLY ONE DIVISION, PRESELECT THAT ONE *}
			<tr>
				<td class='inputLabel'>{#DIVISION#} {#REQ_FIELD_SIGN#}</td>
				<td>{$aInputs.iDivision.input} {$aInputs.iDivision.verValue}</td>
				<td class='inputCheck'>
				<div id='divisionOK' style='display:none'>
					<img src='images/icons/OK.gif' alt='' />
				</div>
	
				<div id='divisionNotOK' style='display:none'>
					<img src='images/icons/notOK.gif' alt='' />
				</div>					
				</td>
			</tr>
		{/if}
		
		{if $aInputs.sMainTournament.input != null}
			<tr>
				<td class='inputLabel'>{#ENTER#} A {#DIVISION#}</td>
				<td>{$aInputs.sMainTournament.input} {$aInputs.sMainTournament.verValue}</td>
			</tr>
		{/if}

		{if $aInputs.sClassics.input != null}
			<tr>
				<td class='inputLabel'>{#ENTER#} {#CLASSICS#} {#DIVISION#}</td>
				<td>{$aInputs.sClassics.input} {$aInputs.sClassics.verValue}</td>
			</tr>
		{/if}
		
		{if $aInputs.sJuniors.input != null}
			<tr>
				<td class='inputLabel'>{#ENTER#} {#JUNIORS#} {#DIVISION#}</td>
				<td>{$aInputs.sJuniors.input} {$aInputs.sJuniors.verValue}</td>
			</tr>
		{/if}
		
		
		{* USED IF WE'RE EDITING A PLAYER *}
		{if $aInputs.iIDEdit.input != null}
			<tr>
				<td></td>
				<td>{$aInputs.iIDEdit.input}</td>
			</tr>
		{/if}
		
		<tr>
			<td></td>
			<td>{$sButtons}</td>
		</tr>
	</table>
	{$sFormEnd}
{/if}