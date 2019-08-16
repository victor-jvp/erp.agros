<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PalletsModelTableSeeder::class);
        $this->call(AuxiliaresTableSeeder::class);
        $this->call(CajasTableSeeder::class);
        $this->call(CubresTableSeeder::class);
        $this->call(CultivosTableSeeder::class);
        $this->call(FincasTableSeeder::class);
        $this->call(MarcasTableSeeder::class);
        $this->call(PalletsTableSeeder::class);
        $this->call(ParcelasTableSeeder::class);
        $this->call(VariedadesTableSeeder::class);
        $this->call(TarrinasTableSeeder::class);
        $this->call(ProductosCompuestos_cabTableSeeder::class);
        $this->call(ContadoresTableSeeder::class);
    }
}
