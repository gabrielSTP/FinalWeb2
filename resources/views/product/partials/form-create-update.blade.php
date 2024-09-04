<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Título</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do livro"
            @if (isset($product->title)) value={{ $product->title }} @endif>
        @error('title')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="description" >Descrição:</label>
    <div class="col-sm-10">
        <textarea id="description" class="form-control" name="description" rows="4" cols="50"
            placeholder="Digite a descrição do livro"> @if (isset($product->description))
{{$product->description}}
@endif </textarea>
        @error('description')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="author">Autor:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="author" name="author"
            placeholder="Digite o autor do livro" 
            @if (isset($product->author)) value="{{ $product->author }}" @endif>
        @error('author')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="imageUrl">URL da capa do livro:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="imageUrl" name="imageUrl"
            placeholder="Digite a URL da capa do livro"
            @if (isset($product->imageUrl)) value="{{ $product->imageUrl }}" @endif>
        @error('imageUrl')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="category_id">Categoria:</label>
    <div class="col-sm-10">
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if (isset($produtc) and $category->id == $product->category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <div class="offset-sm-2 col-sm-10">
        <input type="submit" value="Enviar" name="submit" class="btn btn-primary" />
        <a href="{{ URL::previous() }}" class="ml-3 btn btn-primary"> Voltar </a>
    </div>
</div>
