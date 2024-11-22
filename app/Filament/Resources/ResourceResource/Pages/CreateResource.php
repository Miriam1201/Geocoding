<?php

namespace App\Filament\Resources\ResourceResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;
use App\Filament\Resources\ResourceResource;
use App\Services\GeocodeService;
use Filament\Notifications\Notification;

class CreateResource extends CreateRecord
{
    protected static string $resource = ResourceResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('getCoordinates')
                ->label('Obtener Longitud y Latitud')
                ->color('primary')
                ->icon('heroicon-o-map')
                ->action(function (): void {
                    // Obtenemos el estado y la ciudad del formulario utilizando $this->form->getState()
                    $data = $this->form->getState();

                    $stateId = $data['state_id'] ?? null;
                    $cityId = $data['city_id'] ?? null;

                    if ($stateId && $cityId) {
                        // Obtenemos los nombres del estado y la ciudad
                        $state = \App\Models\State::find($stateId);
                        $city = \App\Models\City::find($cityId);

                        if ($state && $city) {
                            // Usamos el servicio de geocodificación para obtener las coordenadas
                            $geocodeService = app(GeocodeService::class);
                            $coordinates = $geocodeService->getCoordinates($state->name, $city->name);

                            // Actualizamos los datos del formulario con las coordenadas obtenidas
                            $this->form->fill([
                                'latitude' => $coordinates['latitude'],
                                'longitude' => $coordinates['longitude'],
                            ]);

                            // Notificamos al usuario
                            Notification::make()
                                ->title('Coordenadas actualizadas correctamente.')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('No se pudo encontrar el estado o la ciudad.')
                                ->danger()
                                ->send();
                        }
                    } else {
                        Notification::make()
                            ->title('Por favor selecciona un estado y una ciudad.')
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
