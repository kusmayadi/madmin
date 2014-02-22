<?php defined('SYSPATH') OR die('No direct script access.');

class Cobacobi_ORM extends Kohana_ORM {

  protected $_slug_name = 'slug';

  protected function slug_name()
  {
    return $this->_slug_name;
  }

  protected function create_slug($name)
  {
    $slug = strtolower($name);
    $slug = preg_replace('/[\W|_]+/', ' ', $slug);
    $slug = trim($slug);
    $slug = preg_replace('/[\s]+/', '-', $slug);

    $model = ORM::factory($this->object_name())->where($this->slug_name(), '=', $slug)->find();

    if ($model->loaded())
    {
      if ($this->id > 0)
      {
        $slug .= '-'.$this->id;
      }
      else
      {
        $slug .= '-'.rand(1,100);
      }

      return $this->create_slug($slug);
    }
    else
    {
      return $slug;
    }
  }
}
