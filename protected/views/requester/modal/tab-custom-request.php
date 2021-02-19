<div id="mod-rol"> <?php
	$masterdata = MasGroleMod::search($rol);
	foreach ($masterdata as $dataitem1) {
		$datam2 = MasRequest::getdatamod($req_code,$dataitem1["mod_id"]);
		$i2 = 0;
		$ck2 = "";
		$oconrol_id = "";
		foreach($datam2 as $odata2) { $oconrol_id = $odata2["ra_id"]; } ?>
		<div class="form-group row" style="background-color: white; margin-bottom:10px;width:100%; border:.5px solid #ddd; padding-bottom:10px">
			<label class="col-sm-3 form-control-label text-left font-w"><?php echo $dataitem1["ma_name"]; ?></label>
			<div class="col-sm-9" style="padding-top: 10px;">
				<select class="form-control form-control-lg font-03 custom-select sel-lev" id="rol<?php echo $dataitem1["mod_id"]; ?>" data-id="<?php echo $dataitem1["mod_id"]; ?>" data-mod="<?php echo $dataitem1["mod_id"]; ?>"> <?php
					$datarole = MasGroleModLev::search($dataitem1["id"]);
					foreach ($datarole as $dataitem2) {
						if($dataitem2["status"] == 1){ $ck2 = "selected"; }else{ $ck2 = ""; }
						if($req_code!=""){ if($dataitem2["rol_id"] == $oconrol_id){ $ck2 = "selected"; }else{ $ck2 = ""; } } ?>
						<option value="<?php echo $dataitem2["id"]; ?>" data-ra_id="<?php echo $dataitem2["rol_id"]; ?>" <?php echo $ck2; ?>><?php echo $dataitem2["ra_name"]; ?></option> <?php
					} ?>
				</select>
			</div>
		</div> <?php
	} ?>
</div>