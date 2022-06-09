<?php

include("../../../inc/includes.php");
header("Content-Type: text/html; charset=UTF-8");
Html::header_nocache();

Session::checkLoginUser();

switch ($_POST['action']) {
    case 'showListProcesses':
        PluginWebapplicationsDashboard::showListProcesses($_POST['applianceId']);
        break;
}
