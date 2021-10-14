@extends('admin.layout')
@section('title')
    <div class="row">
        <div class="col-6">
            <h1 class="m-0">Servicios</h1>
        </div>
        <div class="col-6 text-right">
            <a class="btn btn-primary" href="{{route('productos.create')}}" id="create-producto"> <i class="fas fa-plus"></i> Crear un nuevo servicio</a>
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
                    <table id="productos-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Status</th>
                            <th>Slug</th>
                            <th>Padre</th>

                            <th class="text-center">Editar</th>
                            <th class="text-center">Eliminar</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($productos as $producto)
                            @if($producto->id != 1)
                                <tr>
                                    <td>{{$producto->id}}</td>
                                    <td>{{$producto->nombre}}</td>
                                    <td>{{$producto->status_string}}</td>
                                    <td>{{$producto->slug}}</td>
                                    @if($producto->padre)
                                    <td>{{$producto->padre->nombre}}</td>
                                    @else
                                        <td>Menu</td>
                                    @endif

                                    <td class="text-center"><a href="{{url("/admin/editar-productos/".$producto->id)}}" class="btn btn-secondary"><i class="fas fa-pencil-alt"></i></a></td>
                                    <td class="text-center"><button value="{{$producto->id}}" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></button></td>
                                </tr>
                            @endif
                        @endforeach

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
@endsection

@section("scripts")
<script>
    $('#productos-table').on('click', '.delete', function() {
        var id = $(this).val();
        var desicion = confirm("Seguro que desea eliminar este producto");
        if (desicion) {
            $.ajax({
                type: 'POST',
                url: "/admin/eliminar-producto/" + id,
                data: {
                    '_token': '{{csrf_token()}}',
                    'id': id,
                },
                success: function (data) {
                    alert("Producto eliminado");
                    location.reload();

                },
                error: function () {
                }
            });
        }
    });
</script>
@endsection
