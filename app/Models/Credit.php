<?php

namespace App\Models;

use App\Scopes\SkipDeletedRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'status', 'total_credits'];

    public function getStatusAttribute($key){
        return ucwords($key);
    }
  
    protected static function booted()
    {
        static::addGlobalScope(new SkipDeletedRecord);
    }
}
