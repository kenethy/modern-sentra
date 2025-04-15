<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash; // Import Hash
use Illuminate\Database\Eloquent\Model; // Import Model

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Konfigurasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                     // Pastikan email unik, abaikan record saat ini (edit)
                    ->unique(User::class, 'email', ignoreRecord: true),

                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label('Email Terverifikasi Pada')
                    ->nullable(), // Boleh null

                Forms\Components\TextInput::make('password')
                    ->password() // Tipe password (hidden)
                    ->required(fn (string $context): bool => $context === 'create') // Wajib hanya saat create
                    ->maxLength(255)
                     // Hanya hash jika password diisi (untuk edit opsional)
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                     // Jangan isi field password saat load form edit
                    ->dehydrated(fn ($state) => filled($state))
                    ->label(fn (string $context): string => ($context === 'edit') ? 'Password Baru (Opsional)' : 'Password'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Terverifikasi'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    // Jangan biarkan user menghapus dirinya sendiri
                    ->hidden(fn (Model $record): bool => $record->id === auth()->id()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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