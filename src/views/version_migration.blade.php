<?php echo "<?php\n" ?>

use Illuminate\Database\Migrations\Migration;
use {{ $devlog['versions']['model'] }} as Version;
use {{ $devlog['changes']['model'] }} as Change;

class DevlogVersion{{ $version->timestamp }} extends Migration
{
    /**
     * Run the migrations.
     *
     * @ return void
     */
    public function up()
    {
        $version = new Version();
@if (isset($version->id) && $version->id)
        $version->{{ $devlog['versions']['id'] }} = {{ $version->id }};
@endif
        $version->{{ $devlog['versions']['code'] }} = '{{ $version->code }}';
@if (isset($version->description) && $version->description)
        $version->{{ $devlog['versions']['description'] }} = '{{ $version->description }}';
@endif
        $version->{{ $devlog['versions']['release_date'] }} = '{{ $version->release_date }}';
        $version->save();

@foreach ($version->changes as $change)
        $change = new Change();
        $change->{{ $devlog['changes']['description'] }} = '{{ $change }}';
        $version->changes()->save($change);
@endforeach
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Version::query()->where('{{ $devlog['versions']['code'] }}', '=', '{{ $version->code }}')->delete();
    }
}
