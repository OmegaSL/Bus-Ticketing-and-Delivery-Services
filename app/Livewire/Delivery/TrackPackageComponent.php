<?php

namespace App\Livewire\Delivery;

use Livewire\Component;

class TrackPackageComponent extends Component
{
	public $package;

	public function mount($package)
	{
		$this->package = $package;

		$package = \App\Models\Package::where('id', $this->package)->first();
		// check if the package has delivery record
		if(!$package->delivery){
			// redirect to all delivery orders page
			return redirect()->route('all-delivery-orders')->with('error', 'Package has not been assigned to a delivery agent yet');
		}
	}

    public function render()
    {
        return view('livewire.delivery.track-package-component',[
			'delivery' => \App\Models\Delivery::where('package_id', $this->package)->first(),
        ])->extends('layouts.master');
    }
}
