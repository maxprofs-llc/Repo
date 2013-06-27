var scripts = new Array();

var classes = {
  continent: {
    name: 'continent',
    geo: true,
    plural: 'continents',
    headers: ['name', 'latitude', 'longitude'],
    complete: false
  },
  country: {
    name: 'country',
    geo: true,
    plural: 'countries',
    headers: ['name', 'continent', 'latitude', 'longitude'],
    complete: false
  },
  region: {
    name: 'region',
    geo: true,
    plural: 'regions',
    headers: ['name', 'country', 'continent', 'latitude', 'longitude'],
    complete: false
  },
  city: {
    name: 'city',
    geo: true,
    plural: 'cities',
    headers: ['name', 'region', 'country', 'continent', 'latitude', 'longitude'],
    complete: false
  },
  player: {
    name: 'player',
    geo: false,
    plural: 'players',
    headers: ['name', 'initials', 'city', 'region', 'country', 'continent'],
    complete: false
  }
}

var continents = [];
var countries = [];
var regions = [];
var cities = [];
var players = [];

function CONTINENT(data) {
  if (continents.indexOf(data) == -1) {
    this.id = data.id;
    this.name = data.name;
    this.altName = data.altName;
    this.class = 'continent';
    this.comment = data.comment;
    this.latitude = data.latitude;
    this.longitude = data.longitude;
    this.countries = [];
    this.regions = [];
    this.cities = [];
    this.players = [];
    this.link = addLink(this);
    if (this.id !=0) {
      continents.push(this);
    }
  } else {
    this.remove();
  }
}

CONTINENT.prototype = {
  remove:  function() {
    continents.splice(continents.indexOf(this),1);
  },
  addCountry: function(country) {
    if (this.countries.indexOf(country) == -1) {
      this.countries.push(country);
      country.continent_id = this.id;
    }
  },
  addRegion: function(region) {
    if (this.regions.indexOf(region) == -1) {
      this.regions.push(region);
      region.continent_id = this.id;
    }
  },
  addCity: function(city) {
    if (this.cities.indexOf(city) == -1) {
      this.cities.push(city);
      city.continent_id = this.id;
    }
  },
  addPlayers: function(player) {
    if (this.players.indexOf(player) == -1) {
      this.players.push(player);
      player.continent_id = this.id;
    }
  },
  addParents: function() {
  },
  addLinks: function() {
    this.links = {
      name: this.link,
      latitude: false,
      longitude: false
    }
  }
}

function COUNTRY(data) {
  if (countries.indexOf(data) == -1) {
    this.id = data.id;
    this.name = data.name;
    this.altName = data.altName;
    this.class = 'country';
    this.comment = data.comment;
    this.latitude = data.latitude;
    this.longitude = data.longitude;
    this.continent_id = data.continent_id;
    this.capitalCity_id = data.capitalCity_id;
    this.regions = [];
    this.cities = [];
    this.players = [];
    this.link = addLink(this);
    if (this.id !=0) {
      countries.push(this);
    }
  } else {
    this.remove();
  }
}

COUNTRY.prototype = {
  remove: function() {
    countries.splice(countries.indexOf(this),1);
    var obj = this.getContinent();
    obj.countries.splice(obj.countries.indexOf(this),1);
  },
  addRegion: function(region) {
    if (this.regions.indexOf(region) == -1) {
      this.regions.push(region);
      region.country_id = this.id;
    }
  },
  addCity: function(city) {
    if (this.cities.indexOf(city) == -1) {
      this.cities.push(city);
      city.country_id = this.id;
    }
  },
  addPlayer: function(player) {
    if (this.players.indexOf(player) == -1) {
      this.players.push(player);
      player.country_id = this.id;
    }
  },
  getContinent: function() {
    return continent(this.continent_id);
  },
  addParents: function() {
    addParent(this, 'continent');
  },
  addLinks: function() {
    this.links = {
      name: this.link,
      continent: addLink(continent(this.continent_id)),
      latitude: false,
      longitude: false
    }
  }
}

function REGION(data) {
  if (regions.indexOf(data) == -1) {
    this.id = data.id;
    this.name = data.name;
    this.altName = data.altName;
    this.class = 'region';
    this.comment = data.comment;
    this.latitude = data.latitude;
    this.longitude = data.longitude;
    this.continent_id = data.continent_id;
    this.country_id = data.country_id;
    this.capitalCity_id = data.capitalCity_id;
    this.cities = [];
    this.players = [];
    this.link = addLink(this);
    if (this.id !=0) {
      regions.push(this);
    }
  } else {
    this.remove();
  }
}

REGION.prototype = {
  remove: function() {
    regions.splice(regions.indexOf(this),1);
    var obj = this.getContinent();
    obj.regions.splice(obj.regions.indexOf(this),1);
    var obj = this.getCountry();
    obj.regions.splice(obj.regions.indexOf(this),1);
  },
  addCity: function(city) {
    if (this.cities.indexOf(city) == -1) {
      this.cities.push(city);
      city.region_id = this.id;
    }
  },
  addPlayer: function(player) {
    if (this.players.indexOf(player) == -1) {
      this.players.push(player);
      player.region_id = this.id;
    }
  },
  getContinent: function() {
    return continent(this.continent_id);
  },
  getCountry: function() {
    return country(this.country_id);
  },
  addParents: function() {
    addParent(this, 'continent');
    addParent(this, 'country');
  },
  addLinks: function() {
    this.links = {
      name: this.link,
      country: addLink(country(this.country_id)),
      continent: addLink(continent(this.continent_id)),
      latitude: false,
      longitude: false
    }
  }
}

function CITY(data) {
  if (cities.indexOf(data) == -1) {
    this.id = data.id;
    this.name = data.name;
    this.altName = data.altName;
    this.class = 'city';
    this.comment = data.comment;
    this.latitude = data.latitude;
    this.longitude = data.longitude;
    this.continent_id = data.continent_id;
    this.country_id = data.country_id;
    this.region_id = data.region_id;
    this.players = [];
    this.link = addLink(this);
    if (this.id !=0) {
      cities.push(this);
    }
  } else {
    this.remove();
  }
}

CITY.prototype = {
  remove: function() {
    cities.splice(cities.indexOf(this),1);
    var obj = this.getContinent();
    obj.cities.splice(obj.cities.indexOf(this),1);
    var obj = this.getCountry();
    obj.cities.splice(obj.cities.indexOf(this),1);
    var obj = this.getRegion();
    obj.cities.splice(obj.cities.indexOf(this),1);
  },
  addPlayer: function(player) {
    if (this.players.indexOf(player) == -1) {
      this.players.push(player);
      player.city_id = this.id;
    }
  },
  getContinent: function() {
    return continent(this.continent_id);
  },
  getCountry: function() {
    return country(this.country_id);
  },
  getRegion: function() {
    return region(this.region_id);
  },
  addParents: function() {
    addParent(this, 'continent');
    addParent(this, 'country');
    addParent(this, 'region');
  },
  addLinks: function() {
    this.links = {
      name: this.link,
      region: addLink(region(this.region_id)),
      country: addLink(country(this.country_id)),
      continent: addLink(continent(this.continent_id)),
      latitude: false,
      longitude: false
    }
  }
}

function PLAYER(data) {
  if (players.indexOf(data) == -1) {
    this.id = data.id;
    this.name = data.name;
    this.class = 'player';
    this.comment = data.comment;
    this.continent_id = data.continent_id;
    this.country_id = data.country_id;
    this.region_id = data.region_id;
    this.city_id = data.city_id;
    this.firstName = data.firstName;
    this.lastName = data.lastName;
    this.initials = data.initials;
    this.gender_id = data.gender_id;
    this.gender = data.gender;
    this.streetAddress = data.streetAddress;
    this.zipCode = data.zipCode;
    this.telephoneNumber = data.telephoneNumber;
    this.mailAddress = data.mailAddress;
    this.dateRegistered = data.dateRegistered;
    this.birthDate = data.birthDate;
    this.link = addLink(this);
    if (this.id !=0) {
      players.push(this);
    }
  } else {
    this.remove();
  }
}

PLAYER.prototype = {
  remove: function() {
    players.splice(players.indexOf(this),1);
    var obj = this.getContinent();
    obj.players.splice(obj.players.indexOf(this),1);
    var obj = this.getCountry();
    obj.players.splice(obj.players.indexOf(this),1);
    var obj = this.getRegion();
    obj.players.splice(obj.players.indexOf(this),1);
    var obj = this.getCity();
    obj.players.splice(obj.players.indexOf(this),1);
  },
  getContinent: function() {
    return continent(this.continent_id);
  },
  getCountry: function() {
    return country(this.country_id);
  },
  getRegion: function() {
    return region(this.region_id);
  },
  getCity: function() {
    return city(this.city_id);
  },
  addParents: function() {
    addParent(this, 'continent');
    addParent(this, 'country');
    addParent(this, 'region');
    addParent(this, 'city');
  },
  addLinks: function() {
    this.links = {
      name: this.link,
      initials: false,
      city: addLink(city(this.city_id)),
      region: addLink(region(this.region_id)),
      country: addLink(country(this.country_id)),
      continent: addLink(continent(this.continent_id))
    }
  }
}

function ucfirst(txt) {
  return txt.substring(0, 1).toUpperCase() + txt.substring(1);    
}

function complete(type) {
  if (type) {
    return (classes[type].complete);
  } else {
    for (var item in classes) {
      if (!complete(item)) {
        return false
      }
    }
    return true;
  }
}

function getObjects(type) {
  if (type) {
    showLoading(classes[type]);
    $.getJSON('ajax/' + type + '.php', null, function(data) {
      if (data.length > 0) {
        for (var obj in data) {
          new window[type.toUpperCase()](data[obj]);
        }
      }
      classes[type].complete = true;
      if (complete()) {
        popGeo();
        popEls($('select'));
        popEls($('table'));
        popEls($('input'));
      }
    });
  } else {
    for (var item in classes) {
      getObjects(classes[item].name);
    }
  }
}

function popEls(els) {
  for (var el in els) {
    switch (getType(els[el])) {
      case 'HTMLSelectElement':
        popSels(els);
      break;
      case 'HTMLTableElement':
        popTbls(els);
      break;
      case 'HTMLInputElement':
        formatInputs(els);
      break;
    }
  }
}

function addOption(obj, sel, selected) {
  var option = document.createElement('option');
  option.value = obj.id;
  option.text = (obj.altName) ? obj.name + ' / ' + obj.altName : obj.name;
  if (sel) {
    sel.add(option);
    sel.selected = (selected) ? true : false;
  }
  return option;
}

function addTypeOptions(sel, type) {
  sel.add(addOption({id: 0, name: 'Choose ' + type.name + '...'}));
  addOptions(sel, window[type.plural]);
}

function addOptions(sel, objs) {
  if (objs.length > 0) {
    for (var obj in objs) {
      sel.add(addOption(objs[obj]));
    }
  } else {
    sel.innerHTML = null;
    sel.add(addOption({id: 0, name: 'None found...'}))
  }
}


function selectOption(sel, id) {
  if (id) {
    for (var option in sel.options) {
      if (sel.options[option].value == id) {
        sel.options[option].selected = true;
        return true;
      }
    }
  } else {
     sel.options[0].selected = true
  }
}

function filterOptions (sel, obj) {
  sel.innerHTML = null;
  sel.add(addOption({id: 0, name: 'Loading...'}))
  showLoading(classes[sel.name]);
  var objs = (obj.id != 0) ? window[classes[sel.name].plural].filter(cmpGeo, obj) : window[classes[sel.name].plural];
  sel.innerHTML = null;
  sel.add(addOption({id: 0, name: 'Choose ' + sel.name + '...'}));
  addOptions(sel, objs);
  hideLoading(classes[sel.name]);
}

function cmpGeo(obj) {
    return (obj[this.class + '_id'] == this.id) ? true : false;
}    

function geoSelected(sel) {
  var start = false;
  for (var item in classes) {
    if (classes[item].geo) {
      var targetSel = document.getElementById(classes[item].name + 'Select');
      if (targetSel.name == sel.name) {
        start = true;
      } else if (start) {
        filterOptions(targetSel, window[sel.name](sel.options[sel.selectedIndex].value));
        /*
        if (targetSel.options[targetSel.selectedIndex].value != 0) {
          // Popup
        } else {
          filterOptions(targetSel, window[sel.name](sel.options[sel.selectedIndex].value));
        }
        */
      } else {
        if(window[sel.name](sel.options[sel.selectedIndex].value)[targetSel.name + '_id']) {
          selectOption(targetSel, window[sel.name](sel.options[sel.selectedIndex].value)[targetSel.name + '_id']);
        } else {
          selectOption(targetSel, 0);
        }
      }
    }
  }
}

function geoAdd(el, add) {
  if (add) {
    document.getElementById(el.id.replace('Add', '') + 'SelectLabel').innerHTML = 'New ' + document.getElementById(el.id.replace('Add', '') + 'SelectLabel').innerHTML.toLowerCase();
    $('#' + el.id.replace('Add', '') + 'Select').hide();
    el.style.display = 'none';
    $('#' + el.id + 'Text').show();
    $('#' + el.id + 'Cancel').show();
    $('#' + el.id + 'Text').focus();
  } else {
    document.getElementById(el.id.replace('AddCancel', '') + 'SelectLabel').innerHTML = ucfirst(document.getElementById(el.id.replace('AddCancel', '') + 'SelectLabel').innerHTML.replace('New ', ''));
    $('#' + el.id.replace('AddCancel', '') + 'Select').show();
    $('#' + el.id.replace('Cancel', '')).show();
    $('#' + el.id.replace('Cancel', '') + 'Text').hide();
    el.style.display = 'none';
    document.getElementById(el.id.replace('Cancel', '') + 'Text').value = null;        
    $('#' + el.id.replace('AddCancel', '') + 'Select').focus();    
  }
}

function popSel(sel, type) {
  if (!sel && type) {
    var sel = document.getElementById(type.name + 'Select');
  } else if (sel && !type) {
    var type = classes[sel.id.replace('Select', '').toLowerCase()];
  }
  if (sel && type) {
    sel.innerHTML = null;
    addTypeOptions(sel, type);
    hideLoading(type);
  }
}

function popSels(sels){
  if (!sels) {
    var sels = [];
    for (var item in classes) {
      if (document.getElementById(classes[item].name + 'Select')) {
        sels.push(document.getElementById(classes[item].name + 'Select'));
      }
    }
  }
  for (var sel in sels) {
    if (getType(sels[sel]) == 'HTMLSelectElement') {
      popSel(sels[sel]);
    }
  }
}

function popTbl(tbl, type) {
  if (!tbl && type) {
    var tbl = document.getElementById(type.name + 'Table');
  } else if (tbl.id && !type) {
    var type = classes[tbl.id.replace('Table', '').toLowerCase()];
  }
  if (tbl && type) {
    tbl.innerHTML = null;
    addThead(tbl, type);
    var tbody = addTbody(tbl);
    addRows(tbody, type);
    hideLoading(type);
    $('#' + tbl.id).dataTable({'bProcessing': true, 'bDestroy': true});
    $('#' + tbl.id).css('width', '')
  }
}

function popTbls(tbls){
  if (!tbls) {
    var tbls = [];
    for (var item in classes) {
      if (document.getElementById(classes[item].name + 'Table')) {
        tbls.push(document.getElementById(classes[item].name + 'Table'));
      }
    }
  }
  for (var tbl in tbls) {
    popTbl(tbls[tbl]);
  }
}

function addThead(tbl, type) {
  var thead = tbl.createTHead();
  addTheaders(thead, type.headers);
}

function addTheaders (thead, headers) {
  thead.innerHTML = null;
  var tr = thead.insertRow(-1);
  tr.className = 'header';
  for (var header in headers) {
    var th = document.createElement('th');
    tr.appendChild(th)
    th.appendChild(document.createTextNode(ucfirst(headers[header])));
  }
  return thead;
}

function addTbody(tbl) {
  var tbody = tbl.appendChild(document.createElement('tbody'));
  return tbody;
}

function addRows(tbody, type) {
  tbody.innerHTML = null;
  for (var obj in window[type.plural]) {
    addRow(tbody, window[type.plural][obj]);
  }
}

function addRow(tbody, obj) {
  var tr = tbody.insertRow(-1);
  var headers = classes[obj.class].headers;
  for (var header in headers) {
    var td = tr.insertCell(-1);
    if (obj[headers[header]] || obj[headers[header] + '_id']) {
      var item = obj.links[headers[header]] || document.createTextNode(obj[headers[header]]);
      td.appendChild(item);
    }
  }
}

function tShirtIcon(tbody) {
  var tr = tbody.insertRow(-1);
  var td = tr.insertCell(-1);
  var td = tr.insertCell(-1);
  var img = document.createElement('img');
  img.id = 'tShirt' + number;
  img.src = 'images/add_icon.gif';
  img.className = 'icon';
  img.onclick = 'addTShirt(this);';
  img.alt = 'Click to add a T-shirt';
  img.title = img.alt;
  td.appendChild(img);
}

function addLink(obj) {
  var txt = document.createTextNode(obj.name)
  if (obj && obj.id != 0) {
    var a = document.createElement('a');
    a.href = obj.class + '.php?id=' + obj.id + (($.url().param('debug')) ? '&debug=1' : '');
    a.appendChild(txt);
    return a;
  } else {
    return txt;
  }
}

function addParent(obj, type) {
  switch (type) {
    case 'continent':
      var parent = obj.getContinent();
    break;
    case 'country':
      var parent = obj.getCountry();
    break;
    case 'region':
      var parent = obj.getRegion();
    break;
    case 'city':
      var parent = obj.getCity();
    break;
  }
  if (parent) {
    switch (obj.class) {
      case 'country':
        if (parent.countries.indexOf(obj) == -1) {
          parent.countries.push(obj);
        }
      break;
      case 'region':
        if (parent.regions.indexOf(obj) == -1) {
          parent.regions.push(obj);
        }
      break;
      case 'city':
        if (parent.cities.indexOf(obj) == -1) {
          parent.cities.push(obj);
        }
      break;
      case 'player':
        if (parent.players.indexOf(obj) == -1) {
          parent.players.push(obj);
        }
      break;
    }
  }
}

function unknown(type) {
  return new window[type.name.toUpperCase()]({
    class: type,
    id: 0,
    name: 'Unknown ' + type.name
  });
}

function findObject(id, type) {
  var objs = window[type.plural];
  for (var obj in objs) {
    if (objs[obj].id == id) {
      return objs[obj];
    }
  }
  return unknown(type);
}

function continent(id) {
  if (getType(id) != 'Null') {
    return (id) ? findObject(id, classes.continent) : continents[continents.length -1] || false;
  } else {
    return unknown(classes.continent);
  }
}

function country(id) {
  if (getType(id) != 'Null') {
    return (id) ? findObject(id, classes.country) : countries[countries.length -1] || false;
  } else {
    return unknown(classes.country);
  }
}

function region(id) {
  if (getType(id) != 'Null') {
    return (id) ? findObject(id, classes.region) : regions[regions.length -1] || false;
  } else {
    return unknown(classes.region);
  }
}

function city(id) {
  if (getType(id) != 'Null') {
    return (id) ? findObject(id, classes.city) : cities[cities.length -1] || false;
  } else {
    return unknown(classes.city);
  }
}

function player(id) {
  if (getType(id) != 'Null') {
    return (id) ? findObject(id, classes.player) : players[players.length -1] || false;
  } else {
    return unknown(classes.player);
  }
}

function hideLoading(type) {
  $('#' + type.name + 'Loading').hide();
}

function showLoading(type) {
  $('#' + type.name + 'Loading').show();
}

function popGeo(type) {
  if (type) {
    var objs = window[type.plural];
    for (var obj in objs) {
      objs[obj].addParents();
      objs[obj].addLinks();
    }
  } else {
    for (var item in classes) {
      popGeo(classes[item]);
    }
  }
}

function loadScript(url) {
  if (scripts.indexOf(url) == -1) {
    var js = document.createElement("script");
    js.src = url;
    js.type="text/javascript";
    document.getElementsByTagName("head")[0].appendChild(js);
    scripts.push(url)
  }
}

function getType(obj) {
 return ({}).toString.call(obj).match(/\s([a-zA-Z]+)/)[1];
}

function htmlEntitiesEncode(str) {
  var div = document.createElement("div");
  var text = document.createTextNode(str);
  div.appendChild(text);
  return div.innerHTML;
}

function htmlEntitiesDecode(str) {
  var ta = document.createElement("textarea");
  ta.innerHTML = str.replace(/</g,"&lt;").replace(/>/g,"&gt;");
  return ta.value;
}

function varDump(obj, name, tab) {
  if(1) {
    var tab = tab || '';
    var content = (name) ? tab + name + ' => ' : '';
    switch (getType(obj)) {
      case 'Array':
        content += 'Array[\n';
        for (var prop in obj) {
          content += varDump(obj[prop], prop, tab + '\t');
        }
        content += tab + ']';
      break;
      case 'Object':
        content += 'Object{\n';
        for (var prop in obj) {
          if (['prevObject'].indexOf(prop) == -1) {
            content += varDump(obj[prop], prop, tab + '\t');
          }
        }
        content += tab + '}';
      break;
      case 'HTMLCollection':
        content += 'Collection{\n';
        for (var prop in obj) {
          content += varDump(obj[prop], prop, tab + '\t');
        }
        content += tab + '}';
      break;
      case 'NodeList':
        content += 'Nodes{\n';
        for (var prop in obj) {
          content += varDump(obj[prop], prop, tab + '\t');
        }
        content += tab + '}';
      break;
      case 'HTMLTableSectionElement':
        content += 'TableElement{\n';
        for (var prop in obj) {
          if (['rows', 'id', 'name', 'className'].indexOf(prop) != -1) {
            content += varDump(obj[prop], prop, tab + '\t');
          }
        }
        content += tab + '}';
      break;
      case 'HTMLTableRowElement':
        content += 'Rows{\n';
        for (var prop in obj) {
          if (['cells', 'id', 'name', 'className'].indexOf(prop) != -1) {
            content += varDump(obj[prop], prop, tab + '\t');
          }
        }
        content += tab + '}';
      break;
      case 'HTMLLabelElement':
        content += 'Label<\n';
        for (var prop in obj) {
          if (['htmlFor', 'childNodes', 'id', 'name', 'className'].indexOf(prop) != -1) {
            content += varDump(obj[prop], prop, tab + '\t');
          }
        }
        content += tab + '>';
      break;
      case 'HTMLSelectElement':
        content += 'Select<\n';
        for (var prop in obj) {
          if (getType(obj[prop]) === 'HTMLOptionElement' || ['selectedIndex', 'length', 'size', 'disabled', 'id', 'name', 'className'].indexOf(prop) != -1) {
            content += varDump(obj[prop], prop, tab + '\t');
          }
        }
        content += tab + '>';
      break;
      case 'HTMLTableCellElement':
        content += 'Cell<\n';
        for (var prop in obj) {
          if (['width', 'rowSpan', 'colSpan', 'childNodes', 'id', 'name', 'className'].indexOf(prop) != -1) {
            content += varDump(obj[prop], prop, tab + '\t');
          }
        }
        content += tab + '>';
      break;
      case 'HTMLInputElement':
        content += 'Input<\n';
        for (var prop in obj) {
          if (['value', 'type', 'name', 'id', 'checked', 'className'].indexOf(prop) != -1) {
            content += varDump(obj[prop], prop, tab + '\t');
          }
        }
        content += tab + '>';
      break;
      case 'HTMLOptionElement':
        content += 'Option< ' + obj.value + ' = \'' + obj.text + '\' >';
      break;   
      case 'HTMLTableElement':
        content += 'Table<\n';
        for (var prop in obj) {
          if (['tBodies', 'width', 'tHead', 'tFoot', 'id', 'name', 'className'].indexOf(prop) != -1) {
            content += varDump(obj[prop], prop, tab + '\t');
          }
        }
        content += tab + '>';
      break;
      case 'String':
        content += 'String: \'' + obj + '\'';
      break;
      case 'Number':
        content += 'Number: ' + obj;
      break;
      case 'Null':
        content += 'NULL';
      break;
      case 'Undefined':
        content += 'UNDEFINED';
      break;
      case 'Date':
        content += 'Date' + obj.toISOString() + ' ' + obj.getTimezoneOffset();
      break;
      case 'Boolean':
        content += 'Boolean: ' + obj.toString().toUpperCase();
      break;
      case '[object RegExp]':
        content += 'RegExp: /' + obj.source + '/';
      break;
      case 'Function':
        content += obj.toString().replace(/  /g, tab);
      break;
      case 'Text':
        content += 'Text: ' + obj.wholeText;
      break;
      case 'HTMLAnchorElement':
        content += 'Link<\n';
        content += (obj.id) ? tab + '\tID => ' + obj.id + '\n' : '';
        content += (obj.name) ? tab + '\tName => ' + obj.name + '\n' : '';
        content += tab + '\tHref => ' + obj.href + '\n';
        content += tab + '\tString: => ' + obj.text + '\n';
        content += tab + '>';
      break;
      default:
        content += getType(obj) + ': ' + obj;
      break;
    }
    return content + '\n';
  }
}

function debug(obj, name) {
  var debugMode = $.url().param('debug');
  if (debugMode) {
    var pre = document.createElement('pre');
    pre.innerHTML += varDump(obj, name);
    pre.style.align='left';
    document.getElementById('debug').appendChild(pre);
    console.log(obj);
  }
}
