<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'path_img',
        'theme',
        'section_id', 
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function section() 
    {
        return $this->belongsTo(Section::class, 'section_id'); 
    }      
    
}
