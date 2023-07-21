<div>
    @if (session('info'))
        <div class="alert alert-primary" role="alert">
            <strong>¡Éxito!</strong>
            {{ session('info') }}
        </div>
    @endif
    <div class="card">

        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('cuota.create') }}">NUEVA CUOTA</a>
        </div>

        @if ($cuotas->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>Descripcion</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cuotas as $cuota)
                            <tr>

                                <td>
                                    {{ $cuota->descripcion }}
                                </td>
                                <td>
                                    {{ $cuota->fecha }}
                                </td>
                                <td>
                                   BS. {{ $cuota->monto }}
                                </td>
                                {{-- para que el boton quede pegado a la derecha->width=10px --}}
                                <td width="10px">
                                    <a class="btn btn-primary"
                                        href="{{ route('cuota.edit', $cuota) }}">Editar/Ver</a>
                                </td>
                                <td width="10px">
                                    {{-- el form es necesario para cuando queremos eliminar por eso no pusimos la etiqueta <a href=""></a> --}}
                                    <form action="{{ route('cuota.destroy', $cuota) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $cuotas->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>
</div>
