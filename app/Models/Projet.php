<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'description',
        'github_link',
        'image',
        'user_id',
    ];
    public function languages(){
        return $this->belongsToMany('App\Models\Language')->withPivot('created_at');
    }
    public function user(){
      return $this->belongsTo('App\Models\User');
    }
    public function getRouteKeyName()
      {
        return "id"; 
      }
}
