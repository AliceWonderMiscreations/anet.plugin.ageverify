/*jslint browser: true, plusplus: true, regexp: true */

function clickAgeVerify() {
    "use strict";
    var ajaxpath, csrf, postdata;
    ajaxpath = $('#content').attr('data-ajax');
    csrf = $('#content').attr('data-csrf');
    postdata = { csrf: csrf };
    $.ajax({
        type: 'POST',
        url: ajaxpath + 'splashscreen.php',
        data: postdata,
        dataType: 'text',
        success: function () {
            $('#splashscreen').hide("slow");
        }
    });
}

function clickAgeVerifyKeydown(evt) {
    "use strict";
    var emclick;
    switch (evt.which) {
    case 13:
        emclick = true;
        break;
    case 32:
        emclick = true;
        break;
    default:
        emclick = false;
    }
    if (emclick) {
        clickAgeVerify();
    }
}

$(document).ready(function () {
    "use strict";
    $('#AgeVerifyEnter').bind('click', function () {clickAgeVerify(); });
    $('#AgeVerifyEnter').bind('keydown', function (evt) {clickAgeVerifyKeydown(evt); });
});