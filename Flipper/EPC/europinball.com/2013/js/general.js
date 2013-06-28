var scripts = new Array();
var debugMode = 1;

// The classes variable contains meta-information about the classes.
var classes = {
  continent: {
    name: 'continent',
    geo: true,
    plural: 'continents',
    headers: ['name', 'latitude', 'longitude'], // Headers normally used in tables and lists
    complete: false
  },
  country: {
    name: 'country',
    geo: true,
    plural: 'countries',
    headers: ['name', 'continent', 'latitude', 'longitude'], // Headers normally used in tables and lists
    complete: false
  },
  region: {
    name: 'region',
    geo: true,
    plural: 'regions',
    headers: ['name', 'country', 'continent', 'latitude', 'longitude'], // Headers normally used in tables and lists
    complete: false
  },
  city: {
    name: 'city',
    geo: true,
    plural: 'cities',
    headers: ['name', 'region', 'country', 'continent', 'latitude', 'longitude'], // Headers normally used in tables and lists
    complete: false
  },
  player: {
    name: 'player',
    geo: false,
    plural: 'players',
    headers: ['name', 'initials', 'city', 'region', 'country', 'continent'], // Headers normally used in tables and lists
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

var continents = []; // Contains all continents
var countries = []; // Contains all countries
var regions = []; // Contains all regions
var cities = []; // Contains all cities
var players = []; // Contains all players
var genders = [ // Contains all genders
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


// Classes definitions for continents, countries, regions, cities, players and genders.
// Implemented as JS functions with protoypes.

function CONTINENT(data) {
  if (continents.indexOf(data) == -1) {
    this.id = data.id;
    this.name = data.name;
    this.altName = data.altName;
    this.class = 'continent';
    this.comment = data.comment;
    this.latitude = data.latitude;
    this.longitude = data.longitude;
    this.countries = []; // Contins all countries on the continent
    this.regions = []; // Contins all regions on the continent
    this.cities = []; // Contins all cities on the continent
    this.players = []; // Contins all players from the continent
    this.link = addLink(this);
    if (this.id !=0) {
      continents.push(this); // Add to the global continents array
    }
  } else {
    this.remove();
  }
}

CONTINENT.prototype = {
  remove:  function() {
    continents.splice(continents.indexOf(this),1); // Remove from the global continents array.
  },
  // Add children objects:
  addCountry: function(country) { // Add a country to the array with all countries on the continent
    if (this.countries.indexOf(country) == -1) {
      this.countries.push(country);
      country.continent_id = this.id;
    }
  },
  addRegion: function(region) { // Add a region to the array with all regions on the continent
    if (this.regions.indexOf(region) == -1) {
      this.regions.push(region);
      region.continent_id = this.id;
    }
  },
  addCity: function(city) { // Add a city to the array with all cities on the continent
    if (this.cities.indexOf(city) == -1) {
      this.cities.push(city);
      city.continent_id = this.id;
    }
  },
  addPlayers: function(player) { // Add a player to the array with all players from the continent
    if (this.players.indexOf(player) == -1) {
      this.players.push(player);
      player.continent_id = this.id;
    }
  },
  addParents: function() { // Continents don't have parents
  },
  addLinks: function() { // Used to generate links for linkable fields.
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
    this.regions = []; // Contins all regions in the country
    this.cities = []; // Contins all cities in the country
    this.players = []; // Contins all players from the country
    this.link = addLink(this);
    if (this.id !=0) {
      countries.push(this); // Add to the global countries array
    }
  } else {
    this.remove();
  }
}

COUNTRY.prototype = {
  remove: function() {
    countries.splice(countries.indexOf(this),1); // Remove from the global countries array.
    var obj = this.getContinent();
    obj.countries.splice(obj.countries.indexOf(this),1); // Take the dead child away from the parent
  },
  // Add children objects:
  addRegion: function(region) { // Add a region to the array with all region in the country
    if (this.regions.indexOf(region) == -1) {
      this.regions.push(region);
      region.country_id = this.id;
    }
  },
  addCity: function(city) { // Add a city to the array with all cities in the country
    if (this.cities.indexOf(city) == -1) {
      this.cities.push(city);
      city.country_id = this.id;
    }
  },
  addPlayer: function(player) { // Add a player to the array with all players from the country
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
  addLinks: function() { // Used to generate links for linkable fields.
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
    this.cities = []; // Contins all cities in the region
    this.players = []; // Contins all players from the region
    this.link = addLink(this);
    if (this.id !=0) {
      regions.push(this); // Add to the global regions array
    }
  } else {
    this.remove();
  }
}

REGION.prototype = {
  remove: function() {
    regions.splice(regions.indexOf(this),1); // Remove from the global regions array.
    var obj = this.getContinent();
    obj.regions.splice(obj.regions.indexOf(this),1); // Take the dead grandchild away from the grandparent
    var obj = this.getCountry();
    obj.regions.splice(obj.regions.indexOf(this),1); // Take the dead child away from the parent
  },
  // Add children objects:
  addCity: function(city) { // Add a city to the array with all cities in the region
    if (this.cities.indexOf(city) == -1) {
      this.cities.push(city);
      city.region_id = this.id;
    }
  },
  addPlayer: function(player) { // Add a player to the array with all players from the region
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
  addLinks: function() { // Used to generate links for linkable fields.
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
    this.players = []; // Contins all players from the city
    this.link = addLink(this);
    if (this.id !=0) {
      cities.push(this); // Add to the global cities array
    }
  } else {
    this.remove();
  }
}

CITY.prototype = {
  remove: function() {
    cities.splice(cities.indexOf(this),1); // Remove from the global cities array.
    var obj = this.getContinent();
    obj.cities.splice(obj.cities.indexOf(this),1); // Take the dead great grandchild away from the great grandparent
    var obj = this.getCountry();
    obj.cities.splice(obj.cities.indexOf(this),1); // Take the dead grandchild away from the grandparent
    var obj = this.getRegion();
    obj.cities.splice(obj.cities.indexOf(this),1); // Take the dead child away from the parent
  },
  // Add children objects:
  addPlayer: function(player) { // Add a player to the array with all players from the city
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
  addLinks: function() { // Used to generate links for linkable fields.
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
      players.push(this); // Add to the global players array
    }
  } else {
    this.remove();
  }
}

PLAYER.prototype = {
  remove: function() {
    players.splice(players.indexOf(this),1); // Remove from the global players array.
    var obj = this.getContinent();
    obj.players.splice(obj.players.indexOf(this),1); // Take the dead great great grandchild away from the great great  grandparent
    var obj = this.getCountry();
    obj.players.splice(obj.players.indexOf(this),1); // Take the dead great grandchild away from the great grandparent
    var obj = this.getRegion();
    obj.players.splice(obj.players.indexOf(this),1); // Take the dead grandchild away from the grandparent
    var obj = this.getCity();
    obj.players.splice(obj.players.indexOf(this),1); // Take the dead child away from the parent
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
  addLinks: function() { // Used to generate links for linkable fields.
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
      genders.push(this); // Add to the global genders array
    }
  } else {
    this.remove();
  }
}

GENDER.prototype = {
  remove: function() {
    genders.splice(genders.indexOf(this),1); // Remove from the global genders array.
  },
  addLinks: function() { // Used to generate links for linkable fields.
    this.links = {
      name: this.link
    }
  }
}

// Function called from the search button on the registration page. "id" is not necessarily an IFPA ID - it might as well be a phone number, email address, TAG or (parts of) a person's name. What to search for is determined by the regexps in the getPlayerByIfpaId function in functions/general.php. The results table is normally shown in the ifpaRegResults div  (dstId).
function ifpaReg(id, dstId) {
  var tbl = document.getElementById(dstId + 'Table');
  $('#' + dstId + 'TableDiv').show();
  if ($('#playerEditTable')) {
    $('#playerEditTable').hide();
  }
  try { 
    $('#' + tbl.id).dataTable.fnClearTable(); // Clear the datatable layout (and the table) if the datatable object exists...
  } catch(err) {
    tbl.innerHTML = null; // ...otherwise empty the whole table. (Nulling the table with datatable object attached will make datatable freak out.)
  }
  $.getJSON('ajax/ifpaReg.php',{ifpaId: $('#' + id).val()}) // Returns a JSON with all hits
  .done(function(data) {
    var type = 'player';
    var objs = [];
    players.length = 0; // Let's delete all the players...
    if (data.length > 0) {
      for (var obj in data) {
        new window[type.toUpperCase()](data[obj]); // ...and create new player objects from the JSON.
      }
      printPlayers(players, dstId);
    }
  })
  .fail(function(jqHXR,status,error) {
    alert('Fail: S: ' + status + ' E: ' + error); // Oh, no! Fail!
  });
}

// Print a table with all loaded players. 
// "meBtns" true/false = add the "This is me!" button at the end of each row.
// "sels" true/false = make all suitable fields into selects containing all objects of that class, with the current one pre-selected (to let a player change his/her city, or similar).
function printPlayers(objs, dstId, meBtns, sels) {
  meBtns = (typeof meBtns === 'undefined') ? true : meBtns; // Default is true
  var tbl = document.getElementById(dstId + 'Table');
  $('#' + dstId + 'TableDiv').show();
  try {
    $('#' + tbl.id).dataTable.fnClearTable(); // Clear the datatable layout (and the table) if the datatable object exists...
  } catch(err) {
    tbl.innerHTML = null; // ...otherwise empty the whole table. (Nulling the table with datatable object attached will make datatable freak out.)
  }
  }
  addThead(tbl, classes['player'], meBtns); // Add table headers (don't forget the header for the meBtn!)
  var tbody = addTbody(tbl);
  addRows(tbody, classes['player'], false, meBtns, sels, objs); // Add the rows, and include info about meBtn and sels.
  $('#' + dstId).show(); // Allright, table done, let's show it
  $('#' + tbl.id).dataTable({'bProcessing': true, 'bDestroy': true}); // Rebuild the datatable
  $('#' + tbl.id).css('width', '') // This is needed, or the table is butt ugly!
}

// This is me!
function thisIsMe(btnId) {
  var meId = btnId.id.replace('meBtn_', ''); // Let's find out who "me" is.
  printPlayerAsList(player(meId),'ifpaRegResults') // Show the details form to the player, with info pre-filled in.
}

// I'm a new guy!
function newGuy(dstId) {
  printPlayerAsList(player(), dstId); // Create a dummy player with no info, and show the (non-existing) details form fo the player.
}

// This prints out the details form. Could probably have done this with meta-information in arrays and some simple loops in stead, but this way gives us total control of what is shown how.
function printPlayerAsList(obj,dstId) {
  $('#' + dstId + 'TableDiv').hide(); // Hide the table div with players - either we've found the player or this is a new guy.
  $('#' + dstId).show(); // And show the details form
  if ($('#playerEditTable')) {
    $('#playerEditTable').remove(); // Kill the player table
  }
  if ($('#idHidden')) {
    $('#idHidden').remove(); // If this is not the first time this player found him/her self, there will be old hidden fields laying around. Let's remove those.
  }
  if ($('#dateRegisteredHidden')) {
    $('#dateRegisteredHidden').remove(); // ...both of them.
  }
  var tbl = document.createElement('table'); // Details form table. Table based layout design ftw!
  tbl.id = 'playerEditTable';
  var thead = tbl.createTHead();
  var tr = thead.insertRow(-1);
  tr.className += ' header';
  var th = document.createElement('th');
  th.colSpan = 2;
  th.align = 'left';
  tr.appendChild(th)
  var h3 = document.createElement('h3');
  h3.appendChild(document.createTextNode('Please confirm, change or add to our info:'));
  th.appendChild(h3); // It only took 10 lines to add a title!
  var tbody = tbl.appendChild(document.createElement('tbody'));
  for (var prop in obj) { // Loop through all object properties (player names and such)
    var mandatory = false; // Mandatory fields will become yellow, but let's assume this is not a mandatory field
    switch (prop) {
      case 'dateRegistered':
      case 'id': // Person ID from the database, so we know who this is. A new guy will have ID 0.
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
        mandatory = true; // The fields above are fields we require from each player. They are free to enter dummy info though. The fields below are optional.
      case 'initials':
      case 'streetAddress':
      case 'zipCode':
      case 'telephoneNumber':
      case 'birthDate':
      case 'initials':
        var tr = tbody.insertRow(-1);
        var lblTd = tr.insertCell(-1); // Label TD
        lblTd.id = prop + 'LabelTd';
        var lbl = document.createElement('label');
        lbl.id = prop + 'TextLabel';
        var txt = document.createTextNode(ucfirst(prop.toLowerCase())); // Field name. I'm lazy, so let's get it from the object property name and just change capitalization.
        lbl.appendChild(txt);
        var td = tr.insertCell(-1);
        var input = document.createElement('input');
        td.id = prop + 'TextTd';
        input.type = 'text';
        input.name = prop; // Name is actual property name, as defined in the database.
        input.id = prop + 'Text'; // ...while ID will also tell what type of input it is.
        input.value = (obj[prop]) ? obj[prop] : '';
        input.className += (mandatory) ? ' mandatory' : ''; // Make it yellow?
        lbl.for = input.id;
        td.appendChild(input);
        lblTd.appendChild(lbl);
        if (prop == 'username') {
          input.onchange = function() { checkUser(this); }; // Let's check that the username is up for grabs. Only done when leaving the field (changed), and not at every keypress.
          var span = document.createElement('span'); // ...and put the result here
          span.id = 'usernameTextSpan';
          td.appendChild(span);
        }
      break;
      case 'country':
        mandatory = true; // We want to know country! The rest is optional.
      case 'city':
      case 'region':
      case 'continent':
      case 'gender':
        var tr = tbody.insertRow(-1);
        var lblTd = tr.insertCell(-1);
        lblTd.id = prop + 'LabelTd'; // Label TD
        var lbl = document.createElement('label');
        lbl.id = prop + 'SelectLabel';
        var txt = document.createTextNode(ucfirst(prop.toLowerCase())); // Field name. I'm lazy, so let's get it from the object property name and just change capitalization.
        lbl.appendChild(txt);
        var td = tr.insertCell(-1);
        td.id = prop + 'SelectTd';
        var input = document.createElement('select');
        input.name = prop; // Name is actual property name, as defined in the database.
        input.id = prop + 'Select'; // ...while ID will also tell what type of input it is.
        popSel(input);
        selectOption(input, obj[prop + '_id']);
        input.onchange = function () { geoSelected(this); }; // When the user has selected one geo-object, then let's adapt all the other ones. If choosing Sweden, only Swedish regions and cities will be shown in the other dropdowns. And if a city in Uppland is chosen - Uppland, Sweden and Europe are automatically selected.
        input.className += (mandatory) ? ' mandatory' : ''; // Make it yellow?
        lbl.for = input.id;
        td.appendChild(input);
        lblTd.appendChild(lbl);
        if (prop == 'city' || prop == 'region') { // Users have a possibility to add cities and regions not already in the database. So let's add some elements for that.
          var img = document.createElement('img'); // A plus sign after the select, to click on to add stuff.
          img.id = prop + 'Add';
          img.src = 'images/add_icon.gif';
          img.className += ' icon';
          img.onclick = function () { geoAdd(this, true); }; // They want to add something (true)!
          img.alt = 'Click to add a new ' + prop.toLowerCase();
          img.title = img.alt;
          td.appendChild(img);
          var selTxt = document.createElement('input'); // So let's replace the select with a text input
          selTxt.type = 'text';
          selTxt.name = selTxt.id; // We can't use actual property name here, since that is used by the dropdown. If this field has a value, the dropdown value is ignored.
          selTxt.id = prop + "AddText"; // ...so both ID and name will also tell what type of input it is.
          selTxt.className += ' invisible'; // Display none until the plus sign is clicked
          td.appendChild(selTxt);
          var cImg = document.createElement('img'); // What if the user regrets his/her choice, and wants to select an existing item anyway? No problem - just click the X icon! If they do, we will remove the value from the selTxt text input, and use the value from the dropdown.
          cImg.id = prop + 'AddCancel';
          cImg.src = 'images/cancel.png';
          cImg.className += ' invisible'; // Display none until the plus sign is clicked
          cImg.alt = 'Click to cancel and get back to the dropdown';
          cImg.title = cImg.alt;
          cImg.onclick = function () { geoAdd(this, false ); }; // The don't want to add something (false)!
          td.appendChild(cImg);
        }
      break;
      case 'classics':
      case 'main':
        var tr = tbody.insertRow(-1);
        var lblTd = tr.insertCell(-1); // Label TD
        lblTd.id = prop + 'LabelTd';
        var lbl = document.createElement('label');
        lbl.id = prop + 'TextLabel';
        var txt = document.createTextNode(ucfirst(prop.toLowerCase()));// Field name. I'm lazy, so let's get it from the object property name and just change capitalization.
        lbl.appendChild(txt);
        var td = tr.insertCell(-1);
        var input = document.createElement('input');
        td.id = prop + 'TextTd';
        input.type = 'checkbox';
        input.name = prop; // Name is actual property name, as defined in the database.
        input.id = prop + 'Checkbox'; // ...while ID will also tell what type of input it is.
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
  var lblTd = tr.insertCell(-1); // Label TD
  lblTd.id = 'passwordLabelTd';
  var lbl = document.createElement('label');
  lbl.id = 'passwordTextLabel';
  var txt = document.createTextNode('Password');
  lbl.appendChild(txt);
  var td = tr.insertCell(-1);
  td.id = 'passwordTextTd';
  var input = document.createElement('input');
  input.type = 'password'; // Let's hide the typing
  input.name = 'password'; // Name is actual property name, as defined in the database.
  input.id = 'passwordText'; // ...while ID will also tell what type of input it is.
  input.value = '';
  input.className += ' mandatory'; // Password is mandatory!
  lbl.for = input.id;
  td.appendChild(input);
  lblTd.appendChild(lbl);
  var tr = tbody.insertRow(-1);
  var td = tr.insertCell(-1);
  td.colSpan = 2;
  var div = document.createElement('div');
  div.id = 'recaptcha'; // Let's add a Google Recaptcha to keep robots away. They can't play pinball anyway!
  td.appendChild(div);
  var tr = tbody.insertRow(-1);
  var lblTd = tr.insertCell(-1); // Label TD
  lblTd.id = 'submitLabelTd';
  var lbl = document.createElement('label');
  lbl.id = 'submitTextLabel';
  var txt = document.createTextNode('Submit'); // We have it all! Let's play!
  lbl.appendChild(txt);
  var td = tr.insertCell(-1);
  td.id = 'submitTd';
  var btn = document.createElement('button');
  btn.id = 'submit';
  btn.type = 'button';
  btn.appendChild(document.createTextNode('Let\'s play!'));
  btn.onclick = function() { submit(); };
  td.appendChild(btn);
  setTimeout(function(){ // Recaptcha is faster than its shadow (or at least faster than creating a div and giving it an ID in the dom), so we need to delay it for 100ms, or it won't find its div. Strange but true.
    Recaptcha.create('6LcpYOMSAAAAAMyv1GntlQeQQMXNdrK1X32NLZo1', 'recaptcha', {
      theme: 'blackglass'
    }), 100
  });
  document.getElementById(dstId).appendChild(tbl); // Let's show it to the user
}

function submit() {
  $.post('ajax/recaptcha.php', {resp: Recaptcha.get_response(), chall: Recaptcha.get_challenge()}) // Let's ajax-check the recaptcha
  .done(function(data) { // Allright, recaptcha response received
    Recaptcha.destroy(); // Let's destroy the recaptcha (either we are done and fine, or we need to create a new one anyway)
    if (data == 'Valid') { // Allright, recaptcha was fine!
      var newData = $('#newData').serializeArray(); // For some reason, I can't use the original object. So we have to serialize the form info...
      var obj = unknown(classes['player']); // ...and create a new object from it. Very annoying.
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
            obj[newData[i].name] = newData[i].value; // All the above are simple add values to the property.
          break;
          case 'city':
          case 'region':
          case 'country':
          case 'continent':
          case 'gender':
            obj[newData[i].name + '_id'] = newData[i].value; // The ones above we want to store as IDs
          break;
          case 'cityAddText':
          case 'regionAddText':
            if (newData[i].value.length > 0) {
              obj[newData[i].name.replace('AddText', '')] = newData[i].value; // The user added a new object, so let's save the name.
              obj[newData[i].name + '_id'] = 0; // ...and to be safe - also remove the ID from the dropdown.
            }
          break;
          case 'main':
          case 'classics':
            if (newData[i].value == 'on') {
              obj[newData[i].name] = true; // Will actually be a 1 when received in ajax
            } else {
              obj[newData[i].name] = false; // Will actually be a 0 when received in ajax
            }
          break;
        }
      }
      var jsonPlayer = JSON.stringify(obj, [ // I stringify the object...
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
      $.post('ajax/register.php', JSON.parse(jsonPlayer)) // ...and then objectify it again. Why? Shouldn't be necessary? I should be able to just use the object straight on? I don't remeber why I did this.
      .done(function(data) {
        alert(data); // No real insertion or updates in the database yet, but I do want to know what would have been inserted or updated.
      })
      .fail(function(jqHXR,status,error) {
        alert('Fail: S: ' + status + ' E: ' + error); // Oh, no! Fail!
      }); 
    } else {
      alert('Recaptcha was invalid - try again! ' + data); // Oh, no! Our user can't read!
      Recaptcha.create('6LcpYOMSAAAAAMyv1GntlQeQQMXNdrK1X32NLZo1', 'recaptcha', { //... so let's recreate the recaptcha, and start all over again.
        theme: 'blackglass',
        callback: Recaptcha.focus_response_field
      });
    }
  })
  .fail(function(jqHXR,status,error) {
    alert('Fail: S: ' + status + ' E: ' + error); // Oh, no! Fail!
  });
}

function checkUser(el) {
  $.post('ajax/checkUser.php', {u: el.value, id: document.getElementById('idHidden').value}) // Let's check if the username is up for grabs.
  .done(function(data) {
    var txt = document.createTextNode(data);
    document.getElementById(el.id + 'Span').innerHTML = '';
    document.getElementById(el.id + 'Span').appendChild(txt);
    if (data == ' Username is already taken!') { // Oh, no! Some bastard took my name!
      document.getElementById(el.id + 'Span').style.color = 'red';
      document.getElementById(el.id + 'Span').style.fontStyle = 'bold';
      document.getElementById('submit').disabled = true; // No submitting taken usernames!
    } else {
      document.getElementById(el.id + 'Span').style.color = ''; // This means the username is free (or that it already belongs to the user)
      document.getElementById(el.id + 'Span').style.fontStyle = '';
      document.getElementById('submit').disabled = false;
    }
  })
  .fail(function(jqHXR,status,error) {
    alert('Fail: S: ' + status + ' E: ' + error); // Oh, no! Fail!
  });
}

function checkForm() {
  // This will be where the details form is validated. We won't validate much - just some basic stuff. Things like invalid email addresses and stuff is ok.
}

function ucfirst(txt) {
  return txt.substring(0, 1).toUpperCase() + txt.substring(1); // Why is this not a native part of Javascript? 
}

function complete(type) { // Used to check that all objects are completely loaded from ajax
  if (type) {
    return (classes[type].complete); // Mark the type as complete
  } else {
    for (var item in classes) { // Check if all types are complete
      if (!complete(item)) {
        return false; // Nope - still stuff to load.
      }
    }
    return true; // Yes, they are.
  }
}

function getObjects(type) { // Load all objects from ajax. If type is specified, only that type is loaded. The function is recursive - if no type is specified, it will call itself for each type.
  if (type && type != 'geo') {
    showLoading(classes[type]); // Show a nice loading image
    $.getJSON('ajax/' + type + '.php', {t: '10'}, function(data) { // Uuuh! Hard coded tournament ID!! Someone, hit me hard, please.
      if (data.length > 0) {
        for (var obj in data) {
          new window[type.toUpperCase()](data[obj]); // Let's create objects from the JSON
        }
      }
      classes[type].complete = true; // Mark the type as complete. If true is returned, it was the last type.
      if (complete()) {
        popGeo(); // Let's get all parent-child relations straightened out.
        popEls($('select')); // Look for selects to populate
        popEls($('table')); // Look for tables to populate 
        popEls($('input')); // Look for inputs to populate (I don't think we ever do this)
      }
    });
  } else {
    for (var item in classes) { // The function is called for recursive action
      if (!(type == 'geo' && classes[item].name == 'player')) {
        getObjects(classes[item].name); // ...so let's get recursive
      }
    }
  }
}

function popEls(els) {
  for (var el in els) {
    switch (getType(els[el])) {
      case 'HTMLSelectElement': // We found a select!
        popSels(els); // ...so let's populate it
      break;
      case 'HTMLTableElement': // We found a table!
        popTbls(els); // ...so let's populate it
      break;
      case 'HTMLInputElement': // We found a input!
       // formatInputs(els); // ...so let's do nothing
      break;
    }
  }
}

function addOption(obj, sel, selected) { // Add an option to a select
  var option = document.createElement('option');
  option.value = obj.id;
  option.text = (obj.altName) ? obj.name + ' / ' + obj.altName : obj.name;
  if (sel) {
    sel.add(option); // Either add it to the provided select
    sel.selected = (selected) ? true : false;
  }
  return option; // ...or just return it
}

function addTypeOptions(sel, type) { // Add all the object of a specific type as options to the select
  sel.add(addOption({id: 0, name: 'Choose ' + type.name + '...'}));
  addOptions(sel, window[type.plural]);
}

function addOptions(sel, objs) { // Add options with the provided objects array
  if (objs.length > 0) {
    for (var obj in objs) {
      sel.add(addOption(objs[obj]));
    }
  } else {
    sel.innerHTML = null;
    sel.add(addOption({id: 0, name: 'None found...'})); // No objects provided!
  }
}


function selectOption(sel, id) { // Make the specific select option selected (ID is database ID, not HTML element ID)
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

function filterOptions (sel, obj) { // This will remove all non-appropriate options from a select. I.e. if someone chose "Europe", all non-european objects will be removed. If obj.id is 0 (unknown item), the select is in stead restored to show all options.
  sel.innerHTML = null;
  sel.add(addOption({id: 0, name: 'Loading...'})); // This might take some time - there are thousands of cities.
  showLoading(classes[sel.name]);
  var objs = (obj.id != 0) ? window[classes[sel.name].plural].filter(cmpGeo, obj) : window[classes[sel.name].plural];
   // It took a while to figure out the line above! sel.name is "country" or similar. classes['country'].plural is "countries". window['countries'] is the global countries array. And then apply the filter to get rid of unwanted objects.
  sel.innerHTML = null;
  sel.add(addOption({id: 0, name: 'Choose ' + sel.name + '...'}));
  addOptions(sel, objs); // Add the new options
  hideLoading(classes[sel.name]);
}

function cmpGeo(obj) {
    return (obj[this.class + '_id'] == this.id) ? true : false; // This is the filter used in the filterOptions function. It checks that object.country_id (or equivalent) is (or is not) the ID we are looking for.
}    

function geoSelected(sel) { // Someone chose something in a geo-select! The "sel" is the select that was changed, and targetSel below is the select that might be affected.
  var start = false; // What? We're just starting!
  for (var item in classes) {
    if (classes[item].geo) { // Only apply to geographical stuff
      var targetSel = document.getElementById(classes[item].name + 'Select'); // This is the select we want to change. 
      if (targetSel.name == sel.name) { // The loop has reached the select that initiated things. So we need to change method (from filtering to selecting, or vice versa).
        start = true; // Now we're starting!
      } else if (start) {
        filterOptions(targetSel, window[sel.name](sel.options[sel.selectedIndex].value)); // This is filtering - i.e. if the user chose a country, the targetSel is regions or cities
        /*
        if (targetSel.options[targetSel.selectedIndex].value != 0) {
          // Popup - if the user has already selected something and we want to change it. Don't think we will ever implement this.
        } else {
          filterOptions(targetSel, window[sel.name](sel.options[sel.selectedIndex].value));
        }
        */
      } else {
        if(window[sel.name](sel.options[sel.selectedIndex].value)[targetSel.name + '_id']) {
          selectOption(targetSel, window[sel.name](sel.options[sel.selectedIndex].value)[targetSel.name + '_id']); 
          // This is selecting - i.e. if the user chose a country, the targetsel is continents. Example, with country chosen and continents as targetSel:
          // window[sel.name] = country
          // sel.options[sel.selectedIndex].value = the ID of the country chosen, let's pick 188 (Sweden) as example
          // targetSel.name + '_id' = continent_id
          // Result: country(188).continent_id
          // The country(188) function will return the country object with ID 188 = Sweden
          // I.e. selectOption will select Sweden.continent_id - the continent that Sweden is located on = Europe
        } else {
          selectOption(targetSel, 0); // There was no parent! So let's have the user choose one.
        }
      }
    }
  }
}

function geoAdd(el, add) { // Somebody wants to add (or regrets wanting to add depending on add = true/false) a geo-object. The "el" is the plus sign. 
  if (add) { // We're adding!
    // Let's change the label using some creative (and ugly) cut'n'pasting-replacing of element IDs
    document.getElementById(el.id.replace('Add', '') + 'SelectLabel').innerHTML = 'New ' + document.getElementById(el.id.replace('Add', '') + 'SelectLabel').innerHTML.toLowerCase();
    $('#' + el.id.replace('Add', '') + 'Select').hide(); // Hide the dropdown
    el.style.display = 'none'; // Hide the plus sign
    $('#' + el.id + 'Text').show(); // Show the text input field
    $('#' + el.id + 'Cancel').show(); // Show the cancel icon
    $('#' + el.id + 'Text').focus(); // Put the focus on the text input
  } else { // We're regretting!
  // Some more creative (and ugly) cut'n'pasting-replacing of element IDs to change the label back
    document.getElementById(el.id.replace('AddCancel', '') + 'SelectLabel').innerHTML = ucfirst(document.getElementById(el.id.replace('AddCancel', '') + 'SelectLabel').innerHTML.replace('New ', ''));
    $('#' + el.id.replace('AddCancel', '') + 'Select').show(); // Show the dropdown again
    $('#' + el.id.replace('Cancel', '')).show(); // Show the plus sign again
    $('#' + el.id.replace('Cancel', '') + 'Text').hide(); // Hide the text input
    el.style.display = 'none'; // Hide the cancel icon
    document.getElementById(el.id.replace('Cancel', '') + 'Text').value = null; // We need to empty the text input, or the ajax call will think the user added something (Ajax can't see that it is hidden)
    $('#' + el.id.replace('AddCancel', '') + 'Select').focus(); // Put the focus on the dropdown
  }
}

function popSel(sel, type) { // Let's pop a sel!
  if (!sel && type) {
    var sel = document.getElementById(type.name + 'Select'); // No sel provided, but we've got the type. Hopefully, there's only one...
  } else if (sel && !type) {
    var type = classes[sel.id.replace('Select', '').toLowerCase()]; // Who needs a type when we've got the select?
  }
  if (sel && type) { // Both were provided (or we figured them out)
    sel.innerHTML = null;
    addTypeOptions(sel, type); // Add all the object of a specific type as options to the select
    hideLoading(type);
  }
}

function popSels(sels){ // Let's pop some sels
  if (!sels) {
    var sels = [];
    for (var item in classes) {
      if (document.getElementById(classes[item].name + 'Select')) {
        sels.push(document.getElementById(classes[item].name + 'Select')); // No selects provided, but don't worry - we'll figure it out. Hopefully, there's only one of each type...
      }
    }
  }
  for (var sel in sels) {
    if (getType(sels[sel]) == 'HTMLSelectElement') { // We've gathered all selects to be populate
      popSel(sels[sel]); // ...so let's populate them
    }
  }
}

function enterClick(id, e) { // Simple function to make enter in a text input click a button (id = button ID). Will this work in IE?
  e = e || window.event;
  if (e.which == 13 || e.keyCode == 13) {
    e.preventDefault();
    e.returnValue = false;
    document.getElementById(id).click();
  }
}

function popTbl(tbl, type) { // Let's populate a table
  if (!tbl && type) {
    var tbl = document.getElementById(type.name + 'Table'); // No table provided, but we've got the type. Hopefully, there's only one...
  } else if (tbl.id && !type) {
    var type = classes[tbl.id.replace('Table', '').toLowerCase()]; // Who needs a type when we've got the table?
  }
  if (tbl && type) { // Both were provided (or we figured them out)
    try {
      $('#' + tbl.id).dataTable.fnClearTable();// Clear the datatable layout (and the table) if the datatable object exists...
    } catch(err) {
      tbl.innerHTML = null; // ...otherwise empty the whole table. (Nulling the table with datatable object attached will make datatable freak out.)
    }
    addThead(tbl, type); // Add headers...
    var tbody = addTbody(tbl); // ...body...
    addRows(tbody, type, true); // ...and rows
    hideLoading(type);
    $('#' + tbl.id).dataTable({'bProcessing': true, 'bDestroy': true}); // Rebuild the datatable
    $('#' + tbl.id).css('width', '') // This is needed, or the table is butt ugly!
  }
}

function popTbls(tbls){ // Let's populate some tables
  if (!tbls) {
    var tbls = [];
    for (var item in classes) {
      if (document.getElementById(classes[item].name + 'Table')) {
        tbls.push(document.getElementById(classes[item].name + 'Table')); // No tables provided, but don't worry - we'll figure it out. Hopefully, there's only one of each type...
      }
    }
  }
  for (var tbl in tbls) { // We've gathered all selects to be populate
    popTbl(tbls[tbl]); // ...so let's populate them
  }
}

function addThead(tbl, type, meBtn) { // meBtn is the "This is me!" button at the end of each row - it also needs a header
  var thead = tbl.createTHead();
  addTheaders(thead, type.headers, meBtn); // The type is the meta object (scroll up) containing meta info about the classes - including what headers to use
}

function addTheaders (thead, headers, meBtn) { // meBtn is the "This is me!" button at the end of each row - it also needs a header
  thead.innerHTML = null;
  var tr = thead.insertRow(-1);
  tr.className += ' header';
  for (var header in headers) { // Let's go through the headers form the meta information objects
    var th = document.createElement('th');
    tr.appendChild(th)
    th.appendChild(document.createTextNode(ucfirst(headers[header])));
  }
  var th = document.createElement('th');
  if (meBtn) { // "This is me!" should be shown
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

// "link" true/false = generate links for linkable fields
// "meBtns" true/false = add the "This is me!" button at the end of each row
// "sels" true/false = make all suitable fields into selects containing all objects of that class, with the current one pre-selected (to let a player change his/her city, or similar).
function addRows(tbody, type, links, meBtns, sels, objs) {
  tbody.innerHTML = null;
  objs = (objs) ? objs : window[type.plural]; // If no objs were provided, use the type and get the global array with all objects of that type
  for (var obj in objs) {
    addRow(tbody, objs[obj], links, meBtns, sels);
  }
}

// "link" true/false = generate links for linkable fields
// "meBtns" true/false = add the "This is me!" button at the end of each row
// "sels" true/false = make all suitable fields into selects containing all objects of that class, with the current one pre-selected (to let a player change his/her city, or similar).
function addRow(tbody, obj, link, meBtn, sels) {
  var tr = tbody.insertRow(-1);
  var headers = classes[obj.class].headers; // Get the headers to use
  for (var header in headers) {
    var td = tr.insertCell(-1);
    if (obj[headers[header]] || obj[headers[header] + '_id']) { // Check that the header exist on this object
      obj.addParents(); // Make sure all parent-child relations are there
      var item = null;
      if (sels && obj[headers[header]].hasOwnProperty('name')) { // If there is a name on the content, it means that this header contains another object - so let's make a select
        var item = document.createElement('select');
        item.id = headers[header] + 'Select';
        popSel(item); // Populate it with all objects of the specific type
        selectOption(item, obj[headers[header]].id); // Select the correct option
      } else {
        if (link) {
          if (!obj.links) {
            obj.addLinks(); // Make sure all links have been generated
          }
          item = (obj.links[headers[header]]) ? obj.links[headers[header]] : null; // If there is a link - let's use it
        } 
        var item = (item) ? item : ((obj[headers[header]].hasOwnProperty('name')) ? document.createTextNode(obj[headers[header]].name) : document.createTextNode(obj[headers[header]])); // There was no link - so let's just add the text (either a name - if this is an object, or the actual content - if this is a string)
      }
      td.appendChild(item);
    }
  }
  if (meBtn) { // This is me! button
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

function tShirtIcon(tbody) { // This is not used yet, but will be
  var tr = tbody.insertRow(-1);
  var td = tr.insertCell(-1);
  var td = tr.insertCell(-1);
  var img = document.createElement('img');
  img.id = 'tShirt' + number;
  img.src = 'images/add_icon.gif';
  img.className += ' icon';
  img.onclick = 'addTShirt(this);';
  img.alt = 'Click to add a T-shirt';
  img.title = img.alt;
  td.appendChild(img);
}

function addLink(obj) { // Create a link for an object. This will be rewritten.
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

function addParent(obj, type) { // Add a parent-child relationship. This should be rewritten to a nice and fancy loop using window[classes] or window[type] in stead of these childish switch statements!
  switch (type) { // First: Find parent and introduce it to the child
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
  if (parent) { // Second: Introduce the child to the parent
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

function unknown(type) { // Create a dummy object containing empty properties
  return new window[type.name.toUpperCase()]({
    class: type,
    id: 0,
    name: 'Unknown ' + type.name
  });
}

function findObject(id, type) { // Find an object using the ID and the class
  var objs = window[type.plural];
  for (var obj in objs) {
    if (objs[obj].id == id) {
      return objs[obj];
    }
  }
  return unknown(type); // None found!
}

function continent(id) { // Get the continent object with the specified ID
  if (getType(id) != 'Null' && getType(id) != 'Undefined') {
    return (id) ? findObject(id, classes.continent) : continents[continents.length -1] || false;
  } else {
    return unknown(classes.continent); // None found!
  }
}

function country(id) { // Get the country object with the specified ID
  if (getType(id) != 'Null' && getType(id) != 'Undefined') {
    return (id) ? findObject(id, classes.country) : countries[countries.length -1] || false;
  } else {
    return unknown(classes.country); // None found!
  }
}

function region(id) { // Get the region object with the specified ID
  if (getType(id) != 'Null' && getType(id) != 'Undefined') {
    return (id) ? findObject(id, classes.region) : regions[regions.length -1] || false;
  } else {
    return unknown(classes.region); // None found!
  }
}

function city(id) { // Get the city object with the specified ID
  if (getType(id) != 'Null' && getType(id) != 'Undefined') {
    return (id) ? findObject(id, classes.city) : cities[cities.length -1] || false;
  } else {
    return unknown(classes.city); // None found!
  }
}

function player(id) { // Get the player object with the specified ID
  if (getType(id) != 'Null' && getType(id) != 'Undefined') {
    return (id) ? findObject(id, classes.player) : players[players.length -1] || false;
  } else {
    return unknown(classes.player); // None found!
  }
}

function gender(id) { // Get the gender object with the specified ID
  if (getType(id) != 'Null' && getType(id) != 'Undefined') {
    return (id) ? findObject(id, classes.gender) : genders[genders.length -1] || false;
  } else {
    return unknown(classes.gender); // None found!
  }
}

function hideLoading(type) {
  $('#' + type.name + 'Loading').hide();
}

function showLoading(type) {
  $('#' + type.name + 'Loading').show();
}

function popGeo(type) { // What is this doing?? It's recursive, it creates a variable, puts objects into it, returns nothing, and then the variable is destroyed when the function is finished? But why?
  if (type) {
    var objs = window[type.plural];
  } else {
    for (var item in classes) {
      popGeo(classes[item]);
    }
  }
}

function loadScript(url) { // Generic function for javascript loading. Don't think we ever use this.
  if (scripts.indexOf(url) == -1) {
    var js = document.createElement("script");
    js.src = url;
    js.type="text/javascript";
    document.getElementsByTagName("head")[0].appendChild(js);
    scripts.push(url)
  }
}

function getType(obj) { // Get a nicer variable type notation than the native Javascript one (everything is a freaking object in Javascript!)
 return ({}).toString.call(obj).match(/\s([a-zA-Z]+)/)[1];
}

function htmlEntitiesEncode(str) { // Generic function for html entities. Don't think we ever use this.
  var div = document.createElement("div");
  var text = document.createTextNode(str);
  div.appendChild(text);
  return div.innerHTML;
}

function htmlEntitiesDecode(str) { // Generic function for html entities. Don't think we ever use this.
  var ta = document.createElement("textarea");
  ta.innerHTML = str.replace(/</g,"&lt;").replace(/>/g,"&gt;");
  return ta.value;
}

function varDump(obj, name, tab) { // Debug function that recursively walk through a variable. Might hit the roof though, and then show nothing.
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

function debugOut(obj, name) { // Send some info to the debug div, if debugMode is true. Which, right now, it always is.
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
