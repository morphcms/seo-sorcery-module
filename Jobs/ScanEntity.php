<?php

namespace Modules\SeoSorcery\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\SeoSorcery\Contracts\ICanBeSeoAnalyzed;
use Modules\SeoSorcery\Models\SeoEntity;
use Modules\SeoSorcery\Services\Sorcery;

class ScanEntity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Sorcery $sorcery, private SeoEntity $entity)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->sorcery->analyze($this->entity);

        $this->entity->report = $results->toJson();
        $this->entity->last_scan_at = now();

        $this->entity->save();
    }
}
