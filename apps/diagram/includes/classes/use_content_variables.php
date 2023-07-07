<?php
/**
* This file contains classes and function for the variables content management.
*
* @package    use_content
* @subpackage business_process
* @version    1.0
* @date       05 May 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the contents management.
*/
class object_content_variables extends BUS_object
{

	/**
	* constructor contents
    *
    * @access public
	*/
    public function __construct()
    {
		$this->nameSet(get_class());
		$this->dbnameSet('dgm');
		$this->idSet('id');
		$this->selectLabelFieldSet('label');

		/* Table structure for the object */
		$this->tableSet('dmg_content');
		$this->joinTableSet('dmg_domain', 'id','dmg_content','domain_id');
		$this->joinTableSet('dmg_content_type', 'id','dmg_content','type_id');

		$this->fieldTableSet('id');
		$this->fieldTableSet('domain_id');
		$this->fieldTableSet('domain_name','dmg_domain','name');
		$this->fieldTableSet('type_id');
		$this->fieldAttrSet('type_id', 'integer');
		$this->filterSet('type_id', 3);
		$this->fieldTableSet('type','dmg_content_type','code');
		$this->fieldTableSet('label');
		$this->fieldAttrSet('label', 'string', array(
			'required' => true,
			'size' => 100));
		$this->fieldTableSet('title');
		$this->fieldAttrSet('title', 'string', array(
			'required' => true,
			'size' => 100));
		$this->fieldTableSet('image');
		$this->fieldAttrSet('image', 'string', array(
			'size' => 255));
		$this->fieldTableSet('description');
		$this->fieldAttrSet('description', 'text');
		$this->fieldTableSet('comp_image');
		$this->fieldAttrSet('comp_image', 'string', array(
			'size' => 255));
		$this->fieldTableSet('comp_description');
		$this->fieldAttrSet('comp_description', 'text');

		$this->fieldCompoSet('code', 'append', 'label');

		$this->whereTableSet('label');

		$this->orderTableSet(0,'id');
		$this->orderTableSet(1,'domain_id');
		$this->orderTableSet(1,'type_id');
		$this->orderTableSet(1,'label');
		$this->orderTableSet(1,'id');
	}
	
     public static function _copy($contentId, $newDomainId) {
		$newContentId = 0;
		
		$tbContent = new Smart_select('dmg_content', 'dgm');
		$tbContent->fieldSet('id');
		$tbContent->fieldSet('domain_id');
		$tbContent->fieldSet('type_id');
		$tbContent->fieldSet('title');
		$tbContent->fieldSet('image');
		$tbContent->fieldSet('description');
		$tbContent->fieldSet('comp_image');
		$tbContent->fieldSet('comp_description');
		$tbContent->whereSet('id',$contentId);
		$content = $tbContent->find();

		$contentDomainId = $content['domain_id'];
		$contentTypeId = $content['type_id'];
		$contentTitle = $content['title'];
		$contentImage = $content['image'];
		$contentDescription = $content['description'];
		$contentCompImage = $content['comp_image'];
		$contentCompDescription = $content['comp_description'];
		
		$tbContent = new Smart_select('dmg_content', 'dgm');
		$tbContent->fieldSet('id');
		$tbContent->whereSet('domain_id',$newDomainId);
		$tbContent->whereSet('type_id',$contentTypeId, 'and');
		$tbContent->whereSet('title',$contentTitle, 'and');
		$content = $tbContent->find();
		if (empty($content)) {
			$sequence = self::_maxSequence($newDomainId);

			$tbContent = new Smart_record('dmg_content', 'dgm');
			$tbContent->fieldSet('domain_id', $newDomainId);
			$tbContent->fieldSet('type_id', $contentTypeId);
			$tbContent->fieldSet('title', $contentTitle);
			$tbContent->fieldSet('image', $contentImage);
			$tbContent->fieldSet('description', $contentDescription);
			$tbContent->fieldSet('comp_image', $contentCompImage);
			$tbContent->fieldSet('comp_description', $contentCompDescription);
			$newContentId = $tbContent->insert();
		
		}
		return $newContentId;
	}

}