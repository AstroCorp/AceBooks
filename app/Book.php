<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    public function bookmarks()
    {
        return $this->hasMany('App\Bookmark');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function collection()
    {
        return $this->belongsTo('App\Collection');
    }

    public function setImage($image)
    {
        $imageName = Str::uuid().".".$image->getClientOriginalExtension();
        $image->move(public_path().'/images/books/', $imageName);

        $this->image = $imageName;
    }

    public function setPDF($file)
    {
        $fileName = Str::uuid().".".$file->getClientOriginalExtension();
        $file->move(public_path().'/books/', $fileName);

        $this->fileName = $fileName;
    }

    // Archivos eliminados, además desaparece de la base de datos
    public function remove()
    {
        if($this->image !== null)
        {
            unlink(public_path().'/images/books/'.$this->image);
        }

        unlink(public_path().'/books/'.$this->filename);

        $this->bookmarks()->each(function($bookmark, $key)
        {
            $bookmark->delete();
        });

        $this->delete();
    }
}
