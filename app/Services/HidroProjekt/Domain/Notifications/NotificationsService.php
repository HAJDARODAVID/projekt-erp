<?php

namespace App\Services\HidroProjekt\Domain\Notifications;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\NotificationSeen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NotificationsService{

    private $user;
    private $allNotifs;
    private $userRights;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->userRights = $this->canSeeNotifications();
    }

    private function canSeeNotifications(){
        $userRights = Session::get('user_rights');
        $notifeUserRights = [];
        if(is_array($userRights)){
            foreach($userRights as $key => $right){
                if (str_starts_with($right, 'sys-notif-')) {
                    $notifeUserRights[] = str_replace('sys-notif-', '', $right);
                }
            }
        }
        return $this->userRights = $notifeUserRights;
    }

    public function getAllNotifications(){
        $seenNotifs = NotificationSeen::where('user_id', $this->user->id)->pluck('notife_id')->toArray();
        $this->allNotifs = Notifications::whereIn('type', $this->userRights)->whereNotIn('id',$seenNotifs)->get();
        return $this;
    }

    public function count(){
        return $this->allNotifs->count();
    }

    public function toArray(){
        $array=[];
        $i=1;
        foreach ($this->allNotifs as $notif) {
            $array[$i] = $notif;
            $i++;
        }
        return $array;
    }

    public function markAsSeen($id){
        NotificationSeen::create([
            'notife_id' => $id, 
            'user_id' => $this->user->id,
        ]);
        return;
    }

    public function createNewSysErrorNotification($e){
        if($this->user){
            $userName = User::where('id', $this->user->id)->with('getWorker', 'getCooperator')->first();
            $userName = !is_null($userName->getWorker) ? $userName->getWorker->fullName : $userName->getCooperator->fullName;
            $errorInfo = [
                'message' => $e->getMessage(),
                'file ' => $e->getFile() .' / at line: ' . $e->getLine(),
                'path' => request()->decodedPath(),
            ];
            return Notifications::create([
                'type' => Notifications::TYPE_SYS_ERROR,
                'message' => 'User: '.$userName.' has encountered the following error: ' .$e->getMessage(),
                'value' => json_encode($errorInfo),
            ]);
        }
        
    }
    
}