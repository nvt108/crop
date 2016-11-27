<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cropper</title>
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/cropper.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="dist/cropper.js"></script>
    <script src="js/main.js"></script>
    <script src="js/crop.js"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Header -->
<header class="navbar navbar-static-top docs-header" id="top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-target="#navbar-collapse" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">Cropper</a>
        </div>
        <nav class="collapse navbar-collapse" id="navbar-collapse" role="navigation">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="https://github.com/fengyuanchen/cropper/blob/master/README.md">Docs</a></li>
                <li><a href="https://github.com/fengyuanchen/cropper">GitHub</a></li>
                <li><a href="https://fengyuanchen.github.io">More</a></li>
                <li><a href="http://chenfengyuan.com">About</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Jumbotron -->
<div class="jumbotron docs-jumbotron">
    <div class="container">
        <h1>Cropper</h1>
        <p class="lead">A simple jQuery image cropping plugin.</p>
    </div>
</div>

<!-- Content -->
<div class="container" id="container">
    <form method="post" action="saveImage.php" >
        <input type="hidden" name="data_img" value=""/>
        <div class="row">
            <div class="col-md-5">
                <!-- <h3 class="page-header">Demo:</h3> -->
                <label for="background_repet">Check <input type="checkbox" id="background_repet" /></label> 
                <div class="background" id="frame_img_base" style="width: 457px; height: 300px; border:1px #cdcdcd solid;margin-bottom: 20px">
                    <img id="background_image_base" src="assets/img/picture.jpg" alt="Picture">
                </div>
                <div class="image" id="frame_img_base1" style="width: 457px; height: 300px; border:1px #cdcdcd solid;margin-bottom: 20px">
                    <img id="insert_image_base" src="assets/img/picture.jpg" alt="Picture">
                </div>
                <div class="col-md-12 docs-buttons">
                            <!-- <h3 class="page-header">Toolbar:</h3> -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
                          <span class="fa fa-arrows"></span>
                        </span>
                                </button>
                                <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)">
                          <span class="fa fa-crop"></span>
                        </span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
                          <span class="fa fa-search-plus"></span>
                        </span>
                                </button>
                                <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
                          <span class="fa fa-search-minus"></span>
                        </span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, -10, 0)">
                          <span class="fa fa-arrow-left"></span>
                        </span>
                                </button>
                                <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 10, 0)">
                          <span class="fa fa-arrow-right"></span>
                        </span>
                                </button>
                                <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 0, -10)">
                          <span class="fa fa-arrow-up"></span>
                        </span>
                                </button>
                                <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 0, 10)">
                          <span class="fa fa-arrow-down"></span>
                        </span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, -45)">
                          <span class="fa fa-rotate-left"></span>
                        </span>
                                </button>
                                <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, 45)">
                          <span class="fa fa-rotate-right"></span>
                        </span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;scaleX&quot;, -1)">
                          <span class="fa fa-arrows-h"></span>
                        </span>
                                </button>
                                <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;scaleY&quot;-1)">
                          <span class="fa fa-arrows-v"></span>
                        </span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;crop&quot;)">
                          <span class="fa fa-check"></span>
                        </span>
                                </button>
                                <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;clear&quot;)">
                          <span class="fa fa-remove"></span>
                        </span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;disable&quot;)">
                          <span class="fa fa-lock"></span>
                        </span>
                                </button>
                                <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;enable&quot;)">
                          <span class="fa fa-unlock"></span>
                        </span>
                                </button>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;reset&quot;)">
                          <span class="fa fa-refresh"></span>
                        </span>
                                </button>
                                <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                    <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                    <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
                          <span class="fa fa-upload"></span>
                        </span>
                                </label>
                                <button type="button" class="btn btn-primary" data-method="destroy" title="Destroy">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;destroy&quot;)">
                          <span class="fa fa-power-off"></span>
                        </span>
                                </button>
                            </div>

                            <div class="btn-group btn-group-crop">
                                <button type="button" class="btn btn-primary" data-method="getCroppedCanvas">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">
                          Get Cropped Canvas
                        </span>
                                </button>
                                <button type="button" class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 160, &quot;height&quot;: 90 }">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 160, height: 90 })">
                          160&times;90
                        </span>
                                </button>
                                <button type="button" class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 320, &quot;height&quot;: 180 }">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 320, height: 180 })">
                          320&times;180
                        </span>
                                </button>
                            </div>

                            <!-- Show the cropped image in modal -->
                            <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4>
                                        </div>
                                        <div class="modal-body"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.modal -->

                            <button type="button" class="btn btn-primary" data-method="getData" data-option data-target="#putData">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getData&quot;)">
                        Get Data
                      </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="setData" data-target="#putData">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setData&quot;, data)">
                        Set Data
                      </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="getContainerData" data-option data-target="#putData">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getContainerData&quot;)">
                        Get Container Data
                      </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="getImageData" data-option data-target="#putData">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getImageData&quot;)">
                        Get Image Data
                      </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="getCanvasData" data-option data-target="#putData">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCanvasData&quot;)">
                        Get Canvas Data
                      </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="setCanvasData" data-target="#putData">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setCanvasData&quot;, data)">
                        Set Canvas Data
                      </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="getCropBoxData" data-option data-target="#putData">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCropBoxData&quot;)">
                        Get Crop Box Data
                      </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="setCropBoxData" data-target="#putData">
                      <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setCropBoxData&quot;, data)">
                        Set Crop Box Data
                      </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="moveTo" data-option="0">
                      <span class="docs-tooltip" data-toggle="tooltip" title="cropper.moveTo(0)">
                        0,0
                      </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="zoomTo" data-option="1">
                      <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoomTo(1)">
                        100%
                      </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="rotateTo" data-option="180">
                      <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotateTo(180)">
                        180°
                      </span>
                            </button>
                            <input type="text" class="form-control" id="putData" placeholder="Get data to here or set data with this value">

                        </div><!-- /.docs-buttons -->
            </div>
            <div class="col-md-7">
                <!-- <h3 class="page-header">Preview:</h3> -->
                <div id="crop-result" class="col-md-12" style="min-height: 400px">
                    <iframe id="preview_iframe" src="iframe.php" width="500px" height="500px"></iframe>
                    <a class="col-md-12" id="image1-download" download="girl-xinh.jpg">Download</a>
                    <a class="col-md-12" id="save-image">Save image</a>
                    <div class="" id="nguyen" style="    width: 100px;float: left;height: 20px;">11111
                        <!--<div class="img-preview preview-lg"></div>-->
                    </div>
                </div>
                <script >

                </script>

                <!-- <h3 class="page-header">Data:</h3> -->
                <div class="docs-data" style="display: none;">
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataX">X</label>
                        <input type="text" class="form-control" id="dataX" placeholder="x">
                        <span class="input-group-addon">px</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataY">Y</label>
                        <input type="text" class="form-control" id="dataY" placeholder="y">
                        <span class="input-group-addon">px</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataWidth">Width</label>
                        <input type="text" class="form-control" id="dataWidth" placeholder="width">
                        <span class="input-group-addon">px</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataHeight">Height</label>
                        <input type="text" class="form-control" id="dataHeight" placeholder="height">
                        <span class="input-group-addon">px</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataRotate">Rotate</label>
                        <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
                        <span class="input-group-addon">deg</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataScaleX">ScaleX</label>
                        <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataScaleY">ScaleY</label>
                        <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            

            <div class="col-md-3 docs-toggles">
                <!-- <h3 class="page-header">Toggles:</h3> -->
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
                        <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 16 / 9">
              16:9
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
                        <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 4 / 3">
              4:3
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
                        <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 1 / 1">
              1:1
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
                        <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 2 / 3">
              2:3
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
                        <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: NaN">
              Free
            </span>
                    </label>
                </div>

                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" class="sr-only" id="viewMode0" name="viewMode" value="0" checked>
                        <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 0">
              VM0
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="viewMode1" name="viewMode" value="1">
                        <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 1">
              VM1
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="viewMode2" name="viewMode" value="2">
                        <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 2">
              VM2
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="viewMode3" name="viewMode" value="3">
                        <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 3">
              VM3
            </span>
                    </label>
                </div>

                <div class="dropdown dropup docs-options">
                    <button type="button" class="btn btn-primary btn-block dropdown-toggle" id="toggleOptions" data-toggle="dropdown" aria-expanded="true">
                        Toggle Options
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="toggleOptions" role="menu">
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="responsive" checked>
                                responsive
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="restore" checked>
                                restore
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="checkCrossOrigin" checked>
                                checkCrossOrigin
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="checkOrientation" checked>
                                checkOrientation
                            </label>
                        </li>

                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="modal" checked>
                                modal
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="guides" checked>
                                guides
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="center" checked>
                                center
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="highlight" checked>
                                highlight
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="background" checked>
                                background
                            </label>
                        </li>

                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="autoCrop" checked>
                                autoCrop
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="movable" checked>
                                movable
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="rotatable" checked>
                                rotatable
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="scalable" checked>
                                scalable
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="zoomable" checked>
                                zoomable
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="zoomOnTouch" checked>
                                zoomOnTouch
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="zoomOnWheel" checked>
                                zoomOnWheel
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="cropBoxMovable" checked>
                                cropBoxMovable
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="cropBoxResizable" checked>
                                cropBoxResizable
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="toggleDragModeOnDblclick" checked>
                                toggleDragModeOnDblclick
                            </label>
                        </li>
                    </ul>
                </div><!-- /.dropdown -->
            </div><!-- /.docs-toggles -->
        </div>
    </form>
</div>

<!-- Footer -->
<footer class="docs-footer">
    <div class="container">
        <p class="heart"></p>
    </div>
</footer>

<!-- Scripts -->

</body>
</html>