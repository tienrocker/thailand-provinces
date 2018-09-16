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
        Schema::dropIfExists(\Config::get('thprovinces.sub_districts_table'));
        Schema::dropIfExists(\Config::get('thprovinces.districts_table'));
        Schema::dropIfExists(\Config::get('thprovinces.provinces_table'));
        Schema::dropIfExists(\Config::get('thprovinces.geographies_table'));

        // Creates the geographies table
        Schema::create(\Config::get('thprovinces.geographies_table'), function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name');
        });

        // Creates the provinces table
        Schema::create(\Config::get('thprovinces.provinces_table'), function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('code');
            $table->string('name_th');
            $table->string('name_en');
            $table->integer('geography_id');

            $table->foreign('geography_id')
                ->references('id')
                ->on(\Config::get('thprovinces.geographies_table'))
                ->onDelete('cascade');
        });

        // Creates the districts table
        Schema::create(\Config::get('thprovinces.districts_table'), function (Blueprint $table) {

            $table->integer('id')->primary();
            $table->integer('code');
            $table->string('name_th');
            $table->string('name_en');
            $table->integer('province_id');

            $table->foreign('province_id')
                ->references('id')
                ->on(\Config::get('thprovinces.provinces_table'))
                ->onDelete('cascade');
        });

        // Creates the sub districts table
        Schema::create(\Config::get('thprovinces.sub_districts_table'), function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('zip_code');
            $table->string('name_th');
            $table->string('name_en');
            $table->integer('district_id');

            $table->foreign('district_id')
                ->references('id')
                ->on(\Config::get('thprovinces.districts_table'))
                ->onDelete('cascade');
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