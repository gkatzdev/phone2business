<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name' => 'Teste Empresa 1'],
            [ 'name' => 'Teste Empresa 2'],
            [ 'name' => 'Teste Empresa 3'],
            [ 'name' => 'Teste Empresa 4'],
            [ 'name' => 'Teste Empresa 5'],
            [ 'name' => 'Teste Empresa 6'],
            [ 'name' => 'Teste Empresa 7'],
            [ 'name' => 'Teste Empresa 8'],
            [ 'name' => 'Teste Empresa 9'],
            [ 'name' => 'Teste Empresa 10']
        ];

        DB::table('company')->insert($data);
    }
}
