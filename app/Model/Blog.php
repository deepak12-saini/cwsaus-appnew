<?php
App::uses('AppModel', 'Model');
/**
 * Blog Model
 *
 * @property Blog $Blog
 * @property  $
 */
class Blog extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		
		
	);
	public $actsAs = array(
    'Slugomatic.Slugomatic' => array(
        'fields' => 'title',
		'scope' => false,
        'conditions' => false,
        'slugfield' => 'slug',
        'separator' => '-',
        'overwrite' => true,
        'length' => 256,
        'lower' => true
    )
	);



}
