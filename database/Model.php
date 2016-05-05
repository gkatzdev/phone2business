<?php
/**
 * Created by Gabriela Katz
 */

namespace database;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomModel extends Model
{
    /** Get an user by id **/
    protected function getEmployeeById($userId)
    {
        $user = DB::table($this->table)
            ->where('id', '=', $userId)
            ->get();
        return $user;
    }

    /** Get all users **/
    protected function getEmployees()
    {
        $user = DB::table('users')
            ->get();
        return $user;
    }

    /** Get all companies **/
    protected function getCompanies(){
        $company = DB::table('company')
            ->get();
        return $company;
    }

    /** Get a company by id **/
    protected function getCompanyById($cpId){
        $company = DB::table($this->table)
            ->where('company.id','=',$cpId)
            ->get();
        return $company;
    }
}