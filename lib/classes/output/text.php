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
 * This file contains just the Text atom class.
 *
 * The text atom is an element in the Output API.
 *
 * @package core
 * @category output
 * @copyright 2014 Sam Hemelryk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

defined('MOODLE_INTERNAL') || die();

/**
 * Text atom.
 *
 * The text atom is used to represent plain text within the element.
 * Renderers can choose to interpret this as something else if they wish to, and can interact with it like other
 * atoms.
 * It can have attributes added by render methods.
 * It can have properties added by owning components.
 *
 * @package core
 * @category output
 * @copyright 2014 Sam Hemelryk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class text extends atom {

    /**
     * The textual content.
     * @var string
     */
    public $content;

    /**
     * Constructs a text atom.
     *
     * @param string $content The textual content of this text atom.
     */
    public function __construct($content) {
        $this->content = (string)$content;
    }
}
