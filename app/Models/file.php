<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class file extends Model
{
    use HasFactory;
    protected $fillable = [
        'filename',
        'content',
      'user_id',
      'group_id',
      'status',
      'downloads',
    ];

    public function user()
   {
       return $this->belongsTo(User::class);
   }

   public function group()
  {
      return $this->belongsTo(Group::class);
  }

  public function incrementDownloads()
   {
       $this->increment('downloads');
   }
}
