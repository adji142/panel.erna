
<script type="text/javascript">
$(document).ready(function () {    
var elem=$('#container ul');      
	$('#viewcontrols a').on('click',function(e) {
		if ($(this).hasClass('gridview')) {
			elem.fadeOut(1000, function () {
				$('#container ul').removeClass('list').addClass('grid');
				$('#viewcontrols').removeClass('view-controls-list').addClass('view-controls-grid');
				$('#viewcontrols .gridview').addClass('active');
				$('#viewcontrols .listview').removeClass('active');
				elem.fadeIn(1000);
			});						
		}
		else if($(this).hasClass('listview')) {
			elem.fadeOut(1000, function () {
				$('#container ul').removeClass('grid').addClass('list');
				$('#viewcontrols').removeClass('view-controls-grid').addClass('view-controls-list');
				$('#viewcontrols .gridview').removeClass('active');
				$('#viewcontrols .listview').addClass('active');
				elem.fadeIn(1000);
			});									
		}
	});
});
</script>
<?php
  require_once(APPPATH."views/front/part/header_front.php");
?>
<div class="total-ads main-grid-border">
	<div class="container">
		<?php require_once(APPPATH."views/front/part/filter.php");?>
		<div class="ads-grid">
			<div class="ads-display col-md-12">
					<div class="wrapper">					
					<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					  <!-- <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
						<li role="presentation" class="active">
						  <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
							<span class="text">All Ads</span>
						  </a>
						</li>
					  </ul> -->
					  <div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
						   <div>
												<div id="container">
								<div class="view-controls-list" id="viewcontrols">
									<label>view :</label>
									<!-- <a class="gridview"><i class="glyphicon glyphicon-th"></i></a> -->
									<a class="listview active"><i class="glyphicon glyphicon-th-list"></i></a>
								</div>
								<div class="sort">
								   <div class="sort-by">
										<label>Sort By : </label>
										<select>
														<option value="">Most recent</option>
														<option value="">Price: Rs Low to High</option>
														<option value="">Price: Rs High to Low</option>
										</select>
									   </div>
									 </div>
								<div class="clearfix"></div>
								<table id="example1" class="">
									<thead>
										<tr>
											<td></td>
										</tr>
									</thead>
									<?php
										if($total_rows==0){
											echo "Tidak ada post untuk saat ini";
										}
										else{
											foreach ($have_post as $content) {
												echo '<tr><td>
												<br>
												<ul class="list">
												<a href="'.base_url("front/post/single/$content->id_post").'">
													<li>
													<img src="'.base_url().'/'.$content->pic1.'" title="" alt="" />
													<img src="'.base_url().'/'.$content->pic2.'" title="" alt="" />
													<img src="'.base_url().'/'.$content->pic3.'" title="" alt="" />
													<img src="'.base_url().'/'.$content->pic4.'" title="" alt="" />
													<img src="'.base_url().'/'.$content->pic5.'" title="" alt="" />
													<section class="list-left">
													<h5 class="title">'.$content->promo_title.'</h5>
													<span class="cityname">'.$content->start_period.' s/d '.$content->end_period.'</span>
													<p class="catpath">'.$content->bidangusaha.'</p>
													</section>
													<section class="list-right">
													<span class="date">'.substr($content->post_date,0,10).'</span>
													</section>
													<div class="clearfix"></div>
													</li> 
												</a>
												</ul>
												</td></tr>
											';
											}
										}
									?>	
								</table>
						</div>
						</div>
						
					  </div>
					</div>
				</div>
				</div>
				<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php require_once(APPPATH."views/front/part/footer.php");?>