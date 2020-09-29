<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">

        <div class="col-md-12" style="margin-top: 10px;">
            <label style="width: 100%;font-size:18px;color: black;font-weight: 700">오유Code표</label>

            <table class="table table-hover table-bordered">
                <tbody>
                <tr>
                    <th style="text-align: center" class="bg bg-warning" width="120">오유Code</th>
                    <th style="text-align: center" class="bg bg-warning" width="100">Type</th>
                    <th style="text-align: center" class="bg bg-warning">설명</th>
                    <th style="text-align: center" class="bg bg-warning">비고</th>
                </tr>
                <tr>
                    <td>0</td>
                    <td>Integer</td>
                    <td>성공일때</td>
                    <td></td>
                </tr>
                <tr>
                    <td>101</td>
                    <td>Integer</td>
                    <td>체계오유</td>
                    <td></td>
                </tr>
                <tr>
                    <td>102</td>
                    <td>Integer</td>
                    <td>db련동오유</td>
                    <td></td>
                </tr>
                <tr>
                    <td>103</td>
                    <td>Integer</td>
                    <td>권한오유</td>
                    <td>잘못된 api 호출일때...</td>
                </tr>
                <tr>
                    <td>104</td>
                    <td>Integer</td>
                    <td>Parameter오유</td>
                    <td>reason 마당 참고</td>
                </tr>
                <tr>
                    <td>105</td>
                    <td>Integer</td>
                    <td>Fileupload오유</td>
                    <td></td>
                </tr>
                <tr>
                    <td>106</td>
                    <td>Integer</td>
                    <td>Access Token 오유</td>
                    <td></td>
                </tr>
                <tr>
                    <td>201</td>
                    <td>Integer</td>
                    <td>Login 오유</td>
                    <td>email Login인 경우 userID 오유</td>
                </tr>
                <tr>
                    <td>211</td>
                    <td>Integer</td>
                    <td>Password 틀림오유</td>
                    <td></td>
                </tr>
                <tr>
                    <td>202</td>
                    <td>Integer</td>
                    <td>회원정보존재안함</td>
                    <td></td>
                </tr>
                <tr>
                    <td>203</td>
                    <td>Integer</td>
                    <td>Email증복오유</td>
                    <td></td>
                </tr>
                <tr>
                    <td>204</td>
                    <td>Integer</td>
                    <td>회원정보존재안함</td>
                    <td></td>
                </tr>
                <tr>
                    <td>205</td>
                    <td>Integer</td>
                    <td>일시정지 회원</td>
                    <td></td>
                </tr>
                <tr>
                    <td>206</td>
                    <td>Integer</td>
                    <td>이름증복오유</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#left_menu_apimanage_parent').addClass("active");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(1)").addClass("selected");
        $('#left_menu_apimanage_parent').children("a:eq(0)").children("span:eq(2)").addClass("open");
        $('#left_menu_apimanage_parent').children("ul:eq(0)").children("li:eq(2)").addClass("open");
        $('#page_title').html("오유코드표");
    });
</script>