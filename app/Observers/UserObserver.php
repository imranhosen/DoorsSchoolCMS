<?php


namespace App\Observers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver{

   /* $userID;
    public function __construct($userID){
        $user = Auth::user();
        $this->userID = $user->getId();
    }*/

    public function saving($model)
    {
        $model->modfied_by = $this->userID;
    }

    public function saved($model)
    {
        $model->modfied_by = $this->userID;
    }


    public function updating($model)
    {
        $model->modfied_by = $this->userID;
    }

    public function updated($model)
    {
        $model->modfied_by = $this->userID;
    }


    public function creating($model)
    {
        $model->created_by = $this->userID;
    }

    public function created($model)
    {
        $model->created_by = $this->userID;
    }


    public function removing($model)
    {
        $model->purged_by = $this->userID;
    }

    public function removed($model)
    {
        $model->purged_by = $this->userID;
    }

}
