<?php

class Student extends \Eloquent {
	protected $fillable = [];


    public function homeworks()
    {
        return $this->belongsToMany('Homework');
    }
}