<?php
	include_once('_define.php');

	$requestURI = explode('/', $_SERVER['REQUEST_URI']);
	$index=count($requestURI)-1;
	while($requestURI[$index]=='')
		$index -= 1;
	$command=$requestURI[$index];
	if(strpos($command,'?')>0)
		$replace=substr($command,0,strpos($command,'?'));
	$command=str_replace('.php','',$command);
	$command=strtolower($command);
	switch($command) {
		case('agegroups'):
			$page=new pages_ageGroupsPage();
			$list=$dr->getAgeGroupList(false,false);
			$noun='age_group';
			break;				
		case('arenas'):
			$page=new pages_arenasPage();
			$list=$dr->getArenaList(false);
			$noun='arena';
			break;		
		case('cardtypes'):
			$page=new pages_cardTypesPage();
			$list=$dr->getGenericList('cardType','ct','cardType');
			$noun='card_type';
			break;
		case('cities'):
			$page=new pages_citiesPage();
			$list=$dr->getCityList(false,false);
			$noun='city';
			break;			
		case('cohorts'):
			$page=new pages_cohortsPage();
			$list=$dr->getCohortList(false,false);
			$noun='cohort';
			break;
		case('continents'):
			$page=new pages_continentsPage();
			$list=$dr->getContinentList(false,false);
			$noun='continent';
			break;
		case('countries'):
			$page=new pages_countriesPage();
			$list=$dr->getCountryList(false,false);
			$noun='country';
			break;
		case('genders'):
			$page=new pages_gendersPage();
			$list=$dr->getGenderList(false,false);
			$noun='gender';
			break;
		case('geodirections'):
			$page=new pages_geoDirectionsPage();
			$list=$dr->getGeoDirectionList(false,false);
			$noun='geographical_direction';
			break;
		case('matchtypes'):
			$page=new pages_matchTypesPage();
			$list=$dr->getMatchTypeList(false,false);
			$noun='match_type';
			break;
		case('organizations'):
			$page=new pages_organizationsPage();
			$list=$dr->getOrganizationList(false,false);
			$noun='organization';
			break;
		case('organizationtypes'):
			$page=new pages_organizationTypesPage();
			$list=$dr->getOrganizationTypeList(false,false);
			$noun='organization_type';
			break;
		case('periodtypes'):
			$page=new pages_periodTypesPage();
			$list=$dr->getGenericList('periodType','pt','match_periodType',false);
			$noun='period_type';
			break;
		case('persons'):
			$page=new pages_personsPage();
			$list=$dr->getPersonList(false,false);
			$noun='person';
			break;
		case('precipitationtypes'):
			$page=new pages_precipitationTypesPage();
			$list=$dr->getPrecipitationTypeList(false,false);
			$noun='precipitation_type';
			break;
		case('roles'):
			$page=new pages_rolesPage();
			$list=$dr->getRoleList(false,false);
			$noun='role';
			break;
		case('sections'):
			$page=new pages_sectionsPage();
			$list=$dr->getSectionList(false,false);
			$noun='section';
			break;
		case('sports'):
			$page=new pages_sportsPage();
			$list=$dr->getSportList(false,false);
			$noun='sport';
			break;
		case('states'):
			$page=new pages_statesPage();
			$list=$dr->getStateList(false,false);
			$noun='state';
			break;
		case('teams'):
			$page=new pages_teamsPage();
			$list=$dr->getGenericList("team","te","team",false,false);
			$noun='team';
			break;
		default:
			header("HTTP/1.0 404 Not Found");
			$page=new pages_editPage();
			$page->contents->addEntity(new html_p($lang->get('The page you requested was not found'),'pageNotFound'));
			$page->printHTML();	
			die();
			break;
	}

	$dropdown=new html_dropDown();
	$dropdown->id='select'.ucfirst(toCamelCase($noun));
	$selected=$dropdown->addOption('',$lang->get('Choose '.$noun).'...');
	$dropdown->addOption(-1,$lang->get('New '.$noun));
	$dropdown->addOption(-99,$lang->get("Get $noun from Master database"));
	
	foreach($list as $item) {
		$opt=$dropdown->addOption($item->id,$item->getName());
	}
	$selected->selected=true;
	
	$page->contents->addEntity(new html_span($lang->get(ucfirst($noun)).': '));
	$page->contents->addEntity($dropdown);
	
	$form=new html_div();
	$form->id=toCamelCase($noun)."FormContents";
	
	$page->contents->addEntity(new html_p());
	$page->contents->addEntity($form);
	
	$page->printHTML();

	function toCamelCase($str) {
    	$func = create_function('$c', 'return strtoupper($c[1]);');
    	return preg_replace_callback('/_([a-z])/', $func, $str);
  	}
	
/*
$page=new pages_editPage();

$page->contents->addEntity(new html_div('AIK','teamLogo'));

$page->printHTML();
*/
?>