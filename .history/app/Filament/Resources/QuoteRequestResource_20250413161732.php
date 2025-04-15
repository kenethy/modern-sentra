<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuoteRequestResource\Pages;
use App\Mail\QuoteResponseMail;
use App\Models\QuoteRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class QuoteRequestResource extends Resource
{
    protected static ?string $model = QuoteRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Interaksi';

    // Defaultnya tidak bisa create dari admin, hanya lihat/edit status
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Buat form read-only untuk halaman view, tapi status bisa diedit
                Forms\Components\Section::make('Informasi Pengirim')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Pengirim')
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->disabled(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Telepon')
                            ->disabled(),
                        Forms\Components\TextInput::make('company_name')
                            ->label('Nama Perusahaan')
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Detail Permintaan')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name') // Relasi ke Product
                            ->label('Produk Terkait (Jika Ada)')
                            ->disabled(),
                        Forms\Components\Textarea::make('message')
                            ->label('Pesan Permintaan')
                            ->columnSpanFull()
                            ->disabled(),
                        Forms\Components\Select::make('status')
                            ->label('Status Permintaan')
                            ->options([ // Opsi status
                                'Baru' => 'Baru',
                                'Diproses' => 'Diproses',
                                'Selesai' => 'Selesai',
                                'Ditolak' => 'Ditolak',
                            ])
                            ->required() // Status wajib diisi/diedit
                        // Jangan disabled agar bisa diedit
                    ])->columns(1), // Bagian status bisa 1 kolom

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nama Pengirim'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('product.name') // Tampilkan nama produk terkait
                    ->label('Produk Terkait')
                    ->placeholder('Umum')
                    ->url(fn(QuoteRequest $record): ?string => $record->product ? ProductResource::getUrl('edit', ['record' => $record->product]) : null) // Link ke edit produk jika ada
                    ->openUrlInNewTab(),

                // Kolom status yang bisa diedit langsung di tabel
                Tables\Columns\SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'Baru' => 'Baru',
                        'Diproses' => 'Diproses',
                        'Selesai' => 'Selesai',
                        'Ditolak' => 'Ditolak',
                    ])
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Tanggal Masuk')
                    ->defaultSort('desc'), // Urutkan terbaru di atas
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Baru' => 'Baru',
                        'Diproses' => 'Diproses',
                        'Selesai' => 'Selesai',
                        'Ditolak' => 'Ditolak',
                    ]),
                Tables\Filters\SelectFilter::make('product_id')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Filter Produk'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // Lihat detail
                Tables\Actions\EditAction::make(), // Edit (terutama status)
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    // Bisa tambah bulk action untuk update status
                    Tables\Actions\BulkAction::make('updateStatus')
                        ->label('Update Status Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->form([
                            Forms\Components\Select::make('status')
                                ->options([
                                    'Baru' => 'Baru',
                                    'Diproses' => 'Diproses',
                                    'Selesai' => 'Selesai',
                                    'Ditolak' => 'Ditolak',
                                ])
                                ->required(),
                        ])
                        ->action(function (array $data, \Illuminate\Database\Eloquent\Collection $records) {
                            $records->each->update(['status' => $data['status']]);
                        })
                        ->deselectRecordsAfterCompletion(),

                ]),
            ])
            ->defaultSort('created_at', 'desc'); // Default sort
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
            'index' => Pages\ListQuoteRequests::route('/'),
            // 'create' => Pages\CreateQuoteRequest::route('/create'), // Nonaktifkan create
            'view' => Pages\ViewQuoteRequest::route('/{record}'), // Halaman view
            'edit' => Pages\EditQuoteRequest::route('/{record}/edit'), // Halaman edit (status)
        ];
    }
}
