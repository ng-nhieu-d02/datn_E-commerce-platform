<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CommentProduct extends Model
{
    use HasFactory;

    protected $table = 'comment_product';
    protected $fillable = [
        'create_by',
        'id_store',
        'id_product',
        'message',
        'rate',
        'derImg',
        'parent_id',
        'parent_path'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }

    public function commentParent($parent)
    {
        return $this->hasMany(CommentProduct::class, 'parent_id')->where('parent_id',$parent)->get();
    }

    protected function getDateTimeAttribute()
    {
        return date("d-m-Y", strtotime($this->created_at));
    }
}
