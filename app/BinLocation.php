<?php

namespace App;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;

class BinLocation extends Model
{
    public function saveLocation(Request $request)
    {  
	    $this->part_id = $request->input("partId");
	    $this->qty = $request->input("qty");
	    $this->binlocation = $request->input('binLocation');
		$this->warehouse = $request->input('warehouse');
		$this->save();
    }
}
