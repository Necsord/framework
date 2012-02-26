<?php
/**
 * @author Marcin Necsord Szulc <servant356@gmail.com>
 * Date: 1/14/12
 */
namespace app\models;
class Users extends \lithium\data\Model {

	/**
	 * @var array
	 */
	protected $_schema = array(
		'_id' => array('type' => 'id'),
		'login' => array('type' => 'string'),
		'warnings' => array(
			'array' => true
		)
	);
}
