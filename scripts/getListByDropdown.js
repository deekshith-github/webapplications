var applianceDrop = document.getElementsByName('applianceDropdown')[0];

applianceDrop.onchange = changeList;

function changeList(e){
    var appId = e.target.value;

    jQuery.ajax({
        type: "POST",
        url: "../ajax/listProcesses.php",
        data: {
            'action'     : 'showListProcesses',
            'applianceId': appId
        },
        success: function (response, opts) {
            var item_bloc = $('[name="listProc"]');
            item_bloc.html(response);
        }
    });

}