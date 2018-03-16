<?php
  require_once(APPPATH."views/front/part/header_front.php");
?>
<link rel="stylesheet" href="<?php echo base_url();?>front/css/etalage.css" type="text/css" media="all" />
<script src="<?php echo base_url();?>front/js/jquery.etalage.min.js"></script>
<script>
			jQuery(document).ready(function($){

				$('#etalage').etalage({
					thumb_image_width: 400,
					thumb_image_height: 400,
					source_image_width: 900,
					source_image_height: 1200,
					show_hint: true,
					click_callback: function(image_anchor, instance_id){
						alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
					}
				});

			});
		</script>

<!-- Ratting POSs -->
<script type="text/javascript">
    $( document ).ready(function() {
        $('.rating').on('rating.change', function (event, value, caption) {
            var rate_id = $(this).prop('id');
            var pure_id = rate_id.substring(6);
            var name = $(this).prop('name').substring(7);
            $.post('<?= base_url()?>front/post/create_rate', {score: value, pid: pure_id, mac: name},
                function (data) {
                    $('#' + rate_id).rating('refresh', {
                        showClear: false,
                        showCaption: false,
                        disabled: true
                    });
                });
            // alert(rate_id);
            // console.log(pure_id);
        });
    });

</script>
<!-- //Ratting post -->
<div class="single-page main-grid-border">
		<div class="container">
			<ol class="breadcrumb" style="margin-bottom: 5px;">
				<li><a href="index.html">Home</a></li>
				<li><a href="all-classifieds.html">All Ads</a></li>
				<li class="active"><a href="mobiles.html">Mobiles</a></li>
				<li class="active">Mobile Phone</li>
			</ol>
			<?php
			ob_start();
			system("ipconfig /all");
			$mycomp = ob_get_contents();
			ob_clean();

			$findme = "Physical Address";
			$pmac = strpos($mycomp, $findme);
			$mac = substr($mycomp,($pmac+36),17);
			foreach ($post_Detail as $key) {
				$ratt = 0;
				$data = "false";
				if($ratFlag >0 and $Ratting>0){
					$ratt = $Ratting/$ratFlag;
				}
				else{
					$ratt = 0;
				}
				if($this->session->userdata('uid')== false){
					$data = "false";
				}
				else{
					$data = $Ratting;
				}
				echo '
				<div class="product-desc">
				<div class="col-md-7 product-view">
					<h2>'.$key->promo_title.'</h2>
					<p> <i class="glyphicon glyphicon-map-marker"></i><a href="#">state</a>, <a href="#">city</a>| Added at '.$key->post_date.', Ad ID: '.$key->id_post.'</p>
					
					<div class="grid images_3_of_2">
						<ul id="etalage">
							<li>
									<img class="etalage_thumb_image" src="'.base_url().$key->pic1.'" class="img-responsive" />
									<img class="etalage_source_image" src="'.base_url().$key->pic1.'" class="img-responsive" title="" />
							</li>
							<li>
								<img class="etalage_thumb_image" src="'.base_url().$key->pic2.' class="img-responsive" />
								<img class="etalage_source_image" src="'.base_url().$key->pic2.'" class="img-responsive" title="" />
							</li>
							<li>
								<img class="etalage_thumb_image" src="'.base_url().$key->pic3.'" class="img-responsive"  />
								<img class="etalage_source_image" src="'.base_url().$key->pic3.'" class="img-responsive"  />
							</li>
						    <li>
								<img class="etalage_thumb_image" src="'.base_url().$key->pic4.'" class="img-responsive"  />
								<img class="etalage_source_image" src="'.base_url().$key->pic4.'" class="img-responsive"  />
							</li>
							<li>
								<img class="etalage_thumb_image" src="'.base_url().$key->pic5.'" class="img-responsive"  />
								<img class="etalage_source_image" src="'.base_url().$key->pic5.'" class="img-responsive"  />
							</li>
						</ul>
						 <div class="clearfix"> </div>		
				  </div> 
					<div class="product-details">
						<h4>Brand : <a href="#">'.$key->company_name.'</a></h4>
						<h4>Views : <strong>150</strong></h4>
						
						<p><strong>Summary</strong> : '.$key->description.'.</p>

						
						<p>Share</p>
						<hr width ="70%" size ="10px">
						<p>Review</p>
						
						<h1>
							'.substr($avg, 0,3).'<p>50 Ulasan</p>
						</h1>
					</div>
				</div>
				<div class="col-md-5 product-details-grid">
					<div class="item-price">
						<div class="product-price">
						<div class="itemtype">
							<p class="p-price">Item Category</p>
							<h4>'.$key->bidangusaha.'</h4>
							<div class="clearfix"></div>
						</div>
							<p class="p-price"><i class="glyphicon glyphicon-earphone"></i></p>
							<h4 class="rate">
								'.$key->phone.'
							</h4>
							<div class="clearfix"></div>
						</div>
						<div class="condition">
							<p class="p-price"><i class="glyphicon glyphicon-phone-alt"></i></p>
							<h4>'.$key->phone2.'</h4>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="interested text-center">
						<h4>Interested in this Ad?<small> Contact the Seller!</small></h4>
						<p><i class="glyphicon glyphicon-earphone"></i>'.$key->phone.'</p>
						<p><i class="glyphicon glyphicon-earphone"></i>'.$key->phone2.'</p>
					</div>
				</div>
				';
			}

				?>
			<div class="clearfix"></div>
			</div>
		</div>
		<!-- FlexSlider -->
<?php require_once(APPPATH."views/front/part/footer.php");?>

<!-- 
<p>Ratting
						<span dir="ltr" class="inline">
							<input id="input-'.$key->id_post.'" name="rating-'.$mac.'" 
							value="'.$ratt.'" data-disabled="'.$data.'"
							class="rating "
               				min="0" max="5" step="1" data-size="xs"
               				accept="" data-symbol="&#xf005;" data-glyphicon="false"
               				data-rating-class="rating-fa">
						</span>
						</p>

						rating review
<h3>
						<input class="rating" min="0" max="5" data-size="xs" data-disabled="true" value="'.$avg.'" />
						</h3>
 -->
<?php require_once(APPPATH."views/front/part/footer.php");?>
