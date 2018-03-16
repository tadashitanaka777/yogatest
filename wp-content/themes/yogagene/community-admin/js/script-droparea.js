jQuery(function($){

    var dropArea = $(".dropArea");

    $(document).on("dragover",".dropArea", function(e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).css({'background':'#ff3399'});
    });
    $(document).on("dragleave",".dropArea", function(e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).css({'background':'#ffffff'});
    });
    
    $(document).on("drop",".dropArea", function(_e) {
        if( _e.originalEvent ){
            var e = _e.originalEvent;
        }
        e.stopPropagation();
        e.preventDefault();
        $(this).css({'background' : '#ffffff'});
        var fileInput = $(this).find('.fileInput');
        var dt = e.dataTransfer;
        var upload = dt.files;
        //var files = fileInput[0].files;
        //_preview($(this),upload);
        fileInput[0].files = upload;
    });
    
    //var input = dropArea.find('.fileInput');
    $(document).on("change",'.fileInput', function(_e) {
        if( _e.originalEvent ){
            var e = _e.originalEvent;
        }
        e.stopPropagation();
        e.preventDefault();
        //console.log(e);
        var fileInput = $(this);
        var upload = e.target.files;
        _preview($(this).closest('.dropArea'),upload);
        fileInput[0].files = upload;
    });
    
    $(document).on('click','.dropButton',function(){
        var dropArea = $(this).closest('.dropArea');
        var files = dropArea.find('.fileInput');
        var button = $(this).attr('data-value');
        var area = dropArea.children('.dropFile');
        var name = files.attr('name');
        var filtered_files = [];
        for (var i = 0; i < files[0].files.length; i++) {
            if(files[0].files[i].name != button){
                filtered_files.files[0].push(files[0].files[i]);
                console.log('rm');
            }
        }
        _preview(dropArea,filtered_files);
        var fileInput = dropArea.find('.fileInput');
        files[0].remove();
        area.append('<input type="file" class="fileInput" name="' + name + '" accept=".jpg,.jpeg,.png" caption="camera">');
        return false;
    });
    
    function _preview(element,upload){
        var preview = element.find('.dropView');
        preview.children('.dropImages').remove();
        preview.children('.dropButton').remove();
        for (var i = 0; i < upload.length; i++) {
            var value = upload[i].name;
            (function() {
                var fr = new FileReader();
                fr.onload = function() {
                    var div = document.createElement('div');
                    var img = document.createElement('img');
                    var button = document.createElement('button');
                    var icon = document.createElement('i');
                    div.setAttribute('class','dropImages portraito');
                    div.setAttribute('style','background-image:url('+fr.result+');');
                    //img.setAttribute('src', fr.result);
                    icon.setAttribute('class','fa fa-trash');
                    button.setAttribute('class','dropButton');
                    button.setAttribute('data-value',value);
                    button.appendChild(icon);
                    //div.appendChild(img);
                    //div.appendChild(button);
                    preview;
                    preview.append(button);
                    preview.append(div);
                };
                fr.readAsDataURL(upload[i]);
            })();
        }
        return;
    }
});