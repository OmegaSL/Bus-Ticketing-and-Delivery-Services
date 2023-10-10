<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

	protected static ?int $navigationSort = 5;

	protected static ?string $recordTitleAttribute = 'booking_type';

	protected static ?string $navigationIcon = 'heroicon-o-banknotes';

	public static function getNavigationGroup(): ?string
	{
		return __('Financial Management');
	}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('booking_id')
                    ->relationship('booking', 'booking_from'),
                Forms\Components\Select::make('package_id')
                    ->relationship('package', 'package_name'),
                Forms\Components\TextInput::make('payment_method')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('payment_status')
                    ->required()
                    ->options([
						'pending' => 'Pending',
						'paid' => 'Paid',
						'failed' => 'Failed',
					])
                    ->default('pending'),
                Forms\Components\TextInput::make('payment_amount')
                    ->required()
                    ->numeric()
	                ->minValue(0.00)
                    ->default(0.00),
                Forms\Components\TextInput::make('payment_currency')
                    ->required()
                    ->maxLength(255)
	                ->disabled()
	                ->default('GHS'),
                Forms\Components\TextInput::make('payment_id')
	                ->disabled()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('booking.id')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('package.package_name')
//                    ->numeric()
//                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_status')
	                ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_currency')
                    ->searchable(),
//                Tables\Columns\TextColumn::make('payment_id')
//                    ->searchable(),
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
//                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPayments::route('/'),
//            'create' => Pages\CreatePayment::route('/create'),
//            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }    
}
