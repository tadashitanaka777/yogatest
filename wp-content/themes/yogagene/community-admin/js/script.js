$(function(){
  
  var osVer = "iPhone";
    if (navigator.userAgent.indexOf(osVer)>0){
      var nav = $('.drawer-nav');
      nav.addClass('iphone');
      nav.wrapInner( '<div class="area"><//div>' );
  }
  
  $(".nav-left").hiraku({
    btn:"#offcanvas-btn-right",
    fixedHeader:"#header",
    direction:"left",
  });
  
  $(".animsition").animsition({
    inClass: 'fade-in',
    outClass: 'fade-out',
    inDuration: 500,
    outDuration: 300,
    linkElement: '.animsition-link',
    loading: true,
    loadingParentElement: 'body',
    loadingClass: 'animsition-loading',
    loadingInner: '',
    timeout: false,
    timeoutCountdown: 5000,
    onLoadEvent: true,
    browser: [ 'animation-duration', '-webkit-animation-duration'],
    overlay : false,
    overlayClass : 'animsition-overlay-slide',
    overlayParentElement : 'body',
    transition: function(url){ window.location.href = url; }
  });
  
  $('.no-submit').on('click',function(){
    return false;
  });
  
  _texrareaAutoHeight();

  $('.drawer').drawer();
  $('.timepicker').clockpicker({donetext:'OK',autoclose:true});
  
  $(function() {
	  //クリックしたときのファンクションをまとめて指定
	  $('.tab-ul li').click(function() {
      //.index()を使いクリックされたタブが何番目かを調べ、
		  //indexという変数に代入します。
		  var index = $('.tab-ul li').index(this);
		  //コンテンツを一度すべて非表示にし、
		  $('.tab-content .tab-li').css('display','none');
		  //クリックされたタブと同じ順番のコンテンツを表示します。
		  $('.tab-content .tab-li').eq(index).css('display','block');
		  //一度タブについているクラスselectを消し、
		  $('.tab-ul li').removeClass('select');
		  //クリックされたタブのみにクラスselectをつけます。
		  $(this).addClass('select')
	  });
  });
  
  //$('#datatable-studio').DataTable();
  //$('#datatable-license').DataTable();
  
  if($('#myAvatar').length){
    var hogeParam = "hoge";
    // Dropzone設定
    Dropzone.autoDiscover = false;
    // Dropzoneフォームのidをキャメルケースで記述
    //Dropzone.options.myAwesomeDropzone = {};
    Dropzone.options.myAvatar = {
      url: "./",
      method: "post",
      withCredentials: false,
      parallelUploads: 1,
      uploadMultiple: false,
      maxFilesize: 1,
      paramName: "attachment[file]",
      createImageThumbnails: true,
      maxThumbnailFilesize: 10,
      thumbnailWidth: 300,
      thumbnailHeight: 300,
      filesizeBase: 1000,
      maxFiles: 1,
      params: {},
      clickable: true,
      ignoreHiddenFiles: true,
      acceptedFiles: ".jpg,.jpeg,.png,.gif",
      acceptedMimeTypes: null,
      autoProcessQueue: true,
      autoQueue: true,
      addRemoveLinks: true,
      previewsContainer: null,
      hiddenInputContainer: "form",
      capture: null,
      renameFilename: null,
      dictDefaultMessage: "<span>【メイン画像】</span><br>クリック or ドロップ<br><small>推奨サイズ：1000x1000の正方形</small>",
      dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
      dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
      dictFileTooBig: "ファイルが大き過ぎます ({{filesize}}MB). 最大: {{maxFilesize}}MB.",
      dictInvalidFileType: "このタイプのファイルはアップロードできません。",
      dictResponseError: "Server responded with {{statusCode}} code.",
      dictCancelUpload: "Cancel upload",
      dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
      dictRemoveFile: "",
      dictRemoveFileConfirmation: null,
      dictMaxFilesExceeded: "You can not upload any more files.",
      enqueueForUpload: true,
    };
    var myDropzone = new Dropzone("div#myAvatar",{url:"./"});
    myDropzone.on("sending", function(file,xhr,formData) {
      console.log(formData);
      formData.append("hoge", hogeParam);
    });
  }
  
  if($('#myLogo').length){
    var hogeParam = "hoge";
    // Dropzone設定
    Dropzone.autoDiscover = false;
    // Dropzoneフォームのidをキャメルケースで記述
    //Dropzone.options.myAwesomeDropzone = {};
    Dropzone.options.myLogo = {
      url: "./",
      method: "post",
      withCredentials: false,
      parallelUploads: 1,
      uploadMultiple: false,
      maxFilesize: 1,
      paramName: "file",
      createImageThumbnails: true,
      maxThumbnailFilesize: 10,
      thumbnailWidth: 300,
      thumbnailHeight: 300,
      filesizeBase: 1000,
      maxFiles: 1,
      params: {},
      clickable: true,
      ignoreHiddenFiles: true,
      acceptedFiles: ".jpg,.jpeg,.png,.gif",
      acceptedMimeTypes: null,
      autoProcessQueue: true,
      autoQueue: true,
      addRemoveLinks: true,
      previewsContainer: null,
      hiddenInputContainer: "form",
      capture: null,
      renameFilename: null,
      dictDefaultMessage: "<span>【ロゴ画像】</span><br>クリック or ドロップ<br><small>推奨サイズ：1000x1000の正方形</small>",
      dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
      dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
      dictFileTooBig: "ファイルが大き過ぎます ({{filesize}}MB). 最大: {{maxFilesize}}MB.",
      dictInvalidFileType: "このタイプのファイルはアップロードできません。",
      dictResponseError: "Server responded with {{statusCode}} code.",
      dictCancelUpload: "Cancel upload",
      dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
      dictRemoveFile: "",
      dictRemoveFileConfirmation: null,
      dictMaxFilesExceeded: "You can not upload any more files."
    };
  
    var myDropzone = new Dropzone("div#myLogo",{url:"./"});
    myDropzone.on("sending", function(file,xhr,formData) {
      formData.append("hoge", hogeParam);
    });
  }

  if($('#myPose').length){
    Dropzone.options.myPose = {
      url: "./",
      method: "post",
      withCredentials: false,
      parallelUploads: 3,
      uploadMultiple: false,
      maxFilesize: 1,
      paramName: "file",
      createImageThumbnails: true,
      maxThumbnailFilesize: 10,
      //thumbnailWidth: 150,
      //thumbnailHeight: 150,
      filesizeBase: 1000,
      maxFiles: 3,
      params: {},
      clickable: true,
      ignoreHiddenFiles: true,
      acceptedFiles: ".jpg,.jpeg,.png,.gif",
      acceptedMimeTypes: null,
      autoProcessQueue: true,
      autoQueue: true,
      addRemoveLinks: true,
      previewsContainer: null,
      hiddenInputContainer: "form",
      capture: null,
      renameFilename: null,
      dictDefaultMessage: "<span>【サブ画像】</span><br>クリック or ドロップ<br><small>推奨サイズ：1000x800の長方形</small><br><small>※複数枚可</small>",
      dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
      dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
      dictFileTooBig: "ファイルが大き過ぎます ({{filesize}}MB). 最大: {{maxFilesize}}MB.",
      dictInvalidFileType: "このタイプのファイルはアップロードできません。",
      dictResponseError: "Server responded with {{statusCode}} code.",
      dictCancelUpload: "Cancel upload",
      dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
      dictRemoveFile: "",
      dictRemoveFileConfirmation: null,
      dictMaxFilesExceeded: "制限枚数を超えています。"
    };
  
    var myPose = new Dropzone("div#myPose",{url:"./"});
    myPose.on("sending", function(file,xhr,formData) {
      formData.append("hoge", hogeParam);
    });
  }
  
  if($('#eventMain').length){
    var hogeParam = "hoge";
    // Dropzone設定
    Dropzone.autoDiscover = false;
    // Dropzoneフォームのidをキャメルケースで記述
    //Dropzone.options.myAwesomeDropzone = {};
    Dropzone.options.eventMain = {
      url: "./",
      method: "post",
      withCredentials: false,
      parallelUploads: 1,
      uploadMultiple: false,
      maxFilesize: 1,
      paramName: "file",
      createImageThumbnails: true,
      maxThumbnailFilesize: 10,
      thumbnailWidth: 300,
      thumbnailHeight: 300,
      filesizeBase: 1000,
      maxFiles: 1,
      params: {},
      clickable: true,
      ignoreHiddenFiles: true,
      acceptedFiles: ".jpg,.jpeg,.png,.gif",
      acceptedMimeTypes: null,
      autoProcessQueue: true,
      autoQueue: true,
      addRemoveLinks: true,
      previewsContainer: null,
      hiddenInputContainer: "body",
      capture: null,
      renameFilename: null,
      dictDefaultMessage: "<span>【メイン画像】</span><br>クリック or ドロップ",
      dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
      dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
      dictFileTooBig: "ファイルが大き過ぎます ({{filesize}}MB). 最大: {{maxFilesize}}MB.",
      dictInvalidFileType: "このタイプのファイルはアップロードできません。",
      dictResponseError: "Server responded with {{statusCode}} code.",
      dictCancelUpload: "Cancel upload",
      dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
      dictRemoveFile: "",
      dictRemoveFileConfirmation: null,
      dictMaxFilesExceeded: "You can not upload any more files."
    };
    
    var eventMain = new Dropzone("div#eventMain",{url:"./"});
    eventMain.on("sending", function(file,xhr,formData) {
      formData.append("hoge", hogeParam);
    });
  }
    
    if($('#eventSub').length){
    var hogeParam = "hoge";
    // Dropzone設定
    Dropzone.autoDiscover = false;
    // Dropzoneフォームのidをキャメルケースで記述
    //Dropzone.options.myAwesomeDropzone = {};
    Dropzone.options.eventSub = {
      url: "./",
      method: "post",
      withCredentials: false,
      parallelUploads: 1,
      uploadMultiple: false,
      maxFilesize: 1,
      paramName: "file",
      createImageThumbnails: true,
      maxThumbnailFilesize: 10,
      thumbnailWidth: 300,
      thumbnailHeight: 300,
      filesizeBase: 1000,
      maxFiles: 1,
      params: {},
      clickable: true,
      ignoreHiddenFiles: true,
      acceptedFiles: ".jpg,.jpeg,.png,.gif",
      acceptedMimeTypes: null,
      autoProcessQueue: true,
      autoQueue: true,
      addRemoveLinks: true,
      previewsContainer: null,
      hiddenInputContainer: "body",
      capture: null,
      renameFilename: null,
      dictDefaultMessage: "<span>【サブ画像】</span><br>クリック or ドロップ",
      dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
      dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
      dictFileTooBig: "ファイルが大き過ぎます ({{filesize}}MB). 最大: {{maxFilesize}}MB.",
      dictInvalidFileType: "このタイプのファイルはアップロードできません。",
      dictResponseError: "Server responded with {{statusCode}} code.",
      dictCancelUpload: "Cancel upload",
      dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
      dictRemoveFile: "",
      dictRemoveFileConfirmation: null,
      dictMaxFilesExceeded: "You can not upload any more files."
    };
    
    var eventSub = new Dropzone("div#eventSub",{url:"./"});
    eventSub.on("sending", function(file,xhr,formData) {
      formData.append("hoge", hogeParam);
    });
  }
    
    if($('#eventLogo').length){
    var hogeParam = "hoge";
    // Dropzone設定
    Dropzone.autoDiscover = false;
    // Dropzoneフォームのidをキャメルケースで記述
    //Dropzone.options.myAwesomeDropzone = {};
    Dropzone.options.eventLogo = {
      url: "./",
      method: "post",
      withCredentials: false,
      parallelUploads: 1,
      uploadMultiple: false,
      maxFilesize: 1,
      paramName: "file",
      createImageThumbnails: true,
      maxThumbnailFilesize: 10,
      thumbnailWidth: 300,
      thumbnailHeight: 300,
      filesizeBase: 1000,
      maxFiles: 1,
      params: {},
      clickable: true,
      ignoreHiddenFiles: true,
      acceptedFiles: ".jpg,.jpeg,.png,.gif",
      acceptedMimeTypes: null,
      autoProcessQueue: true,
      autoQueue: true,
      addRemoveLinks: true,
      previewsContainer: null,
      hiddenInputContainer: "body",
      capture: null,
      renameFilename: null,
      dictDefaultMessage: "<span>【ロゴ画像】</span><br>クリック or ドロップ",
      dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
      dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
      dictFileTooBig: "ファイルが大き過ぎます ({{filesize}}MB). 最大: {{maxFilesize}}MB.",
      dictInvalidFileType: "このタイプのファイルはアップロードできません。",
      dictResponseError: "Server responded with {{statusCode}} code.",
      dictCancelUpload: "Cancel upload",
      dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
      dictRemoveFile: "",
      dictRemoveFileConfirmation: null,
      dictMaxFilesExceeded: "You can not upload any more files."
    };
  
    var eventLogo = new Dropzone("div#eventLogo",{url:"./"});
    eventLogo.on("sending", function(file,xhr,formData) {
      formData.append("hoge", hogeParam);
    });
  }
  
  _addDropzone(false);

});

function _checkRowNumber(element,maxnum){
  $(function(){
    var tr = element.find('tbody tr');
    var child = $(tr).length;
    if(child > maxnum){
      element.find('.btn-add-row').hide();
      element.find('.btn-plug-row').hide();
    }else{
      element.find('.btn-add-row').show();
      element.find('tr:first-child .btn-plug-row').hide();
      element.find('.btn-plug-row').show();
    }
  });
}

function _addDropzone(id){
  jQuery(function($){
    if($('.myItem').length){
      var hogeParam = "hoge";
      // Dropzone設定
      Dropzone.autoDiscover = false;
      // Dropzoneフォームのidをキャメルケースで記述
      //Dropzone.options.myAwesomeDropzone = {};
      Dropzone.options.myItem = {
        url: "./",
        method: "post",
        withCredentials: false,
        parallelUploads: 1,
        uploadMultiple: false,
        maxFilesize: 1,
        paramName: "file",
        createImageThumbnails: true,
        maxThumbnailFilesize: 10,
        thumbnailWidth: 100,
        thumbnailHeight: 100,
        filesizeBase: 1000,
        maxFiles: 1,
        params: {},
        clickable: true,
        ignoreHiddenFiles: true,
        acceptedFiles: ".jpg,.jpeg,.png,.gif",
        acceptedMimeTypes: null,
        autoProcessQueue: true,
        autoQueue: true,
        addRemoveLinks: true,
        previewsContainer: null,
        hiddenInputContainer: "body",
        capture: null,
        renameFilename: null,
        dictDefaultMessage: "<span>【アイテム画像】</span><br>クリック or ドロップ",
        dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
        dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
        dictFileTooBig: "ファイルが大き過ぎます ({{filesize}}MB). 最大: {{maxFilesize}}MB.",
        dictInvalidFileType: "このタイプのファイルはアップロードできません。",
        dictResponseError: "Server responded with {{statusCode}} code.",
        dictCancelUpload: "Cancel upload",
        dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
        dictRemoveFile: "",
        dictRemoveFileConfirmation: null,
        dictMaxFilesExceeded: "You can not upload any more files."
      };
      var itemzone = 'div#myItem';
      if(id != false){
        itemzone = 'div#myItem-' + id;
      }
      var myDropzone = new Dropzone(itemzone,{url:"./"});
      myDropzone.on("sending", function(file,xhr,formData) {
        formData.append("hoge", hogeParam);
      });
    }
  });
}

function _texrareaAutoHeight(){
  var elements = document.getElementsByTagName('textarea');
  for(var i = 0; i < elements.length; i++){
    var ta = elements[i];
    //console.log(ta);
    ta.style.lineHeight = "20px";//init
    if(ta.value === ''){
      ta.style.height = "92px";//init
    }
    ta.addEventListener("input",function(evt){
      if(evt.target.scrollHeight > evt.target.offsetHeight){
        if(evt.target.scrollHeight > 92){
          evt.target.style.height = evt.target.scrollHeight + "px";
        }else{
          evt.target.style.height = 92 + "px";
        }
      }else{
        //console.log('2');
        if(evt.target.scrollHeight > 92){
          var height,lineHeight;
          while (true){
            height = Number(evt.target.style.height.split("px")[0]);
            lineHeight = Number(evt.target.style.lineHeight.split("px")[0]);
            evt.target.style.height = height - lineHeight + "px"; 
            if(evt.target.scrollHeight > evt.target.offsetHeight){
              evt.target.style.height = evt.target.scrollHeight + "px";
              break;
            }
          }
        }
      }
    });
  }
}
/*
jQuery(function($){
  $(window).load(function(){
    $('.dz-hidden-input').attr('name','avatar');
  });
})
*/