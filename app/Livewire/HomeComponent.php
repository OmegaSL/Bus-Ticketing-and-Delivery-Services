<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use JsonException;
use Livewire\Component;

class HomeComponent extends Component
{
	public array $cities = [];
	public $city_from;
	public $city_to;
	public $travel_date;
	protected array $queryString = ['city_from', 'city_to', 'travel_date'];

	/**
	 * @throws JsonException
	 */
	public function mount()
	{
		$jsonFilePath = 'cities.json';

		// Check if the file exists
		if (Storage::exists($jsonFilePath)) {
			// Read the content of the JSON file
			$jsonContent = Storage::get($jsonFilePath);

			// Now, $jsonContent contains the content of the JSON file
			// You can parse it into an array or object if needed
			$this->cities = json_decode($jsonContent, true, 512, JSON_THROW_ON_ERROR);

			// Use $jsonData as needed
		} else {
			// Handle the case where the file doesn't exist
			// You can throw an exception or return an error message
			$this->cities = [];
		}
//		dd($jsonData);
		$this->travel_date = date('Y-m-d');

		$this->travel_date = request()?->query('travel_date', $this->travel_date);
		$this->city_from = request()?->query('city_from', $this->city_from);
		$this->city_to = request()?->query('city_to', $this->city_to);
	}

    public function render()
    {
        return view('livewire.home-component')->extends('layouts.master');
    }

	public function searchRide()
	{
		$this->validate([
			'city_from' => ['required'],
			'city_to' => ['required'],
			'travel_date' => ['date', 'after_or_equal:'.date('Y-m-d')],
		]);

		$this->travel_date = request()?->query('travel_date', $this->travel_date);
		$this->city_from = request()?->query('city_from', $this->city_from);
		$this->city_to = request()?->query('city_to', $this->city_to);

//		return redirect()->route('listing', [
//			'city_from' => $this->city_from,
//			'city_to' => $this->city_to,
//			'travel_date' => $this->travel_date,
//		]);

		return $this->redirect(route('listing', [
			'city_from' => $this->city_from,
			'city_to' => $this->city_to,
			'travel_date' => $this->travel_date,
		]), true);
	}
}
