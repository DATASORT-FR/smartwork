<?php
/**
* This file contains classes and functions for the application structure management.
*
* @package   administration_application
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

	// Private functions

	/**
	* Delete application components
	*
	* @param integer - application id
	*
	* @return boolean
	*           + true : no error
	*           + false : error
 	*
    * @access private
	*/
	private static function deleteStructure($appId) {
		$traitFlag = true;
	
		// Delete contents
		displayMsg('Delete contents', '', 2);
		displayMsg('cms_content', 'Delete All', 3);
		$tbContent = new Smart_select('cms_content', 'content');
		$tbContent->whereSet('application_id', $appId);
		$tbContent->delete();

		// Delete features
		displayMsg('Delete features', '', 2);
		displayMsg('adm_feature', 'Delete All', 3);
		$tbFeature = new Smart_select('adm_feature');
		$tbFeature->whereSet('application_id', $appId);
		$tbFeature->delete();
		
		// Delete menus
		displayMsg('Delete menus', '', 2);
		$tbMenuSource = new Smart_select('adm_menu');
		$tbMenuSource->fieldAll();
		$tbMenuSource->whereSet('application_id', $appId);
		$menuSources = $tbMenuSource->findAll();
		foreach($menuSources as $menuSource) {
			$menuId = $menuSource['id'];
			displayMsg('adm_menu_feature', 'Delete - ' . $menuId, 3);
			$tbMenuFeature = new Smart_select('adm_menu_feature');
			$tbMenuFeature->whereSet('menu_id', $menuId);
			$tbMenuFeature->delete();
		}
		displayMsg('adm_menu', 'Delete All', 3);
		$tbMenu = new Smart_select('adm_menu');
		$tbMenu->whereSet('application_id', $appId);
		$tbMenu->delete();
		
		// Delete references
		displayMsg('Delete references', '', 2);
		displayMsg('adm_application_ref', 'Delete All', 3);
		$tbRef = new Smart_select('adm_application_ref');
		$tbRef->whereSet('application_id', $appId);
		$tbRef->delete();
		
		// Delete users/groups/rights
		displayMsg('Delete users/groups/rights', '', 2);
		$tbGroup = new Smart_select('adm_group');
		$tbGroup->fieldAll();
		$tbGroup->whereSet('application_id', $appId);
		$groups = $tbGroup->findAll();
		foreach($groups as $group) {
			$groupId = $group['id'];
					
			displayMsg('adm_user_group', 'Delete - ' . $groupId, 3);
			$tbUserGroup = new Smart_select('adm_user_group');
			$tbUserGroup->whereSet('group_id', $groupId);
			$tbUserGroup->delete();
				
			displayMsg('adm_group_right', 'Delete - ' . $groupId, 3);
			$tbGroupRight = new Smart_select('adm_group_right');
			$tbGroupRight->whereSet('group_id', $groupId);
			$tbGroupRight->delete();
		}
		
		displayMsg('adm_group', 'Delete All', 3);
		$tbGroup = new Smart_select('adm_group');
		$tbGroup->whereSet('application_id', $appId);
		$tbGroup->delete();
		
		if ($traitFlag) {
			displayMsg('Delete Ok', '', 3);
		}
		else {
			displayMsg('Delete Error', '', 3);
		}
		return $traitFlag;
	}

	/**
	* copy application contents from source app to target app
	*
	* @param integer - application id source
	* 		 integer - application id target
	*
	* @return boolean
	*           + true : no error
	*           + false : error
 	*
    * @access private
	*/
	private static function copyContent($appSourceId, $appCibleId) {
		$traitFlag = true;
		$contentCode = array();
	
		$tbApp = new Smart_select('adm_application');
		$tbApp->fieldAll();
		$tbApp->whereSet('id', $appSourceId);
		$appSource = $tbApp->find();
		if (!empty($appSource)) {
			$appSourceName = $appSource['name'];
			$appCibleName = $appSource['copy_name'];
		}
		else {
			$traitFlag = false;
			displayMsg('Application not found', 3);
		}
		if ($traitFlag) {
			displayMsg('Creation content', '', 2);
			$tbContentSource = new Smart_select('cms_content', 'content');
			$tbContentSource->fieldAll();
			$tbContentSource->whereSet('application_id', $appSourceId);
			$contentSources = $tbContentSource->findAll();
			foreach($contentSources as $contentSource) {
				$contentSourceCode = $contentSource['code'];
				$contentSourceId = $contentSource['id'];
				displayMsg('cms_content', 'Insert - ' . $contentSourceCode . ' - ' . $contentSourceId, 3);
				
				$contentSource['image'] = self::chgImagePath($contentSource['image'], $appSourceName, $appCibleName);
				$contentSource['image1'] = self::chgImagePath($contentSource['image1'], $appSourceName, $appCibleName);
				$contentSource['image2'] = self::chgImagePath($contentSource['image2'], $appSourceName, $appCibleName);
				$contentSource['image3'] = self::chgImagePath($contentSource['image3'], $appSourceName, $appCibleName);
				$contentSource['image4'] = self::chgImagePath($contentSource['image4'], $appSourceName, $appCibleName);
				$contentSource['image5'] = self::chgImagePath($contentSource['image5'], $appSourceName, $appCibleName);
				$contentSource['image6'] = self::chgImagePath($contentSource['image6'], $appSourceName, $appCibleName);
				$contentSource['application_id'] = $appCibleId;
				$tbContentCible = new Smart_record('cms_content', 'content');
				$tbContentCible->fieldAll($contentSource);
				$appContentCibleId = $tbContentCible->insert();
				if ($appContentCibleId == 0) {
					$traitFlag = false;
					break;
				}
				else {
					$contentCode[$contentSourceId] = $appContentCibleId;
				}

			}
		}

		if (!$traitFlag) {
			displayMsg('Error content', '', 3);
		}
	
		return $contentCode;
	}

	/**
	* copy application components from source app to target app
	*
	* @param integer - application id source
	* 		 integer - application id target
	*
	* @return boolean
	*           + true : no error
	*           + false : error
 	*
    * @access private
	*/
	private static function copyStructure($appSourceId, $contentCode, $appCibleId) {
		$traitFlag = true;
		$menuFeatureCode = array();
		$featureCode = array();
	
		if ($traitFlag) {
			displayMsg('Creation feature', '', 2);
			$tbFeatureSource = new Smart_select('adm_feature');
			$tbFeatureSource->fieldAll();
			$tbFeatureSource->whereSet('application_id', $appSourceId);
			$featureSources = $tbFeatureSource->findAll();
			foreach($featureSources as $featureSource) {
				$featureSourceId = $featureSource['id'];
				$featureSourceCode = $featureSource['code'];
				displayMsg('adm_feature', 'Insert - ' . $featureSourceCode . ' - ' . $featureSourceId, 3);
					
				$featureSource['application_id'] = $appCibleId;
				$tbFeatureCible = new Smart_record('adm_feature');
				$tbFeatureCible->fieldAll($featureSource);
				$featureCibleId = $tbFeatureCible->insert();
				if ($featureCibleId == 0) {
					$traitFlag = false;
					break;
				}
				else {
					$featureCode[$featureSource['id']] = $featureCibleId;
				}
			}
		}
			
		if ($traitFlag) {
			displayMsg('Creation menu', '', 2);
			$tbMenuSource = new Smart_select('adm_menu');
			$tbMenuSource->fieldAll();
			$tbMenuSource->whereSet('application_id', $appSourceId);
			$menuSources = $tbMenuSource->findAll();
			foreach($menuSources as $menuSource) {
				$menuSourceId = $menuSource['id'];
				$menuSourceCode = $menuSource['code'];
				displayMsg('adm_menu', 'Insert - ' . $menuSourceCode . ' - ' . $menuSourceId, 3);
					
				$menuSource['application_id'] = $appCibleId;
				$tbMenuCible = new Smart_record('adm_menu');
				$tbMenuCible->fieldAll($menuSource);
				$menuCibleId = $tbMenuCible->insert();
				if ($menuCibleId == 0) {
					$traitFlag = false;
					break;
				}
				else {
					displayMsg('Creation menu_feature', '', 3);						
					$tbMenuFeatureSource = new Smart_select('adm_menu_feature');
					$tbMenuFeatureSource->fieldAll();
					$tbMenuFeatureSource->whereSet('menu_id', $menuSourceId);
					$menuFeatureSources = $tbMenuFeatureSource->findAll();
					foreach($menuFeatureSources as $menuFeatureSource) {
						if (empty($menuFeatureSource['parent_id'])) {
							$menuFeatureArray = $menuFeatureSource;
							displayMsg('adm_menu_feature', 'Insert - ' . $menuFeatureSource['name'], 4);
							
							$menuFeatureArray['parent_id'] = null;

							$menuFeatureArray['content_id'] = null;
							if (!empty($contentCode[$menuFeatureSource['content_id']])) {
								$menuFeatureArray['content_id'] = $contentCode[$menuFeatureSource['content_id']];
							}
							
							$menuFeatureArray['feature_id'] = null;
							$tbFeatureSource = new Smart_select('adm_feature');
							$tbFeatureSource->fieldAll();
							$tbFeatureSource->whereSet('id', $menuFeatureSource['feature_id']);
							$featureSource = $tbFeatureSource->find();
							if (!empty($featureSource)) {
								$menuFeature = $featureSource['code'];
								$tbFeatureSource = new Smart_select('adm_feature');
								$tbFeatureSource->fieldAll();
								$tbFeatureSource->whereSet('code', $menuFeature);
								$tbFeatureSource->whereSet('application_id', $appCibleId, 'and');
								$featureSource = $tbFeatureSource->find();
								if (!empty($featureSource)) {
									$menuFeatureArray['feature_id'] = $featureSource['id'];
								}
							}

							$menuFeatureArray['menu_id'] = $menuCibleId;							
							$tbMenuFeatureCible = new Smart_record('adm_menu_feature');
							$tbMenuFeatureCible->fieldAll($menuFeatureArray);
							$menuFeatureCibleId = $tbMenuFeatureCible->insert();
							if ($menuFeatureCibleId == 0) {
								$traitFlag = false;
								break;
							}
							else {
								$menuFeatureCode[$menuFeatureSource['id']] = $menuFeatureCibleId;
							}
						}
					}
					
					foreach($menuFeatureSources as $menuFeatureSource) {
						if (!empty($menuFeatureSource['parent_id'])) {
							$menuFeatureArray = $menuFeatureSource;
							displayMsg('adm_menu_feature', 'Insert - ' . $menuFeatureSource['name'], 4);
							
							$menuFeatureArray['parent_id'] = null;
							if (!empty($menuFeatureCode[$menuFeatureSource['content']])) {
								$menuFeatureArray['parent_id'] = $menuFeatureCode[$menuFeatureSource['parent_id']];
							}

							$menuFeatureArray['content_id'] = null;
							if (!empty($contentCode[$menuFeatureSource['content']])) {
								$menuFeatureArray['content_id'] = $contentCode[$menuFeatureSource['content_id']];
							}
							
							$menuFeatureArray['feature_id'] = null;
							$tbFeatureSource = new Smart_select('adm_feature');
							$tbFeatureSource->fieldAll();
							$tbFeatureSource->whereSet('id', $menuFeatureSource['feature_id']);
							$featureSource = $tbFeatureSource->find();
							if (!empty($featureSource)) {
								$menuFeature = $featureSource['code'];
								$tbFeatureSource = new Smart_select('adm_feature');
								$tbFeatureSource->fieldAll();
								$tbFeatureSource->whereSet('code', $menuFeature);
								$tbFeatureSource->whereSet('application_id', $appCibleId, 'and');
								$featureSource = $tbFeatureSource->find();
								if (!empty($featureSource)) {
									$menuFeatureArray['feature_id'] = $featureSource['id'];
								}
							}

							$menuFeatureArray['menu_id'] = $menuCibleId;							
							$tbMenuFeatureCible = new Smart_record('adm_menu_feature');
							$tbMenuFeatureCible->fieldAll($menuFeatureArray);
							$menuFeatureCibleId = $tbMenuFeatureCible->insert();
							if ($menuFeatureCibleId == 0) {
								$traitFlag = false;
								break;
							}
							else {
								$menuFeatureCode[$menuFeatureSource['id']] = $menuFeatureCibleId;
							}
						}
					}
					
				}
			}
		}
			
		if ($traitFlag) {
			displayMsg('Creation ref', '', 2);
			$tbRefSource = new Smart_select('adm_application_ref');
			$tbRefSource->fieldAll();
			$tbRefSource->whereSet('application_id', $appSourceId);
			$refSources = $tbRefSource->findAll();
			foreach($refSources as $refSource) {
				$refSourceId = $refSource['id'];
				$refSourceFeatureId = $refSource['feature_id'];
				displayMsg('adm_application_ref', 'Insert - ' . $refSourceId, 3);
					
				$refSource['feature_id'] = null;
				if (!empty($featureCode[$refSourceFeatureId])) {
					$refSource['feature_id'] = $featureCode[$refSourceFeatureId];
				}

				$refSource['application_id'] = $appCibleId;
				$tbRefCible = new Smart_record('adm_application_ref');
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
			$tbGroupSource = new Smart_select('adm_group');
			$tbGroupSource->fieldAll();
			$tbGroupSource->whereSet('application_id', $appSourceId);
			$groupSources = $tbGroupSource->findAll();
			foreach($groupSources as $groupSource) {
				$groupSourceId = $groupSource['id'];
				$groupSourceCode = $groupSource['code'];
				displayMsg('adm_group', 'Insert - ' . $groupSourceCode . ' - ' . $groupSourceId, 3);
					
				$groupSource['application_id'] = $appCibleId;
				$tbGroupCible = new Smart_record('adm_group');
				$tbGroupCible->fieldAll($groupSource);
				$groupCibleId = $tbGroupCible->insert();
				if ($groupCibleId == 0) {
					$traitFlag = false;
					break;
				}
				else {
					displayMsg('Creation group_right', '', 3);
					$tbGroupRightSource = new Smart_select('adm_group_right');
					$tbGroupRightSource->fieldAll();
					$tbGroupRightSource->whereSet('group_id', $groupSourceId);
					$groupRightSources = $tbGroupRightSource->findAll();
					foreach($groupRightSources as $groupRightSource) {
						$groupRightSourceId = $groupRightSource['id'];
						$groupRightSourceFeatureId = $groupRightSource['feature_id'];
						displayMsg('adm_group_right', 'Insert - ' . $groupRightSourceId, 4);
						
						$groupRightSource['feature_id'] = null;
						if (!empty($featureCode[$groupRightSourceFeatureId])) {
							$groupRightSource['feature_id'] = $featureCode[$groupRightSourceFeatureId];
						}
						
						$groupRightSource['group_id'] = $groupCibleId;							
						$tbGroupRightCible = new Smart_record('adm_group_right');
						$tbGroupRightCible->fieldAll($groupRightSource);
						$groupRightCibleId = $tbGroupRightCible->insert();
						if ($groupRightCibleId == 0) {
							$traitFlag = false;
							break;
						}
					}
					
					$tbUserGroupSource = new Smart_select('adm_user_group');
					$tbUserGroupSource->fieldAll();
					$tbUserGroupSource->whereSet('group_id', $groupSourceId);
					$userGroupSources = $tbUserGroupSource->findAll();
					foreach($userGroupSources as $userGroupSource) {
						$userSourceId = $userGroupSource['user_id'];
						displayMsg('adm_user_group', 'Insert - ' . $userSourceId . ' - ' . $groupSourceId, 3);
						
						$userGroupSource['group_id'] = $groupCibleId;
						$tbUserGroupCible = new Smart_record('adm_user_group');
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

		if (!$traitFlag) {
			displayMsg('Error', '', 3);
		}
	
		return $traitFlag;
	}

	private static function appSource($appArray) {
		$application = array();

		$application['code'] = $appArray['code'];
		$application['name'] = $appArray['name'];
		$application['version'] = $appArray['version'];
		$application['flag_admin'] = $appArray['flag_admin'];
		$application['status_id'] = $appArray['status_id'];
		$application['dir'] = $appArray['dir'];
		$application['label'] = $appArray['label'];
		$application['description'] = $appArray['description'];
		$application['apptype'] = $appArray['apptype'];
		$application['image'] = $appArray['image'];
		$application['public'] = $appArray['public'];
		$application['url_root'] = $appArray['url_root'];
		$application['canonical'] = $appArray['canonical'];
		$application['keywords'] = $appArray['keywords'];
		$application['parameters'] = $appArray['parameters'];
		$application['content_page'] = $appArray['content_page'];
		$application['forum_subject_page'] = $appArray['forum_subject_page'];
		$application['forum_topic_page'] = $appArray['forum_topic_page'];

		return $application;
	}

	private static function contentSource($contentArray) {
		$content = array();
		
		$content['code'] = readCont($contentArray, 'code', null);
		$content['status_id'] = readCont($contentArray, 'status_id', 1);
		$content['category_id'] = readCont($contentArray, 'category_id', 1);
		$content['author_id'] = readCont($contentArray, 'author_id', 0);
		$content['date_publication'] = readCont($contentArray, 'date_publication', null);
		$content['title'] = readCont($contentArray, 'title', null);
		$content['title_page'] = readCont($contentArray, 'title_page', null);
		$content['param1'] = readCont($contentArray, 'param1', null);
		$content['param2'] = readCont($contentArray, 'param2', null);
		$content['alt'] = readCont($contentArray, 'alt', null);
		$content['alias'] = readCont($contentArray, 'alias', null);
		$content['style'] = readCont($contentArray, 'style', null);
		$content['content_page'] = readCont($contentArray, 'content_page', null);
		$content['class'] = readCont($contentArray, 'class', null);
		$content['icon'] = readCont($contentArray, 'icon', null);
		$content['path'] = readCont($contentArray, 'path', null);
		$content['image'] = readCont($contentArray, 'image', null);
		$content['description'] = readCont($contentArray, 'description', null);
		$content['keywords'] = readCont($contentArray, 'keywords', null);
		$content['intro'] = readCont($contentArray, 'intro', null);
		$content['content'] = readCont($contentArray, 'content', null);
		$content['image1'] = readCont($contentArray, 'image1', null);
		$content['image2'] = readCont($contentArray, 'image2', null);
		$content['image3'] = readCont($contentArray, 'image3', null);
		$content['image4'] = readCont($contentArray, 'image4', null);
		$content['image5'] = readCont($contentArray, 'image5', null);
		$content['image6'] = readCont($contentArray, 'image6', null);
		$content['block1'] = readCont($contentArray, 'block1', null);
		$content['block2'] = readCont($contentArray, 'block2', null);
		$content['block3'] = readCont($contentArray, 'block3', null);
		$content['block4'] = readCont($contentArray, 'block4', null);
		$content['block5'] = readCont($contentArray, 'block5', null);
		$content['block6'] = readCont($contentArray, 'block6', null);

		return $content;
	}

	private static function featureSource($featureArray) {
		$feature = array();

		$feature['code'] = readCont($featureArray, 'code', null);
		$feature['label'] = readCont($featureArray, 'label', null);

		return $feature;
	}

	private static function menuSource($menuArray) {
		$menu = array();

		$menu['code'] = readCont($menuArray, 'code', null);
		$menu['label'] = readCont($menuArray, 'label', null);

		return $menu;
	}

	private static function groupSource($groupArray) {
		$group = array();

		$group['code'] = readCont($groupArray, 'code', null);
		$group['label'] = readCont($groupArray, 'label', null);

		return $group;
	}

	private static function menuFeatureSource($menuFeatureArray) {
		$menuFeature = array();

		$menuFeature['alias'] = readCont($menuFeatureArray, 'alias', null);
		$menuFeature['class'] = readCont($menuFeatureArray, 'class', null);
		$menuFeature['description'] = readCont($menuFeatureArray, 'description', null);
		$menuFeature['icon'] = readCont($menuFeatureArray, 'icon', null);
		$menuFeature['icon_only'] = readCont($menuFeatureArray, 'icon_only', null);
		$menuFeature['keywords'] = readCont($menuFeatureArray, 'keywords', null);
		$menuFeature['level'] = readCont($menuFeatureArray, 'level', null);
		$menuFeature['page'] = readCont($menuFeatureArray, 'page', null);
		$menuFeature['ref'] = readCont($menuFeatureArray, 'ref', null);
		$menuFeature['title'] = readCont($menuFeatureArray, 'title', null);
		$menuFeature['name'] = readCont($menuFeatureArray, 'name', null);

		return $menuFeature;
	}

	private static function refSource($refArray) {
		$ref = array();

		$ref['alias'] = readCont($refArray, 'alias', null);
		$ref['ref'] = readCont($refArray, 'ref', null);

		return $ref;
	}

	private static function groupRightSource($groupRightArray) {
		$groupRight = array();

		$groupRight['right_create'] = readCont($groupRightArray, 'right_create', null);
		$groupRight['right_delete'] = readCont($groupRightArray, 'right_delete', null);
		$groupRight['right_event'] = readCont($groupRightArray, 'right_event', null);
		$groupRight['right_read'] = readCont($groupRightArray, 'right_read', null);
		$groupRight['right_update'] = readCont($groupRightArray, 'right_update', null);

		return $groupRight;
	}

	/**
	* load images in the app images folder for export
	*
	* @param string - image to change path
	* 		 string - path name cible
	*
	* @return string : new Image
 	*
    * @access private
	*/
	private static function loadImagePath($image, $appName) {

		$newImage = '';
		$imageAlt = '';
		$imageTitle = '';
		
		if (!empty($image)) {
			$atemp = explode(';',$image);
			$image = '';
			if (isset($atemp[0])) {
				$image = $atemp[0];
			}
			if (isset($atemp[1])) {
				$imageAlt = $atemp[1];
			}
			if (isset($atemp[2])) {
				$imageTitle = $atemp[2];
			}
			$pos = strpos($image, './' . IMAGES_PATH . $appName);
			if (($pos !== false) and (!empty($image))) {
				$fileName = basename($image);
				$newImage = './' . IMAGES_PATH . $appName . '/' . $fileName;
				xcopy($image, $newImage);
				displayMsg($newImage, 'Copy media file to ', 5);
			}
			else {
				$newImage = $image;
			}
		}
		$newImage = $newImage .';' . $imageAlt . ';' . $imageTitle;

		return $newImage;
	}
	/**
	* Export application components in a array
	*
	* @param integer - application id source
	*
	* @return array()
	*	contents - content components
	*	features - feature components
	*	menus - menu components
	*	refs - ref components
	*	groups - group components
 	*
    * @access private
	*/
	private static function exportStructure($appId, $appName) {
		$traitFlag = true;
		$exportArray = array();
		$exportContentsArray = array();
		$exportFeaturesArray = array();
		$exportFeaturesItem = array();
		$exportMenusArray = array();
		$exportMenusItem = array();
		$menuFeatureItem = array();
		$exportRefsArray = array();
		$exportRefsItem = array();
		$exportGroupsArray = array();
		$exportGroupsItem = array();
		$tempArray = array();

		if ($traitFlag) {
			displayMsg('Export contents', '', 2);
			$tbContentSource = new Smart_select('cms_content', 'content');
			$tbContentSource->fieldAll();
			$tbContentSource->whereSet('application_id', $appId);
			$contentSources = $tbContentSource->findAll();
			foreach($contentSources as $contentSource) {
				displayMsg('cms_content', 'Export - ' . $contentSource['code'] . ' - ' . $contentSource['id'], 3);
				$contentItem = self::contentSource($contentSource);
				$contentItem['image'] = self::loadImagePath($contentItem['image'], $appName);
				$contentItem['image1'] = self::loadImagePath($contentItem['image1'], $appName);
				$contentItem['image2'] = self::loadImagePath($contentItem['image2'], $appName);
				$contentItem['image3'] = self::loadImagePath($contentItem['image3'], $appName);
				$contentItem['image4'] = self::loadImagePath($contentItem['image4'], $appName);
				$contentItem['image5'] = self::loadImagePath($contentItem['image5'], $appName);
				$contentItem['image6'] = self::loadImagePath($contentItem['image6'], $appName);
				$contentItem['id'] = $contentSource['id'];
				$exportContentsArray[] = $contentItem;
			}
		}
			
		if ($traitFlag) {
			displayMsg('Export features', '', 2);
			$tbFeatureSource = new Smart_select('adm_feature');
			$tbFeatureSource->fieldAll();
			$tbFeatureSource->whereSet('application_id', $appId);
			$featureSources = $tbFeatureSource->findAll();
			foreach($featureSources as $featureSource) {
				displayMsg('adm_feature', 'Export - ' . $featureSource['code'], 3);
				$exportFeaturesItem = self::featureSource($featureSource);
				$exportFeaturesArray[] = $exportFeaturesItem;
			}
		}
		
		if ($traitFlag) {
			displayMsg('Export menus', '', 2);
			$tbMenuSource = new Smart_select('adm_menu');
			$tbMenuSource->fieldAll();
			$tbMenuSource->whereSet('application_id', $appId);
			$menuSources = $tbMenuSource->findAll();
			foreach($menuSources as $menuSource) {
				displayMsg('adm_menu', 'Export - ' . $menuSource['code'], 3);
				$exportMenusItem = self::menuSource($menuSource);

				$menuFeatureItems = array();
				displayMsg('Export menu_features', '', 3);						
				$tbMenuFeatureSource = new Smart_select('adm_menu_feature');
				$tbMenuFeatureSource->fieldAll();
				$tbMenuFeatureSource->whereSet('menu_id', $menuSource['id']);
				$menuFeatureSources = $tbMenuFeatureSource->findAll();
				foreach($menuFeatureSources as $menuFeatureSource) {
					displayMsg('adm_menu_feature', 'Export - ' . $menuFeatureSource['name'], 4);
					$menuFeatureItem = self::menuFeatureSource($menuFeatureSource);
					
					$menuFeatureItem['code'] = $menuFeatureSource['id'];
					$menuFeatureItem['parent'] = '';
					if ($menuFeatureSource['parent_id'] != 0) {
						$menuFeatureItem['parent'] = $menuFeatureSource['parent_id'];
					}
					$menuFeatureItem['content'] = '';
					if (!empty($menuFeatureSource['content_id'])) {
						$menuFeatureItem['content'] = $menuFeatureSource['content_id'];
					}
					$menuFeatureItem['feature'] = '';
					$tbFeatureSource = new Smart_select('adm_feature');
					$tbFeatureSource->fieldAll();
					$tbFeatureSource->whereSet('id', $menuFeatureSource['feature_id']);
					$featureSource = $tbFeatureSource->find();
					if (!empty($featureSource)) {
						$menuFeatureItem['feature'] = $featureSource['code'];
					}
					
					$menuFeatureItems[] = $menuFeatureItem;
				}
				$exportMenusItem['features'] = $menuFeatureItems;
				$exportMenusArray[] = $exportMenusItem;
			}
		}
			
		if ($traitFlag) {
			displayMsg('Export references', '', 2);
			$tbRefSource = new Smart_select('adm_application_ref');
			$tbRefSource->fieldAll();
			$tbRefSource->whereSet('application_id', $appId);
			$refSources = $tbRefSource->findAll();
			foreach($refSources as $refSource) {
				displayMsg('adm_application_ref', 'Export - ' . $refSource['ref'], 3);
				$exportRefsItem = self::refSource($refSource);
				
				$exportRefsItem['feature'] = '';
				$tbFeatureSource = new Smart_select('adm_feature');
				$tbFeatureSource->fieldAll();
				$tbFeatureSource->whereSet('id', $refSource['feature_id']);
				$featureSource = $tbFeatureSource->find();
				if (!empty($featureSource)) {
					$exportRefsItem['feature'] = $featureSource['code'];
				}
				
				$exportRefsArray[] = $exportRefsItem;
			}
		}
			
		if ($traitFlag) {
			displayMsg('Export user/group/rights', '', 2);
			$tbGroupSource = new Smart_select('adm_group');
			$tbGroupSource->fieldAll();
			$tbGroupSource->whereSet('application_id', $appId);
			$groupSources = $tbGroupSource->findAll();
			foreach($groupSources as $groupSource) {
				displayMsg('adm_group', 'Export - ' . $groupSource['code'], 3);
				$exportGroupsItem = self::groupSource($groupSource);
				
				$tempArray = array();
				displayMsg('Export group_rights', '', 3);
				$tbGroupRightSource = new Smart_select('adm_group_right');
				$tbGroupRightSource->fieldAll();
				$tbGroupRightSource->whereSet('group_id', $groupSource['id']);
				$groupRightSources = $tbGroupRightSource->findAll();
				foreach($groupRightSources as $groupRightSource) {
					displayMsg('adm_group_right', 'Export - ' . $groupRightSource['id'], 4);
					$groupRightItem = self::groupRightSource($groupRightSource);
					
					$groupRightItem['feature'] = '';
					$tbFeatureSource = new Smart_select('adm_feature');
					$tbFeatureSource->fieldAll();
					$tbFeatureSource->whereSet('id', $groupRightSource['feature_id']);
					$featureSource = $tbFeatureSource->find();
					if (!empty($featureSource)) {
						$groupRightItem['feature'] = $featureSource['code'];
					}
					$groupRightItem['module'] = '';
					$tbModuleSource = new Smart_select('adm_module');
					$tbModuleSource->fieldAll();
					$tbModuleSource->whereSet('id', $groupRightSource['module_id']);
					$moduleSource = $tbModuleSource->find();
					if (!empty($moduleSource)) {
						$groupRightItem['module'] = $moduleSource['code'];
					}
					
					$tempArray[] = $groupRightItem;
				}
				$exportGroupsItem['rights'] = $tempArray;
					
				$tempArray = array();
				displayMsg('Export group_users', '', 5);
				$tbUserGroupSource = new Smart_select('adm_user_group');
				$tbUserGroupSource->fieldAll();
				$tbUserGroupSource->whereSet('group_id', $groupSource['id']);
				$userGroupSources = $tbUserGroupSource->findAll();
				foreach($userGroupSources as $userGroupSource) {
					if ($userGroupSource['user_id'] == USER_GUEST) {
						$userGroupItem['user'] = 'GUEST';
						$tempArray[] = $userGroupItem;
					}
					if ($userGroupSource['user_id'] == USER_SUPERADMIN) {
						$userGroupItem['user'] = 'SUPERADMIN';
						$tempArray[] = $userGroupItem;
					}
					if ($userGroupSource['user_id'] == USER_DEFAULT) {
						$userGroupItem['user'] = 'DEFAULT';
						$tempArray[] = $userGroupItem;
					}
				}
				$exportGroupsItem['users'] = $tempArray;

				$exportGroupsArray[] = $exportGroupsItem;
			}
		}
		if ($traitFlag) {
			displayMsg('Creation export file', '', 4);
			$exportArray['contents'] = $exportContentsArray;
			$exportArray['features'] = $exportFeaturesArray;
			$exportArray['menus'] = $exportMenusArray;
			$exportArray['refs'] = $exportRefsArray;
			$exportArray['groups'] = $exportGroupsArray;
		}
		
		return $exportArray;
	}

	/**
	* Import application contents from a array
	*
	* @param string - image to change path
	* 		 string - path name source
	* 		 string - path name cible
	*
	* @return string : new Image
 	*
    * @access private
	*/
	private static function chgImagePath($image, $appSourceName, $appCibleName) {

		$newImage = '';
		
		$atemp = explode(';',$image);
		$image = '';
		$imageAlt = '';
		$imageTitle = '';
		if (isset($atemp[0])) {
			$image = $atemp[0];
		}
		if (isset($atemp[1])) {
			$imageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$imageTitle = $atemp[2];
		}
		$newImage = str_replace('./' . IMAGES_PATH . $appSourceName, './' . IMAGES_PATH . $appCibleName, $image);
		$newImage = $newImage .';' . $imageAlt . ';' . $imageTitle;

		return $newImage;
	}
	
	/**
	* Import application contents from a array
	*
	* @param array   - content array
	* 		 integer - application id target
	*
	* @return array : array of content translation
 	*
    * @access private
	*/
	private static function importContent($importContentsArray, $appCibleId) {
		$traitFlag = true;
		$contentCode = array();
	
		displayMsg('Import contents', '', 2);
		$tbAppSource = new Smart_select('adm_application');
		$tbAppSource->fieldAll();
		$tbAppSource->whereSet('id', $appCibleId);
		$appCible = $tbAppSource->find();
		if (!empty($appCible)) {
			$appSourceName = $appCible['copy_name'];
			$appCibleName = $appCible['dir'];
		}
		else {
			$traitFlag = false;
			displayMsg('Application not found', 3);
		}
		if ($traitFlag) {
			foreach($importContentsArray as $contentArray) {
				displayMsg('cms_content', 'Insert - ' . $contentArray['code'] . ' - ' . $contentArray['id'], 3);
				$contentSource = self::contentSource($contentArray);
				$contentSource['image'] = self::chgImagePath($contentSource['image'], $appSourceName, $appCibleName);
				$contentSource['image1'] = self::chgImagePath($contentSource['image1'], $appSourceName, $appCibleName);
				$contentSource['image2'] = self::chgImagePath($contentSource['image2'], $appSourceName, $appCibleName);
				$contentSource['image3'] = self::chgImagePath($contentSource['image3'], $appSourceName, $appCibleName);
				$contentSource['image4'] = self::chgImagePath($contentSource['image4'], $appSourceName, $appCibleName);
				$contentSource['image5'] = self::chgImagePath($contentSource['image5'], $appSourceName, $appCibleName);
				$contentSource['image6'] = self::chgImagePath($contentSource['image6'], $appSourceName, $appCibleName);
				$contentSource['application_id'] = $appCibleId;
				$tbContentCible = new Smart_record('cms_content', 'content');
				$tbContentCible->fieldAll($contentSource);
				$appContentCibleId = $tbContentCible->insert();
				if ($appContentCibleId == 0) {
					$traitFlag = false;
					break;
				}
				else {
					$contentCode[$contentArray['id']] = $appContentCibleId;
				}
			}
		}

		if (!$traitFlag) {
			displayMsg('Error', '', 3);
		}
	
		return $contentCode;
	}

	/**
	* Import application components from a array
	*
	* @param array   - application structure array
	* 		 integer - application id target
	*
	* @return boolean
	*           + true : no error
	*           + false : error
 	*
    * @access private
	*/
	private static function importStructure($importArray, $contentCode, $appCibleId) {
		$traitFlag = true;
	
		$importFeaturesArray = $importArray['features'];
		$importMenusArray = $importArray['menus'];
		$importRefsArray = $importArray['refs'];
		$importGroupsArray = $importArray['groups'];

		if ($traitFlag) {
			displayMsg('Import features', '', 2);
			foreach($importFeaturesArray as $featureArray) {
				displayMsg('adm_feature', 'Insert - ' . $featureArray['code'], 3);
				$featureSource = self::featureSource($featureArray);
				$featureSource['application_id'] = $appCibleId;
				$tbFeatureCible = new Smart_record('adm_feature');
				$tbFeatureCible->fieldAll($featureSource);
				$featureCibleId = $tbFeatureCible->insert();
				if ($featureCibleId == 0) {
					$traitFlag = false;
					break;
				}
			}
		}
			
		if ($traitFlag) {
			displayMsg('Import menus', '', 2);
			foreach($importMenusArray as $menuArray) {
				$importMenuFeaturesArray = $menuArray['features'];
				displayMsg('adm_menu', 'Insert - ' . $menuArray['code'], 3);
				$menuSource = self::menuSource($menuArray);
				$menuSource['application_id'] = $appCibleId;
				$tbMenuCible = new Smart_record('adm_menu');
				$tbMenuCible->fieldAll($menuSource);
				$menuCibleId = $tbMenuCible->insert();
				if ($menuCibleId == 0) {
					$traitFlag = false;
					break;
				}
				else {
					displayMsg('Insertion menu_feature', '', 3);
					$menuFeatureCode = array();
					foreach($importMenuFeaturesArray as $menuFeatureArray) {
						if (empty($menuFeatureArray['parent'])) {
							displayMsg('adm_menu_feature', 'Insert - ' . $menuFeatureArray['name'], 4);
							$menuFeatureSource = self::menuFeatureSource($menuFeatureArray);
							
							$menuFeatureSource['parent_id'] = null;

							$menuFeatureSource['content_id'] = null;
							if (!empty($contentCode[$menuFeatureArray['content']])) {
								$menuFeatureSource['content_id'] = $contentCode[$menuFeatureArray['content']];
							}
							
							$menuFeatureSource['feature_id'] = null;
							$tbFeatureSource = new Smart_select('adm_feature');
							$tbFeatureSource->fieldAll();
							$tbFeatureSource->whereSet('code', $menuFeatureArray['feature']);
							$tbFeatureSource->whereSet('application_id', $appCibleId, 'and');
							$featureSource = $tbFeatureSource->find();
							if (!empty($featureSource)) {
								$menuFeatureSource['feature_id'] = $featureSource['id'];
							}

							$menuFeatureSource['menu_id'] = $menuCibleId;
							$tbMenuFeatureCible = new Smart_record('adm_menu_feature');
							$tbMenuFeatureCible->fieldAll($menuFeatureSource);
							$menuFeatureCibleId = $tbMenuFeatureCible->insert();
							if ($menuFeatureCibleId == 0) {
								$traitFlag = false;
								break;
							}
							else {
								$menuFeatureCode[$menuFeatureArray['code']] = $menuFeatureCibleId;
							}
						}
					}

					foreach($importMenuFeaturesArray as $menuFeatureArray) {
						if ((!empty($menuFeatureArray['parent'])) and (isset($menuFeatureCode[$menuFeatureArray['parent']]))) {
							displayMsg('adm_menu_feature', 'Insert - ' . $menuFeatureArray['name'], 4);
							$menuFeatureSource = self::menuFeatureSource($menuFeatureArray);
							
							$menuFeatureSource['parent_id'] = $menuFeatureCode[$menuFeatureArray['parent']];
							
							$menuFeatureSource['content_id'] = null;
							if (!empty($contentCode[$menuFeatureArray['content']])) {
								$menuFeatureSource['content_id'] = $contentCode[$menuFeatureArray['content']];
							}
							
							$menuFeatureSource['feature_id'] = null;
							$tbFeatureSource = new Smart_select('adm_feature');
							$tbFeatureSource->fieldAll();
							$tbFeatureSource->whereSet('code', $menuFeatureArray['feature']);
							$tbFeatureSource->whereSet('application_id', $appCibleId, 'and');
							$featureSource = $tbFeatureSource->find();
							if (!empty($featureSource)) {
								$menuFeatureSource['feature_id'] = $featureSource['id'];
							}

							$menuFeatureSource['menu_id'] = $menuCibleId;
							$tbMenuFeatureCible = new Smart_record('adm_menu_feature');
							$tbMenuFeatureCible->fieldAll($menuFeatureSource);
							$menuFeatureCibleId = $tbMenuFeatureCible->insert();
							if ($menuFeatureCibleId == 0) {
								$traitFlag = false;
								break;
							}
							else {
								$menuFeatureCode[$menuFeatureArray['code']] = $menuFeatureCibleId;
							}
						}
					}

				}
			}
		}
			
		if ($traitFlag) {
			displayMsg('Import refs', '', 2);
			foreach($importRefsArray as $refArray) {
				displayMsg('adm_application_ref', 'Insert - ' . $refArray['ref'], 3);
				$refSource = self::refSource($refArray);
				
				$refSource['feature_id'] = null;
				$tbFeatureSource = new Smart_select('adm_feature');
				$tbFeatureSource->fieldAll();
				$tbFeatureSource->whereSet('code', $refArray['feature']);
				$tbFeatureSource->whereSet('application_id', $appCibleId, 'and');
				$featureSource = $tbFeatureSource->find();
				if (!empty($featureSource)) {
					$refSource['feature_id'] = $featureSource['id'];
				}

				$refSource['application_id'] = $appCibleId;
				$tbRefCible = new Smart_record('adm_application_ref');
				$tbRefCible->fieldAll($refSource);
				$refCibleId = $tbRefCible->insert();
				if ($refCibleId == 0) {
					$traitFlag = false;
					break;
				}
			}
		}
			
		if ($traitFlag) {
			displayMsg('Import user/group/rights', '', 2);
			foreach($importGroupsArray as $groupArray) {
				$importgroupRightsArray = $groupArray['rights'];
				$importgroupUsersArray = $groupArray['users'];
				displayMsg('adm_group', 'Insert - ' . $groupArray['code'], 3);
				$groupSource = self::groupSource($groupArray);
				$groupSource['application_id'] = $appCibleId;
				$tbGroupCible = new Smart_record('adm_group');
				$tbGroupCible->fieldAll($groupSource);
				$groupCibleId = $tbGroupCible->insert();
				if ($groupCibleId == 0) {
					$traitFlag = false;
					break;
				}
				else {
					displayMsg('Import group_right', '', 3);
					foreach($importgroupRightsArray as $groupRightArray) {
						displayMsg('adm_group_right', 'Insert rights - ' . $groupRightArray['feature'] . '-' . $groupRightArray['module'], 4);
						$groupRightSource = self::groupRightSource($groupRightArray);
						
						$groupRightSource['feature_id'] = null;
						$tbFeatureSource = new Smart_select('adm_feature');
						$tbFeatureSource->fieldAll();
						$tbFeatureSource->whereSet('code', $groupRightArray['feature']);
						$tbFeatureSource->whereSet('application_id', $appCibleId, 'and');
						$featureSource = $tbFeatureSource->find();
						if (!empty($featureSource)) {
							$groupRightSource['feature_id'] = $featureSource['id'];
						}

						$groupRightSource['module_id'] = null;
						$tbModuleSource = new Smart_select('adm_module');
						$tbModuleSource->fieldAll();
						$tbModuleSource->whereSet('code', $groupRightArray['module']);
						$moduleSource = $tbModuleSource->find();
						if (!empty($moduleSource)) {
							$groupRightSource['module_id'] = $moduleSource['id'];
						}

						$groupRightSource['group_id'] = $groupCibleId;
						$tbGroupRightCible = new Smart_record('adm_group_right');
						$tbGroupRightCible->fieldAll($groupRightSource);
						$groupRightCibleId = $tbGroupRightCible->insert();
						if ($groupRightCibleId == 0) {
							$traitFlag = false;
							break;
						}
					}
					
					foreach($importgroupUsersArray as $userGroupArray) {
						$userId = '';
						if ($userGroupArray['user'] == 'GUEST') {
							$userId = USER_GUEST;
						}
						if ($userGroupArray['user'] == 'SUPERADMIN') {
							$userId = USER_SUPERADMIN;
						}
						if ($userGroupArray['user'] == 'DEFAULT') {
							$userId = USER_DEFAULT;
						}
						if (!empty($userId)) {
							displayMsg('adm_user_group', 'Insert - ' . $userGroupArray['user'] . ' - ' . $groupCibleId, 4);
							$tbUserSource = new Smart_select('adm_user');
							$tbUserSource->fieldAll();
							$tbUserSource->whereSet('id', $userId);
							$userSource = $tbUserSource->find();
							if (!empty($userSource)) {
								$userGroupSource = array();
								$userGroupSource['group_id'] = $groupCibleId;
								$userGroupSource['user_id'] = $userId;
								$tbUserGroupCible = new Smart_record('adm_user_group');
								$tbUserGroupCible->fieldAll($userGroupSource);
								$userGroupCibleId = $tbUserGroupCible->insert();
								if ($userGroupCibleId == 0) {
									$traitFlag = false;
									break;
								}
							}
						}
						else {
							displayMsg('adm_user_group', 'Insert not authorized - ' . $userGroupArray['user'] . ' - ' . $groupCibleId, 4);
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

	/**
	* rename application images in all the contents
	*
	* @param integer - application id 
	* 		 string  - application name source
	* 		 string  - application name cible
	*
	* @return boolean
	*           + true : no error
	*           + false : error
 	*
    * @access private
	*/
	private static function renameContent($appId, $appSourceName, $appCibleName) {
		$traitFlag = true;
		$contentCode = array();
	
		if ($traitFlag) {
			displayMsg('Rename content', '', 2);
			$tbContentSource = new Smart_select('cms_content', 'content');
			$tbContentSource->fieldAll();
			$tbContentSource->whereSet('application_id', $appId);
			$contentSources = $tbContentSource->findAll();
			foreach($contentSources as $contentSource) {
				$contentSourceCode = $contentSource['code'];
				$contentSourceId = $contentSource['id'];
				displayMsg('cms_content', 'Rename - ' . $contentSourceCode . ' - ' . $contentSourceId, 3);
				
				$contentSource['image'] = self::chgImagePath($contentSource['image'], $appSourceName, $appCibleName);
				$contentSource['image1'] = self::chgImagePath($contentSource['image1'], $appSourceName, $appCibleName);
				$contentSource['image2'] = self::chgImagePath($contentSource['image2'], $appSourceName, $appCibleName);
				$contentSource['image3'] = self::chgImagePath($contentSource['image3'], $appSourceName, $appCibleName);
				$contentSource['image4'] = self::chgImagePath($contentSource['image4'], $appSourceName, $appCibleName);
				$contentSource['image5'] = self::chgImagePath($contentSource['image5'], $appSourceName, $appCibleName);
				$contentSource['image6'] = self::chgImagePath($contentSource['image6'], $appSourceName, $appCibleName);
				$tbContentCible = new Smart_record('cms_content', 'content');
				$tbContentCible->fieldAll($contentSource);
				$appContentCibleId = $tbContentCible->insert();
				if ($appContentCibleId == 0) {
					$traitFlag = false;
					break;
				}

			}
		}

		if (!$traitFlag) {
			displayMsg('Error', '', 3);
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
	
	/**
	* copy application
	*
	* @param integer - application id source
	*
	* @return boolean
	*           + true : no error
	*           + false : error
 	*
    * @access private
	*/
	public static function copy($appId) {
		$traitFlag = true;
		$appCode = '';
		$appDir = '';
		$appName = '';
		$dirPath = '';
		$appCopyCode = '';
		$appCopyName = '';
		$appCopyContent = 0;
		
		$contentCode = array();
		$appSource = array();
		$appArray = array();

		$db = PDO_extend::ws_open();
		$tbAppSource = new Smart_select('adm_application');
		$tbAppSource->fieldAll();
		$tbAppSource->whereSet('id', $appId);
		$appSource = $tbAppSource->find();
		if (empty($appSource)) {
			$traitFlag = false;
			displayMsg('Application not found', 2);
		}
		else {
			displayMsg($appId . '-' . $appSource['code'], 'Copy application', 2);
			$appCode = $appSource['code'];
			$appDir = $appSource['dir'];
			$appName = $appSource['name'];
			$appCopyCode = $appSource['copy_code'];
			$appCopyName = $appSource['copy_name'];
			$appCopyContent = $appSource['copy_content'];
			if ((!empty($appCopyCode)) and (!empty($appCopyName))) {
				$appSource['code'] = $appCopyCode;
				$appSource['name'] = $appCopyName;
				$appSource['dir'] = $appCopyName;
				$appSource['copy_code'] = '';
				$appSource['copy_name'] = '';
				$appSource['copy_content'] = 0;
				$appSource['flag_admin'] = 0;
				$appSource['url_root'] = '';
				$appSource['canonical'] = '';
			}
			else {
				$traitFlag = false;
				displayMsg('Target Application not defined', '', 3);
			}
		}

		if ($traitFlag) {
			displayMsg($appCopyCode . ' ' . $appCopyName, 'Target', 2);
			$tbAppCible = new Smart_select('adm_application');
			$tbAppCible->fieldAll();
			$tbAppCible->whereSet('code', $appCopyCode);
			$tbAppCible->whereSet('name', $appCopyName, 'or');
			$appCible = $tbAppCible->find();
			if (!empty($appCible)) {
				displayMsg('Target app already exists', '', 2);
				$traitFlag = false;
			}
		}
			
		try {
			$db->beginTransaction();
			if ($traitFlag) {
				displayMsg('App Insert', '', 2);
				$tbAppCible = new Smart_record('adm_application');
				$tbAppCible->fieldAll($appSource);
				$appCibleId = $tbAppCible->insert();
				if ($appCibleId == 0) {
					$traitFlag = false;
				}

				if ($traitFlag) {
					$traitFlag = self::deleteStructure($appCibleId);
				}
	
				if ($traitFlag) {
					if ($appCopyContent) {
						$contentCode = self::copyContent($appId, $appCibleId);
					}
					$traitFlag = self::copyStructure($appId, $contentCode, $appCibleId);
				}
			}

			$appArray['flag_admin'] = 0;
			$appArray['copy_code'] = '';
			$appArray['copy_name'] = '';
			$tbAppSource = new Smart_record('adm_application');
			$tbAppSource->fieldAll($appArray);
			$tbAppSource->idSet($appId);
			$tbAppSource->update();
				
			if ($traitFlag) {
				$db->commit();
			}
			else {
				$db->rollBack();
			}
		}
		catch (Exception $e) {
			$traitFlag = false;
			$db->rollBack();
		}
		
		if ($traitFlag) {
			displayMsg('Files copy', '', 2);
			$dirPath = SITE_ROOT_DIR . APPS_PATH . $appDir;
			$imagesPath = SITE_ROOT_DIR . IMAGES_PATH . $appDir;
			$copyFilesPath = SITE_ROOT_DIR . APPS_PATH . $appCopyName;
			$copyImagesPath = SITE_ROOT_DIR . IMAGES_PATH . $appCopyName;
			if ((file_exists($dirPath)) and (!file_exists($copyFilesPath))) {
				displayMsg('Copy files to ' . $copyFilesPath, '', 3);
				xcopy($dirPath, $copyFilesPath);
			}
			if (file_exists($imagesPath)) {
				displayMsg('Copy images to ' . $copyImagesPath, '', 3);
				xcopy($imagesPath, $copyImagesPath);
			}
			foreach (xscan($copyFilesPath , '~\.tpl$~') as $file) {
				xreplaceInfile($file, './' . IMAGES_PATH . $appDir, './' . IMAGES_PATH . $appCopyName);
			}
		}
		
		if ($traitFlag) {
			displayMsg('Copy Ok', '', 2);
		}
		else {
			displayMsg('Copy Error', '', 2);
		}

		return $traitFlag;
	}

	/**
	* delete application
	*
	* @param integer - application id
	*
	* @return boolean
	*           + true : no error
	*           + false : error
 	*
    * @access private
	*/
	public static function delete($appId) {
		$traitFlag = true;
		$appCode = '';
		$appDir = '';
		$appName = '';
		$dirPath = '';

		$db = PDO_extend::ws_open();
		$tbAppSource = new Smart_select('adm_application');
		$tbAppSource->fieldAll();
		$tbAppSource->whereSet('id', $appId);
		$appSource = $tbAppSource->find();
		if (empty($appSource)) {
			$traitFlag = false;
			displayMsg('Application not found', 2);
		}
		else {
			displayMsg($appId . '-' . $appSource['code'], 'Delete application', 2);
			$appCode = $appSource['code'];
			$appDir = $appSource['dir'];
			$appName = $appSource['name'];
			if (empty($appDir)) {
				$appDir = $appName;
			}
			$dirPath = SITE_ROOT_DIR . APPS_PATH . $appDir;
			$imagesPath = SITE_ROOT_DIR . IMAGES_PATH . $appName;
			try {
				$db->beginTransaction();
				if ($traitFlag) {
					$traitFlag = self::deleteStructure($appId);
				}
				if ($traitFlag) {
					displayMsg('App Delete', '', 3);
					$tbApp = new Smart_select('adm_application');
					$tbApp->whereSet('id', $appId);
					$tbApp->delete();
				}
				if ($traitFlag) {
					$db->commit();
				}
				else {
					$db->rollBack();
				}
			}
			catch (Exception $e) {
				$traitFlag = false;
				$db->rollBack();
			}
		}
			
		if ($traitFlag) {
			displayMsg('Delete files', '', 2);
			if (file_exists($dirPath)) {
				displayMsg('Files delete', '', 3);
				xdelete($dirPath);
			}
			if (file_exists($imagesPath)) {
				displayMsg('Medias delete', '', 3);
				xdelete($imagesPath);
			}
		}

		if ($traitFlag) {
			displayMsg('Delete Ok', '', 2);
		}
		else {
			displayMsg('Delete Error', '', 2);
		}

		return $traitFlag;
	}
	
	/**
	* export application to archive
	*
	* @param integer - application id
	*
	* @return boolean
	*           + true : no error
	*           + false : error
 	*
    * @access private
	*/
	public static function export($appId) {
		$traitFlag = true;
		$appCode = '';
		$appDir = '';
		$appName = '';
		$dirPath = '';
		$archiveNamePath = '';
		$appSource = array();
		$appArray = array();

		$exportArray = array();
		$exportApplicationArray = array();
		$exportContentsArray = array();
	
		$db = PDO_extend::ws_open();
		$tbAppSource = new Smart_select('adm_application');
		$tbAppSource->fieldAll();
		$tbAppSource->whereSet('id', $appId);
		$appSource = $tbAppSource->find();
		if (empty($appSource)) {
			$traitFlag = false;
			displayMsg('Application not found', 2);
		}
		else {
			displayMsg($appId . '-' . $appSource['code'], 'Export application', 2);

			$appCode = $appSource['code'];
			$appDir = $appSource['dir'];
			$appName = $appSource['name'];
			if (empty($appDir)) {
				$appDir = $appName;
			}
			$dirPath = SITE_ROOT_DIR . APPS_PATH . $appDir;
			$imagesPath = SITE_ROOT_DIR . IMAGES_PATH . $appName;

			$exportApplicationArray = self::appSource($appSource);
			$exportApplicationArray['flag_admin'] = 0;
			$exportApplicationArray['status_id'] = 1;
			$exportApplicationArray['copy_code'] = '';
			$exportApplicationArray['copy_name'] = '';
			$exportApplicationArray['copy_content'] = 0;
		}

		if ($traitFlag) {
			try {
				$db->beginTransaction();
				$exportArray = self::exportStructure($appId, $appDir);

				if ($traitFlag) {
					$appArray['flag_admin'] = 0;
					$appArray['date_export'] = date('Y-m-d H:i:s');
					$tbAppSource = new Smart_record('adm_application');
					$tbAppSource->fieldAll($appArray);
					$tbAppSource->idSet($appId);
					$tbAppSource->update();
				}

				if ($traitFlag) {
					$db->commit();
				}
				else {
					$db->rollBack();
				}
			}
			catch (Exception $e) {
				$traitFlag = false;
				$db->rollBack();
			}
		}
		
		if ($traitFlag) {
			displayMsg('Export App files', '', 2);
			$archiveNamePath = SITE_ROOT_DIR . ARCHIVE_PATH . $appName;
			$archiveImagesNamePath = SITE_ROOT_DIR . ARCHIVE_PATH . $appName . '/' . IMAGES_PATH . $appName;
			if (file_exists($dirPath)) {
				if (file_exists($archiveNamePath)) {
					xdelete($archiveNamePath);
				}
				displayMsg('Files copy to ' . $archiveNamePath, '', 3);
				xcopy($dirPath, $archiveNamePath);
			}
			if (file_exists($imagesPath)) {
				displayMsg('Medias copy to ' . $archiveImagesNamePath, '', 3);
				xcopy($imagesPath, $archiveImagesNamePath);
			}
		}

		if ($traitFlag) {
			displayMsg('Creation export files', '', 2);
			$exportArray['code'] = $appCode;
			$exportArray['date_export'] = date('Y-m-d H:i:s');
			$exportArray['application'] = $exportApplicationArray;
			$exportContentsArray = $exportArray['contents'];
			unset($exportArray['contents']);
			
			$exportFile = SITE_ROOT_DIR . ARCHIVE_PATH . $appName . '/application.json';
			$fp = fopen($exportFile, 'w');
			fwrite($fp, json_encode($exportArray));
			fclose($fp);

			$exportContentFile = SITE_ROOT_DIR . ARCHIVE_PATH . $appName . '/contents.json';
			$fp = fopen($exportContentFile, 'w');
			fwrite($fp, json_encode($exportContentsArray));
			fclose($fp);
			
		}
	
		if ($traitFlag) {
			displayMsg('Export Ok', '', 2);
		}
		else {
			displayMsg('Export Error', '', 2);
		}
		
		return $traitFlag;
	}
	
	/**
	* import application from archive
	*
	* @param integer - App Id
	*
	* @return boolean
	*           + true : no error
	*           + false : error
 	*
    * @access private
	*/
	public static function import($appId) {
		$traitFlag = true;
		$importFile = '';
		$importContentFile = '';

		$contentCode = array();
		$appCible = array();
		$appArray = array();
		$appName = '';
		$appCopyContent = 0;
		$importArray = array();
		$importContentsArray = array();
	
		$db = PDO_extend::ws_open();
		$tbAppSource = new Smart_select('adm_application');
		$tbAppSource->fieldAll();
		$tbAppSource->whereSet('id', $appId);
		$appCible = $tbAppSource->find();
		if (!empty($appCible)) {
			$appName = $appCible['copy_name'];
			$appCopyContent = $appCible['copy_content'];
			displayMsg($appId . '-' . $appCible['code'], 'Import application', 2);
		}
		else {
			$traitFlag = false;
			displayMsg('Application not found', 2);
		}

		if ($traitFlag) {
			displayMsg($appName, 'import archive application', 2);
			$importFile = SITE_ROOT_DIR . ARCHIVE_PATH . $appName . '/application.json';
			$importContentFile = SITE_ROOT_DIR . ARCHIVE_PATH . $appName . '/contents.json';
			if (file_exists($importFile)) {
				$importArray = jsonRead($importFile);
				if (file_exists($importContentFile)) {
					$importContentsArray = jsonRead($importContentFile);
				}
			}
			else {
				$traitFlag = false;
				displayMsg($appName, 'Archibe not found', 2);
			}
		}

		if ($traitFlag) {
			try {
				$db->beginTransaction();
				if ($traitFlag) {
					if ($appCopyContent) {
						$contentCode = self::importContent($importContentsArray, $appId);
					}
					$traitFlag = self::importStructure($importArray, $contentCode, $appId);
				}

				if ($traitFlag) {
					$appArray = self::appSource($importArray['application']);
					$appArray['code'] = $appCible['code'];
					$appArray['name'] = $appCible['name'];
					$appArray['dir'] = $appCible['dir'];
					$appArray['flag_admin'] = 0;
					$appArray['status_id'] = 1;
					$appArray['copy_code'] = '';
					$appArray['copy_name'] = '';
					$appArray['copy_content'] = 0;
					$appArray['date_import'] = date('Y-m-d H:i:s');
					$tbAppSource = new Smart_record('adm_application');
					$tbAppSource->fieldAll($appArray);
					$tbAppSource->idSet($appId);
					$tbAppSource->update();
				}

				if ($traitFlag) {
					$db->commit();
				}
				else {
					$db->rollBack();
				}
			}
			catch (Exception $e) {
				$traitFlag = false;
				$db->rollBack();
			}
		}
		if ($traitFlag) {
			displayMsg('Import App files', '', 2);
			$archiveNamePath = SITE_ROOT_DIR . ARCHIVE_PATH . $appName;
			$archiveImagesNamePath = SITE_ROOT_DIR . ARCHIVE_PATH . $appName . '/' . IMAGES_PATH . $appName;
			$dirPath = SITE_ROOT_DIR . APPS_PATH . $appCible['dir'];
			$imagesPath = SITE_ROOT_DIR . IMAGES_PATH . $appCible['dir'];
			if (file_exists($archiveNamePath)) {
				if (file_exists($dirPath)) {
					xdelete($dirPath);
				}
				displayMsg('Copy files to ' . $dirPath, '', 3);
				xcopy($archiveNamePath, $dirPath);
			}
			if (file_exists($archiveImagesNamePath)) {
				displayMsg('Copy medias to ' . $imagesPath, '', 3);
				xcopy($archiveImagesNamePath, $imagesPath);
			}
			
			foreach (xscan($dirPath , '~\.tpl$~') as $file) {
				xreplaceInfile($file, './' . IMAGES_PATH . $appName, './' . IMAGES_PATH . $appCible['dir']);
			}
		}
		if ($traitFlag) {
			displayMsg('Import Ok', '', 2);
		}
		else {
			displayMsg('Import Error', '', 2);
		}
		
		return $traitFlag;
	}

	
	/**
	* init application
	*
	* @param integer - App Id
	*		 string  - App type
	* @return boolean
	*           + true : no error
	*           + false : error
 	*
    * @access private
	*/
	public static function initType($appId) {
		$traitFlag = true;

		$appCible = array();
		$appName = '';
		$appType = '';
				
		$db = PDO_extend::ws_open();
		$tbAppSource = new Smart_select('adm_application');
		$tbAppSource->fieldAll();
		$tbAppSource->whereSet('id', $appId);
		$appCible = $tbAppSource->find();
		if (!empty($appCible)) {
			displayMsg($appId, 'Init application', 2);
			$appCode = $appSource['code'];
			$appName = $appCible['name'];
			$appType = $appCible['apptype'];
			$appDir = $appSource['dir'];
			if (empty($appDir)) {
				$appDir = $appName;
			}
			$dirPath = SITE_ROOT_DIR . APPS_PATH . $appDir;
			$imagesPath = SITE_ROOT_DIR . IMAGES_PATH . $appName;
		}
		else {
			$traitFlag = false;
			displayMsg('Application not found', 2);
		}

		$appType = 'default';
		if ($traitFlag) {
			displayMsg($appType, 'import archive application', 2);
			$importFile = SITE_ROOT_DIR . INIT_PATH . $appType . '/application.json';
			$importContentFile = SITE_ROOT_DIR . INIT_PATH . $appType . '/contents.json';
			if (file_exists($importFile)) {
				$importArray = jsonRead($importFile);
				if (file_exists($importContentFile)) {
					$importContentsArray = jsonRead($importContentFile);
				}
			}
			else {
				$traitFlag = false;
				displayMsg($appType, 'Archibe not found', 2);
			}
		}

		if ($traitFlag) {
			try {
				$db->beginTransaction();
				$traitFlag = self::initStructure($appId);

				$contentCode = self::importContent($importContentsArray, $appId);
				$traitFlag = self::importStructure($importArray, $contentCode, $appId);
				
				if ($traitFlag) {
					$appArray['dir'] = $appDir;
					$appArray['flag_admin'] = 0;
					$appArray['status_id'] = 1;
					$appArray['copy_code'] = '';
					$appArray['copy_name'] = '';
					$appArray['copy_content'] = 0;
					$tbAppSource = new Smart_record('adm_application');
					$tbAppSource->fieldAll($appArray);
					$tbAppSource->idSet($appId);
					$tbAppSource->update();
				}

				if ($traitFlag) {
					$db->commit();
				}
				else {
					$db->rollBack();
				}
			}
			catch (Exception $e) {
				$traitFlag = false;
				$db->rollBack();
			}
		}

		if ($traitFlag) {
			displayMsg('Init App files', '', 2);
			$archiveNamePath = SITE_ROOT_DIR . INIT_PATH . $appType;
			$archiveImagesNamePath = SITE_ROOT_DIR . INIT_PATH . $appType . '/' . IMAGES_PATH . $appType;
			if (file_exists($archiveNamePath)) {
				if (file_exists($dirPath)) {
					xdelete($dirPath);
				}
				displayMsg('Copy files to ' . $dirPath, '', 3);
				xcopy($archiveNamePath, $dirPath);
			}
			if (file_exists($archiveImagesNamePath)) {
				displayMsg('Copy medias to ' . $imagesPath, '', 3);
				xcopy($archiveImagesNamePath, $imagesPath);
			}
			
			foreach (xscan($dirPath , '~\.tpl$~') as $file) {
				xreplaceInfile($file, './' . IMAGES_PATH . $appType, './' . IMAGES_PATH . $appDir);
			}
		}
		if ($traitFlag) {
			displayMsg('Init Ok', '', 2);
		}
		else {
			displayMsg('Init Error', '', 2);
		}
		
		return $traitFlag;
	}
	
	/**
	* rename application
	*
	* @param integer - application id
	*
	* @return boolean
	*           + true : no error
	*           + false : error
 	*
    * @access private
	*/
	public static function rename($appId) {
		$traitFlag = true;
		$appCode = '';
		$appDir = '';
		$appName = '';
		$dirPath = '';
		$appArray = array();
	
		$db = PDO_extend::ws_open();
		$tbAppSource = new Smart_select('adm_application');
		$tbAppSource->fieldAll();
		$tbAppSource->whereSet('id', $appId);
		$appSource = $tbAppSource->find();
		if (empty($appSource)) {
			$traitFlag = false;
			displayMsg('Application not found', 2);
		}
		else {
			$appCode = $appSource['code'];
			$appDir = $appSource['dir'];
			$appName = $appSource['name'];
			$appCopyCode = $appSource['copy_code'];
			$appCopyName = $appSource['copy_name'];
			$appCopyContent = $appSource['copy_content'];
			$dirPath = SITE_ROOT_DIR . APPS_PATH . $appDir;
			$imagesPath = SITE_ROOT_DIR . IMAGES_PATH . $appDir;
			if ((empty($appCopyCode)) or (empty($appCopyName))) {
				$traitFlag = false;
				displayMsg('Target Application not defined', '', 2);
			}
		}

		if ($traitFlag) {
			displayMsg($appCopyCode, 'Target Code', 3);
			$tbAppCible = new Smart_select('adm_application');
			$tbAppCible->fieldAll();
			if ($appCopyCode != $appCode) {
				$tbAppCible->whereSet('code', $appCopyCode);
				if ($appCopyName != $appName) {
					$tbAppCible->whereSet('name', $appCopyName, 'or');
				}
			}
			else {
				if ($appCopyName != $appName) {
					$tbAppCible->whereSet('name', $appCopyName);
				}
				else {
					$traitFlag = false;
					displayMsg('App already exists', '', 2);
				}
			}
		}
		if ($traitFlag) {
			$appCible = $tbAppCible->find();
			if (!empty($appCible)) {
				$traitFlag = false;
				displayMsg('App already exists', '', 2);
			}
		}
		
		try {
			$db->beginTransaction();
			if ($traitFlag) {
				if (($appCopyCode != $appCode) or ($appCopyName != $appName)) {
					$appArray['code'] = $appCopyCode;
					$appArray['name'] = $appCopyName;
					$appArray['dir'] = $appCopyName;
				}

				if ($appCopyName != $appDir) {
					displayMsg('Rename content', '', 2);
					$tbContentSource = new Smart_select('cms_content', 'content');
					$tbContentSource->fieldAll();
					$tbContentSource->whereSet('application_id', $appId);
					$contentSources = $tbContentSource->findAll();
					foreach($contentSources as $contentSource) {
						$contentCode = $contentSource['code'];
						$contentId = $contentSource['id'];
						displayMsg('cms_content', 'Rename - ' . $contentCode . ' - ' . $contentId, 3);
				
						$contentSource['image'] = self::chgImagePath($contentSource['image'], $appDir, $appCopyName);
						$contentSource['image1'] = self::chgImagePath($contentSource['image1'], $appDir, $appCopyName);
						$contentSource['image2'] = self::chgImagePath($contentSource['image2'], $appDir, $appCopyName);
						$contentSource['image3'] = self::chgImagePath($contentSource['image3'], $appDir, $appCopyName);
						$contentSource['image4'] = self::chgImagePath($contentSource['image4'], $appDir, $appCopyName);
						$contentSource['image5'] = self::chgImagePath($contentSource['image5'], $appDir, $appCopyName);
						$contentSource['image6'] = self::chgImagePath($contentSource['image6'], $appDir, $appCopyName);
						$tbContentCible = new Smart_record('cms_content', 'content');
						$tbContentCible->fieldAll($contentSource);
						$tbContentCible->idSet($contentId);
						$appContentId = $tbContentCible->update();
						if ($appContentId == 0) {
							$traitFlag = false;
							break;
						}
					}
				}
				else {
					displayMsg('No rename Content', '', 2);
				}

				
			}

			$appArray['flag_admin'] = 0;
			$appArray['copy_code'] = '';
			$appArray['copy_name'] = '';
			$appArray['copy_content'] = 0;
			$tbAppSource = new Smart_record('adm_application');
			$tbAppSource->fieldAll($appArray);
			$tbAppSource->idSet($appId);
			$tbAppSource->update();
			$db->commit();
			
		}
		catch (Exception $e) {
			$traitFlag = false;
			$db->rollBack();
		}
		
		if ($traitFlag) {
			if ($appCopyName != $appDir) {
				displayMsg('Rename App files', '', 2);
				$namePath = SITE_ROOT_DIR . APPS_PATH . $appCopyName;
				$nameImagesPath = SITE_ROOT_DIR . IMAGES_PATH . $appCopyName;
				if ((!file_exists($namePath)) and (file_exists($dirPath))) {
					rename($dirPath, $namePath);
					displayMsg('Rename ' . $dirPath . ' to ' . $namePath, '', 3);
				}
				if ((!file_exists($nameImagesPath)) and (file_exists($imagesPath))) {
					rename($imagesPath, $nameImagesPath);
					displayMsg('Rename ' . $imagesPath . ' to ' . $nameImagesPath, '', 3);
				}

				foreach (xscan($namePath , '~\.tpl$~') as $file) {
					xreplaceInfile($file, './' . IMAGES_PATH . $appDir, './' . IMAGES_PATH . $appCopyName);
				}
			}
			else {
				displayMsg('No rename App files', '', 2);
			}
		}

		if ($traitFlag) {
			displayMsg('Rename Ok', '', 2);
		}
		else {
			displayMsg('Rename Error', '', 2);
		}
		
		return $traitFlag;
	}

}