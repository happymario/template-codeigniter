<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <div class="col-md-12" style="margin-top: 10px;">
            <label style="width: 100%;font-size:18px;color: black;font-weight: 700">오유Code표</label>
            <pre>define('API_RESULT_SUCCESS', 0);    //성공
define('API_RESULT_ERROR_SYSTEM', 101);  //체계 오유
define('API_RESULT_ERROR_DB', 102);    //DB 오유
define('API_RESULT_ERROR_PRIVILEGE', 103);    //권한 오유
define('API_RESULT_ERROR_PARAM', 104);    //파라메터 오유
define('API_RESULT_ERROR_UPLOAD', 105);   //파일upload 오유
define('API_RESULT_ERROR_ACCESS_TOKEN', 106);   //접근Token 오유
define('API_RESULT_ERROR_CERT_KEY', 107);   //인증번호 오유
define('API_RESULT_ERROR_LOGIN_FAILED', 201); //Login 오유
define('API_RESULT_ERROR_LOGIN_PASSWORD', 211); //비밀번호 오유
define('API_RESULT_ERROR_USER_NO_EXIST', 202); //회원정보없음 오유
define('API_RESULT_ERROR_EMAIL_DUPLICATE', 203);    //Email중복 오유
define('API_RESULT_ERROR_EMAIL_NO_EXIST', 204); //Email없음 오유
define('API_RESULT_ERROR_USER_PAUSED', 205); //정지회원 오유
define('API_RESULT_ERROR_NICKNAME_DUPLICATE', 206);    //이름중복 오유
define('API_RESULT_ERROR_NICKNAME_LENGTH', 207);    //이름길이 오유
define('API_RESULT_ERROR_EMAIL_VERIFIED', 208);    //Email인증 오유
define('API_RESULT_ERROR_PURCHASE', 209);    //결제 오유</pre>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#left_menu_apimanage_parent').addClass("active");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(1)").addClass("selected");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(2)").addClass("open");
        $('#left_menu_apimanage_parent').children("ul:eq(0)").children("li:eq(2)").addClass("open");
        $('#page_title').html("<?=t('menu_api_code')?>");
    });
</script>