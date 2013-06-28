<?php
	class baseClassList extends ArrayObject {

		function getJSON($forceRebuild=false) {
			header("Content-Type: application/json;charset=utf-8");
			$json="[";
			$ser=array();
			foreach($this as $item) {
				if(method_exists($item,'getJSON'))
					$ser[]=$item->getJSON($forceRebuild);
				else
					return Encoding_JSON::encode($item);
			}
			$json.=implode(",", $ser)."]";
			return $json;
		}
		
		public function getArrayOfKeyValues() {
			return array_map("keyValue::FromBaseClass",$this->getArrayCopy());
		}

		function getXML() {
			header("Content-Type: text/xml;charset=utf-8");
			$xml="";
			foreach($this as $item) {
				if(method_exists($item,'getJSON'))
					$xml.=$item->getXML($forceRebuild);
				else
					return Encoding_XML::encode($item);
			}
			return $xml;
		}

		function getHTML($forceRebuild=false, $type = 'div') {
			// $type can (so far) be "div", "table", "list" and "select"
			header("Content-Type: text/html;charset=utf-8");
			$html='<!-- Type: '.$type.' -->';
			foreach($this as $item) {
				if(method_exists($item,'getHTML'))
					$html.=$item->getHTML($forceRebuild, $type);
				else
					return Encoding_HTML::encode($item, false, NULL, $type);
			}
			return $html;
		}

		function merge($list) {
			foreach($list as $item) {
				$this->Append($item);
			}
		}

		function find($value,$property=NULL) {
			$i=0;
			foreach($this as $item) {
				if(is_null($property)) {
					if($value==$item)
						return $i;
				} else {
					if($value==$item->$property)
						return $i;
				}
				$i++;
			}
			return false;
		}
	}
?>