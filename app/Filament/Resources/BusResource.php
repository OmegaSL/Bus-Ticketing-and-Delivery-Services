<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusResource\Pages;
use App\Filament\Resources\BusResource\RelationManagers;
use App\Models\Bus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class BusResource extends Resource
{
    protected static ?string $model = Bus::class;

	protected static ?int $navigationSort = 1;

	protected static ?string $recordTitleAttribute = 'bus_name';

	protected static ?string $navigationIcon = 'heroicon-o-truck';

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

	    $amenities = [
		    'Air Conditioner',
		    'TV',
		    'WiFi',
		    'Toilet',
		    'Reclining Seats',
		    'USB Charging',
		    'Snacks',
		    'Drinks',
		    'Blanket',
		    'Pillow',
		    'Reading Light',
		    'Emergency Exit',
		    'Smoking',
		    'Handicap Accessible',
		    'Luggage',
		    'Pet Friendly',
		    'Child Seat',
		    'Wheelchair',
		    'Bicycle',
		    'Carry-on Baggage',
		    'Over-sized Luggage',
		    'Stroller',
		    'Surfboard',
		    'Skis',
		    'Snowboard',
		    'Snow Sports Equipment',
		    'Water Sports Equipment',
		    'Audio/Video',
		    'Power Outlet',
		    'Extra Legroom',
		    'Meal',
		    'Alcoholic Beverages',
		    'Hostess',
		    'Movies',
		    'Air Conditioning',
		    'WC',
		    'Water',
		    'Coffee',
		    'Tea',
		    'Newspaper',
		    'Magazine',
		    'Air Freshener',
		    'Hand Sanitizer',
		    'Disinfectant Wipes',
		    'Disinfectant Spray',
		    'Face Mask',
		    'Face Shield',
		    'Gloves',
		    'Thermometer',
		    'Hand Soap',
		    'Tissues',
		    'Trash Bag',
		    'First Aid Kit',
		    'Fire Extinguisher',
		    'Defibrillator'
	    ];

        return $form
            ->schema([
                Forms\Components\TextInput::make('bus_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bus_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('bus_type')
                    ->required()
                    ->options([
	                    'VIP' => 'VIP',
	                    'VVIP' => 'VVIP',
	                    'STC' => 'STC',
	                    'O.A' => 'O.A',
	                    'Metro Mass' => 'Metro Mass',
					]),
                Forms\Components\Select::make('bus_route_from')
                    ->required()
                    ->options($cities),
                Forms\Components\Select::make('bus_route_to')
                    ->required()
                    ->options($cities),
                Forms\Components\TextInput::make('bus_capacity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('bus_route_price')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('bus_status')
                    ->required()
                    ->options([
	                    'Available' => 'Available',
	                    'Unavailable' => 'Unavailable',
                    ]),
                Forms\Components\FileUpload::make('bus_image')
                    ->image()
	                ->directory('property_images')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('bus_description')
                    ->maxLength(65535)
                    ->columnSpanFull(),

	            Forms\Components\Section::make('Bus Amenities')
		            ->description('Select the amenities available on the bus')
		            ->schema([
		                Forms\Components\CheckboxList::make('bus_amenities')
			                ->options(array_combine($amenities, $amenities))
							->columnSpanFull(),
		            ])
		            ->collapsible()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bus_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bus_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bus_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bus_capacity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bus_status')
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
	        RelationManagers\SeatsRelationManager::class,
	        RelationManagers\BusHistoriesRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBuses::route('/'),
            'create' => Pages\CreateBus::route('/create'),
            'edit' => Pages\EditBus::route('/{record}/edit'),
        ];
    }    
}
