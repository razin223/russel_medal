<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model {

    public function getSector() {
        return $this->belongsTo('App\Sector', 'sector_id', 'id');
    }

}
