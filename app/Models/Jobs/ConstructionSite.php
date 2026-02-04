<?php

namespace App\Models\Jobs;

use App\Models\WorkingDayRecordModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionSite extends Model
{
    use HasFactory;

    protected $table = 'construction_sites';

    protected $fillable = [
        'name',
        'street',
        'town',
        'start_date',
        'end_date',
        'job_description',
        'status',
    ];

    /**
     * Return a array of all the workday report ID's.
     * 
     * @return array 
     */
    public function getAllWdrID(): array
    {
        //TODO: change the model here
        $wdr = WorkingDayRecordModel::where('construction_site_id', $this->attributes['id'])->pluck('id')->toArray();
        return $wdr;
    }
}
