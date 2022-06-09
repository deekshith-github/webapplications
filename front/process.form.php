<?php
/*
 * @version $Id: HEADER 15930 2011-10-30 15:47:55Z tsmr $
 -------------------------------------------------------------------------
 Releases plugin for GLPI
 Copyright (C) 2018 by the Releases Development Team.

 https://github.com/InfotelGLPI/Releases
 -------------------------------------------------------------------------

 LICENSE

 This file is part of Releases.

 Releases is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 releases is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with releases. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

include('../../../inc/includes.php');


Session::checkLoginUser();

use Glpi\Event;

if (!isset($_GET["id"])) {
    $_GET["id"] = "";
}
if (!isset($_GET["withtemplate"])) {
    $_GET["withtemplate"] = "";
}


$process = new PluginWebapplicationsProcess();

if (isset($_POST["add"])) {

    $process->check(-1, CREATE, $_POST);
    $newID = $process->add($_POST);
    if ($_SESSION['glpibackcreated']) {
        Html::redirect($process->getFormURL() . "?id=" . $newID);
    }
    Html::back();


} else if (isset($_POST["delete"])) {

    $process->check($_POST['id'], DELETE);
    $process->delete($_POST);
    $process->redirectToList();

} else if (isset($_POST["restore"])) {

    $process->check($_POST['id'], PURGE);
    $process->restore($_POST);
    $process->redirectToList();

} else if (isset($_POST["purge"])) {
    $process->check($_POST['id'], PURGE);
    $process->delete($_POST, 1);
    $process->redirectToList();

} else if (isset($_POST["update"])) {

    $process->check($_POST['id'], UPDATE);
    $process->update($_POST);
    Html::back();

}
else {

    if (Session::getCurrentInterface() == "central") {

        Html::header(PluginWebapplicationsProcess::getTypeName(2), $_SERVER['PHP_SELF'], "management", "pluginwebapplicationsprocess", "config");
        $process->display(['id' => $_GET["id"]]);
    }

}

if (Session::getCurrentInterface() == "central") {
    Html::footer();
} else {
    Html::helpFooter();
}
