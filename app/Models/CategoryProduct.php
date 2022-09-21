<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $table = 'category_product';

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id')->where('status', 0)->withDefault();
    }

    public function recursive($category, $parents = 0, $level = 1, &$listCategory)
    {
        if(count($category) > 0) {
            foreach($category as $key => $value) {
                if($value->parent_id == $parents) {
                    $value->level = $level;
                    $listCategory[] = $value;
                    unset($category[$key]);
                    $parent = $value->id;
                    self::recursive($category,$parent,$level + 1, $listCategory);
                }
            }
        }
    }
}
