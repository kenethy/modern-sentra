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
        ];
    }
}
