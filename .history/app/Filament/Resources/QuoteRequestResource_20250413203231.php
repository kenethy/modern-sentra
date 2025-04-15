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

                Forms\Components\Section::make('Respons Penawaran')
                    ->schema([
                        Forms\Components\Select::make('response_status')
                            ->label('Status Respons')
                            ->options([
                                'pending' => 'Belum Direspons',
                                'accepted' => 'Diterima',
                                'rejected' => 'Ditolak',
                                'negotiation' => 'Negosiasi',
                            ])
                            ->default('pending')
                            ->required()
                            ->reactive(),

                        Forms\Components\TextInput::make('quoted_price')
                            ->label('Harga Penawaran')
                            ->prefix('Rp')
                            ->numeric()
                            ->visible(fn(callable $get) => in_array($get('response_status'), ['accepted', 'negotiation'])),

                        Forms\Components\Textarea::make('response_message')
                            ->label('Pesan Respons')
                            ->placeholder('Pesan yang akan dikirim ke pelanggan')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->placeholder('Alasan mengapa permintaan ditolak')
                            ->columnSpanFull()
                            ->visible(fn(callable $get) => $get('response_status') === 'rejected'),

                        Forms\Components\Select::make('response_method')
                            ->label('Metode Pengiriman Respons')
                            ->options([
                                'email' => 'Email',
                                'whatsapp' => 'WhatsApp',
                                'both' => 'Keduanya',
                            ])
                            ->default('whatsapp')
                            ->required()
                            ->visible(fn(callable $get) => $get('response_status') !== 'pending'),

                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Catatan Admin')
                            ->placeholder('Catatan internal (tidak dikirim ke pelanggan)')
                            ->columnSpanFull(),
                    ])->columns(2),

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

                Tables\Columns\SelectColumn::make('response_status')
                    ->label('Status Respons')
                    ->options([
                        'pending' => 'Belum Direspons',
                        'accepted' => 'Diterima',
                        'rejected' => 'Ditolak',
                        'negotiation' => 'Negosiasi',
                    ])
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        'negotiation' => 'warning',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Baru' => 'Baru',
                        'Diproses' => 'Diproses',
                        'Selesai' => 'Selesai',
                        'Ditolak' => 'Ditolak',
                    ]),
                Tables\Filters\SelectFilter::make('response_status')
                    ->options([
                        'pending' => 'Belum Direspons',
                        'accepted' => 'Diterima',
                        'rejected' => 'Ditolak',
                        'negotiation' => 'Negosiasi',
                    ])
                    ->label('Status Respons'),
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

                // Action untuk mengirim pesan WhatsApp
                Tables\Actions\Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn(QuoteRequest $record): string => $record->getWhatsAppUrl())
                    ->openUrlInNewTab()
                    ->visible(fn(QuoteRequest $record): bool => $record->response_status !== 'pending' && !empty($record->phone)),

                // Action untuk respons cepat
                Tables\Actions\Action::make('quickResponse')
                    ->label('Respons Cepat')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('primary')
                    ->form([
                        Forms\Components\Select::make('response_status')
                            ->label('Status Respons')
                            ->options([
                                'accepted' => 'Diterima',
                                'rejected' => 'Ditolak',
                                'negotiation' => 'Negosiasi',
                            ])
                            ->required()
                            ->reactive(),

                        Forms\Components\TextInput::make('quoted_price')
                            ->label('Harga Penawaran')
                            ->prefix('Rp')
                            ->numeric()
                            ->visible(fn(callable $get) => in_array($get('response_status'), ['accepted', 'negotiation'])),

                        Forms\Components\Textarea::make('response_message')
                            ->label('Pesan Respons')
                            ->placeholder('Pesan yang akan dikirim ke pelanggan'),

                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->placeholder('Alasan mengapa permintaan ditolak')
                            ->visible(fn(callable $get) => $get('response_status') === 'rejected'),

                        Forms\Components\Select::make('response_method')
                            ->label('Metode Pengiriman Respons')
                            ->options([
                                'email' => 'Email',
                                'whatsapp' => 'WhatsApp',
                                'both' => 'Keduanya',
                            ])
                            ->default('whatsapp')
                            ->required(),
                    ])
                    ->action(function (QuoteRequest $record, array $data): void {
                        // Update data respons
                        $record->response_status = $data['response_status'];
                        $record->response_message = $data['response_message'] ?? null;
                        $record->rejection_reason = $data['rejection_reason'] ?? null;
                        $record->quoted_price = $data['quoted_price'] ?? null;
                        $record->response_method = $data['response_method'];
                        $record->responded_at = now();
                        $record->save();

                        // Kirim email jika metode respons adalah email atau keduanya
                        if (in_array($data['response_method'], ['email', 'both'])) {
                            Mail::to($record->email)->send(new QuoteResponseMail($record));

                            Notification::make()
                                ->title('Email berhasil dikirim')
                                ->success()
                                ->send();
                        }

                        Notification::make()
                            ->title('Respons berhasil disimpan')
                            ->success()
                            ->send();
                    }),
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
