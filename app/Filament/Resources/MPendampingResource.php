<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MPendampingResource\Pages;
use App\Models\MPendamping;
use App\Services\FonnteService;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class MPendampingResource extends Resource
{
    protected static ?string $model = MPendamping::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Pendamping (Perwakilan)';

    protected static ?string $modelLabel = 'Pendamping';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Harus sama persis dengan nama yang dipilih/diketik di aplikasi saat "Wakilkan Agenda".'),
                Forms\Components\TextInput::make('jabatan')
                    ->label('Jabatan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_hp')
                    ->label('No. HP (WhatsApp)')
                    ->tel()
                    ->required()
                    ->maxLength(20)
                    ->helperText('Boleh diawali 08 atau 62, otomatis dirapikan saat kirim WA.'),
                Forms\Components\Toggle::make('aktif')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Non-aktifkan untuk berhenti mengirim notifikasi WA ke pendamping ini tanpa menghapus datanya.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No. HP'),
                Tables\Columns\IconColumn::make('aktif')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('aktif')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\Action::make('test_wa')
                    ->label('Test WA')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalSubheading(fn (MPendamping $record) => "Kirim pesan test WhatsApp ke {$record->nama} ({$record->no_hp})?")
                    ->action(function (MPendamping $record) {
                        $berhasil = (new FonnteService())->send(
                            $record->no_hp,
                            "Halo {$record->nama}, ini adalah pesan test dari sistem notifikasi Agenda Siagan Bedas. Nomor Anda sudah terhubung dengan baik.",
                            [
                                'pendamping_id' => $record->id,
                                'nama_pendamping' => $record->nama,
                            ]
                        );

                        Notification::make()
                            ->title($berhasil ? 'Pesan test berhasil dikirim' : 'Gagal mengirim pesan test')
                            ->body($berhasil ? null : 'Periksa nomor HP atau lihat menu Log Notifikasi WA untuk detail error.')
                            ->status($berhasil ? 'success' : 'danger')
                            ->send();
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMPendampings::route('/'),
            'create' => Pages\CreateMPendamping::route('/create'),
            'edit' => Pages\EditMPendamping::route('/{record}/edit'),
        ];
    }
}
