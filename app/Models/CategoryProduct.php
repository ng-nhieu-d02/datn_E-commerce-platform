<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $table = 'category_product';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'path',
        'create_by',
        'avatar',
        'title',
        'keyword',
        'status'
    ];

    public static function boot()
    {
        parent::boot();
    
        static::deleting(function ($category) {
            unlink('upload/category/'.$category->avatar);         
        });
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id')->where('status', 0)->withDefault();
    }

    public function recursive($category, $parents = 0, $level = 1, &$listCategory)
    {
        if (count($category) > 0) {
            foreach ($category as $key => $value) {
                if ($value->parent_id == $parents) {
                    $value->level = $level;
                    $listCategory[] = $value;
                    unset($category[$key]);
                    $parent = $value->id;
                    $this->recursive($category, $parent, $level + 1, $listCategory);
                }
            }
        }
    }
    public function recursive_parent($id)
    {
        return CategoryProduct::where('parent_id', $id)->count();
    }
}
