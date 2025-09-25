<?php

namespace DiscoveryDesign\FilamentGaze\Concerns;

use Illuminate\Support\Facades\Cache;
use Filament\Facades\Filament;
use DiscoveryDesign\FilamentGaze\Forms\Components\GazeBanner;

trait HasGazeControl
{
    public function gazeTakeControl()
    {
        $gazeBanner = $this->findGazeBannerComponent();

        if ($gazeBanner) {
            $gazeBanner->takeControl();
        }

        $this->dispatch('$refresh');
    }

    private function findGazeBannerComponent($components = null)
    {
        if ($components === null) {
            $components = $this->form->getComponents();
        }

        foreach ($components as $component) {
            if ($component instanceof GazeBanner) {
                return $component;
            }

            if (method_exists($component, 'getChildComponents')) {
                $found = $this->findGazeBannerComponent($component->getChildComponents());
                if ($found) {
                    return $found;
                }
            }
        }

        return null;
    }
}