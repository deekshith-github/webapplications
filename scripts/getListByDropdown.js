var applianceDrop = document.getElementsByName('applianceDropdown');

applianceDrop.forEach(
    function (node) {
        node.onchange = changeList;
    }
);


function changeList(e){
    var appId = e.target.value;
    var panel = $('#tabspanel').find('a*[class*=active]')[0].title;

    jQuery.ajax({
        type: "POST",
        url: "../ajax/getLists.php",
        data: {
            'panel'     : panel,
            'applianceId': appId,
        },
        success: function (response, opts) {
            var item_bloc = $('[name="lists-'+panel+'"]');
            item_bloc.html(response);
        }
    });

}