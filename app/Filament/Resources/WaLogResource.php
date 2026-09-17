<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaLogResource\Pages;
use App\Models\WaLog;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class WaLogResource extends Resource
{
    protected static ?string $model = WaLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-alt-2';

    protected static ?string $navigationGroup = 'Agenda';

    protected static ?string $navigationLabel = 'Log Notifikasi WA';

    protected static ?string $modelLabel = 'Log Notifikasi WA';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pendamping')
                    ->label('Nama Pendamping')
                    ->disabled(),
                Forms\Components\TextInput::make('no_hp')
                    ->label('No. HP')
                    ->disabled(),
                Forms\Components\TextInput::make('agenda_id')
                    ->label('ID Agenda')
                    ->disabled(),
                Forms\Components\Textarea::make('pesan')
                    ->label('Isi Pesan')
                    ->disabled()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('response')
                    ->label('Response Gateway')
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_pendamping')
                    ->label('Pendamping')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No. HP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('agenda_id')
                    ->label('ID Agenda'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->enum([
                        1 => 'Terkirim',
                        0 => 'Gagal',
                    ])
                    ->colors([
                        'success' => 1,
                        'danger' => 0,
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Status')
                    ->trueLabel('Terkirim')
                    ->falseLabel('Gagal'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWaLogs::route('/'),
            'view' => Pages\ViewWaLog::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }
}
