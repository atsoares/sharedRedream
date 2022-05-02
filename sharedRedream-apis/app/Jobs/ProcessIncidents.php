<?php

namespace App\Jobs;

use App\Repositories\Impl\IncidentRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessIncidents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(IncidentRepositoryInterface $incidentRepo)
    {
        foreach ($incidentRepo->getAllActive() as $incident) {
            if ($incident->total_raised >= $incident->goal){
                $incidentRepo->refund($incident);
            } elseif ((string) $incident->expires_at < today()->format('d-m-Y')){
                if ($incident->total_raised > 0)
                    $incidentRepo->refund($incident);
                else
                    $incidentRepo->update($incident, ['active'=>false]);
            }
        }
    }
}
