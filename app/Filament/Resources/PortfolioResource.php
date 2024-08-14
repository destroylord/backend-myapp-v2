<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Filament\Resources\PortfolioResource\RelationManagers;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
               
                CheckboxList::make('tag')
                    ->options([
                        'laravel'   => 'Laravel',
                        'reactjs'   => 'React JS',
                        'tailwind'  => 'TailwindCss',
                        'wp'        => 'Woordpress'
                    ])
                    ->columns(2),
                TextInput::make('repository')
                    ->url()
                    ->prefix('https://'),
                TextInput::make('website')
                    ->url()
                    ->prefix('https://')
                    ->suffix('.com'),
                FileUpload::make('thumbnail')
                    ->multiple()
                    ->maxSize(3000)
                    ->openable()
                    ->directory('portfolios')
                    ->required()
                    ->image()
                    ->visibility('public'),                  
                MarkdownEditor::make('description')
                    ->disableToolbarButtons([
                        'attachFiles',
                        'codeBlock',
                        'link',
                        'strike'
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                ImageColumn::make('thumbnail')
                    ->height(50)
                    ->getStateUsing(fn (Portfolio $record): ?string => collect($record->thumbnail)->first()),
                TextColumn::make('description')
                    ->limit(50)
                    ->html(),
                TagsColumn::make('tag')->separator(','),
                TextColumn::make('repository'),
                TextColumn::make('website')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->label('Delete Portfolio')
                ->after(function (Portfolio $record) {
                    if ($record->thumbnail) {
                        foreach ($record->thumbnail as $ph) {
                            Storage::delete($ph);
                        }
                    }
                }),

            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}
