<?php

include("../../../inc/includes.php");
header("Content-Type: text/html; charset=UTF-8");
Html::header_nocache();

Session::checkLoginUser();

switch ($_POST['panel']) {
    case 'Ecosystem':
        PluginWebapplicationsDashboardEcosystem::showLists($_POST['applianceId']);
        break;
    case 'Process':
        PluginWebapplicationsDashboardProcess::showLists($_POST['applianceId']);
        break;
    case 'Application':
        PluginWebapplicationsDashboardApplication::showLists($_POST['applianceId']);
        break;
}
