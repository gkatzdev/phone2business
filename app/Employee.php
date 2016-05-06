<?php
/**
 * Created by Gabriela Katz
 * Date: 05/05/2016
 */
namespace App;

use database\CustomModel as Model;

class Employee extends Model
{

    protected $table      = 'employee';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function listEmployees(){
        $employee = $this->getEmployees();
        return $employee;
    }

    public function getEmployee($employeeId){
        $employee = $this->getEmployeeById($employeeId);
        return $employee;
    }

    public function insertEmployee($params){
        $employee = $this->create($params);
        $employee = (object)$employee;

        return $employee;
    }

    public function updateEmployee($params, $employeeId){
        $employee = $this->find($employeeId);
        $companyId = $params['company_id'];

        $data = [
            'company_id' => $companyId,
            'name' => $params['name']
        ];

        $employee->update($data);
        $employee = (object)$employee;

        return $employee;
    }

    public function deleteEmployee($employeeId){
        $employee = $this->find($employeeId);
        $employee->delete($employee);
        return $employee;
    }
}
