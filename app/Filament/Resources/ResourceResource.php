<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResourceResource\Pages;
use App\Filament\Resources\ResourceResource\RelationManagers;
use App\Models\Resource as ResourceModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\ColorPicker;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\City;



class ResourceResource extends Resource
{
    protected static ?string $model = ResourceModel::class;

    protected static ?string $navigationIcon = 'heroicon-c-folder';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('description')->nullable(),

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
                Select::make('sub_category_id')
                    ->label('SubCategory')
                    ->relationship('subCategory', 'name')
                    ->required()
                    ->disabled(fn($get) => !$get('category_id'))
                    ->reactive()
                    ->options(function (\Filament\Forms\Get $get) {
                        $category = $get('category_id');
                        return SubCategory::where('category_id', $category)->pluck('name', 'id');
                    })
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->label('Name'),

                        TextInput::make('order')
                            ->default(1)
                            ->numeric()
                            ->label('Order'),

                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->label('Category')
                            ->required(),

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
                        
                    ]),

                TextInput::make('address')->nullable(),
                TextInput::make('postal_code')
                    ->numeric()
                    ->nullable(),

                Select::make('state_id')
                    ->label('State')
                    ->relationship('state', 'name')
                    ->required()
                    ->reactive(),

                Select::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name')
                    ->required()
                    ->disabled(fn($get) => !$get('state_id'))
                    ->options(function (\Filament\Forms\Get $get) {
                        $state = $get('state_id');
                        return City::where('state_id', $state)->pluck('name', 'id');
                    }),

                TextInput::make('village')->nullable(),
                TextInput::make('phone_1')
                    ->tel()
                    ->nullable()
                    ->minLength(10)
                    ->maxLength(15),
                TextInput::make('phone_2')
                    ->tel()
                    ->nullable()
                    ->minLength(10)
                    ->maxLength(15),
                TextInput::make('email')
                    ->email()
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('url')
                    ->url()
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('latitude')
                    ->numeric()
                    ->nullable()
                    ->minValue(-90)
                    ->maxValue(90),
                TextInput::make('longitude')
                    ->numeric()
                    ->nullable()
                    ->minValue(-180)
                    ->maxValue(180),

                FileUpload::make('images')
                    ->multiple()
                    ->disk('public')
                    ->directory('resources-images')
                    ->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('category.name')->label('Category')->sortable(),
                TextColumn::make('subcategory.name')->label('SubCategory')->sortable(),
                TextColumn::make('state.name')->label('state')->sortable(),
                TextColumn::make('city.name')->label('City')->sortable(),
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
            'index' => Pages\ListResources::route('/'),
            'create' => Pages\CreateResource::route('/create'),
            'edit' => Pages\EditResource::route('/{record}/edit'),
        ];
    }
}
