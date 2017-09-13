<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <style type="text/css">
        body,html,#container{
            height: 100%;
            margin: 0px;
            font-size: 12px;
        }
        .panel {
            color: #333;
            padding: 6px;
            border: 1px solid silver;
            box-shadow: 3px 4px 3px 0px silver;
            position: absolute;
            background-color: #eee;
            top: 10px;
            right: 10px;
            border-radius: 5px;
            overflow: hidden;
            line-height: 20px;
        }
        #input{
            width: 250px;
            height: 25px;
        }
    </style>
    <title>地理编码</title>

</head>
<body>
<div id="container" tabindex="0"></div>
<div class ='panel'>
    输入地址显示位置:</br>
    <input id = 'input' value = '四川省成都市高新区天府大道天府二街138号'/>
    <div id = 'message'></div>
</div>
<script type="text/javascript" src="https://webapi.amap.com/maps?v=1.3&key=5b605ef068fbd7b2ecdf645a5200b0c0"></script>
<script type="text/javascript">

    var map = new AMap.Map('container',{
        resizeEnable: true,
        zoom: 13,
        center: [104.06,30.67]
    });
    AMap.plugin('AMap.Geocoder',function(){
        var geocoder = new AMap.Geocoder({

        });
        var marker = new AMap.Marker({
            map:map,
            bubble:true
        })
        var input = document.getElementById('input');
        input.onchange = function(e){
            var address = input.value;
            geocoder.getLocation(address,function(status,result){

                console.log(result)
                if(status=='complete'&&result.geocodes.length){
                    console.log(result.geocodes[0].location)
                    marker.setPosition(result.geocodes[0].location);
                    map.setCenter(marker.getPosition())
                    document.getElementById('message').innerHTML = ''
                }else{
                    document.getElementById('message').innerHTML = '获取位置失败'
                }
            })
        }
        input.onchange();

    });
</script>
<script type="text/javascript" src="https://webapi.amap.com/demos/js/liteToolbar.js"></script>

</body>
</html>