<div  class="col-sm-12 col-xs-12 contact-info-box">
  <div class="sidebar sidebar-left">
    <div class="widget recent-posts">
    <h3 class="widget-title">ค้นหา</h3>
  </div>
</div>
<div class="row">
  <div class="col-sm-4 col-xs-12">
      <div class="form-group">
          <label class="txtlabel">ประเภทการค้นหา </label>  
          <select class="form-control typesearch" id="typesearch">
            <option value="">เลือกการค้นหา</option>
            <option value="2">เลขบัตร</option>  
              <!-- <option value="3">ชื่อ-นามสกุล</option>                   -->
          </select>
      </div>
  </div>
  <div class="col-sm-4 col-xs-12 show-numid" style="display:none;">
      <div class="form-group">
          <label class="txtlabel">เลขบัตรประจำตัวประชาชน </label>  
          <input type="text" name="numberid" class="form-control numberid" id="numberid" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="13" />
      </div>
  </div>
  <div class="col-sm-4 col-xs-12 show-name" style="display:none;">
      <div class="form-group">
          <label class="txtlabel">ชื่อ นามสกุล </label>  
          <input type="text" name="nameid" class="form-control nameid" id="nameid" />
      </div>
  </div>
  <div class="col-sm-2 col-xs-12 show-sbtn" style="padding: 25px 20px;display:none;">
      <div class="form-group">
          <button class="btn btn-info btn-md btn-fill-search">
              <i class="fa fa-search"></i> ค้นหา
          </button>
      </div>
  </div>
</div>
<div class="load-table-tran"></div>

</div>
	
</div>

<script type="text/javascript">
$(document).ready(function() {

  $('.typesearch').change(function() {
    var label_val = $( this ).val();
    if(label_val=='1'){
        //show-depart
        $( ".show-depart" ).show();
        $( ".show-sbtn" ).show();
        $( ".show-numid" ).hide();
        $( ".show-name" ).hide();
        $( ".numberid" ).val('');
        $( ".nameid" ).val('');

    }else if(label_val=='2'){
        $( ".show-numid" ).show();
        $( ".show-sbtn" ).show();
        $( ".show-depart" ).hide();
        $( ".show-name" ).hide();
        $( ".nameid" ).val('');
        $( ".drpdep" ).val('all');
    }else if(label_val=='3'){
        $( ".show-name" ).show();
        $( ".show-sbtn" ).show();
        $( ".show-depart" ).hide();
        $( ".show-numid" ).hide();
        $( ".drpdep" ).val('all');
        $( ".numberid" ).val('');
    }else{
        $( ".show-depart" ).hide();
        $( ".show-sbtn" ).hide();
        $( ".show-numid" ).hide();
        $( ".show-name" ).hide();

        $( ".drpdep" ).val('all');
        $( ".numberid" ).val('');
        $( ".nameid" ).val('');
    }
  });

  $('.btn-fill-search').click(function(){

      var lload = '<div id="load" style="text-align:center"><img style="width:450px; height:250px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/loading3.gif"></div>';
      $('.load-table-tran').html(lload);

        var typesearch = $( ".typesearch" ).val();
        if(typesearch=='1'){
            var depart_id = $( ".drpdep" ).val();
        }else if(typesearch=='2'){
            var depart_id = $( ".numberid" ).val();
        }else if(typesearch=='3'){
            var depart_id = $( ".nameid" ).val(); 
        }else{
            var depart_id = 'my';
        }
     
      //############------------ LOAD Table EMP --> Controller = setting / fn = loadtabletran

      $.ajax({
          type: "POST",
          url: "<?php echo Yii::app()->createAbsoluteUrl("approver/loadtabletran"); ?>",
          data: {
            depart : depart_id,
            typesearch : typesearch,
            'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'
          },

          success: function (data) {
            $( ".load-table-tran" ).empty();
            $('.load-table-tran').html(data);
          },
          error: function (data){
              console.log(data);
          }
      });

  });

  

});
</script>