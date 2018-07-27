<?php

namespace App\Http\Controllers;

/**
 * Import the models that we need in this controller
 */
use App\Astreinte;
use App\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;


class AstreinteController extends Controller
{
    /**
     * Get "Astreintes" of the whole service
     * @return response json
     * Only the manager access there
     */
    public function getAstreinteForManager()
    {
        if(Auth::user()->user_type_id == 3):
            $astreintes = Astreinte::getAstreintes()->toArray();
            foreach($astreintes as $key=>$astreinte):
                $users = User::select('users.id', 'users.lastname', 'users.firstname', 'users.picture_profil')
                    ->join('astreintes', 'astreintes.user_id', 'users.id')
                    ->where('astreintes.user_id', $astreinte['astreinte_user_id'])
                    ->groupBy('users.id')
                    ->get();
                $astreintes[$key]['user'] = $users;
            endforeach;

            return response::json($astreintes);
        else:
            return response::json(['Error'=>'You are not a manager']);
        endif;
    }

    /**
     * Get "Astreintes" of one agent by the agentId
     * @param agentId
     * @return response json
     * Only the manager access there
     */
    public function getAstreinteByAgentId($agentId)
    {
        if(Auth::user()->user_type_id == 2):
            $astreintes = Astreinte::getAstreinteByAgentId($agentId)->toArray();
            foreach($astreintes as $key=>$astreinte):
                $users = User::select('users.id', 'users.lastname', 'users.firstname', 'users.picture_profil')
                    ->join('astreintes', 'astreintes.user_id', 'users.id')
                    ->where('astreintes.user_id', $astreinte['astreinte_user_id'])
                    ->groupBy('users.id')
                    ->get();
                $astreintes[$key]['user'] = $users;
            endforeach;

            return response::json($astreintes);
        else:
            return response::json(['Error'=>'You are not a manager']);
        endif;
    }
}
