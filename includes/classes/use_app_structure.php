<?php
/**
* This file contains classes and functions for the application structure management.
*
* @package   use_application_structure
* @subpackage business_process
* @version   1.0
* @date      03 April 2020
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

defined('_WSEXEC') or die();

/**
* Classes for the users management.
*/
class object_app_structure
{
	private static $_appModel = array(
		'adm' => array(
			'application' => 'adm_application',
			'content' => 'cms_content',
			'feature' => 'adm_feature',
			'menu' => 'adm_menu',
			'menu_feature' => 'adm_menu_feature',
			'ref' => 'adm_application_ref',
			'group' => 'adm_group',
			'group_right' => 'adm_group_right',
			'user_group' => 'adm_user_group',
			'user' => 'adm_user',
		),
		'type' => array(
			'application' => 'adm_apptype',
			'content' => 'adm_apptype_content',
			'feature' => 'adm_apptype_feature',
			'menu' => 'adm_apptype_menu',
			'menu_feature' => 'adm_apptype_menu_feature',
			'ref' => 'adm_apptype_ref',
			'group' => 'adm_apptype_group',
			'group_right' => 'adm_apptype_group_right',
			'user_group' => 'adm_apptype_user_group',
			'user' => 'adm_apptype_user',
		),
		'archive' => array(
			'application' => 'adm_apparchive',
			'content' => 'adm_apparchive_content',
			'feature' => 'adm_apparchive_feature',
			'menu' => 'adm_apparchive_menu',
			'menu_feature' => 'adm_apparchive_menu_feature',
			'ref' => 'adm_apparchive_ref',
			'group' => 'adm_apparchive_group',
			'group_right' => 'adm_apparchive_group_right',
			'user_group' => 'adm_apparchive_user_group',
			'user' => 'adm_apparchive_user',
		),
	);

	// Private functions
	private static function deleteStructure($appId, $model) {
		
		$appModel = self::$_appModel;
		$traitFlag = true;
	
		if (isset($appModel[$model])) {
			$object = $appModel[$model];
		
			// Delete contents
			displayMsg('Delete contents', '', 2);
			displayMsg($object['content'], 'Delete All', 3);
			$tbContent = new Smart_select($object['content']);
			$tbContent->whereSet('application_id', $appId);
			$tbContent->delete();

			// Delete features
			displayMsg('Delete features', '', 2);
			displayMsg($object['feature'], 'Delete All', 3);
			$tbFeature = new Smart_select($object['feature']);
			$tbFeature->whereSet('application_id', $appId);
			$tbFeature->delete();
		
			// Delete menus
			displayMsg('Delete menus', '', 2);
			$tbMenuSource = new Smart_select($object['menu']);
			$tbMenuSource->fieldAll();
			$tbMenuSource->whereSet('application_id', $appId);
			$menuSources = $tbMenuSource->findAll();
			foreach($menuSources as $menuSource) {
				$menuId = $menuSource['id'];
				displayMsg($object['menu_feature'], 'Delete - ' . $menuId, 3);
				$tbMenuFeature = new Smart_select($object['menu_feature']);
				$tbMenuFeature->whereSet('menu_id', $menuId);
				$tbMenuFeature->delete();
			}
			displayMsg($object['menu'], 'Delete All', 3);
			$tbMenu = new Smart_select($object['menu']);
			$tbMenu->whereSet('application_id', $appId);
			$tbMenu->delete();
		
			// Delete references
			displayMsg('Delete references', '', 2);
			displayMsg($object['ref'], 'Delete All', 3);
			$tbRef = new Smart_select($object['ref']);
			$tbRef->whereSet('application_id', $appId);
			$tbRef->delete();
		
			// Delete users/groups/rights
			displayMsg('Delete users/groups/rights', '', 2);
			$tbGroup = new Smart_select($object['group']);
			$tbGroup->fieldAll();
			$tbGroup->whereSet('application_id', $appId);
			$groups = $tbGroup->findAll();
			foreach($groups as $group) {
				$groupId = $group['id'];
					
				$tbUserGroup = new Smart_select($object['user_group']);
				$tbUserGroup->fieldAll();
				$tbUserGroup->whereSet('group_id', $groupId);
				$userGroups = $tbUserGroup->findAll();
				foreach($userGroups as $userGroup) {
					$userId = $userGroup['user_id'];
					$tbUserGroup = new Smart_select($object['user_group']);
					$tbUserGroup->fieldAll();
					$tbUserGroup->whereSet('user_id', $userId);
					$listUserGroup = $tbUserGroup->findAll();
					if (count($listUserGroup) == 1) {
						displayMsg($object['user'], 'Delete - ' . $userId, 3);
						$tbUser = new Smart_select($object['user']);
						$tbUser->whereSet('id', $userId);
						$tbUser->delete();
					}
				}
				displayMsg($object['user_group'], 'Delete - ' . $groupId, 3);
				$tbUserGroup = new Smart_select($object['user_group']);
				$tbUserGroup->whereSet('group_id', $groupId);
				$tbUserGroup->delete();
					
				displayMsg($object['group_right'], 'Delete - ' . $groupId, 3);
				$tbGroupRight = new Smart_select($object['group_right']);
				$tbGroupRight->whereSet('group_id', $groupId);
				$tbGroupRight->delete();
			}
		
			displayMsg($object['group'], 'Delete All', 3);
			$tbGroup = new Smart_select($object['group']);
			$tbGroup->whereSet('application_id', $appId);
			$tbGroup->delete();
		}
		
		return $traitFlag;
	}

	private static function copyStructure($appSourceId, $appCibleId, $modelSource, $modelCible) {
	
		$appModel = self::$_appModel;
		$traitFlag = true;
	
		if ((!isset($appModel[$modelSource])) or (!isset($appModel[$modelCible]))) {
			$traitFlag = false;
		}
	
		if ($traitFlag) {
			$objectSource = $appModel[$modelSource];
			$objectCible = $appModel[$modelCible];
		}

		if ($traitFlag) {
			displayMsg('Creation content', '', 2);
			$tbContentSource = new Smart_select($objectSource['content']);
			$tbContentSource->fieldAll();
			$tbContentSource->whereSet('application_id', $appSourceId);
			$contentSources = $tbContentSource->findAll();
			foreach($contentSources as $contentSource) {
				$contentSourceId = $contentSource['id'];
				$contentSourceCode = $contentSource['code'];
				displayMsg($objectCible['content'], 'Insert - ' . $contentSourceCode . ' - ' . $contentSourceId, 3);
				
				$contentSource['application_id'] = $appCibleId;
				$tbContentCible = new Smart_record($objectCible['content']);
				$tbContentCible->fieldAll($contentSource);
				$appContentCibleId = $tbContentCible->insert();
				if ($appContentCibleId == 0) {
					$traitFlag = false;
					break;
				}
			}
		}
			
		if ($traitFlag) {
			displayMsg('Creation feature', '', 2);
			$tbFeatureSource = new Smart_select($objectSource['feature']);
			$tbFeatureSource->fieldAll();
			$tbFeatureSource->whereSet('application_id', $appSourceId);
			$featureSources = $tbFeatureSource->findAll();
			foreach($featureSources as $featureSource) {
				$featureSourceId = $featureSource['id'];
				$featureSourceCode = $featureSource['code'];
				displayMsg($objectCible['feature'], 'Insert - ' . $featureSourceCode . ' - ' . $featureSourceId, 3);
					
				$featureSource['application_id'] = $appCibleId;
				$tbFeatureCible = new Smart_record($objectCible['feature']);
				$tbFeatureCible->fieldAll($featureSource);
				$featureCibleId = $tbFeatureCible->insert();
				if ($featureCibleId == 0) {
					$traitFlag = false;
					break;
				}
			}
		}
			
		if ($traitFlag) {
			displayMsg('Creation menu', '', 2);
			$tbMenuSource = new Smart_select($objectSource['menu']);
			$tbMenuSource->fieldAll();
			$tbMenuSource->whereSet('application_id', $appSourceId);
			$menuSources = $tbMenuSource->findAll();
			foreach($menuSources as $menuSource) {
				$menuSourceId = $menuSource['id'];
				$menuSourceCode = $menuSource['code'];
				displayMsg($objectCible['menu'], 'Insert - ' . $menuSourceCode . ' - ' . $menuSourceId, 3);
					
				$menuSource['application_id'] = $appCibleId;
				$tbMenuCible = new Smart_record($objectCible['menu']);
				$tbMenuCible->fieldAll($menuSource);
				$menuCibleId = $tbMenuCible->insert();
				if ($menuCibleId == 0) {
					$traitFlag = false;
					break;
				}
				else {
					displayMsg('Creation menu_feature', '', 3);						
					$tbMenuFeatureSource = new Smart_select($objectSource['menu_feature']);
					$tbMenuFeatureSource->fieldAll();
					$tbMenuFeatureSource->whereSet('menu_id', $menuSourceId);
					$menuFeatureSources = $tbMenuFeatureSource->findAll();
					foreach($menuFeatureSources as $menuFeatureSource) {
						$menuFeatureSourceId = $menuFeatureSource['id'];
						displayMsg($objectCible['menu_feature'], 'Insert - ' . $menuFeatureSourceId, 4);
							
						$menuFeatureSource['menu_id'] = $menuCibleId;							
						$tbMenuFeatureCible = new Smart_record($objectCible['menu_feature']);
						$tbMenuFeatureCible->fieldAll($menuFeatureSource);
						$menuFeatureCibleId = $tbMenuFeatureCible->insert();
						if ($menuFeatureCibleId == 0) {
							$traitFlag = false;
							break;
						}
					}
				}
			}
		}
			
		if ($traitFlag) {
			displayMsg('Creation ref', '', 2);
			$tbRefSource = new Smart_select($objectSource['ref']);
			$tbRefSource->fieldAll();
			$tbRefSource->whereSet('application_id', $appSourceId);
			$refSources = $tbRefSource->findAll();
			foreach($refSources as $refSource) {
				$refSourceId = $refSource['id'];
				displayMsg($objectCible['ref'], 'Insert - ' . $refSourceId, 3);
					
				$refSource['application_id'] = $appCibleId;
				$tbRefCible = new Smart_record($objectCible['ref']);
				$tbRefCible->fieldAll($refSource);
				$refCibleId = $tbRefCible->insert();
				if ($refCibleId == 0) {
					$traitFlag = false;
					break;
				}
			}
		}
			
		if ($traitFlag) {
			displayMsg('Creation user/group/rights', '', 2);
			$tbGroupSource = new Smart_select($objectSource['group']);
			$tbGroupSource->fieldAll();
			$tbGroupSource->whereSet('application_id', $appSourceId);
			$groupSources = $tbGroupSource->findAll();
			foreach($groupSources as $groupSource) {
				$groupSourceId = $groupSource['id'];
				$groupSourceCode = $groupSource['code'];
				displayMsg($objectCible['group'], 'Insert - ' . $groupSourceCode . ' - ' . $groupSourceId, 3);
					
				$groupSource['application_id'] = $appCibleId;
				$tbGroupCible = new Smart_record($objectCible['group']);
				$tbGroupCible->fieldAll($groupSource);
				$groupCibleId = $tbGroupCible->insert();
				if ($groupCibleId == 0) {
					$traitFlag = false;
					break;
				}
				else {
					displayMsg('Creation group_right', '', 3);
					$tbGroupRightSource = new Smart_select($objectSource['group_right']);
					$tbGroupRightSource->fieldAll();
					$tbGroupRightSource->whereSet('group_id', $groupSourceId);
					$groupRightSources = $tbGroupRightSource->findAll();
					foreach($groupRightSources as $groupRightSource) {
						$groupRightSourceId = $groupRightSource['id'];
						displayMsg($objectCible['group_right'], 'Insert - ' . $groupRightSourceId, 4);
						
						$groupRightSource['group_id'] = $groupCibleId;							
						$tbGroupRightCible = new Smart_record($objectCible['group_right']);
						$tbGroupRightCible->fieldAll($groupRightSource);
						$groupRightCibleId = $tbGroupRightCible->insert();
						if ($groupRightCibleId == 0) {
							$traitFlag = false;
							break;
						}
					}
					
					$tbUserGroupSource = new Smart_select($objectSource['user_group']);
					$tbUserGroupSource->fieldAll();
					$tbUserGroupSource->whereSet('group_id', $groupSourceId);
					$userGroupSources = $tbUserGroupSource->findAll();
					foreach($userGroupSources as $userGroupSource) {
						$userSourceId = $userGroupSource['user_id'];
						displayMsg($objectCible['user_group'], 'Insert - ' . $userSourceId . ' - ' . $groupSourceId, 3);
						$tbUserSource = new Smart_select($objectSource['user']);
						$tbUserSource->fieldAll();
						$tbUserSource->whereSet('id', $userSourceId);
						$userSource = $tbUserSource->find();
						if (!empty($userSource)) {
							$userSourceLogin = $userSource['login'];
						
							displayMsg($objectCible['user'], 'Insert - ' . $userSourceLogin, 4);
							$tbUserCible = new Smart_select($objectCible['user']);
							$tbUserCible->fieldAll();
							$tbUserCible->whereSet('login', $userSourceLogin);
							$userCible = $tbUserCible->find();
							if (!empty($userCible)) {
								$userCibleId = $userCible['id'];
							}
							else {
								$tbUserCible = new Smart_record($objectCible['user']);
								$tbUserCible->fieldAll($userSource);
								$userCibleId = $tbUserCible->insert();
								if ($userCibleId == 0) {
									$traitFlag = false;
									break;
								}
							}
								
							$userGroupSource['user_id'] = $userCibleId;
							$userGroupSource['group_id'] = $groupCibleId;
							$tbUserGroupCible = new Smart_record($objectCible['user_group']);
							$tbUserGroupCible->fieldAll($userGroupSource);
							$userGroupCibleId = $tbUserGroupCible->insert();
							if ($userGroupCibleId == 0) {
								$traitFlag = false;
								break;
							}
						}
					}
				}
			}
		}

		if (!$traitFlag) {
			displayMsg('Error', '', 3);
		}
	
		return $traitFlag;
	}

	private static function copyApp($appSourceId, $modelSource = 'adm', $modelCible = 'type') {
		$appModel = self::$_appModel;
		$traitFlag = true;

		$db = PDO_extend::ws_open();
		displayMsg($appSourceId, 'Copy application from ' . $modelSource . ' to ' . $modelCible . ' for', 2);
		if ((!isset($appModel[$modelSource])) or (!isset($appModel[$modelCible]))) {
			$traitFlag = false;
		}
		
		if ($traitFlag) {
			$objectSource = $appModel[$modelSource];
			$objectCible = $appModel[$modelCible];
		}

		if ($traitFlag) {
			try {
				$tbAppSource = new Smart_select($objectSource['application']);
				$tbAppSource->fieldAll();
				$tbAppSource->whereSet('id', $appSourceId);
				$appSource = $tbAppSource->find();
				if (!empty($appSource)) {
					if (($modelSource == 'adm') and ($modelCible == 'adm')) {
						if (!empty($appSource['copy_code'])) {
							$appSource['code'] = $appSource['copy_code'];
							if (!empty($appSource['copy_name'])) {
								$appSource['name'] = $appSource['copy_name'];
							}
						}
						else {
							$traitFlag = false;
							displayMsg('Target Application not defined', '', 2);
						}
					}
					$appSource['dir'] = $appSource['name'];
					$appSource['copy_code'] = '';
					$appSource['copy_name'] = '';
					$appSource['flag_archive'] = 0;
					$appSource['date_archive'] = null;
					$appSource['url_root'] = '';
					$appSource['canonical'] = '';
				}
				else {
					displayMsg('Source Application not found', '', 2);
					$traitFlag = false;
				}
			}
			catch (Exception $e) {
				displayMsg('Source Application not found', '', 2);
				$traitFlag = false;
			}
		}

		if ($traitFlag) {
			try {
				$appCibleCode = $appSource['code'];
				displayMsg($appCibleCode, 'Target Code', 3);
				$db->beginTransaction();

				if ($traitFlag) {
					displayMsg('Creation app', '', 2);
					$tbAppCible = new Smart_select($objectCible['application']);
					$tbAppCible->fieldAll();
					$tbAppCible->whereSet('code', $appCibleCode);
					$appCible = $tbAppCible->find();
					if (!empty($appCible)) {
						displayMsg('App already exists', '', 3);
						$appCibleId = $appCible['id'];
					}
					else {
						displayMsg('App', 'Insert', 3);
						$tbAppCible = new Smart_record($objectCible['application']);
						$tbAppCible->fieldAll($appSource);
						$appCibleId = $tbAppCible->insert();
					}
					if ($appCibleId == 0) {
						displayMsg('Error', '', 3);
						$traitFlag = false;
					}
				}
			
				if ($traitFlag) {
					$traitFlag = self::deleteStructure($appCibleId, $modelCible);
				}
	
				if ($traitFlag) {
					$traitFlag = self::copyStructure($appSourceId, $appCibleId, $modelSource, $modelCible);
				}

				if ($traitFlag) {
					displayMsg('Creation Ok', '', 2);
					$db->commit();
				}
				else {
					displayMsg('Creation Error', '', 2);
					$db->rollBack();
				}
			}
			catch (Exception $e) {
				displayMsg('Creation Error', '', 2);
				$traitFlag = false;
				$db->rollBack();
			}
		}

		return $traitFlag;
	}

	// Public functions

	/**
	* constructor object_content
    *
    * @access public
	*/
    public function __construct()
    {
	}
	
	public static function copy($appId) {
		
		displayMsg($appId, 'Copy application', 1);
		$traitFlag = self::copyApp($appId, 'adm', 'adm');

		return $traitFlag;
	}
	
	public static function archive($appId) {
		
		displayMsg($appId, 'Archive application', 1);
		$traitFlag = self::copyApp($appId, 'adm', 'archive');

		return $traitFlag;
	}
	
	public static function createType($appId) {
				
		displayMsg($appId, 'Create application type', 1);
		$traitFlag = self::copyApp($appId, 'adm', 'type');

		return $traitFlag;
	}

	
	public static function initType($appId, $appTypeId) {
		$traitFlag = true;
				
		displayMsg($appId, 'Init application type', 1);

			
		if ($traitFlag) {
			$traitFlag = self::deleteStructure($appId, 'adm');
		}
	
		if ($traitFlag) {
			$traitFlag = self::copyStructure($appTypeId, $appId, 'type', 'adm');
		}
		if ($traitFlag) {
			displayMsg('Init Type Ok', '', 2);
		}
		return $traitFlag;
	}

	public static function delete($appId, $modelSource = 'adm') {
		$appModel = self::$_appModel;
		$traitFlag = true;

		if ($modelSource == 'adm') {
			displayMsg($appId, 'Delete application', 1);
		}
		if (!isset($appModel[$modelSource])) {
			$traitFlag = false;
		}
		
		if ($traitFlag) {
			$objectSource = $appModel[$modelSource];
		}

		if ($traitFlag) {
			$traitFlag = self::deleteStructure($appId, $modelSource);
		}
		
		if ($traitFlag) {
			$tbApp = new Smart_select($objectSource['application']);
			$tbApp->whereSet('id', $appId);
			$tbApp->delete();
		}
		if ($traitFlag) {
			displayMsg('Delete Ok', '', 2);
		}

		return $traitFlag;
	}

	public static function deleteArchive($appId) {
		$appModel = self::$_appModel;
		$objectSource = $appModel['archive'];
		$traitFlag = true;

		displayMsg($appId, 'Delete application archive', 1);

		$traitFlag = self::deleteStructure($appId, 'archive');
		
		if ($traitFlag) {
			$tbApp = new Smart_select($objectSource['application']);
			$tbApp->whereSet('id', $appId);
			$tbApp->delete();
		}
		if ($traitFlag) {
			displayMsg('Delete Ok', '', 2);
		}
		
		return $traitFlag;
	}

	public static function deleteType($appId) {
		$appModel = self::$_appModel;
		$objectSource = $appModel['type'];
		$traitFlag = true;

		displayMsg($appId, 'Delete application type', 1);
		
		$traitFlag = self::deleteStructure($appId, 'type');
		
		if ($traitFlag) {
			$tbApp = new Smart_select($objectSource['application']);
			$tbApp->whereSet('id', $appId);
			$tbApp->delete();
		}
		if ($traitFlag) {
			displayMsg('Delete Ok', '', 2);
		}
		
		return $traitFlag;
	}

}