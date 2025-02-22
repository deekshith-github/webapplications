<?php
/*
 * @version $Id: HEADER 15930 2011-10-30 15:47:55Z tsmr $
 -------------------------------------------------------------------------
 webapplications plugin for GLPI
 Copyright (C) 2009-2022 by the webapplications Development Team.

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

define('PLUGIN_WEBAPPLICATIONS_VERSION', '4.0.1');

if (!defined("PLUGIN_WEBAPPLICATIONS_DIR")) {
   define("PLUGIN_WEBAPPLICATIONS_DIR", Plugin::getPhpDir("webapplications"));
   define("PLUGIN_WEBAPPLICATIONS_NOTFULL_DIR", Plugin::getPhpDir("webapplications",false));
   define("PLUGIN_WEBAPPLICATIONS_WEBDIR", Plugin::getWebDir("webapplications"));
}


// Init the hooks of the plugins -Needed
function plugin_init_webapplications() {
   global $PLUGIN_HOOKS;

   $PLUGIN_HOOKS['csrf_compliant']['webapplications']   = true;

   $PLUGIN_HOOKS['change_profile']['webapplications']   = ['PluginWebapplicationsProfile',
      'initProfile'];

   Plugin::registerClass('PluginWebapplicationsProfile', ['addtabon' => ['Profile']]);

   //if glpi is loaded
//   if (Session::getLoginUserID()) {
//
//      if (Session::haveRight("plugin_webapplications", READ)
//          || Session::haveRight("config", UPDATE)) {
//         $PLUGIN_HOOKS['config_page']['webapplications']        = 'front/webapplication.php';
//      }
//   }

   $PLUGIN_HOOKS['post_item_form']['webapplications'] = ['PluginWebapplicationsAppliance', 'addFields'];

   $PLUGIN_HOOKS['item_purge']['webapplications']['Appliance'] = ['PluginWebapplicationsAppliance', 'cleanRelationToAppliance'];

   // Other fields inherited from webapplications
   $PLUGIN_HOOKS['item_add']['webapplications']       = ['Appliance' => ['PluginWebapplicationsAppliance',
                                                                         'applianceAdd']];

   $PLUGIN_HOOKS['pre_item_update']['webapplications'] = ['Appliance' => ['PluginWebapplicationsAppliance',
                                                                          'applianceUpdate']];
}


/**
 * Get the name and the version of the plugin - Needed
 *
 * @return array
 */
function plugin_version_webapplications() {

   return ['name'           => _n('Web application', 'Web applications', 2, 'webapplications'),
                'version'        => PLUGIN_WEBAPPLICATIONS_VERSION,
                'license'        => 'GPLv2+',
                'oldname'        => 'appweb',
                'author'         => "<a href='http://blogglpi.infotel.com'>Infotel</a>",
                'homepage'       => 'https://github.com/InfotelGLPI/webapplications',
                'requirements'   => [
                  'glpi' => [
                     'min' => '10.0',
                     'max' => '11.0',
                     'dev' => false
                  ]
               ]
            ];
}
