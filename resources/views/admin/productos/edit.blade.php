@extends("admin.layout")
@section("content")
    <div class="card card-primary col-12 p-0">
        <div class="card-header">
            <h3 class="card-title">Modificar Servicio</h3>
        </div>
        <!-- form start -->
        <form action="{{url("/admin/actualizar-producto/".$producto->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="txtNombre">Nombre</label>
                    <input value="{{$producto->nombre}}" name="nombre" type="text" class="form-control" id="txtNombre">
                </div>
                <div class="form-group">
                    <label for="txtIntroduccion">Introduccion</label>
                    <textarea name="introduccion" id="introduccion" type="text" class="form-control" placeholder="Ingresa una introducción">{{$producto->introduccion}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Primera Imagen</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="imagen" type="file" class="custom-file-input" id="inputImagen">
                            <label class="custom-file-label" for="inputImagen">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtDescripcion">Descripción</label>
                    <textarea name="descripcion" type="text" class="form-control" id="descripcion" placeholder="Ingresa la descripción">{{$producto->descripcion}}</textarea>
                </div>
                <div class="form-group">
                    <label for="txtContenido">Contenido</label>
                    <textarea name="contenido" type="text" class="form-control" id="txtContenido" placeholder="Ingresa el contenido">{{$producto->contenido}}</textarea>
                </div>
                <div class="form-group">
                    <label for="txtDiferenciadores">Diferenciadores</label>
                    <textarea name="diferenciadores" type="text" class="form-control" id="txtDiferenciadores" placeholder="Ingresa el diferenciador">{{$producto->diferenciadores}}</textarea>
                </div>
                <div class="form-group">
                    <label for="listStatus">Status</label>
                    <select name="status" class="form-control selectpicker" id="listStatus" name="listStatus">
                         @if($producto->status==1)
                            <option selected value="1">Activo</option>
                            <option  value="0">Inactivo</option>
                        @else
                            <option value="1">Activo</option>
                            <option selected value="0">Inactivo</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="txtCarac_adic">Caracteristicas Adicionales</label>
                    <textarea name="carac_adi" type="text" class="form-control" id="carac_adi" placeholder="Ingresa caracteristicas adicionales">{{$producto->carac_adi}} </textarea>
                </div>
                <div class="form-group">
                    <label for="txtInfo_adi">Información Adicional</label>
                    <textarea name="info_adi" type="text" class="form-control" id="info_adi" placeholder="Ingresa el diferenciador">{{$producto->info_adi}}</textarea>
                </div>

                <div class="form-group">
                    <label for="listClasificacion">Clasificación</label>
                    <select name="clasificacion" class="form-control" data-live-search="true" id="listClasificacion" name="listClasificacion">
                        {{-- <option value="">Menu</option> --}}
                        @foreach($clasificaciones as $clasificacion)
                            <option value="{{$clasificacion->id}}" {{$clasificacion->id==$producto->clasficacion_id?'selected':''}}>{{$clasificacion->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Segunda Imagen</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="imagen2" type="file" class="custom-file-input" id="inputImagen">
                            <label class="custom-file-label" for="inputImagen">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Imagenes del Carrusel</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="imagenes[]" multiple type="file" class="custom-file-input" id="inputImagen">
                                <label class="custom-file-label" for="inputImagen">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Imagen Carrusel de Bienvenida</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="bienvenida" type="file" class="custom-file-input" id="inputImagen">
                                <label class="custom-file-label" for="inputImagen">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                        <div class="form-check text-center">
                            <input class="form-check-input" name="destacado" {{$imagenDestacada == true?'checked':'' }} type="checkbox" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Activar imagen
                            </label>
                        </div>
                    </div>
                </div>
                <!--<div class="form-check">
                       <input type="checkbox" class="form-check-input" id="exampleCheck1">
                       <label class="form-check-label" for="exampleCheck1">Check me out</label>
                   </div>-->
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary col-12">Modificar</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <script src="{{ asset('ckeditor/config.js') }}"></script>

    <script>
        CKEDITOR.replace('introduccion',{

        });
    </script>

    <script>
        CKEDITOR.replace('descripcion',{

        });
    </script>

    <script>
        CKEDITOR.replace('contenido',{

        });
    </script>

    <script>
        CKEDITOR.replace('diferenciadores',{

        });
    </script>

    <script>
        CKEDITOR.replace('carac_adi',{

        });
    </script>

    <script>
        CKEDITOR.replace('info_adi',{

        });
    </script>

    <script>
        CKEDITOR.replace('cont_extra',{

        });
    </script>
@endsection
