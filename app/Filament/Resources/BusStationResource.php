<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusStationResource\Pages;
use App\Filament\Resources\BusStationResource\RelationManagers;
use App\Models\BusStation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class BusStationResource extends Resource
{
    protected static ?string $model = BusStation::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static ?int $navigationSort = 2;

	protected static ?string $recordTitleAttribute = 'bus_station_name';

	protected static ?string $navigationIcon = 'heroicon-o-building-library';

	public static function getNavigationGroup(): ?string
	{
		return __('Bus Management');
	}

    public static function form(Form $form): Form
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
                Forms\Components\TextInput::make('bus_station_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('bus_station_city')
                    ->required()
                    ->options($cities),
                Forms\Components\TextInput::make('bus_station_country')
                    ->required()
                    ->maxLength(255)
	                ->disabled()
                    ->default('Ghana'),
                Forms\Components\TextInput::make('bus_station_address')
                    ->maxLength(255),
                Forms\Components\TextInput::make('bus_station_phone_number')
	                ->mask('+{233}(99)9999-999'),
                Forms\Components\TextInput::make('bus_station_email')
                    ->email()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bus_station_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bus_station_city')
	                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('bus_station_phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bus_station_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusStations::route('/'),
            'create' => Pages\CreateBusStation::route('/create'),
            'edit' => Pages\EditBusStation::route('/{record}/edit'),
        ];
    }    
}
