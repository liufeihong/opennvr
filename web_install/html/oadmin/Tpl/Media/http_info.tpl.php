<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gb28181配置</title>
    {:W('jQuery')}
    {:W('Dialog')}
    {:W('Bootstrap')}
    <link rel="stylesheet" href="__STATIC__/css/ly.css">
    <script>
        $(function () {
            $("#Formelement").submit(function () {

                var _this = this;
                dialog.loading.show();
                $.when($.post("__URL__/http_post", $(_this).serialize()))
                    .always(function () {
                        dialog.loading.hide();
                    })
                    .done(function (response) {
						//alert(response);
                        dialog.tips(response.status,response.info,function () {
                            if (response.status == 'success') {
                                window.location.href = "__URL__/http";
                            }
                        });
                    });

                return false;
            });

            
        });


    </script>
</head>
<body style="padding: 30px " >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">HTTP网络</div>
        <div class="panel-body">
            <div class="gb28181-container">

                    <div class="field-lists" style="margin-bottom: 40px">
                        <form id="Formelement">
                            <div class="input-group form-inline">
                                <span class="input-group-addon">Enable</span>
                                <select name="enable" id="enable" class="form-control">
                                    <option value="1" {:$info['enable']==1?'selected':''}>是</option>
                                    <option value="0" {:$info['enable']=="0"?'selected':''}>否</option>
                                </select>
                            </div>
                            <div class="input-group form-inline">
                                <span class="input-group-addon">IPV4 绑定地址</span>
                                <select name="bind_addr" id="bind_addr" class="form-control">
                                    <volist name="ipv4" id="vo">
                                        <option value="{$vo.addr}" {:$info['bind_addr']==$vo['addr']?"selected":""}>{$vo.name}({$vo.addr})</option>
                                    </volist>
                                </select>
                            </div>
                            <div class="input-group form-inline">
                                <span class="input-group-addon">IPV6 绑定地址</span>
                                <select name="bind_addr6" id="bind_addr6" class="form-control">
                                    <volist name="ipv6" id="vo">
                                        <option value="{$vo.addr}" {:$info['bind_addr6']==$vo['addr']?"selected":""}>{$vo.name}({$vo.addr})</option>
                                    </volist>
                                </select>
                            </div>
                            <div class="input-group form-inline">
                                <span class="input-group-addon">端口号</span>
                                <input type="number" name="port" class="form-control readonly-field" value="{:$info['port']?$info['port']:5060}" max="65535"/>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-lg btn-success">{:$info?"更新":"新增"}配置</button>
                                <input type="hidden" name="id" value="{$info.id}">

                            </div>
                        </form>
                    </div>
            </div>
        </div>


    </div>

</body>
</html>