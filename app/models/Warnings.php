<?php
namespace app\models;
/**
 * @author Marcin Necsord Szulc <servant356@gmail.com>
 * Date: 1/14/12
 */
class Warnings extends \lithium\data\Model {

	protected $_schema = array(
		'_id' => array('type' => 'id'),
		'user_id' => array('type' => 'MongoId'),
		'created' => array('type' => 'MongoDate')
	);
}
