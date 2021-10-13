<?php
namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use App\Models\User;
use Carbon\Carbon;

class UserEloquentRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    //  Get the number of registered members
    public function getNumberMemberReg()
    {
        $users = $this->_model->select('id', 'created_at')
            ->get()
            ->groupBy(function($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $userMonthCount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $userMonthCount[(int)$key] = count($value);
        }
        $monthCurrent = date('n');
        for ($i = 1; $i <= 12; $i++) {
            if ($i <= $monthCurrent) {
                if (!empty($userMonthCount[$i])) {
                    $userArr[$i] = $userMonthCount[$i];
                } else {
                    $userArr[$i] = 0;
                }
            }
        }

        return $userArr;
    }

    public function getTotalUsers()
    {
        return $this->_model->select('id')->count();
    }
}
