@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Listagem de Livros Cadastrados</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Gênero</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td scope="row">{{ $product->title }}</td>
                        <td scope="row">
                            <div style="max-width: 300px;">
                                @if(strlen($product->description) > 200)
                                    <span class="short-text">{{ \Illuminate\Support\Str::limit($product->description, 200) }}</span>
                                    <span class="full-text" style="display:none;">{{ $product->description }}</span>
                                    <a href="#" class="read-more">Ler mais</a>
                                @else
                                    {{ $product->description }}
                                @endif
                            </div>
                        </td>
                        <td scope="row">{{ $product->author }}</td>
                        <!-- <td scope="row">{{ $product->stock }}</td> -->
                        <td scope="row">@if(isset($product->category)) {{ $product->category->name }} @else - @endif</td>
                        <td scope="row"><a href="{{ route('products.show', $product->id) }}"> Mostrar</td>
                        @can('product-edit')
                            <td scope="row"><a href="{{ route('products.edit', $product->id) }}"> Editar</td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const readMoreLinks = document.querySelectorAll('.read-more');

            readMoreLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const shortText = this.previousElementSibling.previousElementSibling;
                    const fullText = this.previousElementSibling;

                    if (fullText.style.display === 'none') {
                        shortText.style.display = 'none';
                        fullText.style.display = 'inline';
                        this.textContent = 'Ler menos';
                    } else {
                        shortText.style.display = 'inline';
                        fullText.style.display = 'none';
                        this.textContent = 'Ler mais';
                    }
                });
            });
        });
    </script>
@endsection
