<?php echo '<?php' ?>

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_item', function(Blueprint $table) {

            $table->timestamps();
            $table->increments('id');
            $table->text('params');
            $table->text('body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('content_item');
    }
}
