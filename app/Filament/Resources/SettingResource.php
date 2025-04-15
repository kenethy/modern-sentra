<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Konfigurasi';

    // Mungkin tidak ingin user bisa membuat setting baru sembarangan
    // public static function canCreate(): bool
    // {
    //     return false;
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(255)
                    ->label('Kunci Setting')
                    ->unique(Setting::class, 'key', ignoreRecord: true)
                    ->disabledOn('edit'), // Jangan biarkan key diubah setelah dibuat

                // Gunakan field yang sesuai untuk value, RichEditor lebih fleksibel
                Forms\Components\RichEditor::make('value')
                    ->label('Nilai Setting')
                    ->columnSpanFull(),

                // Alternatif jika ingin jenis field berbeda tergantung 'key' (lebih kompleks)
                // Forms\Components\Placeholder::make('value_field')
                //     ->label('Nilai Setting')
                //     ->content(fn ($get) => match ($get('key')) {
                //         'visi', 'misi', 'sejarah' => Forms\Components\RichEditor::make('value')->render(),
                //         'alamat' => Forms\Components\Textarea::make('value')->render(),
                //         'telepon', 'email_kontak' => Forms\Components\TextInput::make('value')->render(),
                //         default => Forms\Components\Textarea::make('value')->render(),
                //     }),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Kunci Setting')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai Setting')
                    ->limit(50) // Batasi tampilan di tabel
                    ->html() // Render HTML jika pakai RichEditor
                    ->searchable(),
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
                 // Hati-hati dengan delete setting penting!
                 Tables\Actions\DeleteAction::make()
                     ->hidden(fn (Setting $record): bool => in_array($record->key, ['visi', 'misi'])), // Sembunyikan delete untuk key tertentu
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Mungkin nonaktifkan bulk delete untuk settings
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }

    // Alternatif: Nonaktifkan Resource ini dan buat Custom Page
    // protected static bool $shouldRegisterNavigation = false; // Sembunyikan dari navigasi jika pakai custom page
}