<?php

namespace App\Filament\Resources\BusResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SeatsRelationManager extends RelationManager
{
    protected static string $relationship = 'seats';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('seat_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('seat_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('seat_status')
	                ->required()
	                ->options([
		                'Available' => 'Available',
		                'Booked' => 'Booked',
		                'Blocked' => 'Blocked',
	                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('seat_number')
            ->columns([
                Tables\Columns\TextColumn::make('seat_number')
	                ->searchable()
					->sortable(),
                Tables\Columns\TextColumn::make('seat_type')
	                ->searchable()
	                ->sortable(),
                Tables\Columns\TextColumn::make('seat_status')
	                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
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
