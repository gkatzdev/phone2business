<?php
/**
 * Created by Gabriela Katz
 * Date: 05/05/2016
 */
namespace App;

use database\CustomModel as Model;

class Company extends Model
{

    protected $table      = 'company';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function listCompanies(){
        $company = $this->getCompanies();
        return $company;
    }

    public function getCompany($companyId){
        $company = $this->getCompanyById($companyId);
        return $company;
    }

    public function insertCompany($params){
        $company = $this->create($params);
        $company = (object)$company;

        return $company;
    }

    public function updateCompany($params, $companyId){
        $company = $this->find($companyId);

        $companyData = [
            'name' => $params['name']
        ];

        $company->update($companyData);
        $company = (object)$company;

        return $company;
    }

    public function deleteCompany($companyId){
        $company = $this->find($companyId);
        $company->delete($company);
        return $company;
    }
}
