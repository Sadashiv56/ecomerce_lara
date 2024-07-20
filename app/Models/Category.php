<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class Category extends Model
{
    use HasFactory;
    public $table = "category";
    protected $fillable = [
        'name', 'slug','status'
    ];
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

}
