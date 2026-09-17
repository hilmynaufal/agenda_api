<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MAgendaResource\Pages;
use App\Models\MAgenda;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class MAgendaResource extends Resource
{
    protected static ?string $model = MAgenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'Agenda';

    protected static ?string $navigationLabel = 'Kelola Agenda';

    protected static ?string $modelLabel = 'Agenda';

    public const STATUS_OPTIONS = [
        0 => 'Menunggu Konfirmasi',
        1 => 'Diterima',
        2 => 'Diwakilkan',
        3 => 'Dikonfirmasi Bupati',
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Agenda')
                    ->schema([
                        Forms\Components\TextInput::make('acara')
                            ->label('Acara')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('tempat')
                            ->label('Tempat')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('skpdnama')
                            ->label('SKPD / OPD'),
                        Forms\Components\TextInput::make('leading_sektor')
                            ->label('Leading Sektor'),
                        Forms\Components\TextInput::make('nip')
                            ->label('NIP Pengaju'),
                        Forms\Components\DatePicker::make('tanggal_mulai')
                            ->label('Tanggal Mulai')
                            ->required(),
                        Forms\Components\DateTimePicker::make('waktu_mulai')
                            ->label('Waktu Mulai'),
                        Forms\Components\DateTimePicker::make('waktu_selesai')
                            ->label('Waktu Selesai'),
                        Forms\Components\TextInput::make('no_hp')
                            ->label('No. HP Pengaju')
                            ->tel(),
                        Forms\Components\TextInput::make('pakaian')
                            ->label('Pakaian'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status & Perwakilan')
                    ->schema([
                        Forms\Components\Select::make('status_agenda')
                            ->label('Status Agenda')
                            ->options(self::STATUS_OPTIONS)
                            ->required(),
                        Forms\Components\TextInput::make('pendamping')
                            ->label('Pendamping (Perwakilan)')
                            ->helperText('Harus sama persis dengan nama di Master Pendamping agar notifikasi WA terkirim otomatis saat status diubah ke "Diwakilkan" lewat aplikasi.'),
                        Forms\Components\TextInput::make('penugasan')
                            ->label('Penugasan'),
                        Forms\Components\Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('keterangan_tambahan')
                            ->label('Keterangan Tambahan')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Berkas Surat')
                    ->schema([
                        Forms\Components\TextInput::make('surat')
                            ->label('Surat')
                            ->disabled(),
                        Forms\Components\TextInput::make('surat2')
                            ->label('Surat 2')
                            ->disabled(),
                        Forms\Components\TextInput::make('surat3')
                            ->label('Surat 3')
                            ->disabled(),
                    ])
                    ->columns(3)
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('acara')
                    ->label('Acara')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('skpdnama')
                    ->label('SKPD')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\BadgeColumn::make('status_agenda')
                    ->label('Status')
                    ->enum(self::STATUS_OPTIONS)
                    ->colors([
                        // Peran warna status mengikuti DESIGN.md: amber = pending,
                        // hijau = diterima, violet tonal = diwakilkan, teal = dihadiri.
                        'warning' => 0,
                        'success' => 1,
                        'text-purple-700 bg-purple-500/10 dark:text-purple-300 dark:bg-purple-500/20' => 2,
                        'primary' => 3,
                    ]),
                Tables\Columns\TextColumn::make('pendamping')
                    ->label('Pendamping')
                    ->searchable()
                    ->toggleable(),
            ])
            ->defaultSort('tanggal_mulai', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status_agenda')
                    ->label('Status')
                    ->options(self::STATUS_OPTIONS),
            ])
            ->actions([
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
            'index' => Pages\ListMAgendas::route('/'),
            'create' => Pages\CreateMAgenda::route('/create'),
            'edit' => Pages\EditMAgenda::route('/{record}/edit'),
        ];
    }
}
