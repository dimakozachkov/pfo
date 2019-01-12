<?php

namespace App\Events;

use App\Models\Orphan;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrphanUpdatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $orphan;

    /**
     * Create a new event instance.
     *
     * @param Orphan $orphan
     */
    public function __construct(Orphan $orphan)
    {
        $this->orphan = $orphan;
    }

    /**
     * @return Orphan
     */
    public function getOrphan(): Orphan
    {
        return $this->orphan;
    }
}
