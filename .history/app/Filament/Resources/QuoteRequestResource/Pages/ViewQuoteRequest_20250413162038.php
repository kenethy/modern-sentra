<?php

namespace App\Filament\Resources\QuoteRequestResource\Pages;

use App\Filament\Resources\QuoteRequestResource;
use App\Mail\QuoteResponseMail;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Mail;

class ViewQuoteRequest extends ViewRecord
{
    protected static string $resource = QuoteRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),

            // Action untuk mengirim email
            Actions\Action::make('sendEmail')
                ->label('Kirim Email')
                ->icon('heroicon-o-envelope')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Kirim Email Respons')
                ->modalDescription('Email akan dikirim ke ' . $this->record->email)
                ->modalSubmitActionLabel('Kirim')
                ->action(function () {
                    // Pastikan ada respons yang sudah diisi
                    if ($this->record->response_status === 'pending') {
                        Notification::make()
                            ->title('Tidak dapat mengirim email')
                            ->body('Anda harus mengisi respons terlebih dahulu sebelum mengirim email.')
                            ->danger()
                            ->send();
                        return;
                    }

                    // Kirim email
                    Mail::to($this->record->email)->send(new QuoteResponseMail($this->record));

                    Notification::make()
                        ->title('Email berhasil dikirim')
                        ->success()
                        ->send();
                })
                ->visible(fn() => $this->record->response_status !== 'pending' && !empty($this->record->email)),

            // Action untuk mengirim WhatsApp
            Actions\Action::make('sendWhatsApp')
                ->label('WhatsApp')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->color('success')
                ->url(fn() => $this->record->getWhatsAppUrl())
                ->openUrlInNewTab()
                ->visible(fn() => $this->record->response_status !== 'pending' && !empty($this->record->phone)),
        ];
    }
}
