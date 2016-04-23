<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';
    private $_attributes = array('uname','email','pwd','fname','lname','gender','country');

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

//----------------------------------------------------------------------------
	function addUser($data){
		$row = $this->createRow();
		$row->uname = $data['uname'];
		$row->email = $data['email'];
		$row->pwd = md5($data['pwd']);
		//echo $row->pwd.":".$data['pwd'];exit;
		$row->fname = $data['fname'];
		$row->lname = $data['lname'];
		//$row->img = $data['image'];
		$row->gender = $data['gender'];
		$row->country = $data['country'];

		return $row->save();
	}

//------------------------------------------------------------------------------
 function listUsers(){
 	// var_dump($this->find($id)->toArray());
 	// exit;
 	return $this->fetchAll()->toArray();

 }	

//------------------------------------------------------------
function getUserById($id){
	return $this->find($id)->toArray();

} 
//----------------------------------------------------------
function editUser($id,$data){
	$extract_data=$this->extractData($data);
	$arrayName = array(
		"pwd" => md5($extract_data['password']),
		 "uname"=> $extract_data['uname'],
		 "email"=> $extract_data['email'],
		 "fname"=> $extract_data['fname'],
		 "lname"=> $extract_data['lname'],
		 "country"=> $extract_data['country'],
		 "gender"=> $extract_data['gender']
		 );
	$where = "id =" . $id;
	return $this->update($arrayName,$where);
	}
//---------------------------------------------------------------------------
	function deleteUser($id){

       return $this->delete('id='.$id);
	}
//-----------------------------------------------------------------------------
	function banUser($id){
	#$extract_data=$this->extractData($data);
	$arrayName = array("isActive" => 0);
	$where = "id =" . $id;
	return $this->update($arrayName,$where);
	}
//-------------------------------------------------------------------------------
	function activeUser($id){
	#$extract_data=$this->extractData($data);
	$arrayName = array("isActive" => 1);
	$where = "id =" . $id;
	return $this->update($arrayName,$where);
	}

//-----------------------------------------------------------------------------


}