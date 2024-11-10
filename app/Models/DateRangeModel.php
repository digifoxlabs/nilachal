<?php

namespace App\Models;

use CodeIgniter\Model;

class DateRangeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'disable_date_ranges';
    protected $primaryKey       = 'date_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'date_id',
        'disable_category',
        'date_type',
        'single_date',
        'start_date',
        'end_date',
        'description',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    /**
     * Get all disabled dates in a format suitable for JavaScript.
     */
    public function getDisabledDates($cat)
    {
        $dates = [];

        foreach ($this->where('disable_category',$cat)->findAll() as $row) {
            if ($row['date_type'] === 'single' && $row['single_date']) {
                $dates[] = $row['single_date'];
            } elseif ($row['date_type'] === 'range' && $row['start_date'] && $row['end_date']) {
                $start = new \DateTime($row['start_date']);
                $end = new \DateTime($row['end_date']);
                
                while ($start <= $end) {
                    $dates[] = $start->format('Y-m-d');
                    $start->modify('+1 day');
                }
            }
        }

        return $dates;
    }
}
