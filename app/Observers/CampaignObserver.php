<?php

namespace App\Observers;

use App\Models\Campaign;
use Illuminate\Support\Str;

class CampaignObserver
{
    public function creating(Campaign $campaign)
    {
        $campaign->slug = Str::slug($campaign->name);
    }

    public function created(Campaign $campaign)
    {
        //
    }

    public function updating(Campaign $campaign)
    {
        $campaign->slug = Str::slug($campaign->name);
    }

    public function updated(Campaign $campaign)
    {
        //
    }

    public function deleted(Campaign $campaign)
    {
        //
    }

    public function restored(Campaign $campaign)
    {
        //
    }

    public function forceDeleted(Campaign $campaign)
    {
        //
    }
}
