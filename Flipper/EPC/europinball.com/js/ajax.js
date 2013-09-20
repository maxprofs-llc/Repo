function getPage(url, post, async, destFunc) {
  debug('URL: ' + url + ' POST: ' + post);
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = destFunc;
  xmlhttp.open("POST",url,async);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(post);
}

function getJson(url, post, async, outId, format) {
//  getPage(url, post, async, function() {
  $.getJSON(url, post, function(json) {
    switch (format) {
      case 'json':
        document.getElementById(outId).innerHTML = json;
      break;
      case 'table':
        cnvJsonTable(json, 'player', outId);
      break;
    }
  });
}




