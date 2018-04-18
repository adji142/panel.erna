<div class="select-box">
	<center><label><h3>Pencarian detail</h3></label></center><br>
	<form method="post" action="<?php echo base_url('front/post/filter_by')?>">
			<div class="search-product ads-list">

					<label>Pilih lokasi</label>
					<div class="search">
						<div id="custom-search-input">
						<div class="input-group">
							<input type="text" class="form-control input-lg" placeholder="" id="pac-input" name="loc" />
								<script type="text/javascript">
  function initAutocomplete() {
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
     map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7WL5r3aYw4WtwPUwQ7ybUvTxUgcWvQ2c&libraries=places&callback=initAutocomplete"
         async defer></script>
						</div>
					</div>
					</div>
				</div>
				<div class="browse-category ads-list">
					<label>Pilih kategori</label>
					<select class="selectpicker show-tick" data-live-search="true" name="cat">
					  <!-- <option data-tokens="" >All</option> -->
					  <?php
					  	$fillter = $this->m_post->get_filter_cat()->result();
					  	foreach ($fillter as $fill) {
					  		echo '<option data-tokens="'.$fill->parent.'" value = "'.$fill->parent.'">'.$fill->storetype.'</option>';
					  	}
					  ?>
					</select>
				</div>
				<div class="search-product ads-list">
					<label>Cari</label>
					<div class="search">
						<div id="custom-search-input">
						<div class="input-group">
							<input type="text" class="form-control input-lg" placeholder="Buscar" name="desc" />
							<span class="input-group-btn">
								<button class="btn btn-info btn-lg" type="submit">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</span>
						</div>
					</div>
					</div>
				</div>
				<div class="clearfix"></div>
				</form>
			</div>
			