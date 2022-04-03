<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesCompany extends Model
{
    use HasFactory;

    protected $table = 'sales_companies';
    protected $fillable = [
        'id',
        'company_logo',
        'company_id',
        'company_name',
        'language',
        'street_name',
        'street_number',
        'zip_code',
        'city',
        'country',
        'contact_person_first_name',
        'contact_person_last_name',
        'contact_person_email',
        'contact_person_phone_number',
        'is_api_lock_connection',
        'is_push_notification',
        'is_feedback_option',
        'accepted_payment_methods',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static function getData($params){
        $query = SalesCompany::query();
        if(isset($params['created_at']) && !empty($params['created_at'])){
            $query->where('sales_companies.created_at','>=',Carbon::parse($params['created_at'])->startOfDay());
        }

        if(isset($params['sales_company'])){
            $query->where('sales_companies.id',$params['sales_company']);
        }

        if(isset($params['city'])){
            $query->where('sales_companies.city',$params['city']);
        }

        if(isset($params['status'])){
            $query->where('sales_companies.status',$params['status']);
        }

        return $query;
    }
}
