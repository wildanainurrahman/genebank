<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vegetable extends Model
{
    protected $guarded = ['id'];

    public function species(){
        return $this->belongsTo('App\Species');
    }

    public function attributes(){
        return $this->belongsToMany('App\Attribute')->withPivot('value');
    }

    public function characters(){
        $categories = \App\Category::getCategoryCharacters();

        return $this->belongsToMany('App\Attribute')->whereIn('category_id', $categories)->withPivot('value');
    }

    /**
     * Evaluations relatioship
     * @return Relationship
     */
    public function evaluations(){
        $categories = \App\Category::getEvaluationCharacters();

        return $this->belongsToMany('App\Attribute')->whereIn('category_id', $categories)->withPivot('value');
    }

    public function passport(){
        return $this->hasOne('App\Passport');
    }

    public function generatePIN()
    {
        return 'UGM'.str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Get characters collection based on category_id
     * @param  array  $categories array of category id
     * @return Collection
     */
    public function getCharacters($categories = [])
    {
        return $this->characters()->whereIn('category_id', $categories)->get();
    }
}
