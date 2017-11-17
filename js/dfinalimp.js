/*$(document).ready(function() {
    $("#formCSV").submit(function () {
        var formData = new FormData(this);
        
        $.ajax({
            url: window.location.pathname,
            type: 'POST',
            data: formData,
            success: function (data) {
                alert(data);
            },
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();

                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        $("#cmdImportar").prop("visible", false);
                        $("#divCarregando").prop("display", "block");
                    }, false);
                }

                $("#cmdImportar").prop("visible", true);
                $("#divCarregando").prop("display", "none");

                return myXhr;
            }
        }); 
    });
}); */