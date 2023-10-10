<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

	protected static ?int $navigationSort = 3;

	protected static ?string $recordTitleAttribute = 'booking_type';

	protected static ?string $navigationIcon = 'heroicon-o-archive-box';

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
	            Forms\Components\Select::make('user_id')
		            ->relationship('user', 'name'),
                Forms\Components\TextInput::make('package_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('package_type')
                    ->required()
	                ->options([
	                    'Document' => 'Document',
	                    'Clothes' => 'Clothes',
	                    'Food' => 'Food',
	                    'Electronics' => 'Electronics',
	                    'Parcel' => 'Parcel',
	                    'Box' => 'Box',
	                    'Pallet' => 'Pallet',
	                    'Container' => 'Container',
	                    'Other' => 'Other',
					]),
                Forms\Components\Select::make('package_size')
                    ->required()
                    ->options([
	                    'small' => 'Small',
	                    'medium' => 'Medium',
	                    'large' => 'Large',
	                    'extra_large' => 'Extra Large',
					])
                    ->default('small'),
                Forms\Components\Textarea::make('package_description')
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Select::make('package_from')
                    ->required()
	                ->options($cities),
                Forms\Components\Select::make('package_to')
	                ->required()
	                ->options($cities),
                Forms\Components\TextInput::make('package_sender_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('package_sender_phone')
	                ->mask('+{233}(99)9999-999')
                    ->maxLength(255),
                Forms\Components\Textarea::make('package_sender_address')
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('package_receiver_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('package_receiver_phone')
	                ->mask('+{233}(99)9999-999')
                    ->maxLength(255),
                Forms\Components\Textarea::make('package_receiver_address')
                    ->maxLength(255)
	                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('package_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('package_type')
	                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('package_sender_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('package_receiver_name')
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }    
}
