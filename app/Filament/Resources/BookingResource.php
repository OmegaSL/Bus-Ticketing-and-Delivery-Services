<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

	protected static ?int $navigationSort = 3;

	protected static ?string $recordTitleAttribute = 'booking_type';

	protected static ?string $navigationIcon = 'heroicon-o-book-open';

	public static function getNavigationGroup(): ?string
	{
		return __('Bus Management');
	}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('bus_id')
                    ->relationship('bus', 'bus_name')
                    ->required(),
                Forms\Components\Select::make('departure_station_id')
                    ->relationship('departure_station', 'bus_station_name')
                    ->required(),
                Forms\Components\Select::make('arrival_station_id')
                    ->relationship('arrival_station', 'bus_station_name')
                    ->required(),
                Forms\Components\DatePicker::make('booking_from')
                    ->required(),
                Forms\Components\DatePicker::make('booking_to')
                    ->required(),
                Forms\Components\TextInput::make('booking_amount')
                    ->required()
                    ->numeric()
	                ->minValue(0.00)
                    ->default(0.00),
                Forms\Components\Select::make('booking_type')
                    ->required()
                    ->options([
						'online' => 'Online',
						'offline' => 'Offline',
					]),
                Forms\Components\Select::make('booking_status')
                    ->required()
                    ->options([
						'pending' => 'Pending',
						'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
                Forms\Components\DateTimePicker::make('departure_date_time')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bus.bus_name')
                    ->numeric()
                    ->sortable()
	                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('departure_station.bus_station_name')
                    ->numeric()
                    ->sortable()
	                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('arrival_station.bus_station_name')
                    ->numeric()
                    ->sortable()
	                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('booking_type')
	                ->icon(fn (string $state): string => match ($state) {
		                'offline' => 'heroicon-o-x-circle',
		                'online' => 'heroicon-o-check-circle',
	                })
	                ->color(fn (string $state): string => match ($state) {
		                'offline' => 'danger',
		                'online' => 'success',
		                default => 'gray',
	                })
                    ->searchable(),
                Tables\Columns\TextColumn::make('booking_status')
	                ->badge()
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
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }    
}
