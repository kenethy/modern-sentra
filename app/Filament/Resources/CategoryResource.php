<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set; // Import Set
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str; // Import Str

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag'; // Icon di sidebar

    protected static ?string $navigationGroup = 'Katalog Produk'; // Grup di sidebar

    protected static ?string $recordTitleAttribute = 'name'; // Judul record saat diedit/view

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('parent_id')
                    ->relationship('parent', 'name') // Relasi ke parent category
                    ->searchable()
                    ->preload()
                    ->placeholder('Kategori Utama (Induk)')
                    ->label('Induk Kategori'),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true) // Update slug saat field ini diubah dan focus hilang
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))) // Auto generate slug
                    ->label('Nama Kategori'),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(Category::class, 'slug', ignoreRecord: true) // Pastikan slug unik, abaikan record saat ini (untuk edit)
                    ->label('Slug (URL)'),
                    // ->disabled() // Nonaktifkan jika ingin slug otomatis penuh
                    // ->dehydrated(), // Pastikan tetap tersimpan meski disabled

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(), // Lebar penuh
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Kategori'),

                Tables\Columns\TextColumn::make('parent.name') // Tampilkan nama parent category
                    ->label('Induk Kategori')
                    ->placeholder('N/A') // Teks jika tidak ada parent
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug'),

                Tables\Columns\TextColumn::make('products_count') // Hitung jumlah produk
                    ->counts('products') // Nama relasi 'products' di model Category
                    ->label('Jumlah Produk')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Sembunyikan defaultnya

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tambahkan filter jika perlu, misal berdasarkan parent
                Tables\Filters\SelectFilter::make('parent_id')
                    ->relationship('parent', 'name')
                    ->label('Filter Induk Kategori')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            // Tambahkan Relation Manager jika perlu (misal: untuk subkategori)
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}