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
 * Class PluginWebapplicationsProcess
 */
class PluginWebapplicationsProcess extends CommonDBTM {

    static $rightname         = "plugin_webapplications_processes";

   static function getTypeName($nb = 0) {

      return _n('Process', 'Processes', $nb, 'webapplications');
   }

    static function getMenuContent() {

        $menu = [];

        $menu['title']           = PluginWebapplicationsProcess::getMenuName();
        $menu['page']            = PluginWebapplicationsProcess::getSearchURL(false);
        $menu['links']['search'] = PluginWebapplicationsProcess::getSearchURL(false);
        if (self::canCreate()) {
            $menu['links']['add'] = "/plugins/webapplications/front/process.form.php";
        }

        $menu['icon'] = self::getIcon();


        return $menu;
    }

    


    static function getIcon() {
        return "fas fa-cogs";
    }

    function showForm($ID, $options = []) {

        $this->initForm($ID, $options);


        TemplateRenderer::getInstance()->display('@webapplications/webapplication_process_form.html.twig', [
            'item'   => $this,
            'params' => $options,
        ]);


    }

    function defineTabs($options=[]) {
        $ong = array();
        //add main tab for current object
        $this->addDefaultFormTab($ong);
        $this->addStandardTab('Appliance_Item', $ong, $options);
        return $ong;
    }


}
