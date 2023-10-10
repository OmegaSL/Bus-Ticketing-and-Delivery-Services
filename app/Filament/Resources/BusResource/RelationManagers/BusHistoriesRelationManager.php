<?php

namespace App\Filament\Resources\BusResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class BusHistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'bus_histories';

    public function form(Form $form): Form
    {
	    $jsonFilePath = 'cities_filament.json';

	    // Check if the file exists
	    if (Storage::exists($jsonFilePath)) {
		    // Read the content of the JSON file
		    $jsonContent = Storage::get($jsonFilePath);

		    // Now, $jsonContent contains the content of the JSON file
		    // You can parse it into an array or object if needed
		    $cities = json_decode($jsonContent, true, 512, JSON_THROW_ON_ERROR);
	    } else {
		    // Handle the case where the file doesn't exist
		    $cities = [];
	    }

        return $form
            ->schema([
            	Forms\Components\Select::make('bus_driver_id')
		            ->relationship('busDriver', 'name')
					->required(),
				Forms\Components\Select::make('current_station_id')
                    ->relationship('currentStation', 'bus_station_name')
                    ->required(),
				Forms\Components\Select::make('last_station_id')
					->relationship('lastStation', 'bus_station_name')
					->required(),
				Forms\Components\DateTimePicker::make('departure_date_time')
                    ->required(),
				Forms\Components\DateTimePicker::make('arrival_date_time')
                    ->required(),
				Forms\Components\Select::make('departure_city')
					->options($cities)
                    ->required(),
				Forms\Components\Select::make('arrival_city')
                    ->options($cities)
					->required(),
				Forms\Components\TextInput::make('price')
					->numeric()
					->required(),
				Forms\Components\TextInput::make('travel_duration')
					->numeric()
                    ->required(),
                Forms\Components\Select::make('bus_status')
	                ->options([
						'available' => 'Available',
                        'unavailable' => 'Unavailable',
					])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('bus_status')
            ->columns([
	            Tables\Columns\TextColumn::make('busDriver.name'),
	            Tables\Columns\TextColumn::make('currentStation.bus_station_name'),
	            Tables\Columns\TextColumn::make('lastStation.bus_station_name'),
                Tables\Columns\TextColumn::make('bus_status')->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
