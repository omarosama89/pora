<?php

class Application_Model_DbTable_Comment extends Zend_Db_Table_Abstract
{

    protected $_name = 'comment';
    private $_attributes = array('id','content','owner','mid');

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


	//add comment :

	public function addComment($data){
		$data = $this->extractData($data);
		$this->insert($data);
	}

	//list all comments for material
	function listComments($mid){
		$db =Zend_Db_Table::getDefaultAdapter();
		$select = $db->select()->from('comment')->where('mid = ?', $mid);
		return $select->query()->fetchAll();
	}

	// delete comment
	function deleteComment($id){
		return $this->delete('id='.$id);
	}

	//get comment by id
	function getCommentById($id){
		return $this->find($id)->toArray();
	}

	//edit comment
	function editComment($data,$id){
		$data = $this->extractData($data);
		return $this->update($data,'id='.$id);

	}
}

