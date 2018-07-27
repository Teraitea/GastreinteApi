<?php

namespace App\Http\Controllers;

/**
 * Import the models that we need in this controller
 */
use App\User;
use App\Astreinte;
use App\StatusAstreinte;

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
        if(Auth::user()->user_type_id == 2):
            $astreintes = Astreinte::getAstreintes()->toArray();
            foreach($astreintes as $key=>$astreinte):
                $users = User::select('users.id', 'users.lastname', 'users.firstname', 'users.picture_profil')
                    ->join('astreintes', 'astreintes.user_id', 'users.id')
                    ->where('astreintes.user_id', $astreinte['astreinte_user_id'])
                    ->groupBy('users.id')
                    ->get();

                $status = StatusAstreinte::select('status_astreintes.id','status_astreintes.name')
                    ->join('astreintes', 'astreintes.status_astreinte_id', 'status_astreintes.id')
                    ->where('astreintes.user_id', $astreinte['astreinte_user_id'])
                    ->groupBy('status_astreintes.id')
                    ->get();

                $astreintes[$key]['status'] = $status;
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

                $status = StatusAstreinte::select('status_astreintes.id','status_astreintes.name')
                    ->join('astreintes', 'astreintes.status_astreinte_id', 'status_astreintes.id')
                    ->where('astreintes.user_id', $astreinte['astreinte_user_id'])
                    ->groupBy('status_astreintes.id')
                    ->get();

                $astreintes[$key]['status'] = $status;
                $astreintes[$key]['user'] = $users;
            endforeach;

            return response::json($astreintes);
        else:
            return response::json(['Error'=>'You are not a manager']);
        endif;
    }

    /**
     * Validate or refuse astreinte of an agent by his id
     * @param astreinteId, agentId
     * @return response json
     * Only the manager access there 
     */
    public function validateAstreinte(Request $request, $astreinteId, $agentId)
    {
        if(Auth::user()->user_type_id == 2):
            $statusAstreinteUpdate = Astreinte::where('id', $astreinteId)->update(['status_astreinte_id' => $request->input('status')]);
            if($statusAstreinteUpdate): 
                return response::json('Update success');
            endif;
        else:
            return response::json(['Error'=>'You are not a manager']);
        endif;
    }

    /**
     * Get connected user's Astreinte
     */

    public function getAuthUserAstreintes()
    {
        $astreintes = Astreinte::getAstreinteAuthUser()->toArray();
        foreach($astreintes as $key=>$astreinte):
            $users = User::select('users.id', 'users.lastname', 'users.firstname', 'users.picture_profil')
                ->join('astreintes', 'astreintes.user_id', 'users.id')
                ->where('astreintes.user_id', $astreinte['astreinte_user_id'])
                ->groupBy('users.id')
                ->get();

            $status = StatusAstreinte::select('status_astreintes.id','status_astreintes.name')
                ->join('astreintes', 'astreintes.status_astreinte_id', 'status_astreintes.id')
                ->where('astreintes.user_id', $astreinte['astreinte_user_id'])
                ->groupBy('status_astreintes.id')
                ->get();
                
            $astreintes[$key]['user'] = $users;
            $astreintes[$key]['status'] = $status;
        endforeach;

        return response::json($astreintes);
    }

}
