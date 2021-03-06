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

namespace WPCC\Component\Generator;

use WPCC\Configuration;

/**
 * Generates actor classes based on provided configuration.
 *
 * @since 1.0.0
 * @category WPCC
 * @package Component
 * @subpackage Generator
 */
class Actor extends \Codeception\Lib\Generator\Actor {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @param array $settings Suite settings.
	 */
	public function __construct( $settings ) {
		$this->settings = $settings;
		$this->modules = Configuration::modules( $settings );
		$this->actions = Configuration::actions( $this->modules );
	}

}