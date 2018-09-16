<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProvincesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Creates the geographies table
        Schema::create(\Config::get('thprovinces.geographies_table'), function (Blueprint $table) {
            $table->integer('id')->index();
            $table->string('name');

            $table->primary('id');
        });

        // Creates the provinces table
        Schema::create(\Config::get('thprovinces.provinces_table'), function (Blueprint $table) {
            $table->integer('id')->index();
            $table->unsignedInteger('code');
            $table->string('name_th');
            $table->string('name_en');
            $table->unsignedInteger('geography_id');

            $table->primary('id');
            $table->foreign('geography_id')->references('id')->on(\Config::get('thprovinces.geographies_table'));
        });

        // Creates the districts table
        Schema::create(\Config::get('thprovinces.districts_table'), function (Blueprint $table) {

            $table->integer('id')->index();
            $table->unsignedInteger('code');
            $table->string('name_th');
            $table->string('name_en');
            $table->unsignedInteger('province_id');

            $table->primary('id');
            $table->foreign('province_id')->references('id')->on(\Config::get('thprovinces.provinces_table'));
        });

        // Creates the sub districts table
        Schema::create(\Config::get('thprovinces.sub_districts_table'), function (Blueprint $table) {
            $table->integer('id')->index();
            $table->unsignedInteger('zip_code');
            $table->string('name_th');
            $table->string('name_en');
            $table->unsignedInteger('district_id');

            $table->primary('id');
            $table->foreign('district_id')->references('id')->on(\Config::get('thprovinces.districts_table'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop(\Config::get('thprovinces.sub_districts_table'));
        Schema::drop(\Config::get('thprovinces.districts_table'));
        Schema::drop(\Config::get('thprovinces.provinces_table'));
        Schema::drop(\Config::get('thprovinces.geographies_table'));
    }

}