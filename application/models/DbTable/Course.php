<?php

class Application_Model_DbTable_Course extends Zend_Db_Table_Abstract
{

    protected $_name = 'course';
    private $_attributes = array('title','descr','owner','cid');

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

	public function getCourseCategory($id){
		$arr = $this->find($id)->toArray();
		$record = $arr[0];
		return $record['cid'];
	}

	public function getCourse($id){
		$arr = $this->find($id)->toArray();
		return $arr[0];
	}

	public function getCourseTitle($id){
		$arr = $this->find($id)->toArray();
		$record = $arr[0];
		return $record['title'];
	}

	public function getCourses($attr,$val){
		if(is_null($attr)){
			$data = $this->fetchAll()->toArray();
		}else{
			$query = $this->select();
			$query->where($attr.'='.$val);
			$data = $this->fetchAll($query)->toArray();
		}
		return $data;
	}

	public function addCourse($data){
		$data = $this->extractData($data);
		$this->insert($data);
	}

	public function deleteCourse($id){
		// echo $id;exit;
		$where = 'id = '.$id;
		$this->delete($where);
	}

	public function updateCourse($id,$data){
		$data = $this->extractData($data,array('title','descr','cid'));
		$where = $this->getAdapter()->quoteInto('id = ?', $id);
		return $this->update($data,$where);
	}
}

