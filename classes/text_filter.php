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
 * Filter implementation
 *
 * File         filter.php
 * Encoding     UTF-8
 *
 * @package     filter_couponinput
 *
 * @copyright   RvD
 * @author      RvD <helpdesk@sebsoft.nl>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace filter_couponinput;

/**
 * Filter implementation
 *
 * @package     filter_couponinput
 *
 * @copyright   RvD
 * @author      RvD <helpdesk@sebsoft.nl>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class text_filter extends \core_filters\text_filter {

    /**
     * Apply filter
     *
     * @param string $text
     * @param array $options
     * @return string
     */
    public function filter($text, array $options = []) {
        if (empty($text) || is_numeric($text)) {
            return $text;
        }

        $search = '/([\[<])couponinputform[\]>]/is';
        $result = preg_replace_callback($search, [$this, 'filter_couponinput_impl'], $text);

        if (is_null($result)) {
            return $text; // Error during regex processing (too many nested spans?).
        } else {
            return $result;
        }
    }

    /**
     * Callback implementation.
     *
     * @param string $template
     * @return string
     */
    public function filter_couponinput_impl($template) {
        global $PAGE, $CFG;
        $cfgbuttonclass = get_config('block_coupon', 'buttonclass');
        $btnclass = 'btn-coupon';
        if ($cfgbuttonclass != 'none') {
            $btnclass .= ' ' . $cfgbuttonclass;
        }
        $baseparams = [];
        if (has_capability('block/coupon:inputcoupons', $PAGE->context)) {
            $renderer = $PAGE->get_renderer('block_coupon');
            $urlinputcoupon = new moodle_url($CFG->wwwroot . '/blocks/coupon/view/input_coupon.php', $baseparams);
            $templatecontext = (object)[
                'urlinputcoupon' => $urlinputcoupon->out(false),
                'btnclass' => $btnclass,
                'instanceid' => 0,
                'sesskey' => sesskey(),
            ];
            return $renderer->render_from_template('block_coupon/coupon/inputform', $templatecontext);
        }
        return '';
    }

}
