<?php
    require_once "./Controller/resourceController.php";
    $name = new resourceController();
    $counts = $name->count_resources($_SESSION['tipo_user']);
    $count = $counts->fetch();
    $materias = $name->curse($_SESSION['tipo_user']);
    $tipo = $name->tipo();
    //var_dump($count);
?>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <br>
                <div class="card">
                    <div class="card-body">
                        <h6>Operaicones</h6>
                        <ol class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="registro"><i class="icon-doc-add"></i> Registrar</a>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="publish"><i class="icon-publish text-success"></i> Publicados</a>
                                </div>
                                <span class="badge bg-primary rounded-pill"><?php echo $count[0]; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="observed"><i class="icon-eye text-warning"></i> Observados</a>
                                </div>
                                <span class="badge bg-primary rounded-pill"><?php echo $count[1]; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="pending"><i class="icon-clock text-info"></i> Pendientes</a>
                                </div>
                                <span class="badge bg-primary rounded-pill"><?php echo $count[2]; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <a href="removed"><i class="icon-doc-remove text-danger"></i> Removidos</a>
                                </div>
                                <span class="badge bg-primary rounded-pill"><?php echo $count[3]; ?></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <br>
                <div class="card">
                    <div class="card-body">
                        <h6>Registrar</h6>
                        <br>
                        <form action="<?php echo SERVERURL ?>Ajax/resourcesAjax.php" method="post" enctype="multipart/form-data" class="formAjax">
                            <div class="from-group">
                                <label for="file" class="formFile">Seleccione su archivo a publicar:</label> <!--<i class="icon-trash text-end" style="overflow_hidden;float:right;">Limpiar</i>-->
                                <div class="container-input">
                                    <input type="file" name="file-6" id="file-6" class="inputfile inputfile-6" data-multiple-caption="{count} archivos seleccionados" multiple />
                                    <label for="file-6">
                                    <figure>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                                    </figure>
                                    <span class="iborrainputfile"></span>
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Titulo del archivo:</label>
                                        <input type="text" name="nombre_file" id="nombre_file" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Tema del archivo:</label>
                                        <select name="tipo" id="tipo" class="form-select">
                                            <?php while($type = $tipo->fetch()){ ?>
                                                <option value="<?php echo $type[0] ;?>"><?php echo $type[0] ;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Formato del documento:</label>
                                        <select name="formato" id="formato" class="form-select">
                                            <option value="Pdf">PDF</option>
                                            <option value="Docx">DOCX</option>
                                            <option value="xlsx">XLSX</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Fecha de subida:</label>
                                        <input type="text" name="fecha_s" id="fecha_s" id="disabledTextInput" readonly value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Materia:</label>
                                        <select name="curso" class="form-select" id="curso">
                                            <?php while($materia = $materias->fetch()){ 
                                                        if(substr($_SESSION['tipo_user'],0,2) == "AL"){
                                                        ?>
                                                <option value="<?php echo $materia[1] ;?>"><?php echo $materia[0] ;?></option>
                                            <?php 
                                            }else{ ?>
                                                <option value="<?php echo $materia[0] ;?>"><?php echo $materia[0] ;?></option>
                                            <?php } 
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="text" name="codigo" id="codigo" value="<?php echo $_SESSION['tipo_user']; ?>" readonly style="display:none" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Descripcion del Archivo:</label>
                                <textarea name="decrip_file" id="descrip_file" class="form-control"></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-success"><i class="icon-upload"></i> Subir</button>
                            </div>
                        </form>
                        <div class="RespuestaAjax"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    /**********File Inputs**********/
.container-input {
    text-align: center;
    background: #b58fff;
    border-top: 5px solid #cfb9ff;
    padding: 50px 0;
    border-radius: 6px;
    margin: 0 auto;
    margin-bottom: 20px;
    background-image: url('View/scripts/img/pattren-top.png');
    background-size: cover;
}

.inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}

.inputfile + label {
    max-width: 80%;
    font-size: 1.25rem;
    font-weight: 700;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    display: inline-block;
    overflow: hidden;
    padding: 0.625rem 1.25rem;
}

.inputfile + label svg {
    width: 1em;
    height: 1em;
    vertical-align: middle;
    fill: currentColor;
    margin-top: -0.25em;
    margin-right: 0.25em;
}

.iborrainputfile {
	font-size:16px; 
	font-weight:normal;
	font-family: 'Lato';
}
    .inputfile-6 + label {
    color: #fff;
}

.inputfile-6:focus + label,
.inputfile-6.has-focus + label,
.inputfile-6 + label:hover {
    color: #fff;
}

.inputfile-6 + label figure {
    width: 100px;
    height: 135px;
    background-color: #9678d0;
    display: block;
    position: relative;
    padding: 30px;
    margin: 0 auto 10px;
}

.inputfile-6:focus + label figure,
.inputfile-6.has-focus + label figure,
.inputfile-6 + label:hover figure {
    background-color: #a793ce;
}

.inputfile-6 + label figure::before,
.inputfile-6 + label figure::after {
    width: 0;
    height: 0;
    content: '';
    position: absolute;
    top: 0;
    right: 0;
}

.inputfile-6 + label figure::before {
    border-top: 20px solid #e8ddff;
    border-left: 20px solid transparent;
}

.inputfile-6 + label figure::after {
    border-bottom: 20px solid #886cbd;
    border-right: 20px solid transparent;
}

.inputfile-6:focus + label figure::after,
.inputfile-6.has-focus + label figure::after,
.inputfile-6 + label:hover figure::after {
    border-bottom-color: #7c60b4;
}

.inputfile-6 + label svg {
    width: 100%;
    height: 100%;
    fill: #fff;
}

</style>
<script>
    'use strict';

;( function ( document, window, index )
{
	var inputs = document.querySelectorAll( '.inputfile' );
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			if( this.files && this.files.length > 1 ){
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			}else{
				fileName = e.target.value.split( '\\' ).pop();

			} 
            var contador = fileName.length;
            if(fileName.substring(contador,contador-4) == ".PDF" || fileName.substring(contador,contador-4) == ".pdf" || fileName.substring(contador,contador-4) == "docx" || fileName.substring(contador,contador-4) == "xlsx"){
                console.log("formato Correcto");
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: '!Formato de documento no permitido¡',
                    text: 'Los unicos Formatos permitidos son ".PDF",".Docx",".Xlsx" porfavor Selecciona un archivo con formato permitido',
                    showConfirmButton: true,
                });
            }
            if( fileName ){
				label.querySelector( 'span' ).innerHTML = fileName;
                
			}else{
				label.innerHTML = labelVal;
            }
		}
        
        );
	}
    );
}( document, window, 0 ));
</script>