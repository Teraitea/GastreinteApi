<?php

namespace App;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Database\Eloquent\Model;

class Astreinte extends Model
{
    protected $fillable = [
        'user_id',
        'type_astreinte_id',
        'status_astreinte_id',
        'start_at_date',
        'end_at_date',
        'start_at_time',
        'end_at_time'

    ];

    public static function getAstreintes()
    {
        return Astreinte::select(
                    'astreintes.id as astreinte_id',
                    'astreintes.user_id as astreinte_user_id',
                    'astreintes.type_astreinte_id as astreinte_type_astreinte_id',
                    'astreintes.status_astreinte_id as astreinte_status_astreinte_id',
                    'astreintes.start_at_date as astreinte_start_at_date',
                    'astreintes.end_at_date as astreinte_end_at_date',
                    'astreintes.start_at_time as astreinte_start_at_time',
                    'astreintes.end_at_time as astreinte_end_at_time'
                )
            ->get();
    }

    public static function getAstreinteByAgentId($agentId)
    {
        return Astreinte::select(
                    'astreintes.id as astreinte_id',
                    'astreintes.user_id as astreinte_user_id',
                    'astreintes.type_astreinte_id as astreinte_type_astreinte_id',
                    'astreintes.status_astreinte_id as astreinte_status_astreinte_id',
                    'astreintes.start_at_date as astreinte_start_at_date',
                    'astreintes.end_at_date as astreinte_end_at_date',
                    'astreintes.start_at_time as astreinte_start_at_time',
                    'astreintes.end_at_time as astreinte_end_at_time'
                )
            ->where('astreintes.user_id', $agentId)
            ->get();
    }

    public static function getAstreinteAuthUser()
    {
        return Astreinte::select(
                    'astreintes.id as astreinte_id',
                    'astreintes.user_id as astreinte_user_id',
                    'astreintes.type_astreinte_id as astreinte_type_astreinte_id',
                    'astreintes.status_astreinte_id as astreinte_status_astreinte_id',
                    'astreintes.start_at_date as astreinte_start_at_date',
                    'astreintes.end_at_date as astreinte_end_at_date',
                    'astreintes.start_at_time as astreinte_start_at_time',
                    'astreintes.end_at_time as astreinte_end_at_time'
                )
            ->where('astreintes.user_id', Auth::user()->id)
            ->get();
    }
}
