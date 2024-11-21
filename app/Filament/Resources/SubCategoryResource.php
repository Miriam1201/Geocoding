<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubCategoryResource\Pages;
use App\Filament\Resources\SubCategoryResource\RelationManagers;
use App\Models\SubCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;

class SubCategoryResource extends Resource
{

    protected static ?string $navigationLabel = 'Subcategories';
    protected static ?string $pluralLabel = 'Subcategories';
    protected static ?string $label = 'Subcategory';

    protected static ?string $model = SubCategory::class;

    protected static ?string $navigationIcon = 'heroicon-c-folder';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Name'),

                TextInput::make('order')
                    ->default(1)
                    ->numeric()
                    ->label('Order'),

                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required()
                    ->reactive()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->label('Name'),
                        TextInput::make('order')
                            ->required()
                            ->default(1)
                            ->numeric()
                            ->label('Order'),
                        ColorPicker::make('color')
                            ->label('Color')
                            ->nullable(),
                        FileUpload::make('background')
                            ->directory('area-images-backgrounds')
                            ->label('Background Image'),
                        FileUpload::make('icon')
                            ->directory('area-images-icons')
                            ->label('Icon Image'),
                    ]),

                ColorPicker::make('color')
                    ->label('Color'),

                FileUpload::make('background')
                    ->directory('subcategory-images-backgrounds')
                    ->label('Background')
                    ->image(),

                FileUpload::make('icon')
                    ->directory('subcategory-images-icons')
                    ->label('Icon')
                    ->image(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Name'),

                TextColumn::make('order')
                    ->sortable()
                    ->label('Order'),

                TextColumn::make('category.name')
                    ->label('Category'),

                ColorColumn::make('color')
                    ->label('Color')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListSubCategories::route('/'),
            'create' => Pages\CreateSubCategory::route('/create'),
            'edit' => Pages\EditSubCategory::route('/{record}/edit'),
        ];
    }
}

