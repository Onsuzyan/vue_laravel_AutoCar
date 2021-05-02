<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleMakesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('make')->insert([
                array('name' => 'Acura' ,'code' => 'ACURA'),
                array('name' => 'Alfa Romeo' ,'code' => 'ALFA'),
                array('name' => 'AMC' ,'code' => 'AMC'),
                array('name' => 'Aston Martin' ,'code' => 'ASTON'),
                array('name' => 'Audi' ,'code' => 'AUDI'),
                array('name' => 'Avanti' ,'code' => 'AVANTI'),
                array('name' => 'Bentley' ,'code' => 'BENTL'),
                array('name' => 'BMW' ,'code' => 'BMW'),
                array('name' => 'Buick' ,'code' => 'BUICK'),
                array('name' => 'Cadillac' ,'code' => 'CAD'),
                array('name' => 'Chevrolet' ,'code' => 'CHEV'),
                array('name' => 'Chrysler' ,'code' => 'CHRY'),
                array('name' => 'Daewoo' ,'code' => 'DAEW'),
                array('name' => 'Daihatsu' ,'code' => 'DAIHAT'),
                array('name' => 'Datsun' ,'code' => 'DATSUN'),
                array('name' => 'DeLorean' ,'code' => 'DELOREAN'),
                array('name' => 'Dodge' ,'code' => 'DODGE'),
                array('name' => 'Eagle' ,'code' => 'EAGLE'),
                array('name' => 'Ferrari' ,'code' => 'FER'),
                array('name' => 'FIAT' ,'code' => 'FIAT'),
                array('name' => 'Fisker' ,'code' => 'FISK'),
                array('name' => 'Ford' ,'code' => 'FORD'),
                array('name' => 'Freightliner' ,'code' => 'FREIGHT'),
                array('name' => 'Geo' ,'code' => 'GEO'),
                array('name' => 'GMC' ,'code' => 'GMC'),
                array('name' => 'Honda' ,'code' => 'HONDA'),
                array('name' => 'HUMMER' ,'code' => 'AMGEN'),
                array('name' => 'Hyundai' ,'code' => 'HYUND'),
                array('name' => 'Infiniti' ,'code' => 'INFIN'),
                array('name' => 'Isuzu' ,'code' => 'ISU'),
                array('name' => 'Jaguar' ,'code' => 'JAG'),
                array('name' => 'Jeep' ,'code' => 'JEEP'),
                array('name' => 'Kia' ,'code' => 'KIA'),
                array('name' => 'Lamborghini' ,'code' => 'LAM'),
                array('name' => 'Lancia' ,'code' => 'LAN'),
                array('name' => 'Land Rover' ,'code' => 'ROV'),
                array('name' => 'Lexus' ,'code' => 'LEXUS'),
                array('name' => 'Lincoln' ,'code' => 'LINC'),
                array('name' => 'Lotus' ,'code' => 'LOTUS'),
                array('name' => 'Maserati' ,'code' => 'MAS'),
                array('name' => 'Maybach' ,'code' => 'MAYBACH'),
                array('name' => 'Mazda' ,'code' => 'MAZDA'),
                array('name' => 'McLaren' ,'code' => 'MCLAREN'),
                array('name' => 'Mercedes-Benz' ,'code' => 'MB'),
                array('name' => 'Mercury' ,'code' => 'MERC'),
                array('name' => 'Merkur' ,'code' => 'MERKUR'),
                array('name' => 'MINI' ,'code' => 'MINI'),
                array('name' => 'Mitsubishi' ,'code' => 'MIT'),
                array('name' => 'Nissan' ,'code' => 'NISSAN'),
                array('name' => 'Oldsmobile' ,'code' => 'OLDS'),
                array('name' => 'Peugeot' ,'code' => 'PEUG'),
                array('name' => 'Plymouth' ,'code' => 'PLYM'),
                array('name' => 'Pontiac' ,'code' => 'PONT'),
                array('name' => 'Porsche' ,'code' => 'POR'),
                array('name' => 'RAM' ,'code' => 'RAM'),
                array('name' => 'Renault' ,'code' => 'REN'),
                array('name' => 'Rolls-Royce' ,'code' => 'RR'),
                array('name' => 'Saab' ,'code' => 'SAAB'),
                array('name' => 'Saturn' ,'code' => 'SATURN'),
                array('name' => 'Scion' ,'code' => 'SCION'),
                array('name' => 'smart' ,'code' => 'SMART'),
                array('name' => 'SRT' ,'code' => 'SRT'),
                array('name' => 'Sterling' ,'code' => 'STERL'),
                array('name' => 'Subaru' ,'code' => 'SUB'),
                array('name' => 'Suzuki' ,'code' => 'SUZUKI'),
                array('name' => 'Tesla' ,'code' => 'TESLA'),
                array('name' => 'Toyota' ,'code' => 'TOYOTA'),
                array('name' => 'Triumph' ,'code' => 'TRI'),
                array('name' => 'Volkswagen' ,'code' => 'VOLKS'),
                array('name' => 'Volvo' ,'code' => 'VOLVO'),
                array('name' => 'Yugo' ,'code' => 'YUGO'),
        ]);
    }
}
