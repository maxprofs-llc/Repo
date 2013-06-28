<?php
  echo('
<html>
  <head>
    <title>Populate</title>
  </head>
  <body>
  ');
  function debug($str){
    if ($GLOBALS['debug']) {
      echo('<br />'.$str.'<br /><br />');
    }
  }
  function debug_r($arr){
    if ($GLOBALS['debug']) {
      echo('<br />');
      print_r($arr);
      echo('<br /><br />');
    }
  }
  $conn = @mysql_connect('localhost', 'root', 'Lagerlof18') or die(mysql_errno().': '.mysql_error()."\n");
  $debug = isset($_POST['debug']);
  debug_r($_POST);
  if ($_POST['run']==1) {
    $v1Db = (isset($_POST['v1Db'])) ? $_POST['v1Db'] : 'stats_v1';
    $v2Db = (isset($_POST['v2Db'])) ? $_POST['v2Db'] : 'stats_provskott';
    $template = isset($_POST['template']);
    if ($template){
      $templDb = (isset($_POST['templDb'])) ? $_POST['templDb'] : 'stats_test';
      $db = mysql_select_db($templDb,$conn);
      $res = mysql_query('show tables');
      while($row = mysql_fetch_row($res)){
        $tables[] = $row[0];
      }
      debug_r($row);
      echo('Creating tables');
      foreach ($tables as $table){
        $res = mysql_query('show create table `'.$templDb.'`.`'.$table.'`');
        $row = mysql_fetch_row($res);
        mysql_query('DROP TABLE `'.$v2Db.'`.`'.$table.'`');
        $row[1] = str_replace('CREATE TABLE ','create table `'.$v2Db.'`.',$row[1]);
        $row[1] = preg_replace('/`([^`]+)id`/','\\1Id',$row[1]);
        $row[1] = str_replace('NOT NULL','default NULL',$row[1]);
        $row[1] = str_replace('`id` bigint(20) unsigned default NULL auto_increment','`id` bigint(20) unsigned NOT NULL auto_increment',$row[1]);
        $row[1] = str_replace('`id` bigint(20) default NULL auto_increment','`id` bigint(20) unsigned NOT NULL auto_increment',$row[1]);
        $row[1] = str_replace('`id` bigint(20) unsigned default NULL','`id` bigint(20) unsigned NOT NULL auto_increment',$row[1]);
        $row[1] = str_replace('`id` bigint(20) default NULL','`id` bigint(20) unsigned NOT NULL auto_increment',$row[1]);
        debug($row[1]);
        mysql_query($row[1]) or die(mysql_errno().': '.mysql_error()."\n");
        echo('... '.$table.' ');
      }
      echo('<br /><br />Structure fixed and (hopefully) written to '.$v2Db.' from '.$templDb.'.<br /><br />');
    } else {
      echo('No template database chosen, so let\'s hope the structure is already there...<br /><br />');
    }
    
    $db = mysql_select_db($v1Db,$conn);

    foreach(array('opponent', 'countries') as $table){
      debug($table);
      mysql_query('update '.$table.' set land="Mexiko" where land="Mexico"') or die(mysql_errno().': '.mysql_error()."\n");
      mysql_query('update '.$table.' set land="Västtyskland" where land="Väst Tyskland"') or die(mysql_errno().': '.mysql_error()."\n");
      mysql_query('update '.$table.' set land="Nederländerna" where land="Nedländerna"') or die(mysql_errno().': '.mysql_error()."\n");
      mysql_query('update '.$table.' set land="Nederländerna" where land="Holland"') or die(mysql_errno().': '.mysql_error()."\n");
      mysql_query('update '.$table.' set land="Cambodia" where land="Kambodja"') or die(mysql_errno().': '.mysql_error()."\n");
      mysql_query('update '.$table.' set land="Canada" where land="Kanada"') or die(mysql_errno().': '.mysql_error()."\n");
      mysql_query('update '.$table.' set land="Cuba" where land="Kuba"') or die(mysql_errno().': '.mysql_error()."\n");
      mysql_query('update '.$table.' set land="Bosnien & Hercegovina" where land="Bosnien"') or die(mysql_errno().': '.mysql_error()."\n");
      mysql_query('update '.$table.' set land="Bosnien & Hercegovina" where land="Bosnien-Hercegovina"') or die(mysql_errno().': '.mysql_error()."\n");
      mysql_query('update '.$table.' set land="Bosnien & Hercegovina" where land="Bosnien och Hercegovina"') or die(mysql_errno().': '.mysql_error()."\n");
      mysql_query('update '.$table.' set land="Trinidad & Tobago" where land="Trinidad och Tobago"') or die(mysql_errno().': '.mysql_error()."\n");
    }

    foreach(array('opponent', 'arena', 'domare') as $table){
      debug($table);
      mysql_query('update '.$table.' set ort="New York, NY" where ort="Ney York, NY"') or die(mysql_errno().': '.mysql_error()."\n");
      mysql_query('update '.$table.' set ort="New York, NY" where ort="New York. NY"') or die(mysql_errno().': '.mysql_error()."\n");
    }    

    mysql_query('update opponent set land="Danmark" where ort="Köpenhamn"') or die(mysql_errno().': '.mysql_error()."\n");
    
    echo('Washed some data...<br />');
    
    $db = mysql_select_db($v2Db,$conn);

    mysql_query('delete from location where 1') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('alter table location auto_increment=1') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into location set id=1,latitude=52.42565,longitude=13.535156 on duplicate key update id=1,latitude=52.42565,longitude=13.535156') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into location set id=1,latitude=52.42565,longitude=13.535156 on duplicate key update id=1,latitude=52.42565,longitude=13.535156') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into location set id=2,latitude=54.052511,longitude=97.382813 on duplicate key update id=2,latitude=54.052511,longitude=97.382813') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into location set id=3,latitude=51.50145,longitude=-88.945312 on duplicate key update id=3,latitude=51.50145,longitude=-88.945312') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into location set id=4,latitude=-16.815756,longitude=-54.492187 on duplicate key update id=4,latitude=-16.815756,longitude=-54.492187') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into location set id=5,latitude=-29.69823,longitude=156.445313 on duplicate key update id=5,latitude=-29.69823,longitude=156.445313') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into location set id=6,latitude=3.326258,longitude=24.960938 on duplicate key update id=6,latitude=3.326258,longitude=24.960938') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into location set id=7,latitude=-90,longitude=0 on duplicate key update id=7,latitude=-90,longitude=0') or die(mysql_errno().': '.mysql_error()."\n");

    mysql_query('insert into continent set id=1,locationId=1 on duplicate key update id=1,locationId=1') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continent set id=2,locationId=1 on duplicate key update id=2,locationId=2') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continent set id=3,locationId=1 on duplicate key update id=3,locationId=3') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continent set id=4,locationId=1 on duplicate key update id=4,locationId=4') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continent set id=5,locationId=1 on duplicate key update id=5,locationId=5') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continent set id=6,locationId=1 on duplicate key update id=6,locationId=6') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continent set id=7,locationId=1 on duplicate key update id=7,locationId=7') or die(mysql_errno().': '.mysql_error()."\n");

    mysql_query('insert into continentStrings set id=1,languageId="sv",continentId=1,shortName="EUR",name="Europa" on duplicate key update id=1,languageId="sv",continentId=1,shortName="EUR",name="Europa"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=8,languageId="en",continentId=1,shortName="EUR",name="Europe" on duplicate key update id=8,languageId="en",continentId=1,shortName="EUR",name="Europe"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=2,languageId="sv",continentId=2,shortName="ASI",name="Asien" on duplicate key update id=2,languageId="sv",continentId=2,shortName="ASI",name="Asien"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=9,languageId="en",continentId=2,shortName="ASI",name="Asia" on duplicate key update id=9,languageId="en",continentId=2,shortName="ASI",name="Asia"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=3,languageId="sv",continentId=3,shortName="NAM",name="Nordamerika" on duplicate key update id=3,languageId="sv",continentId=3,shortName="NAM",name="Nordamerika"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=10,languageId="en",continentId=3,shortName="NAM",name="North America" on duplicate key update id=10,languageId="en",continentId=3,shortName="NAM",name="North America"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=4,languageId="sv",continentId=4,shortName="SAM",name="Sydamerika" on duplicate key update id=4,languageId="sv",continentId=4,shortName="SAM",name="Sydamerika"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=11,languageId="en",continentId=4,shortName="SAM",name="South America" on duplicate key update id=11,languageId="en",continentId=4,shortName="SAM",name="South America"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=5,languageId="sv",continentId=5,shortName="OCE",name="Oceanien" on duplicate key update id=5,languageId="sv",continentId=5,shortName="OCE",name="Oceanien"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=12,languageId="en",continentId=5,shortName="OCE",name="Oceania" on duplicate key update id=12,languageId="en",continentId=5,shortName="OCE",name="Oceania"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=6,languageId="sv",continentId=6,shortName="AFR",name="Afrika" on duplicate key update id=6,languageId="sv",continentId=6,shortName="AFR",name="Afrika"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=13,languageId="en",continentId=6,shortName="AFR",name="Africa" on duplicate key update id=13,languageId="en",continentId=6,shortName="AFR",name="Africa"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=7,languageId="sv",continentId=7,shortName="ANT",name="Antarktis" on duplicate key update id=7,languageId="sv",continentId=7,shortName="ANT",name="Antarktis"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into continentStrings set id=14,languageId="en",continentId=7,shortName="ANT",name="Antarctica" on duplicate key update id=14,languageId="en",continentId=7,shortName="ANT",name="Antarctica"') or die(mysql_errno().': '.mysql_error()."\n");

    echo('Continents created...<br />');

    mysql_query('insert into country (id,iso2,iso3,numCode) select id,iso2,iso3,numcode from `'.$v1Db.'`.`countries` on duplicate key update country.id=`'.$v1Db.'`.`countries`.`id`, country.iso2=`'.$v1Db.'`.`countries`.`iso2`, country.iso3=`'.$v1Db.'`.`countries`.`iso3`, country.numCode=`'.$v1Db.'`.`countries`.`numcode`') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into countryStrings (id,languageId,countryId,name) select id,"sv",id,land from `'.$v1Db.'`.`countries` on duplicate key update countryStrings.id=`'.$v1Db.'`.`countries`.`id`, countryStrings.languageId="sv", countryStrings.countryId=`'.$v1Db.'`.`countries`.`id`, countryStrings.name=`'.$v1Db.'`.`countries`.`land`') or die(mysql_errno().': '.mysql_error()."\n");

    echo('Countries migrated...<br />');

    mysql_query('select @maxLoc:=MAX(id) from location') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into location (zipArea, countryId) (select ort,countryid from `'.$v1Db.'`.arena where ort is not null and ort!="" and ort!="Okänd ort") UNION (select ort,countryid from `'.$v1Db.'`.domare where ort is not null and ort!="" and ort!="Okänd ort") UNION (select o.ort,c.id from `'.$v1Db.'`.opponent as o, `'.$v1Db.'`.countries as c where o.ort is not null and o.ort!="" and ort!="Okänd ort" and o.land=c.land) order by ort') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('update location set zipArea=NULL where 1') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('delete from city where 1') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('alter table city auto_increment=1') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into city (url,countryId) (select ort,countryid from `'.$v1Db.'`.arena where ort is not null and ort!="" and ort!="Okänd ort") UNION (select ort,countryid from `'.$v1Db.'`.domare where ort is not null and ort!="" and ort!="Okänd ort") UNION (select o.ort,c.id from `'.$v1Db.'`.opponent as o, `'.$v1Db.'`.countries as c where o.ort is not null and o.ort!="" and ort!="Okänd ort" and o.land=c.land) order by ort') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('update city set url=NULL, locationId=id+@maxLoc where 1') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('delete from cityStrings where 1') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('alter table cityStrings auto_increment=1') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into cityStrings (name,publicComment) (select ort,countryid from `'.$v1Db.'`.arena where ort is not null and ort!="" and ort!="Okänd ort") UNION (select ort,countryid from `'.$v1Db.'`.domare where ort is not null and ort!="" and ort!="Okänd ort") UNION (select o.ort,c.id from `'.$v1Db.'`.opponent as o, `'.$v1Db.'`.countries as c where o.ort is not null and o.ort!="" and ort!="Okänd ort" and o.land=c.land) order by ort') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('update cityStrings set cityid=id, publicComment=NULL, languageId="sv" where 1') or die(mysql_errno().': '.mysql_error()."\n");

    echo('Cities migrated...<br />');

    mysql_query('select @maxLoc:=MAX(id) from location') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into location (id,cityId,countryId,longitude,latitude) select l.id+a.id, c.id, c.countryId, a.longitude, a.latitude from location as l, `'.$v1Db.'`.arena as a, city as c, cityStrings as cS where c.id=cS.id and cS.languageId="sv" and cS.name=a.ort and a.name!="Okänd arena" and a.ort!="Okänd ort" and l.id=@maxLoc on duplicate key update id=l.id+a.id, cityId=c.id, countryId=c.countryId, longitude=a.longitude, latitude=a.latitude') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into arena (id,locationId) select a.id, l.id+a.id from location as l, `'.$v1Db.'`.arena as a, city as c, cityStrings as cS where c.id=cS.id and cS.languageId="sv" and cS.name=a.ort and a.name!="Okänd arena" and a.ort!="Okänd ort" and l.id=@maxLoc on duplicate key update arena.id=a.id, arena.locationId=l.id+a.id') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into arenaStrings (id,name) select a.id,a.name from `'.$v1Db.'`.arena as a, city as c, cityStrings as cS where c.id=cS.id and cS.languageId="sv" and cS.name=a.ort and a.name!="Okänd arena" and a.ort!="Okänd ort" on duplicate key update arenaStrings.id=a.id, arenaStrings.name=a.name') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('update arenaStrings set languageId="sv", arenaId=id where 1') or die(mysql_errno().': '.mysql_error()."\n");

    echo('Arenas migrated...<br />');

    mysql_query('insert into sport set id=1 on duplicate key update id=1') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into sportStrings set id=1, languageId="sv", sportId=1, name="Fotboll" on duplicate key update id=1, languageId="sv", sportId=1, name="Fotboll"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into sportStrings set id=2, languageId="en", sportId=1, name="Football" on duplicate key update id=2, languageId="en", sportId=1, name="Football"') or die(mysql_errno().': '.mysql_error()."\n");

    mysql_query('insert into gender set id=1 on duplicate key update id=1') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into gender set id=2 on duplicate key update id=2') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into genderStrings set id=1, languageId="sv", genderId=1, name="Herrar" on duplicate key update id=1, languageId="sv", genderId=1, name="Herrar"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into genderStrings set id=2, languageId="en", genderId=1, name="Men" on duplicate key update id=2, languageId="en", genderId=1, name="Men"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into genderStrings set id=3, languageId="sv", genderId=2, name="Damer" on duplicate key update id=3, languageId="sv", genderId=2, name="Damer"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into genderStrings set id=4, languageId="en", genderId=2, name="Women" on duplicate key update id=4, languageId="en", genderId=2, name="Women"') or die(mysql_errno().': '.mysql_error()."\n");
    
    mysql_query('insert into section set id=1 on duplicate key update id=1') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into sectionStrings set id=1, languageId="sv", sectionId=1, name="A-lag" on duplicate key update id=1, languageId="sv", sectionId=1, name="A-lag"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into sectionStrings set id=2, languageId="en", sectionId=1, name="A team" on duplicate key update id=2, languageId="en", sectionId=1, name="A team"') or die(mysql_errno().': '.mysql_error()."\n");

    mysql_query('insert into organizationType set id=1, name="Sports club" on duplicate key update id=1, name="Sports club"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into organizationType set id=2, name="National sports association" on duplicate key update id=2, name="National sports association"') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into organizationType set id=3, name="Temporary compilation" on duplicate key update id=3, name="Temporary compilation"') or die(mysql_errno().': '.mysql_error()."\n");
    
    mysql_query('select @maxLoc:=MAX(id) from location') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into organization (id,locationId,organizationTypeId,nativeName,shortName,url,privateComment) select o.id,@maxLoc+o.id,replace(replace(replace(o.teamtype,"Klubblag","1"),"Landslag","2"),"Kombinationslag","3"),o.name,o.forkortning,o.homepage,o.comment from stats_v1.opponent as o, city as c, country as co, cityStrings as cS, countryStrings as coS where o.ort=cS.name and cS.cityId=c.id and o.land=coS.name and coS.countryId=co.id order by id on duplicate key update id=o.id, locationId=@maxLoc+o.id, organizationTypeId=replace(replace(replace(o.teamtype,"Klubblag","1"),"Landslag","2"),"Kombinationslag","3"), nativeName=o.name, shortName=o.forkortning, url=o.homepage, privateComment=o.comment') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into organizationStrings (id,languageId,organizationId,name,publicComment) select o.id,"sv",o.id,o.name,o.comment from stats_v1.opponent as o, city as c, country as co, cityStrings as cS, countryStrings as coS where o.ort=cS.name and cS.cityId=c.id and o.land=coS.name and coS.countryId=co.id order by o.id on duplicate key update id=o.id, languageId="sv", organizationId=o.id, name=o.name, publicComment=o.comment') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into location (id,cityId,countryId) select @maxLoc+o.id,c.id,co.id from stats_v1.opponent as o, city as c, country as co, cityStrings as cS, countryStrings as coS where o.ort=cS.name and cS.cityId=c.id and o.land=coS.name and coS.countryId=co.id order by o.id on duplicate key update id=@maxLoc+o.id, cityId=c.id, countryId=co.id') or die(mysql_errno().':'.mysql_error()."\n");

    mysql_query('select @maxLoc:=MAX(id) from location') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into team (id,organizationId,genderId,sportId,sectionid,locationId,privateComment) select o.id,o.id,1,1,1,@maxLoc+o.id,o.comment from stats_v1.opponent as o, city as c, country as co, cityStrings as cS, countryStrings as coS where o.ort=cS.name and cS.cityId=c.id and o.land=coS.name and coS.countryId=co.id order by id on duplicate key update id=o.id, organizationId=o.id,genderId=1,sportId=1,sectionId=1,locationId=@maxLoc+o.id,privateComment=o.comment') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into teamStrings (id,languageId,teamId,name,shortName,publicComment) select o.id,"sv",o.id,o.name,o.forkortning,o.comment from stats_v1.opponent as o, city as c, country as co, cityStrings as cS, countryStrings as coS where o.ort=cS.name and cS.cityId=c.id and o.land=coS.name and coS.countryId=co.id order by id on duplicate key update id=o.id, languageId="sv",teamId=o.id,name=o.name,shortName=o.forkortning,publicComment=o.comment') or die(mysql_errno().': '.mysql_error()."\n");
    mysql_query('insert into location (id,cityId,countryId) select @maxLoc+o.id,c.id,co.id from stats_v1.opponent as o, city as c, country as co, cityStrings as cS, countryStrings as coS where o.ort=cS.name and cS.cityId=c.id and o.land=coS.name and coS.countryId=co.id order by o.id on duplicate key update id=@maxLoc+o.id, cityId=c.id, countryId=co.id') or die(mysql_errno().':'.mysql_error()."\n");

    echo('Teams/clubs migrated...<br />');

    echo('<br />Nothing more to do.<br />');
    echo('<br />Hmm... seems like it worked to me? <a href="https://ithora.pal.pp.se/phpmyadmin/index.php?db='.$v2Db.'" target="_new">Go check it out</a>!<br />');
    echo('<br />No, you say? Damn. <a href="populate.php">At it again</a>!<br />');

  } else {
    echo('
    <form action="populate.php" method="POST">
    <input type="hidden" name="run" value="1">
      <table>
        <tr>
          <td></td>
          <td>Version 1 database:</td>
          <td>
            <select name="v1Db">
    ');    
    $res = mysql_list_dbs($conn);
    while($row = mysql_fetch_assoc($res)){
      if (substr($row['Database'],0,5)=='stats') {
        echo('              <option value="'.$row['Database'].'"');
        if ($row['Database']=='stats_v1'){
          echo(' selected="selected"');
        }
        echo('>'.$row['Database']."</option>\n");
      }
    }
    mysql_free_result($res);
    echo('
            </select>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>New database:</td>
          <td>
            <select name="v2Db">
    ');
    $res = mysql_list_dbs($conn);
    while($row = mysql_fetch_assoc($res)){
      if (substr($row['Database'],0,5)=='stats') {
        echo('              <option value="'.$row['Database'].'"');
        if ($row['Database']=='stats_provskott'){
          echo(' selected="selected"');
        }
        echo('>'.$row['Database']."</option>\n");
      }
    }
    mysql_free_result($res);
    echo('
            </select>
          </td>
        </tr>
        <tr>
          <td><input type="checkbox" name="template" value="1" id="template" onclick="document.getElementById(\'templateDb\').disabled=!document.getElementById(\'template\').checked;"></td>
          <td>Use template database:</td>
          <td>
            <select name="templateDb" disabled="disabled" id="templateDb">
    ');
    $res = mysql_list_dbs($conn);
    while($row = mysql_fetch_assoc($res)){
      if (substr($row['Database'],0,5)=='stats') {
        echo('              <option value="'.$row['Database'].'"');
        if ($row['Database']=='stats_test'){
          echo(' selected="selected"');
        }
        echo('>'.$row['Database']."</option>\n");
      }
    }
    mysql_free_result($res);
    mysql_close($conn);
    echo ('
            </select>
          </td>
        </tr>
        <tr>
          <td><input type="checkbox" name="debug" value="1"></td>
          <td>Debug</td>
          <td><input type="submit"></td>
      </table>
    </form>
  </body>
</html>
    ');
  }
?>
