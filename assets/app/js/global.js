function remove_confirm(onOk, onCancel) {
    var $popup = $('<div class="mimi-popup-bg delete-confirm" style="display: none">\n' +
        '        <div class="mimi-popup mimi-popup-medium orange" style="width: 40%">\n' +
        '            <div class="header">\n' +
        '                <span><i class="fa fa-warning"></i> 정말 삭제하시겠습니까?</span>\n' +
        '                <button class="close-btn"></button>\n' +
        '            </div>\n' +
        '            <div class="popup-body" style="padding-bottom: 10px">\n' +
        '                <div class="mimi-row text-right">\n' +
        '                    <a class="btn-ok" style="margin-right: 5px">확인</a>\n' +
        '                    <a class="btn-cancel">취소</a>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>');

    $('body').append($popup);
    $popup.fadeIn();

    $popup.css('z-index', 1200);
    $popup.find('.header > span')
        .css('font-size', '20px')
        .css('font-family', 'NotoSansCJKkr-DemiLight');

    /* X 단추 또는 취소 단추를 누를때 */
    $popup.find('button.close-btn, a.btn-cancel').on('click', function () {
        $popup.fadeOut(300, function () {
            $(this).remove();
        });
        if (onCancel != undefined)
            onCancel();
    });

    $popup.find('a.btn-ok').on('click', function () {
        $popup.fadeOut(300, function () {
            $(this).remove();
        });
        if (onOk != undefined)
            onOk();
    });
}

function mobile_remove_confirm(onOk, onCancel) {
    var $popup = $('<div class="mimi-popup-bg delete-confirm" style="display: none">\n' +
        '        <div class="mimi-popup mimi-popup-medium orange">\n' +
        '            <div class="header">\n' +
        '                <span><i class="fa fa-warning"></i> 정말 삭제하시겠습니까?</span>\n' +
        '                <a class="close-btn"></a>\n' +
        '            </div>\n' +
        '            <div class="popup-body" style="padding-bottom: 10px">\n' +
        '                <div class="text-right" style="margin-bottom: 10px">\n' +
        '                    <a class="btn-ok btn-black" style="margin-right: 5px">확인</a>\n' +
        '                    <a class="btn-cancel">취소</a>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>');

    $('body').append($popup);
    $popup.fadeIn();

    $popup.css('z-index', 1200);
    $popup.find('.header > span')
        .css('font-size', '16.87px')
        .css('font-family', 'NotoSansCJKkr-DemiLight');

    /* X 단추 또는 취소 단추를 누를때 */
    $popup.find('a.close-btn, a.btn-cancel').on('click', function () {
        $popup.fadeOut(300, function () {
            $(this).remove();
        });
        if (onCancel != undefined)
            onCancel();
    });

    $popup.find('a.btn-ok').on('click', function () {
        $popup.fadeOut(300, function () {
            $(this).remove();
        });
        if (onOk != undefined)
            onOk();
    });
}

function mobile_modal_confirm(onOk, onCancel, title, content) {
    title = typeof title !== 'undefined' ? title : '탈퇴하시겠습니까?';
    content = typeof content !== 'undefined' ? content : '탈퇴후 모든 입찰 판매정보는 삭제됩니다.';
    var $popup = $('<div class="mimi-popup-bg delete-confirm" style="display: none">\n' +
        '        <div class="mimi-popup mimi-popup-medium orange">\n' +
        '            <div class="header">\n' +
        '                <span><i class="fa fa-warning"></i> '+ title + '</span>\n' +
        '                <a class="close-btn"></a>\n' +
        '            </div>\n' +
        '            <div class="popup-body" style="padding-bottom: 10px">\n' +
        '               <div class="mimi-row text-left margin-top-0">\n' +
        '                   <p class="modal-info-content">' + content + '</p>\n' +
        '                </div>\n' +
        // '                <hr>\n' +
        '                <div class="text-right" style="margin-bottom: 10px;margin-top: 15px">\n' +
        '                    <a class="btn-ok btn-black" style="margin-right: 5px">확인</a>\n' +
        '                    <a class="btn-cancel">취소</a>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>');

    $('body').append($popup);
    $popup.fadeIn();

    $popup.css('z-index', 1200);
    $popup.find('.header > span')
        .css('font-size', '16.87px')
        .css('font-family', 'NotoSansCJKkr-DemiLight');

    /* X 단추 또는 취소 단추를 누를때 */
    $popup.find('a.close-btn, a.btn-cancel').on('click', function () {
        $popup.fadeOut(300, function () {
            $(this).remove();
        });
        if (onCancel != undefined)
            onCancel();
    });

    $popup.find('a.btn-ok').on('click', function () {
        $popup.fadeOut(300, function () {
            $(this).remove();
        });
        if (onOk != undefined)
            onOk();
    });
}

function modal_confirm(onOk, onCancel, title, content) {
    title = typeof title !== 'undefined' ? title : '탈퇴하시겠습니까?';
    content = typeof content !== 'undefined' ? content : '탈퇴후 모든 입찰 판매정보는 삭제됩니다.';
    var $popup = $('<div class="mimi-popup-bg delete-confirm" style="display: none">\n' +
        '        <div class="mimi-popup mimi-popup-medium orange" style="width: 40%">\n' +
        '            <div class="header">\n' +
        '                <span><i class="fa fa-warning"></i> ' + title + '</span>\n' +
        '                <button class="close-btn"></button>\n' +
        '            </div>\n' +
        '            <div class="popup-body" style="padding-bottom: 10px">\n' +
        '                <div class="mimi-row text-left">\n' +
        '                   <p>' + content + '</p>\n' +
        '                </div>\n' +
        '                <hr>\n' +
        '                <div class="mimi-row text-right">\n' +
        '                    <a class="btn-ok" style="margin-right: 5px">확인</a>\n' +
        '                    <a class="btn-cancel">취소</a>\n' +
        '                </div>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>');

    $('body').append($popup);
    $popup.fadeIn();

    $popup.css('z-index', 1200);
    $popup.find('.header > span')
        .css('font-size', '20px')
        .css('font-family', 'NotoSansCJKkr-DemiLight');

    /* X 단추 또는 취소 단추를 누를때 */
    $popup.find('button.close-btn, a.btn-cancel').on('click', function () {
        $popup.fadeOut(300, function () {
            $(this).remove();
        });
        if (onCancel != undefined)
            onCancel();
    });

    $popup.find('a.btn-ok').on('click', function () {
        $popup.fadeOut(300, function () {
            $(this).remove();
        });
        if (onOk != undefined)
            onOk();
    });
}

/*
        * 쿠키에 데이터를 저장하는 함수
        * */
function createCookie(name, value, hours) {
    if (hours) {
        var date = new Date();
        date.setTime(date.getTime() + (hours * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}


/*
* 쿠키에서 데이터값을 얻는 함수
* */
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

/*
* 쿠키에서 데이터를 삭제하는 함수
* */
function eraseCookie(name) {
    createCookie(name, "", -1);
}

/**
 * 정규표현식 수값만검사하는 함수
 * */

function checkNumber(str) {
    var reg_number = /^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/;

    if (!reg_number.test(str)) {

        return false;

    }
    return true;
}

/**
 * 수값형식 함수
 * */
function num_format(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function isAndroidWebview() {
    return (navigator.userAgent.indexOf("outofstock_android")) > 0;
}

function isIOSWebview() {
    return (navigator.userAgent.indexOf("outofstock_ios")) > 0;
}