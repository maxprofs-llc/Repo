<?php
	class weather_weather extends locatable_inCity {
	
		//Pointers
		
		public $precipitationTypeId;	//Type of precipitation, eg Rain, Snow etc
		public $weatherType;		//Type of weather, eg Sunny, Cloudy, Skies etc
		public $windGeoDirectionId;	//Direction of wind, N, S, SW etc
		
		//Properties
	
		public $date;				//Date of weather measurement
		public $time;				//Time of weather measurement
		public $temperature;		//Temperature in °C
		public $windSpeed;			//Wind speed in m/s
		public $gustSpeed;			//Gust speed in m/s
		public $visibility;			//Visibility in %
		public $humidity;			//Humidity in %
		public $pressure;			//Pressure in bar
		public $precipitation;		//Precipitation in mm
		public $cloudiness;			//Cloudiness in %. 0=Clear blue sky, 100%=Cloud covered sky
		
		//JSON
		
		public $_precipitationType;
		public $_windGeoDirection;
		
		function __construct() {
			parent::__construct();	
		}
		
		function prepareForSerialization() {
			parent::prepareForSerialization();
			$this->_precipitationType=$this->getPrecipitationType();
			$this->_windGeoDirection=$this->getWindGeoDirection();
		}
		
		public function getPrecipitationType() {
			return data_dataStore::getProperty('dataReader')->getPrecipitationTypeById($this->precipitationTypeId);
		}

		public function getWindGeoDirection() {
			return data_dataStore::getProperty('dataReader')->getGeoDirectionById($this->windGeoDirectionId);
		}
		
		function getName() {
			return $this->publicComment;
		}
	}
?>