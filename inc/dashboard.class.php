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


/**
 * Class PluginWebapplicationsDashboard
 */
class PluginWebapplicationsDashboard extends CommonDBTM {

    static $rightname         = "plugin_webapplications_dashboards";

    static function getTypeName($nb = 0) {

        return __('Dashboard', 'webapplications');
    }



    function showForm($ID, $options = [])
    {


        $options['candel'] = false;
        $options['colspan'] = 1;


        echo "<div align='center'>
        <table class='tab_cadre_fixe'>";
        echo "<tr><td colspan='6' style='text-align:right'>" . __('Appliance', 'webapplications') . "</td>";

        echo "<td >";
        Appliance::dropdown(['name' => 'applianceDropdown']);
        echo "</td>";
        echo "</tr>";
        echo "</table></div>";
        echo "<script src='../scripts/getListByDropdown.js' type='text/javascript'></script>";
        echo "<div name=listProc></div>";

        $this->showListProcesses();


    }

    static function showListProcesses($ApplianceId){


        $processDBTM = new PluginWebapplicationsProcess();
        echo "<link rel='stylesheet' href='../css/style.css'>";
        echo "<script src='../scripts/processAccordion.js' type='text/javascript'></script>";

        echo "<div name=listProcessesApp>";

        $procsAppDBTM = new Appliance_Item();
        $procsApp = $procsAppDBTM->find(['appliances_id' => $ApplianceId, 'itemtype' => 'PluginWebapplicationsProcess']);


        $listProcId = array();
        foreach ($procsApp as $proc) {
            $procsAppDBTM->getFromDB($proc['id']);

            array_push($listProcId, $proc['items_id']);
        }

        $processes = $processDBTM->find(['id' => $listProcId]);
        foreach ($processes as $process) {

            $processDBTM->getFromDB($process['id']);

            $name = $process['name'];

            echo "<button class='accordion'>$name</button>";

            echo "<div class='panel' id='tabsbody'>";


            echo "<table class='tab_cadre_fixe' style='border:1px solid white;'>";


            echo "<tbody>";

            echo "<tr>";
            echo "<th>";
            echo "Name";
            echo "</th>";
            echo "<td>";
            echo $name;
            echo "</td>";

            $linkProc = PluginWebapplicationsProcess::getFormURLWithID($process['id']);

            echo "<td style='width: 10%'>";
            echo Html::submit(_sx('button', 'Edit'), ['name' => 'edit', 'class' => 'btn btn-secondary', 'icon' => 'fas fa-edit', 'onclick'=>"window.location.href='".$linkProc."'"]);
            echo "</td>";

            echo "</tr>";

            $owner = $process['owner'];

            echo "<tr>";
            echo "<th>";
            echo "Owner";
            echo "</th>";
            echo "<td>";
            echo $owner;
            echo "</td>";
            echo "</tr>";


            $processEntityDBTM = new PluginWebapplicationsProcess_Entity();
            $entities = $processEntityDBTM->find(['plugin_webapplications_processes_id' => $process['id']]);
            $entityDBTM = new PluginWebapplicationsEntity();

            echo "<tr>";
            echo "<th>";
            echo "List Entities";
            echo "</th>";
            echo "</tr>";

            echo "<tr>";
            echo "<td></td>";
            echo "<td>";
            if (!empty($entities)) {

                echo "<select name='entities' id='entities' Size='3' ondblclick='location = this.value;'>";
                foreach ($entities as $entity) {
                    $entityDBTM->getFromDB($entity['plugin_webapplications_entities_id']);
                    $name = $entityDBTM->getName();
                    $link = PluginWebapplicationsEntity::getFormURLWithID($entity['plugin_webapplications_entities_id']);
                    echo "<option value=$link>$name</option>";
                }
                echo "</select>";

            } else echo "no associated entity";
            echo "</td>";
            echo "</tr>";


            $applianceItemDBTM = new Appliance_Item();
            $appliances = $applianceItemDBTM->find(['items_id' => $process['id'], 'itemtype' => 'PluginWebapplicationsProcess']);
            $applianceDBTM = new Appliance();

            echo "<tr>";
            echo "<th>";
            echo "List Appliances";
            echo "</th>";
            echo "</tr>";

            echo "<tr>";
            echo "<td></td>";
            echo "<td>";
            if (!empty($appliances)) {

                echo "<select name='appliances' id='appliances' Size='3' ondblclick='location = this.value;'>";
                foreach ($appliances as $appliance) {
                    $applianceDBTM->getFromDB($appliance['appliances_id']);
                    $name = $applianceDBTM->getName();
                    $link = Appliance::getFormURLWithID($appliance['appliances_id']);
                    echo "<option value=$link>$name</option>";
                }
                echo "</select>";

            } else echo "no associated appliance";
            echo "</td>";
            echo "</tr>";


            $disp = $process['webapplicationavailabilities'];
            $int = $process['webapplicationintegrities'];
            $conf = $process['webapplicationconfidentialities'];
            $tra = $process['webapplicationtraceabilities'];


            echo "<tr>";
            echo "<th colspan='4'>";
            echo "DICT";
            echo "</th>";
            echo "</tr>";

            echo "<tr>";
            echo "<td></td>";
            echo "<td>";

            echo "<table style='text-align : center; width: 60%'>";

            echo "<td class='dict'>";
            echo "Availability &nbsp";
            echo "</td>";

            echo "<td name='webapplicationavailabilities' id='5'>";
            echo $disp;
            echo "</td>";

            echo "<td></td>";

            echo "<td class='dict'>";
            echo "Integrity &nbsp";
            echo "</td>";
            echo "<td name='webapplicationintegrities' id='6'>";
            echo $int;
            echo "</td>";

            echo "<td></td>";

            echo "<td class='dict'>";
            echo "Confidentiality &nbsp";
            echo "</td>";
            echo "<td name='webapplicationconfidentialities' id='7'>";
            echo $conf;
            echo "</td>";

            echo "<td></td>";

            echo "<td class='dict'>";
            echo "Tracabeality &nbsp";
            echo "</td>";
            echo "<td name='webapplicationtraceabilities' id='8'>";
            echo $tra;
            echo "</td>";

            echo "</table>";

            echo "</td>";
            echo "</tr>";

            $comment = $process['comment'];

            echo "<tr>";
            echo "<th style='padding-bottom: 20px'>";
            echo "Comment";
            echo "</th>";
            echo "<td>";
            if (!empty($comment)) {
                echo "<table style='border:1px solid white; width:60%'>";
                echo "<td>" . $comment . "</td>";
                echo "</table>";
            }
            echo "</td>";
            echo "</tr>";

            echo "</tbody>";
            echo "</table></div>";
        }

        echo "</div>";


    }

    function defineTabs($options=[]) {
        $ong = [];
        //add main tab for current object
        $this->addDefaultFormTab($ong);
        /*
        $this->addStandardTab('', $ong, $options);// Vue Ecosystème
        $this->addStandardTab('', $ong, $options);//Vue Metier
        $this->addStandardTab('', $ong, $options);//Vue Applications
        $this->addStandardTab('', $ong, $options);//Vue Administration
        $this->addStandardTab('', $ong, $options);//Vue Infra logiques
        $this->addStandardTab('', $ong, $options);//Vue Infra physiques
        */
        return $ong;
    }




}