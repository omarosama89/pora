<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract
{

    protected $_name = 'category';

    private $_attributes = array('title','descr','owner');

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


	public function getCategories($attr,$val){
		if(is_null($attr)){
			$data = $this->fetchAll()->toArray();
		}else{
			$query = $this->select();
			$query->where($attr.'='.$val);
			$data = $this->fetchAll($query)->toArray();
		}
		return $data;
	}

	public function addCategory($data){
		$data = $this->extractData($data);
		$this->insert($data);
	}

}

