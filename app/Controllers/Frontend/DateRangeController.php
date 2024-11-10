<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\FrontendController;
use App\Models\DateRangeModel;
use CodeIgniter\API\ResponseTrait;

class DateRangeController extends FrontendController
{

    use ResponseTrait;
    public function getDisabledOnlineDates()
    {
      
            $model = new DateRangeModel();
            $disabledDates = $model->getDisabledDates('online');
    
           // return $this->respond(['disabledDates' => $disabledDates]);

            return $this->response->setJSON([
                'status' => 'success',
                'disabledDates' => $disabledDates
            ]);
    }
}
