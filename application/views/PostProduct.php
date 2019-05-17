<?php
    require_once(APPPATH."views/part/Header.php");
    require_once(APPPATH."views/part/sidebar.php");
?>
<link href="<?php echo base_url()?>Assets/dropone/dropzone.min.css" rel="stylesheet">
<script src="<?php echo base_url()?>Assets/dropone/dropzone.min.js"></script>

<style type="text/css">
  .dropzone {
    margin-top: 20px;
    border: 2px dashed #0087F7;
  }
</style>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
        <a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="tip-buttom"> Mutasi Stock</a>

    </div>
    <!-- <form id="search" enctype='application/json'> -->
    
  </div>
<!--End-breadcrumbs-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title">
            <h5>Tambah Product</h5>
        </div>
        <div class="widget-content">
          <div class="dropzone">
            <div class="dz-message">
             <h3>Click or drag and drop your image hire (Max. 5 photos)</h3>
            </div>
          </div>
          <input type="text" name="thumbnail" id="dropzone--dropzoneThumbnail" class="form-control" placeholder="BASE64 Blob Goes Here..." />
        </div>
      </div>

      <div class="widget-box">
        <div class="widget-title">
            <h5>List Product</h5>
        </div>
        <div class="widget-content">
          <table class="table table-bordered data-table" >
            <thead>
              <tr>
                <th>#</th>
                <th>No Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Sumber Stock</th>
                <th>Di buat oleh</th>
              </tr>
            </thead>
            <tbody>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- End models -->
<?php
    require_once(APPPATH."views/part/footer.php");
?>
<script type="text/javascript">
  Dropzone.autoDiscover = false;
  var foto_upload= new Dropzone(".dropzone",{
    url: "/",
    maxFiles:5,
    maxFilesize: 2,
    method:"post",
    acceptedFiles:"image/*",
    paramName:"userfile",
    dictInvalidFileType:"Type file ini tidak dizinkan",
    addRemoveLinks:true,
    accept: function(file, done) {
          // todo: use modernizr to set maxfilesize if FileReader unavailable
          // fixme: throw error if not an image

          var reader = new FileReader();
          reader.onload = handleReaderLoad;
          reader.readAsDataURL(file);

          function handleReaderLoad(e) {
              var filePayload = e.target.result;
              var img = document.getElementById('dropzone');
              img.src = filePayload;
              filePayload = resizeWithCanvas(img);
              img.src = filePayload;
              document.getElementById('dropzone--dropzoneThumbnail').value = filePayload;
          }

          done();
      }
  });
  (function() {
    // build of Modernizr 3.3.1 including only the `filereader` test
      !function(e,n,s){function o(e,n){return typeof e===n}function a(){var e,n,s,a,i,l,c;for(var u in t)if(t.hasOwnProperty(u)){if(e=[],n=t[u],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(s=0;s<n.options.aliases.length;s++)e.push(n.options.aliases[s].toLowerCase());for(a=o(n.fn,"function")?n.fn():n.fn,i=0;i<e.length;i++)l=e[i],c=l.split("."),1===c.length?f[c[0]]=a:(!f[c[0]]||f[c[0]]instanceof Boolean||(f[c[0]]=new Boolean(f[c[0]])),f[c[0]][c[1]]=a),r.push((a?"":"no-")+c.join("-"))}}function i(e){var n=c.className,s=f._config.classPrefix||"";if(u&&(n=n.baseVal),f._config.enableJSClass){var o=new RegExp("(^|\\s)"+s+"no-js(\\s|$)");n=n.replace(o,"$1"+s+"js$2")}f._config.enableClasses&&(n+=" "+s+e.join(" "+s),u?c.className.baseVal=n:c.className=n)}var t=[],l={_version:"3.3.1",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var s=this;setTimeout(function(){n(s[e])},0)},addTest:function(e,n,s){t.push({name:e,fn:n,options:s})},addAsyncTest:function(e){t.push({name:null,fn:e})}},f=function(){};f.prototype=l,f=new f;var r=[],c=n.documentElement,u="svg"===c.nodeName.toLowerCase();f.addTest("filereader",!!(e.File&&e.FileList&&e.FileReader)),a(),i(r),delete l.addTest,delete l.addAsyncTest;for(var d=0;d<f._q.length;d++)f._q[d]();e.Modernizr=f}(window,document);
  })();

  // (function() {
  //     window.Dropzone.autoDiscover = false;
  //     var dropzoneOptions = {
  //         url: '/',
  //         paramName: 'thumbnail',
  //         clickable: '.dropzone, .dropzone *',
  //         hiddenInputContainer: '.dropzone',
  //         addRemoveLinks: true,
  //         uploadMultiple: false,
  //         autoProcessQueue: false,
  //         thumbnail: function() {},
  //         uploadprogress: function() {},
  //         dictRemoveFile: '',
  //         dictInvalidFileType: "You can't upload files of this type.",
  //         maxFiles: 1,
  //         acceptedFiles: 'image/*',
  //         previewsContainer: document.getElementById('dropzone--preview'),
  //         previewTemplate: document.getElementById('dropzone--preview-layout').innerHTML,
  //         init: function() {
  //             this.on("maxfilesexceeded", function(file) {
  //                 this.removeAllFiles();
  //                 this.addFile(file);
  //             });
  //             this.on("error", function(file, errorMessage, third) {
  //                 console.error(errorMessage);
  //                 if (errorMessage === dropzoneOptions.dictInvalidFileType) {
  //                     // todo: remove the <img> and removal button 
  //                     // fixme: need to auto-remove the file when another is added
  //                     console.log('that is my kind of error');
  //                 }
  //             })
  //         },
  //         accept: function(file, done) {
  //             // todo: use modernizr to set maxfilesize if FileReader unavailable
  //             // fixme: throw error if not an image

  //             var reader = new FileReader();
  //             reader.onload = handleReaderLoad;
  //             reader.readAsDataURL(file);

  //             function handleReaderLoad(e) {
  //                 var filePayload = e.target.result;
  //                 var img = document.getElementById('dropzone--dropzoneImage');
  //                 img.src = filePayload;
  //                 filePayload = resizeWithCanvas(img);
  //                 img.src = filePayload;
  //                 document.getElementById('dropzone--dropzoneThumbnail').value = filePayload;
  //             }

  //             done();
  //         }
  //     };
      
  //     console.log(Modernizr.filereader);
      
  //     if (Modernizr.filereader) {
  //         document.getElementById('dropzone--dropzoneFallback').classList.add('hidden');
  //         new Dropzone("#dropzone-thumbnail-upload", dropzoneOptions);
  //     } else {
  //         document.getElementById('dropzone--dropzoneMessage').remove();
  //     }

  //     function resizeWithCanvas(img) {
  //         var MAX_WIDTH = 1200;
  //         var MAX_HEIGHT = 1200;
  //         var OUTPUT_QUALITY = .75;

  //         var canvas = document.createElement("canvas");
  //         var ctx = canvas.getContext("2d");
  //         var width = img.width;
  //         var height = img.height;

  //         ctx.drawImage(img, 0, 0);

  //         if (width > height) {
  //             if (width > MAX_WIDTH) {
  //                 height *= MAX_WIDTH / width;
  //                 width = MAX_WIDTH;
  //             }
  //         } else {
  //             if (height > MAX_HEIGHT) {
  //                 width *= MAX_HEIGHT / height;
  //                 height = MAX_HEIGHT;
  //             }
  //         }
  //         canvas.width = width;
  //         canvas.height = height;
  //         var ctx = canvas.getContext("2d");
  //         ctx.drawImage(img, 0, 0, width, height);

  //         if (navigator.userAgent.toLowerCase().indexOf('chrome') > -1) {
  //             return canvas.toDataURL("image/jpeg", OUTPUT_QUALITY);
  //         } else {
  //             return canvas.toDataURL("image/jpeg");
  //         }
  //     }
  // })();

  $(function () {
    var form_mode = '';
    $.ajaxSetup({
        beforeSend:function(jqXHR, Obj){
            var value = "; " + document.cookie;
            var parts = value.split("; csrf_cookie_token=");
            if(parts.length == 2)   
            Obj.data += '&csrf_token='+parts.pop().split(";").shift();
        }
    });
    $('#hrgperpcs').keyup(function(event) {

      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40) return;

      // format number
      $(this).val(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
      });
    });
    $( document ).ready(function() {

    });
    Dropzone.autoDiscover = false;
    var foto_upload= new Dropzone(".dropzone",{
      url: "<?php echo base_url('back/post/proses_upload') ?>",
      maxFiles:5,
      maxFilesize: 2,
      method:"post",
      acceptedFiles:"image/*",
      paramName:"userfile",
      dictInvalidFileType:"Type file ini tidak dizinkan",
      addRemoveLinks:true,
      accept: function(file, done) {
          // todo: use modernizr to set maxfilesize if FileReader unavailable
          // fixme: throw error if not an image

          var reader = new FileReader();
          reader.onload = handleReaderLoad;
          reader.readAsDataURL(file);

          function handleReaderLoad(e) {
              var filePayload = e.target.result;
              var img = document.getElementById('dropzone');
              img.src = filePayload;
              filePayload = resizeWithCanvas(img);
              img.src = filePayload;
              document.getElementById('dropzone--dropzoneThumbnail').value = filePayload;
          }

          done();
      }
    });
  });
  function resizeWithCanvas(img) {
      var MAX_WIDTH = 1200;
      var MAX_HEIGHT = 1200;
      var OUTPUT_QUALITY = .75;

      var canvas = document.createElement("canvas");
      var ctx = canvas.getContext("2d");
      var width = img.width;
      var height = img.height;

      ctx.drawImage(img, 0, 0);

      if (width > height) {
          if (width > MAX_WIDTH) {
              height *= MAX_WIDTH / width;
              width = MAX_WIDTH;
          }
      } else {
          if (height > MAX_HEIGHT) {
              width *= MAX_HEIGHT / height;
              height = MAX_HEIGHT;
          }
      }
      canvas.width = width;
      canvas.height = height;
      var ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0, width, height);

      if (navigator.userAgent.toLowerCase().indexOf('chrome') > -1) {
          return canvas.toDataURL("image/jpeg", OUTPUT_QUALITY);
      } else {
          return canvas.toDataURL("image/jpeg");
      }
  }
</script>
<!-- <div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<script src="<?php echo base_url();?>Assets/js/jquery.min.js"></script> 
<script src="<?php echo base_url();?>Assets/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url();?>Assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>Assets/js/jquery.uniform.js"></script> 
<script src="<?php echo base_url();?>Assets/js/select2.min.js"></script> 
<script src="<?php echo base_url();?>Assets/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url();?>Assets/js/matrix.js"></script> 
<script src="<?php echo base_url();?>Assets/js/matrix.tables.js"></script>
</body>
</html> -->

<!-- <script type="text/javascript">
    $('#example1').DataTable();
</script> -->