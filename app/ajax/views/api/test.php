<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<?php echo '{"message":"","code":1000,"result":{"items":[{"id":1,"name":"\u8001\u53f8\u673a","carInfo":{"number":"\u5dddA32131","type":"\u5927\u5954","inner":"2*3*3","outer":"2*3*4"},"goodsInfo":[{"name":"\u5927\u8c46","num":4},{"name":"\u7389\u7c73","num":3}]}]}}';?>
<script>
    //var api_url ='<?php echo \yii\helpers\Url::to(['/ajax/api']);?>';
    var api_url ='http://test.xiuzhimeng.com/huoyun/ajax/api';

    var items=[

        {'order_id':5,delivery_time:'16:22',distance:2,interval:3}
//        {'order_id':6,delivery_time:'16:12',distance:12,interval:5}
    ];


//    $.ajax({
//        type: "post",
//        url:api_url+'/add-deliver',
//        dataType: "json",
//        data:{platform_id:1,act:'edit',id:4,driver_id:1,distance:2,interval:3,items:items},
//        success: function (data) {
//
//            console.log(data)
//        }
//    });

    $.ajax({
        type: "post",
        url:api_url+'/deliver-info',
        dataType: "json",
        data:{platform_id:1,id:6,},
        success: function (data) {

            console.log(data)
        }
    });
</script>