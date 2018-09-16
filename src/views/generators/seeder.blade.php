<?php echo '<?php' ?>

use Tienrocker\ThProvinces\Provinces\Districts;
use Tienrocker\ThProvinces\Provinces\Geographies;
use Tienrocker\ThProvinces\Provinces\Provinces;
use Tienrocker\ThProvinces\Provinces\SubDistricts;
use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {

        if (Schema::hasTable(\Config::get('thprovinces.sub_districts_table')))
            DB::table(\Config::get('thprovinces.sub_districts_table'))->truncate();
        if (Schema::hasTable(\Config::get('thprovinces.districts_table')))
            DB::table(\Config::get('thprovinces.districts_table'))->truncate();
        if (Schema::hasTable(\Config::get('thprovinces.provinces_table')))
            DB::table(\Config::get('thprovinces.provinces_table'))->truncate();
        if (Schema::hasTable(\Config::get('thprovinces.geographies_table')))
            DB::table(\Config::get('thprovinces.geographies_table'))->truncate();

        // Get all of the geographies
        $provinces = (new Geographies())->getList();
        foreach ($provinces as $province) {
            DB::table(\Config::get('thprovinces.geographies_table'))->insert([
                'id' => $province['id'],
                'name' => $province['name'],
            ]);
        }

        // Get all of the provinces
        $provinces = (new Provinces())->getList();
        foreach ($provinces as $province) {
            DB::table(\Config::get('thprovinces.provinces_table'))->insert([
                'id' => $province['id'],
                'code' => $province['code'],
                'name_th' => $province['name_th'],
                'name_en' => $province['name_en'],
                'geography_id' => $province['geography_id']
            ]);
        }

        // Get all of the districts
        $provinces = (new Districts())->getList();
        foreach ($provinces as $province) {
            DB::table(\Config::get('thprovinces.districts_table'))->insert([
                'id' => $province['id'],
                'code' => $province['code'],
                'name_th' => $province['name_th'],
                'name_en' => $province['name_en'],
                'province_id' => $province['province_id']
            ]);
        }

        // Get all of the provinces
        $provinces = (new SubDistricts())->getList();
        foreach ($provinces as $province) {
            DB::table(\Config::get('thprovinces.sub_districts_table'))->insert([
                'id' => $province['id'],
                'zip_code' => $province['zip_code'],
                'name_th' => $province['name_th'],
                'name_en' => $province['name_en'],
                'district_id' => $province['amphure_id']
            ]);
        }
    }
}