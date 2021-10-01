{{-- Formulario que permite modificar la informacion de contacto que se le muestra al usuario--}}
@extends('admin.layout')
@section('title')
    <div class="row">
        <div class="col-6">
            <h1 class="m-0">Modificar Información de contacto</h1>
        </div>
    </div>
@endsection
@section('content')

    @if (session('guardado'))
        <div class="alert alert-success col-12" role="alert">
            <i class="fas fa-check"></i> {{ session('guardado') }}
        </div>
    @elseif(session('fallo'))
        <div class="alert alert-danger col-12" role="alert">
            <i class="fas fa-times"></i> {{ session('fallo') }}
        </div>
    @endif
            <div class="card col-12 p-0">
                <!-- /.card-header -->
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputDireccion1">Dirección</label>
                            <input type="Direccion" class="form-control" id="exampleInputDireccion1" aria-describedby="DireccionHelp">
                            <small id="DireccionHelp" class="form-text text-muted">Calle, colonia, No. Ext., No. Int., C.P., Municipio, Ciudad</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTelefono1">Telefono</label>
                            <input type="Telefono" class="form-control" id="exampleInputTelefono1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputWhatsapp1">Whatsapp</label>
                            <input type="Whatsapp" class="form-control" id="exampleInputWhatsapp1">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
@endsection

@section("scripts")
<script>
    $('#btndelete').on('click', function() {
        let id = $(this).val();
        let decision = confirm("Seguro que desea eliminar este mensaje");
        if (decision) {
            $.ajax({
                type: 'POST',
                url: `/admin/eliminar-mensaje/${id}`,
                data: {
                    '_token': '{{csrf_token()}}',
                    'id': id,
                },
                success: function (data) {
                    alert("Producto eliminado");
                    location.replace("/admin/mensajes");
                },
                error: function () {
                
                }
            });
        }
    });

</script>
@endsection
