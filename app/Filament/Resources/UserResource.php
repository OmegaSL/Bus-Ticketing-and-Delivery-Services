<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

	protected static ?int $navigationSort = 0;

	protected static ?string $recordTitleAttribute = 'name';

	protected static ?string $navigationIcon = 'heroicon-o-user-group';

	public static function getNavigationLabel(): string
	{
		return trans('Users');
	}

	public static function getPluralLabel(): string
	{
		return trans('Users');
	}

	public static function getLabel(): string
	{
		return trans('User');
	}

	public static function getNavigationGroup(): ?string
	{
		return __('User Management');
	}

	public static function getNavigationBadge(): ?string
	{
		return static::$model::count();
	}

    public static function form(Form $form): Form
    {
	    if (auth()->user()->hasRole('super_admin')) {
		    $roles = fn (string $search) => Role::where('name', 'like', "%{$search}%")
			    ->limit(20)
			    ->pluck('name', 'id');
	    } else {
		    $roles = fn (string $search) => Role::where('name', 'like', "%{$search}%")
			    ->where('name', '!=', 'super_admin')
			    ->limit(20)
			    ->pluck('name', 'id');
	    }

        return $form
            ->schema([
	            Forms\Components\TextInput::make('name')
		            ->required()->label(trans('Name'))
		            ->unique(ignoreRecord: true),
	            Forms\Components\TextInput::make('first_name')
		            ->maxLength(255),
	            Forms\Components\TextInput::make('last_name')
		            ->maxLength(255),
	            Forms\Components\TextInput::make('email')
		            ->email()->required()
		            ->label(trans('Email'))
		            ->unique(ignoreRecord: true),
	            Forms\Components\TextInput::make('phone_number')
		            ->required()
		            ->mask('+{233}(99)9999-999'),
	            Forms\Components\TextInput::make('password')->label(trans('Password'))
		            ->password()
		            ->required(fn ($record) => is_null($record))
		            ->maxLength(255)
		            ->autocomplete('off')
		            ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : ""),
	            Forms\Components\TextInput::make('city')
		            ->maxLength(255),
	            Forms\Components\Select::make('roles')
		            ->multiple()
		            ->relationship('roles', 'name')
		            ->getSearchResultsUsing($roles)
		            ->getOptionLabelUsing(fn ($value): ?string => Role::find($value)?->name)
		            ->label(trans('Roles')),
	            Forms\Components\Textarea::make('address')
		            ->maxLength(255)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
	            Tables\Columns\TextColumn::make('name')
		            ->sortable()
		            ->searchable()
		            ->weight('medium')
		            ->label(trans('Name')),
	            Tables\Columns\TextColumn::make('full_name')
		            ->sortable()
		            ->searchable()
		            ->weight('medium')
		            ->label(trans('Name')),
	            Tables\Columns\TextColumn::make('email')
		            ->sortable()
		            ->searchable()
		            ->size('sm')
		            ->color('secondary')
		            ->label(trans('Email')),
                Tables\Columns\TextColumn::make('phone_number')
	                ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
	            Tables\Columns\IconColumn::make('email_verified_at')
			            ->sortable()
			            ->searchable()
			            ->boolean()
			            ->label(trans('Verified')),
	            Tables\Columns\TextColumn::make('roles.name')
		            ->label(__('Roles'))
		            ->badge()
		            ->formatStateUsing(fn ($state): string => Str::headline($state))
		            ->colors(['primary'])
		            ->searchable(),
	            Tables\Columns\TextColumn::make('created_at')
		            ->label(trans('Creation Date'))
		            ->dateTime('M j, Y')
		            ->sortable()
		            ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
	            Tables\Filters\Filter::make('verified')
		            ->label(trans('Email Verified'))
		            ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
	            Tables\Filters\Filter::make('unverified')
		            ->label(trans('Email Unverified'))
		            ->query(fn (Builder $query): Builder => $query->whereNull('email_verified_at')),
	            Tables\Filters\SelectFilter::make('roles')
		            ->relationship('roles', 'name')
//		            ->searchable()
            ])
            ->actions([
	            Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
	            Tables\Actions\DeleteAction::make()
		            ->hidden(function ($record) {
			            if ($record->hasRole('super_admin')) {
				            return true;
			            }
		            }),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
