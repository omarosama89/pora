<?php

class Application_Model_DbTable_Material extends Zend_Db_Table_Abstract
{

    protected $_name = 'material';

    private $_attributes = array('id','title','type','location','owner','cid');

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

	public function addMaterial($data){
		$data = $this->extractData($data);
		$this->insert($data);
	}

	public function getMaterials($id){
		$query = $this->select();
		$query->where('cid='.$id);
		return $this->fetchAll($query)->toArray();
	}

}

