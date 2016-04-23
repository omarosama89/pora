<?php

class Application_Model_DbTable_Request extends Zend_Db_Table_Abstract
{

    protected $_name = 'request';
    private $_attributes = array('content','owner');

	private function extractData($data,$filter){
		$extractedData = array();
		if(isset($filter)){
			$attrs = $filter;
		} else {
			$attrs = $this->_attributes;
		}
		foreach ($data as $key => $value) {
			if(in_array($key, $attrs)){
				$extractedData[$key] = $value;
			}
		}
		return $extractedData;
	}
//--------------------------------------------------------------------
	function addRequest($data){
		$data = $this->extractData($data);
		return $this->insert($data);
		
	}
//--------------------------------------------------------------------
	function listRequest(){
 	// var_dump($this->find($id)->toArray());
 	// exit;
 	return $this->fetchAll()->toArray();
    }	
//---------------------------------------------------------------------
function deleteRequest($id){
		//echo "id is:$id" ; exit;
       return $this->delete('id='.$id);
	}


}

