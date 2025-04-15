<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload; // Import Media Library Upload
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn; // Import Media Library Column


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Katalog Produk';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Utama')
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name') // Relasi ke Category
                                    ->required()
                                    ->searchable()
                                    ->preload() // Load opsi saat halaman dibuka
                                    ->label('Kategori Produk'),

                                Forms\Components\Select::make('brand_id')
                                    ->relationship('brand', 'name') // Relasi ke Brand
                                    ->searchable()
                                    ->preload() // Load opsi saat halaman dibuka
                                    ->label('Merk')
                                    ->placeholder('Tanpa Merk')
                                    ->nullable(),

                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->label('Nama Produk'),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Product::class, 'slug', ignoreRecord: true)
                                    ->label('Slug (URL)'),
                                // ->disabled()
                                // ->dehydrated(),

                                Forms\Components\RichEditor::make('description')
                                    ->label('Deskripsi Produk')
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('usage_tips')
                                    ->label('Tips Penggunaan')
                                    ->columnSpanFull(),
                            ])->columns(2), // Bagi section ini jadi 2 kolom

                        Forms\Components\Section::make('Atribut & Spesifikasi')
                            ->schema([
                                Forms\Components\KeyValue::make('specifications')
                                    ->label('Spesifikasi Teknis')
                                    ->keyLabel('Nama Spek')
                                    ->valueLabel('Nilai Spek')
                                    ->reorderable() // Bisa diubah urutannya
                                    ->addActionLabel('Tambah Spesifikasi'),
                                //->columnSpanFull(), // Satu kolom lebar

                                // Mengelola Atribut Produk (untuk filter)
                                Forms\Components\Repeater::make('attributes') // Nama relasi di Model Product
                                    ->relationship() // Otomatis handle relasi HasMany
                                    ->label('Atribut Filter')
                                    ->schema([
                                        Forms\Components\TextInput::make('attribute_name')->required()->label('Nama Atribut (misal: Warna)'),
                                        Forms\Components\TextInput::make('attribute_value')->required()->label('Nilai Atribut (misal: Merah)'),
                                    ])
                                    ->addActionLabel('Tambah Atribut Filter')
                                    ->columns(2) // Atribut & Nilai sejajar
                                    ->columnSpanFull(), // Gunakan lebar penuh untuk Repeater

                            ])->columns(1), // Section ini 1 kolom
                    ])
                    ->columnSpan(['lg' => 2]), // Grup kiri, lebar 2/3 di layar besar

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status & Media')
                            ->schema([
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Produk Unggulan?')
                                    ->helperText('Tandai jika produk ini ingin ditonjolkan.'),

                                // Upload Gambar via Spatie Medialibrary
                                SpatieMediaLibraryFileUpload::make('product_images') // Nama collection bebas
                                    ->collection('product_images') // Nama collection di model Product (jika didefinisikan)
                                    ->multiple() // Boleh upload > 1 gambar
                                    ->reorderable()
                                    ->image() // Pastikan hanya gambar
                                    ->imageEditor() // Aktifkan editor gambar (crop, rotate)
                                    ->label('Gambar Produk'),
                            ]),

                        // Bisa tambahkan section lain di sini jika perlu
                    ])
                    ->columnSpan(['lg' => 1]), // Grup kanan, lebar 1/3 di layar besar

            ])->columns(3); // Layout utama 3 kolom
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('product_images') // Nama collection
                    ->collection('product_images')
                    ->label('Gambar')
                    ->circular(), // Tampilkan bulat (opsional)

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Produk'),

                Tables\Columns\TextColumn::make('category.name') // Tampilkan nama kategori
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean() // Tampilkan icon check/x
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Filter Kategori'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Filter Unggulan'),
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
            // Jika ingin manage Quote Requests dari halaman produk:
            // \App\Filament\Resources\ProductResource\RelationManagers\QuoteRequestsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
