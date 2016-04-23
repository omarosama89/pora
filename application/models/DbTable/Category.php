<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract
{

    protected $_name = 'category';

    private $_attributes = array('id','title','descr','owner');

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
	public function getCategoryTitle($id){
		$record = $this->find($id)->toArray()[0];
		return $record['title'];
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

<<<<<<< HEAD
	public function deleteCategory($id){
		return $this->delete('id='.$id);
	}
=======
>>>>>>> 7e2b8f7c5f684c5cebad7b2e4285edc992c41ce8

	function getCategoryById($id){
		return $this->find($id)->toArray();
	}

	public function editCategory($id,$data){
		$data = $this->extractData($data);
		return $this->update($data,'id='.$id);
	}
}


<<<<<<< HEAD
/*
=======
>>>>>>> 7e2b8f7c5f684c5cebad7b2e4285edc992c41ce8
	public function updateCategory($id,$data){
		$data = $this->extractData($data,array('title','descr'));
		$where = $this->getAdapter()->quoteInto('id = ?', $id);
		return $this->update($data,$where);
	}

	public function deleteCategory($id){
		$where = 'id = '.$id;
		$this->delete($where);
	}
<<<<<<< HEAD
>>>>>>> 62fc816913d54e39fd781f7bbc3050ec1be84be1
}*/
=======

}
>>>>>>> 7e2b8f7c5f684c5cebad7b2e4285edc992c41ce8

