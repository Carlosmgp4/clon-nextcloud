<?php
/**
 * @copyright Copyright (c) 2017 Arthur Schiwon <blizzz@arthur-schiwon.de>
 *
 * @author Arthur Schiwon <blizzz@arthur-schiwon.de>
 * @author Jos Poortvliet <jos@opensuse.org>
 * @author Julius Härtl <jus@bitgrid.net>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Carl Schwan <carl@carlschwan.eu>
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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */
namespace OCA\FederatedFileSharing\Settings;

use OCA\FederatedFileSharing\FederatedShareProvider;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Services\IInitialState;
use OCP\IL10N;
use OCP\IUserSession;
use OCP\IURLGenerator;
use OCP\Settings\ISettings;

class Personal implements ISettings {
	private FederatedShareProvider $federatedShareProvider;
	private IUserSession $userSession;
	private IL10N $l;
	private \OC_Defaults $defaults;
	private IInitialState $initialState;
	private IURLGenerator $urlGenerator;

	public function __construct(
		FederatedShareProvider $federatedShareProvider, #
		IUserSession $userSession,
		IL10N $l,
		\OC_Defaults $defaults,
		IInitialState $initialState,
		IURLGenerator $urlGenerator
	) {
		$this->federatedShareProvider = $federatedShareProvider;
		$this->userSession = $userSession;
		$this->l = $l;
		$this->defaults = $defaults;
		$this->initialState = $initialState;
		$this->urlGenerator = $urlGenerator;
	}

	/**
	 * @return TemplateResponse returns the instance with all parameters set, ready to be rendered
	 * @since 9.1
	 */
	public function getForm() {
		$cloudID = $this->userSession->getUser()->getCloudId();
		$url = 'https://nextcloud.com/sharing#' . $cloudID;

		$parameters = [
			'message_with_URL' => $this->l->t('Share with me through my #Nextcloud Federated Cloud ID, see %s', [$url]),
			'message_without_URL' => $this->l->t('Share with me through my #Nextcloud Federated Cloud ID', [$cloudID]),
			'logoPath' => $this->defaults->getLogo(),
			'reference' => $url,
			'cloudId' => $cloudID,
			'color' => $this->defaults->getColorPrimary(),
			'textColor' => "#ffffff",
		];

		$this->initialState->provideInitialState('color', $this->defaults->getColorPrimary());
		$this->initialState->provideInitialState('textColor', '#fffff');
		$this->initialState->provideInitialState('logoPath', $this->defaults->getLogo());
		$this->initialState->provideInitialState('reference', $url);
		$this->initialState->provideInitialState('cloudId', $cloudID);
		$this->initialState->provideInitialState('docUrlFederated', $this->urlGenerator->linkToDocs('user-sharing-federated'));

		return new TemplateResponse('federatedfilesharing', 'settings-personal', $parameters, '');
	}

	/**
	 * @return string the section ID, e.g. 'sharing'
	 * @since 9.1
	 */
	public function getSection() {
		if ($this->federatedShareProvider->isIncomingServer2serverShareEnabled() ||
			$this->federatedShareProvider->isIncomingServer2serverGroupShareEnabled()) {
			return 'sharing';
		}
		return null;
	}

	/**
	 * @return int whether the form should be rather on the top or bottom of
	 * the admin section. The forms are arranged in ascending order of the
	 * priority values. It is required to return a value between 0 and 100.
	 *
	 * E.g.: 70
	 * @since 9.1
	 */
	public function getPriority() {
		return 40;
	}
}
