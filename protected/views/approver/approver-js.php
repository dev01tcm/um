<script type="text/javascript">
$(document).ready(function() {


    $.ajax({
        type: "POST",
        url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadrequesttap"); ?>",
        data: {
            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
        },
  
        success: function (data) {
            $('.load-request-tab').empty();
            $('.load-request-tab').html(data);


        },
        error: function (data){
            console.log(data);
        }
    }); 

    //######################--------------Click BTN btn-request
    $('.btn-request').click(function(){
        $('.btn-nav-f').removeClass('active');
        $(this).addClass('active');

        //############------------ LOAD MODAL PAGE EDIT --> Controller = setting / fn = loadrequesttap

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadrequesttap"); ?>",
            data: {
              'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
                $('.load-request-tab').empty();
                $('.load-request-tab').html(data);
            },
            error: function (data){
                console.log(data);
            }
        });
    });


    //btn-tran
     //######################--------------Click BTN btn-tran
    $('.btn-tran').click(function(){
        $('.btn-nav-f').removeClass('active');
        $(this).addClass('active');

        //############------------ LOAD MODAL PAGE EDIT --> Controller = setting / fn = loadtrantap

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadtrantap"); ?>",
            data: {
              'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
                $('.load-tran-tab').empty();
                $('.load-tran-tab').html(data);
            },
            error: function (data){
                console.log(data);
            }
        });
    });

     //######################--------------Click BTN btn-emp
    $('.btn-emp').click(function(){
        $('.btn-nav-f').removeClass('active');
        $(this).addClass('active');

        var lload = '<div id="load" style="text-align:center"><img style="width:450px; height:250px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading3.gif"></div>';
        $('.load-emp-tab').html(lload);

        //############------------ LOAD MODAL PAGE EDIT --> Controller = setting / fn = loademptap

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loademptap"); ?>",
            data: {
              'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
                $('.load-emp-tab').empty();
                $('.load-emp-tab').html(data);
            },
            error: function (data){
                console.log(data);
            }
        });
    });


});
</script>