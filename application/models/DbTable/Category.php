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

	public function getCategory($id){
		return $this->find($id)->toArray()[0];
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

	public function updateCategory($id,$data){
		$data = $this->extractData($data,array('title','descr'));
		$where = $this->getAdapter()->quoteInto('id = ?', $id);
		return $this->update($data,$where);
	}

	public function deleteCategory($id){
		// echo $id;exit;
		$where = 'id = '.$id;
		$this->delete($where);
	}
}

