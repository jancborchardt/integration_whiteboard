<?php
/**
 * Nextcloud - spacedeck
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Julien Veyssier <eneiluj@posteo.net>
 * @copyright Julien Veyssier 2020
 */

return [
	'routes' => [
		['name' => 'config#setAdminConfig', 'url' => '/admin-config', 'verb' => 'PUT'],
		['name' => 'spacedeckAPI#saveSpaceToFile', 'url' => '/space/{space_id}/{file_id}', 'verb' => 'POST'],
		['name' => 'spacedeckAPI#loadSpaceFromFile', 'url' => '/space/{file_id}', 'verb' => 'GET'],
	]
];