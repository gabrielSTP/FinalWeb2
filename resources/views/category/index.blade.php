@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Listagem de Gêneros Cadastrados</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td scope="row">{{ $category->name }}</td>
                        <td scope="row">{{ $category->description }}</td>
                        <td scope="row"><a href="{{ route('category.show', $category->id) }}"> Mostrar</td>
                        @role('Administrator')
                            <td scope="row"><a href="{{ route('category.edit', $category->id) }}"> Editar</td>
                        @endrole
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
