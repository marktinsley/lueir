<?php

namespace App\Events;

use App\Models\RecentFile;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RecentFileAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var RecentFile
     */
    public RecentFile $recentFile;

    /**
     * Create a new event instance.
     *
     * @param RecentFile $recentFile
     */
    public function __construct(RecentFile $recentFile)
    {
        $this->recentFile = $recentFile;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('files');
    }
}
