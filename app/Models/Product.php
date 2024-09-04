<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'author',
        'imageUrl',
        'category_id',
    ];

    protected $table = 'books';  // Substitua 'nova_tabela' pelo nome da nova tabela.


    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }
}
