<?php

// +----------------------------------------------------------------------+
// | Copyright 2015 10up Inc                                              |
// +----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify |
// | it under the terms of the GNU General Public License, version 2, as  |
// | published by the Free Software Foundation.                           |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to the Free Software          |
// | Foundation, Inc., 51 Franklin St, Fifth Floor, Boston,               |
// | MA 02110-1301 USA                                                    |
// +----------------------------------------------------------------------+

namespace WPCC;

use Codeception\Configuration;
use Codeception\Lib\Di;
use Codeception\Lib\GroupManager;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Suite manager class.
 *
 * @since 1.0.0
 * @category WPCC
 */
class SuiteManager extends \Codeception\SuiteManager {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @param \Symfony\Component\EventDispatcher\EventDispatcher $dispatcher
	 * @param string $name The suite name.
	 * @param array $settings The suite settings.
	 */
	public function __construct( EventDispatcher $dispatcher, $name, array $settings ) {
		$this->settings = $settings;
		$this->dispatcher = $dispatcher;
		$this->di = new Di();
		$this->path = $settings['path'];
		$this->groupManager = new GroupManager( $settings['groups'] );
		$this->moduleContainer = new ModuleContainer( $this->di, $settings );

		$modules = Configuration::modules( $this->settings );
		foreach ( $modules as $moduleName ) {
			$this->moduleContainer->create( $moduleName );
		}
		
		$this->moduleContainer->validateConflicts();
		$this->suite = $this->createSuite( $name );
		if ( isset( $settings['current_environment'] ) ) {
			$this->env = $settings['current_environment'];
		}
	}

}