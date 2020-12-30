/**
 * @author Julien Veyssier <eneiluj@posteo.net>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

import ApplicationPrototype from './prototype.js'
import SpacedeckViewer from './components/SpacedeckViewer'

const APP_NAME = 'integration_spacedeck'
const APP_EXT = 'spd'
const APP_MIME = 'application/spacedeck'

__webpack_nonce__ = btoa(OC.requestToken) 			 // eslint-disable-line
__webpack_public_path__ = OC.linkTo(APP_NAME, 'js/') // eslint-disable-line

OCA.integration_spacedeck = ApplicationPrototype

document.addEventListener('DOMContentLoaded', () => {
	// add the + action to create a file
	OCA.integration_spacedeck.initialize(APP_NAME, APP_EXT, APP_MIME)

	// register the viewer if possible
	if (OCA.Viewer) {
		OCA.Viewer.registerHandler({
			id: 'spacedeck',

			// group: 'media',

			mimes: [
				'application/spacedeck',
			],

			component: SpacedeckViewer,
		})
	} else {
		// if there is no viewer, do as the Whiteboard app: register a file action
		OCA.integration_spacedeck.registerFileActions()
	}
})