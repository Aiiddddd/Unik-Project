<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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
                    Textarea::make('summary')->label('Short description (shown on the card)')->rows(2)->maxLength(200)->columnSpanFull(),
                    FileUpload::make('cover')->label('Cover photo (JPG, PNG, or WebP, max 8 MB)')
                        ->image()
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->maxSize(8192)
                        ->imageResizeMode('contain')->imageResizeTargetWidth('2400')->imageResizeTargetHeight('2400')->imageResizeUpscale(false)
                        ->disk('public')->directory('projects')->visibility('public')
                        ->required()->columnSpanFull(),
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
                        ->image()->multiple()->reorderable()->maxFiles(40)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->maxSize(8192)
                        ->imageResizeMode('contain')->imageResizeTargetWidth('2400')->imageResizeTargetHeight('2400')->imageResizeUpscale(false)
                        ->disk('public')->directory('projects/gallery')->visibility('public')
                        ->columnSpanFull(),
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
