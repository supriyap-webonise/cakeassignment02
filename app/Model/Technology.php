<?php class Technology extends AppModel
{
	public function gettechnology($getTechId)
	{
		$gettechnology = $this->find('list',array(
													'fields' => array('id', 'name'),																									
													"conditions"=>array("Technology.id IN (".$getTechId.")")));
		return $gettechnology;
	}
}
