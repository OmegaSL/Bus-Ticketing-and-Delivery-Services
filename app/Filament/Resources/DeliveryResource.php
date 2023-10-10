<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeliveryResource\Pages;
use App\Filament\Resources\DeliveryResource\RelationManagers;
use App\Models\Delivery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class DeliveryResource extends Resource
{
    protected static ?string $model = Delivery::class;

	protected static ?int $navigationSort = 4;

	protected static ?string $recordTitleAttribute = 'booking_type';

	protected static ?string $navigationIcon = 'heroicon-o-map-pin';

	public static function getNavigationGroup(): ?string
	{
		return __('Package Management');
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
                Forms\Components\Select::make('package_id')
                    ->relationship('package', 'package_name')
                    ->required(),
	            Forms\Components\Select::make('driver_id')
		            ->relationship('driver', 'name')
		            ->required(),
                Forms\Components\Select::make('delivery_current_location')
                    ->required()
                    ->options($cities),
                Forms\Components\Select::make('delivery_last_location')
	                ->required()
	                ->options($cities),
                Forms\Components\TextInput::make('delivery_code')
                    ->maxLength(255),
                Forms\Components\Select::make('delivery_status')
                    ->required()
                    ->options([
						'pending' => 'Pending',
						'processing' => 'Processing',
						'in_transit' => 'In Transit',
						'delivered' => 'Delivered',
	                    'cancelled' => 'Cancelled',
					])
                    ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('package.package_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('delivery_current_location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('delivery_last_location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('delivery_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('delivery_status')
	                ->badge()
                    ->sortable(),
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
            'index' => Pages\ListDeliveries::route('/'),
            'create' => Pages\CreateDelivery::route('/create'),
            'edit' => Pages\EditDelivery::route('/{record}/edit'),
        ];
    }    
}
