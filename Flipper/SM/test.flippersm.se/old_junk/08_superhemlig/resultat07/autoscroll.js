<!--
///  This JavaScript script automatically scrolls the HTML document.
///
///  This script will work, only if the browser's scrollbar is enabled,
///  so the document has to be of reasonable length.
///  Depending on the length of the document you will have to adjust the
///  height value at the top of the script.
///
///  Paste this snippet into the <head> section of your HTML document.
///
///  Original JavaScript. AutoScrollDocument
///  Author: Debjyoti Das.
///  Author URL: http://ddas77.tripod.com
///  Author EMail: ddas77@denmail.every1.net
///		   ddas77@email.com
///		   debjyoti_das77@yahoo.com
///  Author ICQ: 82485009
///
///  Date: Thursday, January 23, 2003, 5:04 PM IST
///
///  Copyright (C) 2003, ddas77.tripod.com. All Rights Reserved.
///  You are free to reuse this code snippet.
///  Please have the courtesy to keep this header message intact.
///

var timer	= 0;
// the following value corresponds to the height of the document
var height	= 100000;	// change this value to that of the original...
                        //   ...height of your document.
var scrollSpeed = 80;	// speed control for scrolling; ...
                        //   ...a lower value corresponds to a faster speed
var scrollRate 	= 2;	// amount of units scrolled at a time
var initWait	= 4000;	// time to wait after loading the document and...
                        //   ...before running this script.

function transport(h)
{
	window.scroll(0, h)
	setTimeout("polling()", scrollSpeed)
}

function polling()
{
	if(timer > height)
	{
		timer = 0
	}
	h = (timer * scrollRate)
	timer++
	transport(h);
}

// commenting the following line, disables document scrolling
setTimeout("polling()", initWait);

//-->
