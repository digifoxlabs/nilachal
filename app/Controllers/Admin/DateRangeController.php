<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\AdminController;
use App\Models\DateRangeModel;
use CodeIgniter\API\ResponseTrait;

class DateRangeController extends AdminController
{

    use ResponseTrait;
    public function getDisabledOfflineDates()
    {
      
            $model = new DateRangeModel();
            $disabledDates = $model->getDisabledDates('offline');
    
           // return $this->respond(['disabledDates' => $disabledDates]);

            return $this->response->setJSON([
                'status' => 'success',
                'disabledDates' => $disabledDates
            ]);
    }


    
}
