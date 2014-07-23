<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This file contains just the Button atom class.
 *
 * The button atom is an element in the Output API.
 *
 * @package core
 * @category output
 * @copyright 2014 Sam Hemelryk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

defined('MOODLE_INTERNAL') || die();

/**
 * The button atom.
 *
 * The button in fact extends the action atom rather than the base atom class.
 * It is important to note that the button atom should ONLY be used when you absolutely require a button.
 * If you simply have an action that the user can perform please use the action class instead.
 * This way the renderer can decide when to use the action as a link and when to use it as a button.
 *
 * @package core
 * @category output
 * @copyright 2014 Sam Hemelryk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class button extends action {
}
