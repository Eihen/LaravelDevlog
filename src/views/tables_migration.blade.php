<?php echo "<?php\n" ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DevlogSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @ return void
     */
    public function up()
    {
        // Create table for storing versions
        Schema::create('{{ $devlog['versions']['table'] }}', function (Blueprint $table) {
            $table->increments('{{ $devlog['versions']['id'] }}');
            // Version code, using Semantic Versioning (semver.org) is recommended
            $table->string('{{ $devlog['versions']['code'] }}', {{ $devlog['versions']['code_size'] }})->unique();
            $table->string('{{ $devlog['versions']['description'] }}', {{ $devlog['versions']['description_size'] }})->nullable();
            $table->date('{{ $devlog['versions']['release_date'] }}');
@if ($devlog['versions']['timestamps?'])
            $table->timestamps();
@endif
        });

        // Create table for storing changes
        Schema::create('{{ $devlog['changes']['table'] }}', function (Blueprint $table) {
            $table->increments('{{ $devlog['changes']['id'] }}');
            $table->unsignedInteger('{{ $devlog['changes']['version_id'] }}');
            $table->string('{{ $devlog['changes']['description'] }}', {{ $devlog['changes']['description_size'] }}); // Description of the change
@if ($devlog['changes']['timestamps?'])
            $table->timestamps();
@endif

            $table->foreign('{{ $devlog['changes']['version_id'] }}')->references('{{ $devlog['versions']['id'] }}')
                ->on('{{ $devlog['versions']['table'] }}')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('{{ $devlog['changes']['table'] }}');
        Schema::dropIfExists('{{ $devlog['versions']['table'] }}');
    }
}
