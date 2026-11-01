<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        $services = collect(config('whatwedo.services', []))->pluck('tab', 'slug')->all();

        return $schema->components([
            Section::make('Event')
                ->columns(2)
                ->schema([
                    TextInput::make('title')->required()->maxLength(160)->columnSpanFull(),
                    Select::make('service')->label('Category in "What we do"')->options($services)->required(),
                    TextInput::make('category')->label('Small label on the card')->placeholder('e.g. Government & Institution')->maxLength(80),
                    FileUpload::make('cover')->label('Cover photo')->image()->disk('public')->directory('projects')->visibility('public')->required()->columnSpanFull(),
                ]),

            Section::make('Event page')
                ->description('What visitors see after clicking the event card.')
                ->schema([
                    RichEditor::make('content')
                        ->label('Main content')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('projects/content')
                        ->fileAttachmentsVisibility('public')
                        ->columnSpanFull(),
                    FileUpload::make('gallery')
                        ->label('Gallery photos')
                        ->image()->multiple()->reorderable()
                        ->disk('public')->directory('projects/gallery')->visibility('public')
                        ->columnSpanFull(),
                ]),

            Section::make('Bahasa Indonesia (opsional)')
                ->description('Versi Indonesia dari halaman event. Kalau dikosongkan, pengunjung /id melihat teks Inggris.')
                ->collapsible()
                ->schema([
                    TextInput::make('title_id')->label('Judul')->maxLength(160),
                    TextInput::make('label_id')->label('Label kecil di kartu')->maxLength(80),
                    RichEditor::make('content_id')
                        ->label('Konten utama')
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('projects/content')
                        ->fileAttachmentsVisibility('public'),
                ]),

            Section::make('Details')
                ->columns(3)
                ->schema([
                    TextInput::make('client')->maxLength(120),
                    TextInput::make('period')->placeholder('e.g. 2-4 May 2018')->maxLength(80),
                    TextInput::make('location')->maxLength(120),
                ]),

            Section::make('Publishing')
                ->columns(3)
                ->schema([
                    TextInput::make('slug')->helperText('Leave empty to generate from the title')->unique(ignoreRecord: true)->maxLength(160),
                    TextInput::make('sort_order')->numeric()->default(0)->helperText('Smaller number appears first'),
                    Toggle::make('is_published')->label('Published')->default(true),
                ]),
        ]);
    }
}
