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


	public function getMaterialCourse($id){
		$record = $this->find($id)->toArray()[0];
		return $record['cid'];
	}

	public function addMaterial($data){
		$data = $this->extractData($data);
		$this->insert($data);
	}

	public function getMaterials($attr,$val){
		if(is_null($attr)){
			$data = $this->fetchAll()->toArray();
		}else{
			$query = $this->select();
			$query->where($attr.'='.$val);
			$data = $this->fetchAll($query)->toArray();
		}
		return $data;
	}

	public function getMaterial($id){
		return $this->find($id)->toArray()[0];
	}

	public function deleteMaterial($id){
		// echo $id;exit;
		$where = 'id = '.$id;
		$this->delete($where);
	}
	public function updateMaterial($id,$data){
		$data = $this->extractData($data,array('title','descr','cid'));
		$where = $this->getAdapter()->quoteInto('id = ?', $id);
		return $this->update($data,$where);
	}
}

