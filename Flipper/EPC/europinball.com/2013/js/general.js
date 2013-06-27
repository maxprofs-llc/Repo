var scripts = new Array();
var debugMode = 1;

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
  },
  gender: {
    name: 'gender',
    geo: false,
    plural: 'genders',
    headers: ['name'],
    complete: true
  }
}

var continents = [];
var countries = [];
var regions = [];
var cities = [];
var players = [];
var genders = [
  {
    id: 1,
    name: 'Female'
  }, 
  {
    id: 2,
    name: 'Male'
  },
  {
    id: 3,
    name: 'Other'
  }
];

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
    this.continent = null;
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
    this.continent = null;
    this.country = null;
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
    this.continent = null;
    this.country = null;
    this.region = null;
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
    this.name = (data.name) ? data.name : data.firstName + ' ' + data.lastName;
    this.class = 'player';
    this.comment = data.comment;
    this.isIfpa = data.isIfpa;
    this.isPerson = data.isPerson;
    this.isPlayer = data.isPlayer;
    this.ifpa_id = data.ifpa_id;
    this.type = data.type;
    this.player_ids = data.player_ids;
    this.firstName = data.firstName;
    this.lastName = data.lastName;
    this.initials = data.initials;
    this.gender = data.gender;
    this.gender_id = data.gender_id;
    this.streetAddress = data.streetAddress;
    this.zipCode = data.zipCode;
    this.city = null;
    this.city_id = data.city_id;
    this.region = null;
    this.region_id = data.region_id;
    this.country = null;
    this.country_id = data.country_id;
    this.continent_id = data.continent_id;
    this.continent = null;
    this.telephoneNumber = data.telephoneNumber;
    this.mobileNumber = data.mobileNumber;
    this.mailAddress = data.mailAddress;
    this.dateRegistered = data.dateRegistered;
    this.birthDate = data.birthDate;
    this.classics = null;
    this.main = null;
    this.username = data.username;
    this.password = null;
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

function GENDER(data) {
  if (genders.indexOf(data) == -1) {
    this.id = data.id;
    this.name = (data.name) ? data.name : data.firstName + ' ' + data.lastName;
    this.class = 'gender';
    this.comment = data.comment;
    this.link = addLink(this);
    if (this.id !=0) {
      genders.push(this);
    }
  } else {
    this.remove();
  }
}

GENDER.prototype = {
  remove: function() {
    genders.splice(genders.indexOf(this),1);
  },
  addLinks: function() {
    this.links = {
      name: this.link
    }
  }
}

function ifpaReg(id, dstId) {
  var tbl = document.getElementById(dstId + 'Table');
  $('#' + dstId + 'TableDiv').show();
  if ($('#playerEditTable')) {
    $('#playerEditTable').hide();
  }
  try {
    $('#' + tbl.id).dataTable.fnClearTable();
  } catch(err) {
    tbl.innerHTML = null;
  }
  $.getJSON('ajax/ifpaReg.php',{ifpaId: $('#' + id).val()})
  .done(function(data) {
    var type = 'player';
    var objs = [];
    players.length = 0;
    if (data.length > 0) {
      for (var obj in data) {
        new window[type.toUpperCase()](data[obj]);
      }
      printPlayers(players, dstId);
    }
  })
  .fail(function(jqHXR,status,error) {
    alert('Fail: S: ' + status + ' E: ' + error);
  });
}

function printPlayers(objs, dstId, meBtns, sels) {
  meBtns = (typeof meBtns === 'undefined') ? true : meBtns;
  var tbl = document.getElementById(dstId + 'Table');
  $('#' + dstId + 'TableDiv').show();
  try {
    $('#' + tbl.id).dataTable.fnClearTable();
  } catch(err) {
    tbl.innerHTML = null;
  }
  addThead(tbl, classes['player'], meBtns);
  var tbody = addTbody(tbl);
  addRows(tbody, classes['player'], false, meBtns, sels, objs);
  $('#' + dstId).show();
  $('#' + tbl.id).dataTable({'bProcessing': true, 'bDestroy': true});
  $('#' + tbl.id).css('width', '')
}

function thisIsMe(btnId) {
  var meId = btnId.id.replace('meBtn_', '');
  printPlayerAsList(player(meId),'ifpaRegResults')
}

function newGuy(dstId) {
  printPlayerAsList(player(), dstId);
}

function printPlayerAsList(obj,dstId) {
  $('#' + dstId + 'TableDiv').hide();
  $('#' + dstId).show();
  if ($('#playerEditTable')) {
    $('#playerEditTable').remove();
  }
  if ($('#idHidden')) {
    $('#idHidden').remove();
  }
  if ($('#dateRegisteredHidden')) {
    $('#dateRegisteredHidden').remove();
  }
  var tbl = document.createElement('table');
  tbl.id = 'playerEditTable';
  var thead = tbl.createTHead();
  var tr = thead.insertRow(-1);
  tr.className = 'header';
  var th = document.createElement('th');
  th.colSpan = 2;
  th.align = 'left';
  tr.appendChild(th)
  var h3 = document.createElement('h3');
  h3.appendChild(document.createTextNode('Please confirm, change or add to our info:'));
  th.appendChild(h3);
  var tbody = tbl.appendChild(document.createElement('tbody'));
  for (var prop in obj) {
    var mandatory = false;
    switch (prop) {
      case 'dateRegistered':
      case 'id':
        var input = document.createElement('input');
        input.type = 'hidden';
        input.id = prop + 'Hidden';
        input.name = prop;
        input.value = (prop == 'id') ? obj.id : new Date().toISOString().substring(0,10);
        document.getElementById(dstId).appendChild(input);
      break;
      case 'firstName':
      case 'lastName':
      case 'username':
      case 'mailAddress':
      case 'mobileNumber':
        mandatory = true;
      case 'initials':
      case 'streetAddress':
      case 'zipCode':
      case 'telephoneNumber':
      case 'birthDate':
      case 'initials':
        var tr = tbody.insertRow(-1);
        var lblTd = tr.insertCell(-1);
        lblTd.id = prop + 'LabelTd';
        var lbl = document.createElement('label');
        lbl.id = prop + 'TextLabel';
        var txt = document.createTextNode(ucfirst(prop.toLowerCase()));
        lbl.appendChild(txt);
        var td = tr.insertCell(-1);
        var input = document.createElement('input');
        td.id = prop + 'TextTd';
        input.type = 'text';
        input.id = prop + 'Text';
        input.name = prop;
        input.value = (obj[prop]) ? obj[prop] : '';
        input.className = (mandatory) ? ' mandatory' : '';
        lbl.for = input.id;
        td.appendChild(input);
        lblTd.appendChild(lbl);
        if (prop == 'username') {
          input.onchange = function() { checkUser(this); };
          var span = document.createElement('span');
          span.id = 'usernameTextSpan';
          td.appendChild(span);
        }
      break;
      case 'country':
        mandatory = true;
      case 'city':
      case 'region':
      case 'continent':
      case 'gender':
        var tr = tbody.insertRow(-1);
        var lblTd = tr.insertCell(-1);
        lblTd.id = prop + 'LabelTd';
        var lbl = document.createElement('label');
        lbl.id = prop + 'SelectLabel';
        var txt = document.createTextNode(ucfirst(prop.toLowerCase()));
        lbl.appendChild(txt);
        var td = tr.insertCell(-1);
        td.id = prop + 'SelectTd';
        var input = document.createElement('select');
        input.id = prop + 'Select';
        input.name = prop;
        popSel(input);
        selectOption(input, obj[prop + '_id']);
        input.onchange = function () { geoSelected(this); };
        input.className = (mandatory) ? ' mandatory' : '';
        lbl.for = input.id;
        td.appendChild(input);
        lblTd.appendChild(lbl);
        if (prop == 'city' || prop == 'region') {
          var img = document.createElement('img');
          img.id = prop + 'Add';
          img.src = 'images/add_icon.gif';
          img.className = ' icon';
          img.onclick = function () { geoAdd(this, true); };
          img.alt = 'Click to add a new ' + prop.toLowerCase();
          img.title = img.alt;
          td.appendChild(img);
          var selTxt = document.createElement('input');
          selTxt.type = 'text';
          selTxt.id = prop + "AddText";
          selTxt.name = selTxt.id;
          selTxt.className = ' invisible';
          td.appendChild(selTxt);
          var cImg = document.createElement('img');
          cImg.id = prop + 'AddCancel';
          cImg.src = 'images/cancel.png';
          cImg.className = ' invisible';
          cImg.alt = 'Click to cancel and get back to the dropdown';
          cImg.title = cImg.alt;
          cImg.onclick = function () { geoAdd(this, false ); };
          td.appendChild(cImg);
        }
      break;
      case 'classics':
      case 'main':
        var tr = tbody.insertRow(-1);
        var lblTd = tr.insertCell(-1);
        lblTd.id = prop + 'LabelTd';
        var lbl = document.createElement('label');
        lbl.id = prop + 'TextLabel';
        var txt = document.createTextNode(ucfirst(prop.toLowerCase()));
        lbl.appendChild(txt);
        var td = tr.insertCell(-1);
        var input = document.createElement('input');
        td.id = prop + 'TextTd';
        input.type = 'checkbox';
        input.id = prop + 'Checkbox';
        input.name = prop;
        input.checked = true;;
        lbl.for = input.id;
        td.appendChild(input);
        var txt = document.createTextNode('Participate in ' + ucfirst(prop.toLowerCase()));
        td.appendChild(txt);
        lblTd.appendChild(lbl);
      break;
    }
  }
  var tr = tbody.insertRow(-1);
  var lblTd = tr.insertCell(-1);
  lblTd.id = 'passwordLabelTd';
  var lbl = document.createElement('label');
  lbl.id = 'passwordTextLabel';
  var txt = document.createTextNode('Password');
  lbl.appendChild(txt);
  var td = tr.insertCell(-1);
  td.id = 'passwordTextTd';
  var input = document.createElement('input');
  input.type = 'password';
  input.id = 'passwordText';
  input.name = 'password';
  input.value = '';
  input.className = ' mandatory';
  lbl.for = input.id;
  td.appendChild(input);
  lblTd.appendChild(lbl);
  var tr = tbody.insertRow(-1);
  var td = tr.insertCell(-1);
  td.colSpan = 2;
  var div = document.createElement('div');
  div.id = 'recaptcha';
  td.appendChild(div);
  var tr = tbody.insertRow(-1);
  var lblTd = tr.insertCell(-1);
  lblTd.id = 'submitLabelTd';
  var lbl = document.createElement('label');
  lbl.id = 'submitTextLabel';
  var txt = document.createTextNode('Submit');
  lbl.appendChild(txt);
  var td = tr.insertCell(-1);
  td.id = 'submitTd';
  var btn = document.createElement('button');
  btn.id = 'submit';
  btn.type = 'button';
  btn.appendChild(document.createTextNode('Let\'s play!'));
  btn.onclick = function() { submit(); };
  td.appendChild(btn);
  setTimeout(function(){
    Recaptcha.create('6LcpYOMSAAAAAMyv1GntlQeQQMXNdrK1X32NLZo1', 'recaptcha', {
      theme: 'blackglass'
    }), 100
  });
  document.getElementById(dstId).appendChild(tbl);
}

function submit() {
  $.post('ajax/recaptcha.php', {resp: Recaptcha.get_response(), chall: Recaptcha.get_challenge()})
  .done(function(data) {
    Recaptcha.destroy();
    if (data == 'Valid') {
      var newData = $('#newData').serializeArray();
      var obj = unknown(classes['player']);
      for(var i = 0; i < newData.length; i++) {
        switch (newData[i].name) {
          case 'dateRegistered':
          case 'id':
          case 'firstName':
          case 'lastName':
          case 'initials':
          case 'username':
          case 'password':
          case 'streetAddress':
          case 'zipCode':
          case 'telephoneNumber':
          case 'mobileNumber':
          case 'mailAddress':
          case 'birthDate':
            obj[newData[i].name] = newData[i].value;
          break;
          case 'city':
          case 'region':
          case 'country':
          case 'continent':
          case 'gender':
            obj[newData[i].name + '_id'] = newData[i].value;
          break;
          case 'cityAddText':
          case 'regionAddText':
            if (newData[i].value.length > 0) {
              obj[newData[i].name.replace('AddText', '')] = newData[i].value;
              obj[newData[i].name + '_id'] = 0;
            }
          break;
          case 'main':
          case 'classics':
            if (newData[i].value == 'on') {
              obj[newData[i].name] = true;
            } else {
              obj[newData[i].name] = false;
            }
          break;
        }
      }
      var jsonPlayer = JSON.stringify(obj, [
        'dateRegistered', 
        'firstName', 
        'lastName', 
        'initials', 
        'username', 
        'password', 
        'streetAddress', 
        'zipCode', 
        'telephoneNumber',
        'mobileNumber', 
        'mailAddress', 
        'birthDate', 
        'city_id', 
        'region_id', 
        'country_id', 
        'continent_id',
        'city', 
        'region', 
        'country', 
        'continent', 
        'gender', 
        'gender_id']
      );
      $.post('ajax/register.php', JSON.parse(jsonPlayer))
      .done(function(data) {
        alert(data);
      })
      .fail(function(jqHXR,status,error) {
        alert('Fail: S: ' + status + ' E: ' + error);
      }); 
    } else {
      alert('Recaptcha was invalid - try again! ' + data);
      Recaptcha.create('6LcpYOMSAAAAAMyv1GntlQeQQMXNdrK1X32NLZo1', 'recaptcha', {
        theme: 'blackglass',
        callback: Recaptcha.focus_response_field
      });
    }
  })
  .fail(function(jqHXR,status,error) {
    alert('Fail: S: ' + status + ' E: ' + error);
  });
}

function checkUser(el) {
  $.post('ajax/checkUser.php', {u: el.value, id: document.getElementById('idHidden').value})
  .done(function(data) {
    var txt = document.createTextNode(data);
    document.getElementById(el.id + 'Span').innerHTML = '';
    document.getElementById(el.id + 'Span').appendChild(txt);
    if (data == ' Username is already taken!') {
      document.getElementById(el.id + 'Span').style.color = 'red';
      document.getElementById(el.id + 'Span').style.fontStyle = 'bold';
      document.getElementById('submit').disabled = true;
    } else {
      document.getElementById(el.id + 'Span').style.color = '';
      document.getElementById(el.id + 'Span').style.fontStyle = '';
      document.getElementById('submit').disabled = false;
    }
  })
  .fail(function(jqHXR,status,error) {
    alert('Fail: S: ' + status + ' E: ' + error);
  });
}

function checkForm() {
  
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
  if (type && type != 'geo') {
    showLoading(classes[type]);
    $.getJSON('ajax/' + type + '.php', {t: '10'}, function(data) {
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
      if (!(type == 'geo' && classes[item].name == 'player')) {
        getObjects(classes[item].name);
      }
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
       // formatInputs(els);
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

function enterClick(id, e) {
  e = e || window.event;
  if (e.which == 13 || e.keyCode == 13) {
    e.preventDefault();
    e.returnValue = false;
    document.getElementById(id).click();
  }
}

function popTbl(tbl, type) {
  if (!tbl && type) {
    var tbl = document.getElementById(type.name + 'Table');
  } else if (tbl.id && !type) {
    var type = classes[tbl.id.replace('Table', '').toLowerCase()];
  }
  if (tbl && type) {
    try {
      $('#' + tbl.id).dataTable.fnClearTable();
    } catch(err) {
      tbl.innerHTML = null;
    }
    addThead(tbl, type);
    var tbody = addTbody(tbl);
    addRows(tbody, type, true);
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

function addThead(tbl, type, meBtn) {
  var thead = tbl.createTHead();
  addTheaders(thead, type.headers, meBtn);
}

function addTheaders (thead, headers, meBtn) {
  thead.innerHTML = null;
  var tr = thead.insertRow(-1);
  tr.className = 'header';
  for (var header in headers) {
    var th = document.createElement('th');
    tr.appendChild(th)
    th.appendChild(document.createTextNode(ucfirst(headers[header])));
  }
  var th = document.createElement('th');
  if (meBtn) {
    tr.appendChild(th)
    th.appendChild(document.createTextNode('Me?')); 
  } else {
    tr.appendChild(th)
  }
  return thead;
}

function addTbody(tbl) {
  var tbody = tbl.appendChild(document.createElement('tbody'));
  return tbody;
}

function addRows(tbody, type, links, meBtns, sels, objs) {
  tbody.innerHTML = null;
  objs = (objs) ? objs : window[type.plural];
  for (var obj in objs) {
    addRow(tbody, objs[obj], links, meBtns, sels);
  }
}

function addRow(tbody, obj, link, meBtn, sels) {
  var tr = tbody.insertRow(-1);
  var headers = classes[obj.class].headers;
  for (var header in headers) {
    var td = tr.insertCell(-1);
    if (obj[headers[header]] || obj[headers[header] + '_id']) {
      obj.addParents();
      var item = null;
      if (sels && obj[headers[header]].hasOwnProperty('name')) {
        var item = document.createElement('select');
        item.id = headers[header] + 'Select';
        popSel(item);
        selectOption(item, obj[headers[header]].id);
      } else {
        if (link) {
          if (!obj.links) {
            obj.addLinks();
          }
          item = (obj.links[headers[header]]) ? obj.links[headers[header]] : null;
        } 
        var item = (item) ? item : ((obj[headers[header]].hasOwnProperty('name')) ? document.createTextNode(obj[headers[header]].name) : document.createTextNode(obj[headers[header]]));
      }
      td.appendChild(item);
    }
  }
  if (meBtn) {
    var btn = document.createElement('button');
    btn.id = 'meBtn_' + obj.id;
    btn.type = 'button';
    btn.appendChild(document.createTextNode('This is me!'));
    btn.onclick = function() { thisIsMe(this); };
    var td = tr.insertCell(-1);
    td.appendChild(btn);
  } else {
    var td = tr.insertCell(-1);
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
      obj.continent = parent;
    break;
    case 'country':
      var parent = obj.getCountry();
      obj.country = parent;
    break;
    case 'region':
      var parent = obj.getRegion();
      obj.region = parent;
    break;
    case 'city':
      var parent = obj.getCity();
      obj.city = parent;
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
  if (getType(id) != 'Null' && getType(id) != 'Undefined') {
    return (id) ? findObject(id, classes.continent) : continents[continents.length -1] || false;
  } else {
    return unknown(classes.continent);
  }
}

function country(id) {
  if (getType(id) != 'Null' && getType(id) != 'Undefined') {
    return (id) ? findObject(id, classes.country) : countries[countries.length -1] || false;
  } else {
    return unknown(classes.country);
  }
}

function region(id) {
  if (getType(id) != 'Null' && getType(id) != 'Undefined') {
    return (id) ? findObject(id, classes.region) : regions[regions.length -1] || false;
  } else {
    return unknown(classes.region);
  }
}

function city(id) {
  if (getType(id) != 'Null' && getType(id) != 'Undefined') {
    return (id) ? findObject(id, classes.city) : cities[cities.length -1] || false;
  } else {
    return unknown(classes.city);
  }
}

function player(id) {
  if (getType(id) != 'Null' && getType(id) != 'Undefined') {
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

function debugOut(obj, name) {
  var debugMode = $.url().param('debug');
  debugMode = true;
  if (debugMode) {
    var pre = document.createElement('pre');
    pre.innerHTML += varDump(obj, name);
    pre.style.align='left';
    document.getElementById('debug').appendChild(pre);
    console.log(obj);
  }
}
