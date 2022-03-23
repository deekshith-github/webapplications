<?php

/*
 * @version $Id: HEADER 15930 2011-10-30 15:47:55Z tsmr $
 -------------------------------------------------------------------------
 webapplications plugin for GLPI
 Copyright (C) 2009-2016 by the webapplications Development Team.

 https://github.com/InfotelGLPI/webapplications
 -------------------------------------------------------------------------

 LICENSE

 This file is part of webapplications.

 webapplications is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 webapplications is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with webapplications. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access directly to this file");
}

use Glpi\Application\View\TemplateRenderer;

/**
 * Class PluginWebapplicationsFlux
 */
class PluginWebapplicationsFlux extends CommonDBTM {

   static function getTypeName($nb = 0) {

      return _n('Flux', 'Flux', $nb, 'webapplications');
   }

    static function getMenuContent() {

        $menu = [];

        $menu['title']           = PluginWebapplicationsFlux::getMenuName();
        $menu['page']            = PluginWebapplicationsFlux::getSearchURL(false);
        $menu['links']['search'] = PluginWebapplicationsFlux::getSearchURL(false);
        //if (self::canCreate()) {
            $menu['links']['add'] = "/plugins/webapplications/front/flux.form.php";
       // }

        $menu['icon'] = self::getIcon();


        return $menu;
    }

    static function getIcon() {
        return "fas fa-rss";
    }

    function showForm($ID, $options = []) {

        $this->initForm($ID, $options);
        $this->showFormHeader($options);


        $this->showFormButtons($options);

        Html::closeForm();

    }



}
