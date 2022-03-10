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
 * Class PluginWebapplicationsDatabase
 */
class PluginWebapplicationsDatabase extends CommonDBTM {

   static function getTypeName($nb = 0) {

      return _n('Web application', 'Web applications', $nb, 'webapplications');
   }

   /**
    * @param $params
    */
   static function addFields($params) {

      $item             = $params['item'];
      $webapp_database = new self();
      if ($item->getType() == 'Database') {

         if ($item->getID()) {
            $webapp_database->getFromDBByCrit(['databases_id' => $item->getID()]);
         } else {
            $webapp_database->getEmpty();
         }
         $options = [];

         TemplateRenderer::getInstance()->display('@webapplications/webapplication_database_form.html.twig', [
            'item'   => $webapp_database,
            'params' => $options,
         ]);
      }
      return true;
   }

   /**
    * @param \Database $item
    *
    * @return false
    */
   static function databaseAdd(Database $item) {
      if (!is_array($item->input) || !count($item->input)) {
         // Already cancel by another plugin
         return false;
      }
      self::setDatabase($item);
   }


   /**
    * @param \Database $item
    *
    * @return false
    */
   static function databaseUpdate(Database $item) {
      if (!is_array($item->input) || !count($item->input)) {
         // Already cancel by another plugin
         return false;
      }
      self::setDatabase($item);
   }

   /**
    * @param \Database $item
    */
   static function setDatabase(Database $item) {
      $database = new PluginWebApplicationsDatabase();
      if (!empty($item->fields)) {
         $database->getFromDBByCrit(['databases_id' => $item->getID()]);
         if (is_array($database->fields) && count($database->fields) > 0) {
            $database->update(['id'                           => $database->fields['id'],
                                'webapplicationtechnics_id'    => isset($item->input['webapplicationtechnics_id']) ? $item->input['webapplicationtechnics_id'] : $database->fields['plugin_webapplications_webapplicationtechnics_id'],
                                'webapplicationexternalexpositions_id'    => isset($item->input['webapplicationexternalexpositions_id']) ? $item->input['webapplicationexternalexpositions_id'] : $database->fields['plugin_webapplications_webapplicationexternalexpositions_id'],
                                'webapplicationavailabilities_id'    => isset($item->input['webapplicationavailabilities_id']) ? $item->input['webapplicationavailabilities_id'] : $database->fields['plugin_webapplications_webapplicationavailabilities_id'],
                                'webapplicationintegrities_id'    => isset($item->input['webapplicationintegrities_id']) ? $item->input['webapplicationintegrities_id'] : $database->fields['plugin_webapplications_webapplicationintegrities_id'],
                                'webapplicationconfidentialities_id'    => isset($item->input['webapplicationconfidentialities_id']) ? $item->input['webapplicationconfidentialities_id'] : $database->fields['plugin_webapplications_webapplicationconfidentialities_id'],
                                'webapplicationtraceabilities_id'    => isset($item->input['webapplicationtraceabilities_id']) ? $item->input['webapplicationtraceabilities_id'] : $database->fields['plugin_webapplications_webapplicationtraceabilities_id']
                               ]);
         } else {
            $database->add([ 'webapplicationtechnics_id'    => isset($item->input['webapplicationtechnics_id']) ? $item->input['webapplicationtechnics_id'] : 0,
                             'webapplicationexternalexpositions_id' => isset($item->input['webapplicationexternalexpositions_id']) ? $item->input['webapplicationexternalexpositions_id'] : 0,
                             'webapplicationavailabilities_id' => isset($item->input['webapplicationavailabilities_id']) ? $item->input['webapplicationavailabilities_id'] : 0,
                             'webapplicationintegrities_id' => isset($item->input['webapplicationintegrities_id']) ? $item->input['webapplicationintegrities_id'] : 0,
                             'webapplicationconfidentialities_id' => isset($item->input['webapplicationconfidentialities_id']) ? $item->input['webapplicationconfidentialities_id'] : 0,
                             'webapplicationtraceabilities_id' => isset($item->input['webapplicationtraceabilities_id']) ? $item->input['webapplicationtraceabilities_id'] : 0,
                             'databases_id'                => $item->getID()]);
         }
      }
   }


   /**
    * @param $item
    */
   static function cleanRelationToDatabase($item) {

      $temp = new self();
      $temp->deleteByCriteria(['databases_id' => $item->getID()]);

   }
}
