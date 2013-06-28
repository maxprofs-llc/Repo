var dayArrayShort = new Array(
	'S&ouml;',
	'M&aring;',
	'Ti',
	'On',
	'To',
	'Fr',
	'L&ouml;'
);

var dayArrayMed = new Array(
	'S&ouml;n',
	'M&aring;n',
	'Tis',
	'Ond',
	'Tor',
	'Fre',
	'L&ouml;r'
);

var dayArrayLong = new Array(
	'S&ouml;ndag',
	'M&aring;ndag',
	'Tisdag',
	'Onsdag',
	'Torsdag',
	'Fredag',
	'L&ouml;rdag'
);

var monthArrayShort = new Array(
	'Jan',
	'Feb',
	'Mar',
	'Apr',
	'Maj',
	'Jun',
	'Jul',
	'Aug',
	'Sep',
	'Okt',
	'Nov',
	'Dec'
);
var monthArrayMed = new Array(
	'Jan',
	'Feb',
	'Mars',
	'April',
	'Maj',
	'Juni',
	'Juli',
	'Aug',
	'Sept',
	'Okt',
	'Nov',
	'Dec'
);
var monthArrayLong = new Array(
	'Januari',
	'Februari',
	'Mars',
	'April',
	'Maj',
	'Juni',
	'Juli',
	'Augusti',
	'September',
	'Oktober',
	'November',
	'December'
);

var cancelHide=false;

var todayDate = new Date();

var todayYear = todayDate.getFullYear();
var todayMonth = (+todayDate.getMonth() + 1);
var todayDay = todayDate.getDate();
var todayWeekDay = todayDate.getDay();

var todayYearStr = todayYear.toString();
var todayMonthStr = (todayMonth.toString().length < 2) ? '0' + todayMonth : todayMonth;
var todayDayStr = (todayDay.toString().length < 2) ? '0' + todayDay : todayDay;
var todayWeekDayStr = (todayWeekDay.toString().length < 2) ? '0' + todayWeekDay : todayWeekDay;

var todayDateStr = todayYearStr + '-' + todayMonthStr + '-' + todayDayStr;

var datePickerDivID = "datepicker";
var iFrameDivID = "datepickeriframe";
 
var defaultDateSeparator = "-";
var defaultDateFormat = "ymd" 
var dateSeparator = defaultDateSeparator;
var dateFormat = defaultDateFormat;

function displayDatePicker(dateFieldId, displayBelowThisObject, dtFormat, dtSep) {
	
  var targetDateField = document.getElementById(dateFieldId);

	if (!displayBelowThisObject)
    displayBelowThisObject = targetDateField;
 
  if (dtSep)
    dateSeparator = dtSep;
  else
    dateSeparator = defaultDateSeparator;
 
  if (dtFormat)
    dateFormat = dtFormat;
  else
    dateFormat = defaultDateFormat;

  var x = displayBelowThisObject.offsetLeft;
  var y = displayBelowThisObject.offsetTop + displayBelowThisObject.offsetHeight;
 
  var parent = displayBelowThisObject;
  while (parent.offsetParent) {
    parent = parent.offsetParent;
    x += parent.offsetLeft;
    y += parent.offsetTop ;
  }
 
  drawDatePicker(targetDateField, x, y);
}

function hideDatePicker() {
	if(cancelHide)
		return;
	var pickerDiv = document.getElementById(datePickerDivID);
	pickerDiv.style.visibility="hidden";
	pickerDiv.style.display="none";
	adjustiFrame(pickerDiv,document.getElementById(iFrameDivID));
}

function drawDatePicker(targetDateField, x, y) {
  var dt = getFieldDate(targetDateField.value );
  if (!document.getElementById(datePickerDivID)) {
    var newNode = document.createElement("div");
    newNode.setAttribute("id", datePickerDivID);
    newNode.setAttribute("class", "dpDiv");
    newNode.setAttribute("style", "visibility: hidden;");
    document.body.appendChild(newNode);
  }
 
  var pickerDiv = document.getElementById(datePickerDivID);
  pickerDiv.style.position = "absolute";
  pickerDiv.style.left = x + "px";
  pickerDiv.style.top = y + "px";
  //pickerDiv.style.visibility = (pickerDiv.style.visibility == "visible" ? "hidden" : "visible");
  pickerDiv.style.visibility="visible";
  //pickerDiv.style.display = (pickerDiv.style.display == "block" ? "none" : "block");
  pickerDiv.style.display="block";
  if (document.getElementById('timePicker')) {
    document.getElementById('timePicker').style.display = (pickerDiv.style.visibility == "visible") ? 'none' : '';
  }
  pickerDiv.style.zIndex = 10000;
 
  refreshDatePicker(targetDateField.id, dt.getFullYear(), dt.getMonth(), dt.getDate());
}

function refreshDatePicker(dateFieldId, year, month, day) {
	cancelHide=true;
	var thisDay = new Date();
 
  if ((month >= 0) && (year > 0)) {
    thisDay = new Date(year, month, 1);
  } else {
    day = thisDay.getDate();
    thisDay.setDate(1);
  }
 
  var crlf = "\r\n";
  var TABLE_buttons = "<table cols=6 border='0' cellspacing='0'>" + crlf;
  var TABLE = "<table cols=7 class='dpTable'>" + crlf;
  var xTABLE = "</table>" + crlf;
  var TR = "<tr class='dpTR'>";
  var TR_title = "<tr class='dpTitleTR'>";
  var TR_days = "<tr class='dpDayTR'>";
  var TR_todaybutton = "<tr class='dpTodayButtonTR'><td colspan='7'><table class='dpTodayButtonTABLE'><tr class='dpTodayButtonTR'>";
  var xTR = "</tr>" + crlf;
  var TD = "<td class='dpTD' onMouseOut='this.className=\"dpTD\";' onMouseOver=' this.className=\"dpTDHover\";' ";
  var TD_title = "<td colspan='7' class='dpTitleTD'>";
  var TD_buttons = "<td class='dpButtonTD'>";
  var TD_buttonrow = "<td colspan='7' align='center'>";
  var TD_todaybutton = "<td class='dpTodayButtonTD'>";
  var TD_monthbutton = "<td class='dpThisMonthButtonTD'>";
  var TD_closebutton = "<td class='dpCloseButtonTD'>";
  var TD_days = "<td class='dpDayTD'>";
  var TD_selected = "<td class='dpDayHighlightTD' onMouseOut='this.className=\"dpDayHighlightTD\";' onMouseOver='this.className=\"dpTDHover\";' ";
  var TD_today = "<td class='dpDayTodayTD' onMouseOut='this.className=\"dpDayTodayTD\";' onMouseOver='this.className=\"dpTDHover\";' ";
  var xTD = "</td>" + crlf;
  var DIV_title = "<div class='dpTitleText'>";
  var DIV_selected = "<div class='dpDayHighlight'>";
  var DIV_today = "<div class='dpDayToday'>";
  var xDIV = "</div>";
 
  var html = TABLE;
 
  html += TR_title;
  html += TD_title + DIV_title + '&nbsp;' + monthArrayLong[ thisDay.getMonth()] + ' ' + thisDay.getFullYear() + '&nbsp;' + xDIV + xTD;
  html += xTR;
  html += TR_title;
  html += TD_buttonrow;
  html += TABLE_buttons;
  html += TR_title;
  html += TD_buttons + "<button class='dpButton' " + getButtonCode(dateFieldId, thisDay, -120, "&lsaquo;&laquo;") + xTD;
  html += TD_buttons + "<button class='dpButton' " + getButtonCode(dateFieldId, thisDay, -12, "&laquo;") + xTD;
  html += TD_buttons + "<button class='dpButton' " + getButtonCode(dateFieldId, thisDay, -1, "&lsaquo;") + xTD;
  html += TD_buttons + "<button class='dpButton' " + getButtonCode(dateFieldId, thisDay, 1, "&rsaquo;") + xTD;
  html += TD_buttons + "<button class='dpButton' " + getButtonCode(dateFieldId, thisDay, 12, "&raquo;") + xTD;
  html += TD_buttons + "<button class='dpButton' " + getButtonCode(dateFieldId, thisDay, 120, "&raquo;&rsaquo;") + xTD;
  html += xTR;
  html += xTABLE;
  html += xTD;
  html += xTR;
 
  html += TR_days;
  for(i = 0; i < dayArrayShort.length; i++)
    html += TD_days + dayArrayShort[i] + xTD;
  html += xTR;
 
  html += TR;
 
  for (i = 0; i < thisDay.getDay(); i++)
    html += TD + "&nbsp;" + xTD;

do {
    dayNum = thisDay.getDate();
    TD_onclick = " onclick=\"updateDateField('" + dateFieldId + "', '" + getDateString(thisDay) + "');\">";
    
    if (dayNum == day)
      html += TD_selected + TD_onclick + DIV_selected + dayNum + xDIV + xTD;
	  else if ((dayNum == todayDay) && (thisDay.getMonth() == (+todayMonth -1)) && (thisDay.getFullYear() == todayYear))
      html += TD_today + TD_onclick + DIV_today + dayNum + xDIV + xTD;
    else
      html += TD + TD_onclick + dayNum + xTD;
    
    if (thisDay.getDay() == 6)
      html += xTR + TR;
    
    thisDay.setDate(thisDay.getDate() + 1);
  } while (thisDay.getDate() > 1)
 
  if (thisDay.getDay() > 0) {
    for (i = 6; i > thisDay.getDay(); i--)
      html += TD + "&nbsp;" + xTD;
  }
  html += xTR;
 
  var todayString = "Idag är det " + dayArrayMed[todayWeekDay] + ", " + todayDay + " " + monthArrayMed[(+todayMonth - 1)] + " " + todayYear;
//	debug(todayString);
	html += TR_todaybutton + TD_todaybutton;
  html += "<button class='dpTodayButton' onClick='refreshDatePicker(\"" + dateFieldId + "\");updateDateField(\"" + dateFieldId + "\", \"" + getDateString(todayDate) + "\");'>Idag</button> " + xTD;
	html += TD_monthbutton;	
  html += "<button class='dpTodayButton'  onClick=\"$(\'" + dateFieldId + "\').value=\'\';\">Inget</button>"+ xTD;
	html += TD_closebutton;
  html += "<button class='dpTodayButton' onClick=\"$(\'" + dateFieldId + "\').value=\'0000-00-00\';\">Ok&auml;nt</button>";
  html += xTD + xTR + xTABLE;
 
  html += xTABLE;
 
  document.getElementById(datePickerDivID).innerHTML = html;
  adjustiFrame();
  window.setTimeout(function() {
	  cancelHide=false;
  },300);  
}


function getButtonCode(dateFieldId, dateVal, adjust, label) {
  var newMonth = (dateVal.getMonth () + adjust) % 12;
  var newYear = dateVal.getFullYear() + parseInt((dateVal.getMonth() + adjust) / 12);
  if (newMonth < 0) {
    newMonth += 12;
    newYear += -1;
  }
 
  return "onClick='refreshDatePicker(\"" + dateFieldId + "\", " + newYear + ", " + newMonth + ");'>" + label + "</button>";
}


function getDateString(dateVal) {
  var dayString = "00" + dateVal.getDate();
  var monthString = "00" + (dateVal.getMonth()+1);
  dayString = dayString.substring(dayString.length - 2);
  monthString = monthString.substring(monthString.length - 2);
 
  switch (dateFormat) {
    case "dmy" :
      return dayString + dateSeparator + monthString + dateSeparator + dateVal.getFullYear();
    case "ymd" :
      return dateVal.getFullYear() + dateSeparator + monthString + dateSeparator + dayString;
    case "mdy" :
    default :
      return monthString + dateSeparator + dayString + dateSeparator + dateVal.getFullYear();
  }
}

function getFieldDate(dateString) {
  var dateVal;
  var dArray;
  var d, m, y;
 
  try {
    dArray = splitDateString(dateString);
    if (dArray) {
      switch (dateFormat) {
        case "dmy" :
          d = parseInt(dArray[0], 10);
          m = parseInt(dArray[1], 10) - 1;
          y = parseInt(dArray[2], 10);
        break;
        case "ymd" :
          d = parseInt(dArray[2], 10);
          m = parseInt(dArray[1], 10) - 1;
          y = parseInt(dArray[0], 10);
        break;
        case "mdy" :
        default :
          d = parseInt(dArray[1], 10);
          m = parseInt(dArray[0], 10) - 1;
          y = parseInt(dArray[2], 10);
        break;
      }
      dateVal = new Date(y, m, d);
    } else if (dateString) {
      dateVal = new Date(dateString);
    } else {
      dateVal = new Date();
    }
  } catch(e) {
    dateVal = new Date();
  }
 
  return dateVal;
}


function splitDateString(dateString) {
  var dArray;
  if (dateString.indexOf("/") >= 0)
    dArray = dateString.split("/");
  else if (dateString.indexOf(".") >= 0)
    dArray = dateString.split(".");
  else if (dateString.indexOf("-") >= 0)
    dArray = dateString.split("-");
  else if (dateString.indexOf("\\") >= 0)
    dArray = dateString.split("\\");
  else
    dArray = false;
 
  return dArray;
}

/*
function datePickerClosed(dateField) {
  var dateObj = getFieldDate(dateField.value);
  var today = new Date();
  today = new Date(today.getFullYear(), today.getMonth(), today.getDate());
 
  if (dateField.name == "StartDate") {
    if (dateObj < today) {
      alert("Allvarligt, det där datumet har ju redan varit!");
      dateField.value = "";
      document.getElementById(datePickerDivID).style.visibility = "visible";
      adjustiFrame();
    } else {
      dateObj.setTime(dateObj.getTime() + (7 * 24 * 60 * 60 * 1000));
      var endDateField = document.getElementsByName ("EndDate").item(0);
      endDateField.value = getDateString(dateObj);
    }
  }
}
*/

function updateDateField(dateFieldId, dateString) {
	cancelHide=true;
	console.log('UPDATE');
  var targetDateField = document.getElementById(dateFieldId);
  if (dateString)
    targetDateField.value = dateString;
  targetDateField.fireEvent('change');
  
  var pickerDiv = document.getElementById(datePickerDivID);
  pickerDiv.style.visibility = "hidden";
  pickerDiv.style.display = "none";
 
  adjustiFrame();
  targetDateField.focus();
 
  if ((dateString) && (typeof(datePickerClosed) == "function"))
    datePickerClosed(targetDateField);
  
  window.setTimeout(function() {
	  cancelHide=false;
  },300);
}

function adjustiFrame(pickerDiv, iFrameDiv)
{
  var is_opera = (navigator.userAgent.toLowerCase().indexOf("opera") != -1);
  if (is_opera)
    return;
  
	try {
		if (!document.getElementById(iFrameDivID)) {
			var newNode = document.createElement("iFrame");
			newNode.setAttribute("id", iFrameDivID);
			newNode.setAttribute("src", "javascript:false;");
			newNode.setAttribute("scrolling", "no");
			newNode.setAttribute ("frameborder", "0");
			document.body.appendChild(newNode);
		}
	
		if (!pickerDiv)
			pickerDiv = document.getElementById(datePickerDivID);
		if (!iFrameDiv)
			iFrameDiv = document.getElementById(iFrameDivID);

		try {
			iFrameDiv.style.position = "absolute";
			iFrameDiv.style.width = pickerDiv.offsetWidth;
			iFrameDiv.style.height = pickerDiv.offsetHeight ;
			iFrameDiv.style.top = pickerDiv.style.top;
			iFrameDiv.style.left = pickerDiv.style.left;
			iFrameDiv.style.zIndex = pickerDiv.style.zIndex - 1;
			iFrameDiv.style.visibility = pickerDiv.style.visibility ;
			iFrameDiv.style.display = pickerDiv.style.display;
		} catch(e) {
		}
	} catch (ee) {
	}
}

