<?php

namespace App\Filament\Resources\QuoteRequestResource\Pages;

use App\Filament\Resources\QuoteRequestResource;
use App\Mail\QuoteResponseMail;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditQuoteRequest extends EditRecord
{
    protected static string $resource = QuoteRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
