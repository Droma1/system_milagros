$(document).ready(function(){
    $('#btn-menu').click(function(){
            $('.offcanvas-end').css('transform','none'); 
    });
    $('.btn-close-menu').click(function(){
        $('.offcanvas-end').css('transform','TranslateX(100%)');
    });
    $('#check').click(function(){
        var check = $('input:checkbox[name=check]:checked').val()
        console.log($('input:checkbox[name=check]:checked').val());
        if(check == 'on'){
            $('#contra').attr('type','text');
            $('#text-eye').html("Ocultar Contraseña");
        }else{
            $('#contra').attr('type','password');
            $('#text-eye').html("Mostrar Contraseña");
        }
    });
    $('.formAjax').submit(function(e){
        e.preventDefault();
    console.log("ejecutandose");
        var form=$(this);
    
        var tipo=form.attr('data-form');
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var respuesta=form.children('.RespuestaAjax');
    
        var msjError="<script>alert('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
        var formdata = new FormData(this);
    
    
        var textoAlerta;
        if(tipo==="save"){
            textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
        }else if(tipo==="delete"){
            textoAlerta="Los datos serán eliminados completamente del sistema";
        }else if(tipo==="update"){
            textoAlerta="Los datos del sistema serán actualizados";
        }else{
            textoAlerta="Quieres realizar la operación solicitada";
        }
    
        $.ajax({
                type: metodo,
                url: accion,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                xhr: function(){
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
                            respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                            respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    console.log(data);
                    respuesta.html(data);
                },
                error: function() {
                    respuesta.html(msjError);
                }
            });
            console.log(respuesta);
            
    
    });
    $(".filtrar").click(function(){

    });
});
