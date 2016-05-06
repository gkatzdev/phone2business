<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name' => 'Teste Empresa 1', 'company_id' => 1],
            [ 'name' => 'Teste Empresa 2', 'company_id' => 5],
            [ 'name' => 'Teste Empresa 3', 'company_id' => 2],
            [ 'name' => 'Teste Empresa 4', 'company_id' => 8],
            [ 'name' => 'Teste Empresa 5', 'company_id' => 3],
            [ 'name' => 'Teste Empresa 6', 'company_id' => 10],
            [ 'name' => 'Teste Empresa 7', 'company_id' => 4],
            [ 'name' => 'Teste Empresa 8', 'company_id' => 6],
            [ 'name' => 'Teste Empresa 9', 'company_id' => 7],
            [ 'name' => 'Teste Empresa 10', 'company_id' => 9]
        ];

        DB::table('employee')->insert($data);
    }
}
