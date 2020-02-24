@extends('layouts.main')
@section('contenido')

    <div class="container"> <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Listado de productos
                            <a href="{{ route('products.create') }}" class="btn btn-success btn-sm float-right">Nuevo producto</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        @if (session('info'))
                            <div class="alert alert-success">
                                {{ session('info') }}
                            </div>
                        @endif

                        <table class="table table-hover table-sm">
                            <thead>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Eliminar</th>
                                <th>Editar</th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>
                                        {{ $product->description }}
                                    </td>
                                    <td>
                                        {{ $product->price }}
                                    </td>
                                    <td>
                                        <a href="javascript: document.getElementById('delete-{{$product->id}}').submit()" class="btn btn-danger btn-sm">Eliminar</a>
                                        <form id="delete-{{$product->id}}" method="post" action="{{ route('products.destroy', $product->id) }}">
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <p>
                            Bienvenido {{ auth()->user()->name }}
                            <a href="javascript:document.getElementById('logout').submit()" class="btn btn-danger btn-sm float-right">Cerrar sesión</a>
                        </p>

                        <form action="{{ route('logout') }}" id="logout" style="display:none" method="post">
                            <!-- Executa el botó 'Cerrar sesión' -->
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection