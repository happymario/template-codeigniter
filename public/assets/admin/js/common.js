/**
 * Created by Star_Man on 2019-09-11.
 */

jQuery(function () {
    jQuery(document).on("click", "form.ajax button:submit, form.ajax input:submit, form.ajax input:image", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var f = this.form;
        var $f = jQuery(f);
        var $b = jQuery(this);
        var $t, t;
        var result = true;
        $f.find("input, select, textarea").each(function (i) {
            $t = jQuery(this);
            if ($t.prop("required")) {
                if (!jQuery.trim($t.val())) {
                    t = jQuery("label[for='" + $t.attr("id") + "']").text();
                    result = false;
                    $t.focus();
                    alert(t + " 필수 입력입니다.");
                    return false;
                }
            }
        });
        if (!result)
            return false;
    });
});


// $(document).ajaxStart(function () {
//     showLoading();
// });
//
// $(document).ajaxComplete(function () {
//     hideLoading();
// });

$(function () {
    $('input[numberonly]').on('input', function (e) {
        $(this).val($(this).val().replace(new RegExp('[^0-9]', 'g'), ''));
    });

    $('input[maxlength!=""]').on('input', function () {
        var maxlength = $(this).attr('maxlength');
        if ($(this).val().length > maxlength) {
            $(this).val().slice(0, maxlength - 1);
        }
    });
});

if (!String.prototype.startsWith) {
    String.prototype.startsWith = function(search, pos) {
        return this.substr(!pos || pos < 0 ? 0 : +pos, search.length) === search;
    };
}

function showSweetAlert(message, button_type) {
    var sa_message = message;

    swal.fire({
        text: sa_message,
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "확인",
        customClass: {
            confirmButton: button_type
        }
    }).then(function() {
        KTUtil.scrollTop();
    });
}

function showSweetConfirm(message, button_type, callback) {
    var sa_message = message;

    swal({
            title: '',
            text: sa_message,
            type: '',
            confirmButtonClass: button_type,
            confirmButtonText: "확인",
            showCancelButton: true,
            cancelButtonText: "취소",
        },
        callback);
}

function showNotification(no_title, message, type) {

    var shortCutFunction = type;
    var msg = message;
    var title = no_title || '';

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
}

function select_reverse(frm, need, v1) {
    var i;
    for (i = 0; i < frm.elements.length; i++) {
        if (!frm.elements[i].name.indexOf(need)) {
            if (v1 == true || v1 == false) {
                frm.elements[i].checked = v1;
            } else {
                frm.elements[i].checked = !frm.elements[i].checked;
            }
        }
    }
}

function checked_count(frm, need, v1) {
    var i;
    var cnt = 0;
    for (i = 0; i < frm.elements.length; i++) {
        if (!frm.elements[i].name.indexOf(need)) {
            if (v1 == true) {
                if (frm.elements[i].checked) {
                    cnt = cnt + 1;
                }
            } else if (v1 == false) {
                if (!frm.elements[i].checked) {
                    cnt = cnt + 1;
                }
            }
        }
    }
    return cnt;
}

function check_required(element, message, force_force) {
    force_force = typeof force_force !== 'undefined' ? force_force : true;
    if (element.val() == '') {
        showNotification("오류", message, "warning");
        if (force_force) {
            element.focus();
        }
        return false;
    }
    return true;
}

function showLoading() {
    KTApp.block('#total_body', {
        overlayColor: 'red',
        opacity: 0.1,
        state: 'primary' // a bootstrap color
    });
}

function hideLoading() {
    KTApp.unblock('#total_body');
}


function nl2br(str){
    return str.replace(/\n/g, "<br />");
}

function goBack() {
    history.back();
    window.close();
}

function readURL(css_identifier, input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(css_identifier).attr("src", e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validatePhone (phone) {
    //var regPhone = /(01[0|1|6|9|7])(\d{3}|\d{4})(\d{4}$)/g;
    //return regPhone.test(phone);
    return phone.length < 11 || phone.length > 13 ? false : true;
}

function validURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
        '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
    return !!pattern.test(str);
}

function formatMoney (n, c, d, t) {
    var c = isNaN((c = Math.abs(c))) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt((n = Math.abs(Number(n) || 0).toFixed(c)))),
        j = (j = i.length) > 3 ? j % 3 : 0;

    return (
        s +
        (j ? i.substr(0, j) + t : "") +
        i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) +
        (c
            ? d +
            Math.abs(n - i)
                .toFixed(c)
                .slice(2)
            : "")
    );
}

function digitTime (i) {
    var x = parseInt(i);
    if (x < 10) {
        x = "0" + x;
    }
    return x;
}

function empty(data) {
    if(data == null || typeof data == undefined || data == "") {
        return true;
    }

    return false;
}