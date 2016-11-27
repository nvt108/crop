/**
 * Created by TrungNV on 11/26/2016.
 */
var URL = window.URL || window.webkitURL;
var uploadedImageURL;
var Cropper = function() {
    this.options = {
        iframeId: '#preview_iframe',
        imageToCropId: "#background_image_base11",
        frameImageBase: "#bgr_frame_img_base",
        heightPreview: 0,
        widthPreview: 0,
        ratioOfBaseImage: 0,
        cropMethod: "getCroppedCanvas",
        cropPreview: "#background_iframe_preview",
        repeatId: "#background_repet",
        frameCropSize: {}
    };

    this.init = function(options) {
        if (jQuery.type(options) === 'object' && !jQuery.isEmptyObject(options)) {
            this.setOption(options);
        }
        var objCrop = this;
        objCrop.setIframeSize();
        var optionsCrop = {
//            aspectRatio: 16/9,
            crop: function(e) {
                var result = $(objCrop.options.imageToCropId).cropper(objCrop.options.cropMethod);
                if ($(objCrop.options.cropPreview).is('iframe')) {
                    $(objCrop.options.cropPreview).css('background-image', "url(" + result.toDataURL('image/jpeg') + ")");
                }else{
                    $(objCrop.options.iframeId).contents().find(objCrop.options.cropPreview).css('background-image', "url(" + result.toDataURL('image/jpeg') + ")");
                }
            }
        };
        optionsCrop.built = function() {
            var imageData = $("#background_image_base").cropper('getCanvasData');
            var sizeFrameCrop = objCrop.getSizeFrame(imageData);
            $(objCrop.options.imageToCropId).cropper('setCropBoxData', sizeFrameCrop);
        };
        $(this.options.imageToCropId).cropper('destroy').cropper(optionsCrop);
        this.setRadiusFrame();
        // set repeat image
        $(this.options.repeatId).click(function(){
            if( $(this).is(":checked") ){
                $(objCrop.options.cropPreview).css('background-repeat', "repeat");
            }else{
                $(objCrop.options.cropPreview).css('background-repeat', "no-repeat");
            }
        });

    };

    this.getSizeFrame = function(imageData) {
        if (!jQuery.isEmptyObject(this.options.frameCropSize)) { // edit cta 
            return this.options.frameCropSize;
        } else if (jQuery.type(imageData) === 'object' && !jQuery.isEmptyObject(imageData)) {
            var imageHeight = imageData.height ? imageData.height : 0;
            var imageWidth = imageData.width ? imageData.width : 0;
            var naturalHeight = imageData.naturalHeight ? imageData.naturalHeight : 0;
            var naturalWidth = imageData.naturalWidth ? imageData.naturalWidth : 0;
            var height = (imageHeight / naturalHeight) * this.options.heightPreview;
            var width = (imageWidth / naturalWidth) * this.options.widthPreview;
            var top = (imageHeight - height) / 2;
            var left = (imageWidth - width) / 2;
            console.log(imageHeight, imageWidth, height, width, naturalHeight, naturalWidth)
            return {
                top: top ? top : 0,
                left: left ? left : 0,
                height: height,
                width: width
            };
        }
    };

    this.setOption = function(options) {
        for (var i in options) {
            this.options[i] = options[i];
        }
    };

    this.setIframeSize = function() {
        if ($(this.options.cropPreview).is('iframe')) {
            this.options.heightPreview = $(this.options.cropPreview).height();
            this.options.widthPreview = $(this.options.cropPreview).width();
        } else {
            this.options.heightPreview = $(this.options.iframeId).contents().find(this.options.cropPreview).height();
            this.options.widthPreview = $(this.options.iframeId).contents().find(this.options.cropPreview).width();
        }
        console.log(this.options.heightPreview,this.options.widthPreview)
    };
    
    this.setRadiusFrame = function(){
        if ( ! $(this.options.cropPreview).is('iframe') ) {
            var radius = $(this.options.iframeId).contents().find(this.options.cropPreview).css('border-radius');
            if( radius && "0px" != radius ){
                var setRadius = setInterval(function(){
                    $(".image .cropper-face").css('border-radius', radius);
                    $(".image .cropper-view-box").css('border-radius',radius);
                    if ( $(".image .cropper-face").css('border-radius') == radius ){
                        clearInterval(setRadius);
                    }
                },100);
            }
        }
    };
}
var BackgroundCrop = new Cropper();
var InsertImageCrop = new Cropper();
$(document).ready(function() {
    $('#preview_iframe').on('load', function(){
        var frameCropSize = {top: 20, left: 150, height: 100, width: 100};
        BackgroundCrop.init({imageToCropId: "#background_image_base", cropPreview: "#preview_iframe"});
        InsertImageCrop.init({imageToCropId: "#insert_image_base",cropPreview: "#image_iframe_preview"});
    });
});
