
<div class="modal-header">
  <button class="close" aria-label="Close" type="button" data-dismiss="modal">
    <span class="font-01 font-w" aria-hidden="true"><i class="fa fa-close"></i></span>
  </button>
  <h2 class="modal-title font-01 font-w"> จัดการ <?php echo $_POST['name'];?></h2>
</div>


<div class="modal-body font-03">
  <div class="example-wrap">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
     <!--  <li class="nav-item active">
        <a class="nav-link active btn-po-tab" id="test-tab" data-toggle="tab" role="tab" href="javascript:void(0)" aria-controls="test" aria-selected="true">ตำแหน่ง</a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link btn-le-tab" id="profile-tab" data-toggle="tab" role="tab" href="javascript:void(0)" aria-controls="profile" aria-selected="false">ระดับ</a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link btn-br-tab" id="contact-tab" data-toggle="tab" role="tab" href="javascript:void(0)" aria-controls="contact" aria-selected="false">สาขา</a>
      </li> -->
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane active" id="test" role="tabpanel" aria-labelledby="test-tab">
          <div class="load-rela-tab"></div>
      </div>
      <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> -->
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabrelale"); ?>",
            data: {
                ide : "<?php echo $_POST['ide']?>",
                'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
                $('.load-rela-tab').empty();
                $('.load-rela-tab').html(data);
            },
            error: function (data){
                console.log(data);
            }
        }); 
      //btn-po-tab
      $('.btn-po-tab').click(function(event) {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabrelapo"); ?>",
            data: {
                ide : "<?php echo $_POST['ide']?>",
                'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
                $('.load-rela-tab').empty();
                $('.load-rela-tab').html(data);
            },
            error: function (data){
                console.log(data);
            }
        }); 
      });

      //btn-le-tab
      $('.btn-le-tab').click(function(event) {
        // alert('1');
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabrelale"); ?>",
            data: {
                ide : "<?php echo $_POST['ide']?>",
                'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
                $('.load-rela-tab').empty();
                $('.load-rela-tab').html(data);
            },
            error: function (data){
                console.log(data);
            }
        }); 
      });

      //btn-br-tab
      $('.btn-br-tab').click(function(event) {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createAbsoluteUrl("admin/tabrelabr"); ?>",
            data: {
                ide : "<?php echo $_POST['ide']?>",
                'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
            },
      
            success: function (data) {
                $('.load-rela-tab').empty();
                $('.load-rela-tab').html(data);
            },
            error: function (data){
                console.log(data);
            }
        }); 
      });
      
  });
</script>