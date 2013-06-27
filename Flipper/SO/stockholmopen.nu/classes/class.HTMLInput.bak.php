<?php
class HTMLInput
{
	public function getFormStart($a_sMethod, $a_sAction, $a_sName, $a_bFileForm, $a_bUseFormName = false)
	{
		$sName = null;
		if($a_bUseFormName == true)
			$sName = " name='" . $a_sName . "' ";
			
		$sEncType = null;
		if($a_bFileForm == true)
			$sEncType = "enctype='multipart/form-data'";
	
		if($a_sName == null)
			$a_sName = "form";
		
		return "<form action='" . $a_sAction ."' ". $sName . " id='" . $a_sName . "' " . $sEncType . " method='" . $a_sMethod . "'>";
	}

	public function getSubmit($a_sName, $a_sString, $a_sClass = null)
	{
		if($a_sClass != null)
			$sClass = "class='".$a_sClass."'";
		else 
			$sClass = null;
			
		return "<input type='submit' id='" . $a_sName . "' name='" . $a_sName . "' " . $sClass . " value='" . htmlspecialchars($a_sString, ENT_QUOTES) . "' />";	
	}
	
	public function getTextInput($a_sName, $a_iSize, $a_iMaxLength, $a_sPreSelect = null, $a_sClass = null, $a_bDisabled = false, $a_sType = null, $a_sCustomText = null)
	{
		if($a_sClass != null)
			$sClass = "class='".$a_sClass."'";
		else 
			$sClass = null;
		
		if($a_bDisabled == true)
			$sDisabled = "disabled";
		else
			$sDisabled = null;

		$sType = "text";
		if($a_sType == "password")
			$sType = "password";
		
		return "<input type='" . $sType . "' id='" . $a_sName . "' " . $sDisabled . " name='" . $a_sName . "' " . $sClass . " value='" . htmlspecialchars($a_sPreSelect, ENT_QUOTES) ."' size='" . $a_iSize . "' maxlength='" . $a_iMaxLength . "' " . $a_sCustomText . " />";	
	}
	
	public function getTextArea($a_sName, $a_iRows, $a_iCols, $a_iLimit = null, $a_sPreSelect = null, $a_sClass = null, $a_sCustomText = null)
	{
		if($a_sClass != null)
			$sClass = "class='".$a_sClass."'";
		else 
			$sClass = null;
		
		if($a_iLimit == null)
			$sString = "<textarea name='" . $a_sName . "' id='" . $a_sName . "' " . $sClass . " rows='" . $a_iRows . "' cols='" . $a_iCols ."' " . $a_sCustomText . " >" . $a_sPreSelect . "</textarea>";	
		else // a limit is selected	
			$sString = "<textarea wrap='physical' name='" . $a_sName . "' id='" . $a_sName . "' " . $sClass . "' rows='" . $a_iRows . "' cols='" . $a_iCols ."' onKeyDown=\"limitText(this.form." . $a_sName . ",this.form.countdown," . $a_iLimit . ");\" onKeyUp=\"limitText(this.form." . $a_sName . ",this.form.countdown," . $a_iLimit . ");\" " . $a_sCustomText . " >" . $a_sPreSelect . "</textarea>";

		return $sString;
	}
	
	public function getCountDownInput($a_iLimit)
	{
		$iLength = strlen($a_iLimit);
		return "<input readonly type='text' name='countdown' size='" . $iLength ."' value='" . htmlspecialchars($a_iLimit, ENT_QUOTES) . "' />";
	}
	
	public function getTextAreaLimitJavascript()
	{		
		$sString = "<script language=\"javascript\" type=\"text/javascript\">";
		$sString.= "function limitText(limitField, limitCount, limitNum)"; 
		$sString.= "{";
		$sString.= "	if (limitField.value.length > limitNum)"; 
		$sString.= "	{";
		$sString.= "	limitField.value = limitField.value.substring(0, limitNum);";
		$sString.= "	}";
		$sString.= "	else";
		$sString.= "	{";
		$sString.= "	limitCount.value = limitNum - limitField.value.length;";
		$sString.= "	}";
		$sString.= "}";
		$sString.= "</script>";
		return $sString;
	}
	
	public function getJavaScriptSelect($a_sName, $a_sLocation, $a_aValues, $a_sPreSelect = null, $a_sClass = null, $a_cPrefix = null)
	{
		$cPrefix = "?";
		if($a_cPrefix != null)
			$cPrefix = $a_cPrefix;
				
		$sString = "<select name=\"" . $a_sName . "\" id='" . $a_sName . "' onchange=\"document.location.href='" . $a_sLocation . $cPrefix . $a_sName . "=' + this[this.selectedIndex].value;\" class='" . $a_sClass ."'>"; 
		
		$i = 0;
		foreach($a_aValues as $val)
		{
			if($a_sPreSelect == null && $i == 0)
			{
				$sString.= "<option selected='selected' value='". htmlspecialchars($val, ENT_QUOTES) . "'>" . $val . "</option>";
			}
			else
			{
				if($a_sPreSelect == $val)
					$sString.= "<option selected='selected' value='". htmlspecialchars($val, ENT_QUOTES) . "'>" . $val . "</option>";
				else
					$sString.= "<option value = '" . htmlspecialchars($val, ENT_QUOTES) . "'>" . $val . "</option>";
			}
		$i++;
		}

		$sString.= "</select>";
		return $sString;
	}
	
	public function getJavaScriptNumberSelect($a_sName, $a_sLocation, $a_iMax, $a_sPreSelect = null, $a_sClass = null, $a_cPrefix = null)
	{
		$cPrefix = "?";
		if($a_cPrefix != null)
			$cPrefix = $a_cPrefix;
			
		$sString = "<select name=\"" . $a_sName . "\" id='" . $a_sName . "' onchange=\"document.location.href='" . $a_sLocation . $cPrefix . $a_sName . "=' + this[this.selectedIndex].value;\" class='" . $a_sClass ."'>"; 

		for ($i=1; $i < ($a_iMax+1); $i++)
		{
			if($a_sPreSelect == null && $i == 1)
			{
				$sString.= "<option selected='selected' value='". htmlspecialchars($i, ENT_QUOTES) . "'>" . $i . "</option>";
			}
			else
			{
				if($a_sPreSelect == $i)
					$sString.= "<option selected='selected' value='". htmlspecialchars($i, ENT_QUOTES) . "'>" . $i . "</option>";
				else
					$sString.= "<option value = '" . htmlspecialchars($i, ENT_QUOTES) . "'>" . $i . "</option>";
			}
		}

		$sString.= "</select>";
		
		return $sString;
	}

	// creates a simple html select, the value of the select
	// will be the same as the output
	public function getSelect($a_sName, $a_aValues, $a_sPreSelect = null, $a_sClass = null, $a_sCustomText = null)
	{
		if($a_sClass != null)
			$sClass = "class='" . $a_sClass . "'";
		else 
			$sClass = null;

		$sString = "<select name='" . $a_sName . "' id='" . $a_sName . "' " . $sClass. " " . $a_sCustomText . " >\n";
		$sString .= "<option value=''>-</option>\n";		

		foreach ($a_aValues as $value) 
		{	
			if($a_sPreSelect == $value)
				$sSelected = "selected";
			else 
				$sSelected = null;
			$sString .= "<option " . $sSelected . " value='" . htmlspecialchars($value, ENT_QUOTES) . "'>" . $value . "</option>\n";		
		}				
		
		$sString .= "</select>\n";
		
		return $sString;
	}

	public function getMultipleSelect($a_sName, $a_aValues, $a_iSize, $a_aPreSelect = null, $a_sClass = null, $a_sCustomText = null)
	{
		if($a_sClass != null)
			$sClass = "class='" . $a_sClass . "'";
		else 
			$sClass = null;

		if($a_aPreSelect == null)
			$a_aPreSelect = array();	
			
		$sString = "<select name='" . $a_sName . "[]' id='" . $a_sName . "' size='" . $a_iSize . "' " . $sClass. " multiple " . $a_sCustomText . " >\n";
		$sString .= "<option value=''>-</option>\n";		
		foreach ($a_aValues as $value) 
		{	
			if(in_array($value, $a_aPreSelect))
				$sSelected = "selected";
			else 
				$sSelected = null;
			$sString .= "<option " . $sSelected . " value='" . htmlspecialchars($value, ENT_QUOTES) . "'>" . $value . "</option>\n";		
		}				
		$sString .= "</select>\n";
		return $sString;	
	}

	// nifty to use when the select value has to be different from
	// the output value, the value is in the $a_aValues array, output in the $a_aOutput	
	public function getMultipleSelectID($a_sName, $a_aValues, $a_aOutput, $a_iSize, $a_aPreSelect = null, $a_sClass = null, $a_sCustomText = null)
	{
		if($a_sClass != null)
			$sClass = "class='" . $a_sClass . "'";
		else 
			$sClass = null;

		if($a_aPreSelect == null)
			$a_aPreSelect = array();	
			
		$sString = "<select name='" . $a_sName . "[]' id='" . $a_sName . "' size='" . $a_iSize . "' " . $sClass. " multiple " . $a_sCustomText . " >\n";
		$i = 0;		
		foreach ($a_aValues as $value) 
		{	
			if(in_array($value, $a_aPreSelect))
				$sSelected = "selected";
			else 
				$sSelected = null;
			$sString .= "<option " . $sSelected . " value='" . htmlspecialchars($value, ENT_QUOTES) . "'>" . $a_aOutput[$i] . "</option>\n";		
			$i++;
		}				
		$sString .= "</select>\n";
		return $sString;	
	}	
	
	// nifty to use when the select value has to be different from
	// the output value, the value is in the $a_aValues array, output in the $a_aOutput
	public function getSelectID($a_sName, $a_aValues, $a_aOutput, $a_sPreSelect = null, $a_sClass = null, $a_sCustomText = null)
	{	
		if($a_sClass != null)
			$sClass = "class='" . $a_sClass . "'";
		else 
			$sClass = null;		
			
		$sString = "<select name='" . $a_sName . "' id='" . $a_sName . "' " . $sClass . " " . $a_sCustomText . " >\n";
		
		$sString .= "<option value=''>-</option>\n";
		$i = 0;		
		foreach ($a_aValues as $value) 
		{	
			if($a_sPreSelect != null && $a_sPreSelect == $value)
				$sSelected = "selected";
			else 
				$sSelected = null;
			$sString .= "<option " . $sSelected . " value='" . htmlspecialchars($value, ENT_QUOTES) . "'>" . $a_aOutput[$i] . "</option>\n";		
			$i++;
		}				
		$sString .= "</select>\n";
		
		return $sString;
	}	

	public function getSelectYear($a_sName, $a_iEndYear = null, $a_iPreselectYear = null, $a_sClass = null, $a_sCustomText = null)
	{
		$iYear = date("Y");
		
		if($a_iEndYear == null)
			$a_iEndYear = 1889;

		$aYears = array();
		
		for($i = $iYear; $i >= $a_iEndYear; $i--)
		{
			array_push($aYears, $i);
		}

		return $this->getSelect($a_sName, $aYears, $a_iPreselectYear, $a_sClass, $a_sCustomText);
	}
	
	public function getSelectMonth($a_sName, $a_iPreselectMonth = null, $a_sClass = null, $a_sCustomText = null)
	{
		if($a_sClass != null)
			$sClass = "class='" . $a_sClass . "'";
		else 
			$sClass = null;	
		
		$sString  = "<select name='" . $a_sName . "' id='" . $a_sName . "' " . $sClass . " " . $a_sCustomText . " >\n";		
		$sString .= "<option value=''>-</option>\n";
		for($i=1; $i < 13; $i++)
		{
			if($i < 10)
				$iOut = "0" . $i;
			else
				$iOut = $i;
			
			if($a_iPreselectMonth == $i)
				$sSelected = "selected";
			else 
				$sSelected = null;		

			$sString .= "<option " . $sSelected . " value='" . htmlspecialchars($iOut, ENT_QUOTES) . "'>" . $iOut . "</option>\n";
		}
		$sString .= "</select>\n";
			
		return $sString;	
	}

	public function getSelectDay($a_sName, $a_iPreselectDay = null, $a_sClass = null, $a_sCustomText = null)
	{
		if($a_sClass != null)
			$sClass = "class='" . $a_sClass . "'";
		else 
			$sClass = null;
			
		$sString  = "<select name='" . $a_sName . "' id='" . $a_sName . "' " . $sClass . " " . $a_sCustomText . ">\n";	
		$sString .= "<option value=''>-</option>\n";

		for($i=1; $i < 31; $i++)
		{
			if($i < 10)
				$iOut = "0".$i;
			else
				$iOut = $i;
			
			if($a_iPreselectDay == $i)
				$sSelected = "selected";
			else 
				$sSelected = null;		

			$sString .= "<option " . $sSelected . " value='" . htmlspecialchars($iOut, ENT_QUOTES) . "'>" . $iOut . "</option>\n";
		}
		$sString .= "</select>\n";		

		return $sString;		
	}
	
	public function getFileInput($a_sName, $a_iSize = null, $a_sClass = null, $a_sCustomText)
	{
		if($a_sClass != null)
			$sClass = "class='" . $a_sClass . "'";
		else 
			$sClass = null;	
			
		if($a_iSize != null)
			$sSize = "size='" . $a_iSize . "'";
			
		return "<input type='file' id='" . $a_sName . "' name='" . $a_sName . "' " . $sSize . "  " . $sClass . " " . $a_sCustomText . " />";
	}
	
	public function getHiddenInput($a_sName, $a_sValue, $a_sCustomText = null)
	{
		$a_sValue = htmlspecialchars($a_sValue, ENT_QUOTES);
		return "<input type='hidden' id='" . $a_sName . "' name='" . $a_sName . "' value='". $a_sValue ."' " . $a_sCustomText . " />";
	}
	
	// requires an array with the months-names, and one with the month ids
	public function getDateSelectMonthString($a_aMonthsNames, $a_aMonthsIDs, $a_sNamePrefix = null, $a_iPreselectYear = null, $a_iPreselectMonth = null, $a_iPreselectDay = null, $a_sClass = null)
	{
		$iYear = date("Y");
		
		if($a_sClass != null)
			$sClass = "class='".$a_sClass."'";
		else 
			$sClass = null;
			
		$sString = "<select name='" . $a_sNamePrefix . "Year' " . $sClass . " >\n";
		$sString .= "<option value=''>-</option>\n";
		for($i=$iYear; $i > 1899; $i--)
		{			
			if($a_iPreselectYear == $i)
				$sSelected = "selected";
			else 
				$sSelected = null;		

			$sString .= "<option " . $sSelected . " value='" . htmlspecialchars($i, ENT_QUOTES) . "'>" . $i . "</option>\n";
		}
		$sString .= "</select>\n";
		
		$sString .= " ";			
		$sString .= "<select name='" . $a_sNamePrefix . "Month' " . $sClass . " >\n";		
		$sString .= "<option value=''>-</option>\n";
		for($i=0; $i < 12; $i++)
		{
				$iOut = $a_aMonthsNames[$i];
				$iVal = $a_aMonthsIDs[$i];
				
			if($a_iPreselectMonth == ($i+1) && $a_iPreselectMonth != null)
			{
				$sSelected = "selected";
			}
			else 
				$sSelected = null;		

			$sString .= "<option " . $sSelected . " value='" . htmlspecialchars($iVal, ENT_QUOTES) . "'>" . $iOut . "</option>\n";
		}
		$sString .= "</select>\n";
		
		$sString .= "<select name='" . $a_sNamePrefix . "Day' " . $sClass . " >\n";	
		$sString .= "<option value=''>-</option>\n";
		for($i=1; $i < 31; $i++)
		{
			if($i < 10)
				$iOut = "0".$i;
			else
				$iOut = $i;
			
			if($a_iPreselectDay == $i)
				$sSelected = "selected";
			else 
				$sSelected = null;		

			$sString .= "<option " . $sSelected . " value='" . htmlspecialchars($iOut, ENT_QUOTES) . "'>" . $iOut . "</option>\n";
		}
		$sString .= "</select>\n";		

		return $sString;
	}
	
	public function getTimeSelect($a_sNamePrefix = null, $a_iPreselectHour = null, $a_iPreselectMinute = null, $a_sClass)
	{
		if($a_sClass != null)
			$sClass = "class='" . $a_sClass . "'";
		else 
			$sClass = null;
			
		$sString = "<select name='" . $a_sNamePrefix . "Hour' " . $sClass . " >\n";
		$sString .= "<option value=''>-</option>\n";
		for($i=0; $i < 24; $i++)
		{						
			if($i < 10)
				$iOut = "0".$i;
			else 
				$iOut = $i;
			
			if($a_iPreselectHour == $iOut)
			$sSelected = "selected";
			else 
			$sSelected = null;
						
			$sString .= "<option " . $sSelected . " value='" . htmlspecialchars($iOut, ENT_QUOTES) . "'>" . $iOut . "</option>\n";
		}
		$sString .= "</select>\n";

		$sString .= "<select name='" . $a_sNamePrefix . "Minute' " . $sClass . " >\n";
		$sString .= "<option value=''>-</option>\n";
		for($i=0; $i < 61; $i++)
		{					
			if($i < 10)
				$iOut = "0".$i;
			else 
				$iOut = $i;

			if($a_iPreselectMinute == $iOut)
				$sSelected = "selected";
			else 
				$sSelected = null;
			$sString .= "<option " . $sSelected . " value='" . htmlspecialchars($iOut, ENT_QUOTES) . "'>" . $iOut . "</option>\n";
		}
		$sString .= "</select>\n";

		return $sString;	
	}
	
	public function getTableForm(&$a_oForm, $a_sTableClass = null, $a_iTableWidth = null, $a_sTRClass = null, $a_sTDClass = null, $a_iTDWidth = null)
	{
		$sTableClass = null;
		$sTRClass = null;
		$sTDClass = null;
		$iTDWidth = null;
		$iTableWidth = null;
		
		if($a_sTableClass != null)
			$sTableClass = "class='" . $a_sTableClass . "'";
			
		if($a_sTRClass != null)
			$sTRClass = "class='" . $a_sTRClass . "'";
			
		if($a_sTDClass != null)
			$sTDClass = "class='" . $a_sTDClass . "'";

		if($a_iTDWidth != null)
			$iTDWidth = "width='" . $a_iTDWidth . "'";

		if($a_iTableWidth != null)
			$iTableWidth = "width='" . $a_iTableWidth . "'";
			
		if($a_oForm->displayForm($a_oForm))
		{
			$sString = $a_oForm->getFormStart() . "<br />";
			$sString.= "\n<table " . $sTableClass . " " . $iTableWidth . " >";
			$aInputs = $a_oForm->getInputs();
			// loop through all inputs
			foreach($aInputs as $input)
			{			
				$sString .= "\n<tr " . $sTRClass . " >\n";
				$sString .= "<td " . $sTDClass . " " . $iTDWidth . " valign='top' >" . $input['label'] . "</td>\n";
				$sString .=	"<td " . $sTDClass . " valign='top' >\n";
				
				if(isset($input['isGroup']) && $input['isGroup'] == true)
				{
					// a group input, get the input name
					// loop through all inputs on the name index
					foreach($input['names'] as $groupInputName)
					{
						$sString .= $input[$groupInputName]['input'];
						$sString .= $input[$groupInputName]['output'];
						//if(isset($input[$groupInputName]['verValue']))
							//$sString .= $input[$groupInputName]['verValue'];
					}
					
					// set the verification values
					if(isset($input['verValue']))
						$sString .= $input['verValue'];
				}
				else
				{
					// a "normal" input
					if(isset($input['input']) && $input['input'] != null)
					{
						$sString .=	$input['input'];
							if(isset($input['verValue']))
								$sString .=	$input['verValue'];
					}
				
				}
				
				$sString .= "</td>\n";
				$sString .= "</tr>\n";			
			}
	
			$sString .= "\n<tr " . $sTRClass . " >\n";
			$sString .=	"<td " . $sTDClass . " valign='top' >";
			$sString .= "<td " . $sTDClass . " valign='top' >" . $a_oForm->getButtons() . "</td>\n"; 
			$sString .= "</tr>\n";
			$sString .= $a_oForm->getFormEnd();

			return $sString;
		}
		else
		{
			return false;
		}
	}
}
?>