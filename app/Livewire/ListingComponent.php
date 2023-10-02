<?php

namespace App\Livewire;

use App\Models\Bus;
use Livewire\Component;
use Livewire\WithPagination;

class ListingComponent extends Component
{
	use WithPagination;

	protected $paginationTheme = 'bootstrap';

	public $perPage = 10;
	public $city_from;
	public $city_to;
	public $travel_date;
	protected array $queryString = ['city_from', 'city_to', 'travel_date'];

	public function mount()
	{
		$this->travel_date = date('Y-m-d');

		$this->travel_date = request()?->query('travel_date', $this->travel_date);
		$this->city_from = request()?->query('city_from', $this->city_from);
		$this->city_to = request()?->query('city_to', $this->city_to);
	}

    public function render()
    {
        return view('livewire.listing-component',[
			'buses' => \App\Models\Bus::query()
				->with('bus_histories', function ($query) {
					$query->latest()->where('departure_date_time', '>=', $this->travel_date);
				})
				->where('bus_route_from', $this->city_from)
				->where('bus_route_to', $this->city_to)
				->paginate($this->perPage, ['*'], 'buses'),
        ])->extends('layouts.master');
    }
}
