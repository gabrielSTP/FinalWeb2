@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Gênero {{ $category->name }}</h1>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Nome do Gênero</label>
            <div class="col-sm-10">
                <input disabled type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do produto"
                    value={{ $category->name }}>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="description">Descrição:</label>
            <div class="col-sm-10">
                <textarea disabled id="description" class="form-control" name="description" rows="4" cols="50"
                    placeholder="Digite a descrição do produto"> {{ $category->description }} </textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <form action="{{ route('category.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" >Excluir</button>
                    <a href="{{ URL::previous() }}" class="ml-3 btn btn-primary"> Voltar </a>
                </form>
            </div>
        </div>
        <br>
        <h1>Livros do Gênero {{ $category->name }} Cadastrados</h1>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nome do Gênero</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Autor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category->products as $product)
                    <tr>
                        <td scope="row">{{ $product->title }}</td>
                        <td scope="row">{{ $product->description }}</td>
                        <td scope="row">{{ $product->author }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
