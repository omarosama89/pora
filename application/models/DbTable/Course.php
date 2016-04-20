<?php

class Application_Model_DbTable_Course extends Zend_Db_Table_Abstract
{

    protected $_name = 'course';
    private $_attributes = array();

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

	public function getCourseTitle($id){
		$record = $this->find($id)->toArray()[0];
		return $record['title'];
	}

	public function getCourses($filter){
		// var_dump($this);
		// exit;
		$data = $this->fetchAll()->toArray();
		if(isset($filter))
			return $this->extractData($data,$filter);
		else
			return $data;
	}
}

