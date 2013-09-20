function getJson(url, post, type, outId, format) {
  outId = outId || type;
  format = format || 'table';
  debug('url: ' + url + ' post: ' + post + ' type: ' + type + ' outId: ' + outId + ' format: ' + format);
  $.getJSON(url, post, function(data) {
    switch (format) {
      case 'json':
        document.getElementById(outId).innerHTML = varDump(data).replace('\n', '<br>');
        return data;
      break;
      case 'table':
        debug(data);
        cnvJsonTable(data, type, outId);
        $('#' + outId + '_loading').remove();
        hideTables(outId);
        $('#' + outId).dataTable({'bProcessing': true});
      break;
      case 'select':
        var select = document.getElementById(outId);
        select.innerHTML = null;
        debug(data.length, 'Json length');
        if (data.length) {
          addOption({id: 0, name: 'Choose ' + type + '...'}, select);
          for (var obj in data) {
            addOption(data[obj], select);
          }
        } else {
          addOption({id: 0, name: 'No ' + getPlural(type) + ' found.'}, select);
        }
        if (type != 'continent' && type != 'country') {
          addOption({id: -1, name: 'Add new ' + type + '...'}, select);
        }
      break;
    }
  }).fail(function(){
    switch (format) {
      case 'table':
        hideTables(outId);
      break;
      case 'table':
        var select = document.getElementById(outId);
        select.innerHTML = null;
        addOption({id: 0, name: 'No ' + getPlural(type) + ' found.'}, select);
      break;
    }
  });
}

function hideTables(table){
  debug(table + ': ' + $('#' + table + ' >tbody >tr').length);
  if($('#' + table + ' >tbody >tr').length) {
    $('#' + table + '_div').show();
  } else {
    $('#' + table + '_div').hide();
  }
}

function popTable(type) {
  var id = ($.url().param('id')) ? 'id=' + $.url().param('id') : '';
  var getAll = ($.url().param('id')) ? true : false;
  var start = false;
  var types = geoTypes;
  types.push('player');
  for (var field in types) {
    id = ($.url().param(types[field] + '_id')) ? types[field] + '_id=' + $.url().param(types[field] + '_id') : id ;
    getAll = ($.url().param(types[field] + '_id')) ? true : getAll ;
    if (type == types[field]) {
      start = true;
    }
    if (start) {
      debug('ajax/' + types[field] + '.php ' + id + ' ' + types[field]);
      getJson('ajax/' + types[field] + '.php', id, types[field]);
      if (getAll) {
        var a = document.createElement('a');
        a.href = types[field] + '.php' + (($.url().param('debug')) ? '?debug=1' : '');
        var text = document.createTextNode('Get all of them.');
        a.appendChild(text);
        var text = document.createTextNode('. These are not all ' + getPlural(types[field]) + '. ');
        document.getElementById(types[field] + '_all').appendChild(text);
        document.getElementById(types[field] + '_all').appendChild(a);
      }
    }
    if (type == types[field] && $.url().param('id')) {
      id = types[field] + '_id=' + $.url().param('id');
    }
  }
}

function addOption(obj, sel, selected) {
  var option = document.createElement('option');
  option.value = obj.id;
  option.text = getName(obj);
  if (sel) {
    sel.add(option);
    sel.selected = (selected) ? true : false;
  }
  return option;
}

function popRegForm() {
  geoSelected();
}

function geoSelected(select) {
  if (select) {
    var type = select.id.toString().replace('Select', '').toLowerCase();
    var condition = type + '_id=' + select.value;
    var start = false;
  } else {
    var start = true;
  }
  if (select && select.value == -1) {
    // Add new!
  } else {
    for (var field in geoTypes) {
      if (start) {
        if (select) {
          document.getElementById(geoTypes[field] + 'Select').innerHTML = null;
          addOption({id: 0, name: 'Loading...'}, document.getElementById(geoTypes[field] + 'Select'));
        }
        getJson('ajax/' + geoTypes[field] + '.php', condition, geoTypes[field], geoTypes[field] + 'Select', 'select');    
      } else if (geoTypes[field] == type) {
        start = true;
      } else if (select) {
        getParents(type, select.value);
      }
    }
  }
}

function getParents(type, id, format) {
  format = (format) ? format : 'select';
  $.getJSON('ajax/' + type + '.php', 'id=' + id, function(data) {
    revTypes = geoTypes;
    revTypes.reverse();
    var start = false;
    for (var field in revTypes) {
      switch (format) {
        case 'select':
          if (start) {
            start = true;
            if (data.length > 0 && data[0][revTypes[field] + '_id']) {
              setSelValue(document.getElementById(revTypes[field] + 'Select'), data[0][revTypes[field] + '_id']);
//              geoSelected(document.getElementById(revTypes[field] + 'Select'));
//              return true;
            }
          } else if (geoTypes[field] == type) {
            start = true;
          }
        break;
      }
    }
  });
}

function getHeaders(type) {
  var headers = {};
  switch (type) {
    case 'player':
      headers.headers = ['Name', 'Initials', 'City', 'Region', 'Country', 'Continent'];
      headers.links = ['parent', false, 'self', 'self', 'self', 'self']
    break;
    case 'city':
      headers.headers = ['Name', 'Region', 'Country', 'Continent', 'Latitude', 'Longitude'];
      headers.links = ['parent', 'self', 'self', 'self', false, false]
    break;
    case 'region':
      headers.headers = ['Name', 'Country', 'Continent', 'Latitude', 'Longitude'];
      headers.links = ['parent', 'self', 'self', false, false]
    break;
    case 'country':
      headers.headers = ['Name', 'Continent', 'Latitude', 'Longitude'];
      headers.links = ['parent', 'self', false, false]
    break;
    case 'continent':
      headers.headers = ['Name', 'Latitude', 'Longitude'];
      headers.links = ['parent', false, false]
    break;
  }
  return headers;
}

function getName(obj) {
  switch (getType(obj)) {
    case 'object':
      var name = obj.name
    break;
    case 'null': 
      var name = '';
    break;
    case 'string':
    default:
      var name = obj;
    break;
  }
  return name;
}

function getLink(obj, type) {
  type = type || obj.class;
  var a = document.createElement('a');
  a.href = type + '.php?id=' + obj.id + (($.url().param('debug')) ? '&debug=1' : '');
  var text = document.createTextNode(getName(obj));
  a.appendChild(text);  
  return a;
}

function tableHeaders(thead, headers) {
  var tr = thead.insertRow(-1);
  tr.className = 'header';
  for (var header in headers.headers) {
    var th = document.createElement('th');
    tr.appendChild(th)
    th.appendChild(document.createTextNode(headers.headers[header]));
  }
  return thead;
}

function tableRows(tbody, obj, headers) {
  for (i=0; i<obj.length; i++) {
    var tr = tbody.insertRow(-1);
    for (var header in headers.headers) {
      field = headers.headers[header].toLowerCase();
      var td = tr.insertCell(-1);
      if (obj[i][field]) {
        switch (headers.links[header]) {
          case 'parent':
            var a = getLink(obj[i]);
            td.appendChild(a);
          break;
          case 'self':
            var a = getLink(obj[i][field]);
            td.appendChild(a);
          break;
          default:
            td.appendChild(document.createTextNode(obj[i][field]));
          break;
        }
      }
    }
  }
  return tr;
}

function cnvJsonTable (obj, type, outId) {
  var headers = getHeaders(type);
  var tbl = document.getElementById(outId);
  var thead = tbl.createTHead();
  tableHeaders(thead, headers);
  var tbody = tbl.appendChild(document.createElement('tbody'));
  tableRows(tbody, obj, headers);
  // debug(tbl.innerHTML);
  return tbl;
}
