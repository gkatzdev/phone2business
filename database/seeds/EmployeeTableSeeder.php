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
            [ 'name' => 'Teste Colaborador 1', 'company_id' => 1],
            [ 'name' => 'Teste Colaborador 2', 'company_id' => 5],
            [ 'name' => 'Teste Colaborador 3', 'company_id' => 2],
            [ 'name' => 'Teste Colaborador 4', 'company_id' => 8],
            [ 'name' => 'Teste Colaborador 5', 'company_id' => 3],
            [ 'name' => 'Teste Colaborador 6', 'company_id' => 10],
            [ 'name' => 'Teste Colaborador 7', 'company_id' => 4],
            [ 'name' => 'Teste Colaborador 8', 'company_id' => 6],
            [ 'name' => 'Teste Colaborador 9', 'company_id' => 7],
            [ 'name' => 'Teste Colaborador 10', 'company_id' => 9]
        ];

        DB::table('employee')->insert($data);
    }
}
