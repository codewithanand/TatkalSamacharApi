<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Article;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'file_path',
        'file_type'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }
}
