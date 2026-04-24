<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        $vehicleIds = Vehicle::query()->pluck('id')->toArray();

        $names = [
            'João Silva', 'Maria Santos', 'Pedro Oliveira', 'Ana Costa', 'Carlos Souza',
            'Paula Almeida', 'Lucas Rodrigues', 'Camila Lima', 'Gabriel Pereira', 'Juliana Alves',
            'Rafael Ferreira', 'Bruna Martins', 'Diego Costa', 'Larissa Gomes', 'Thiago Ribeiro',
            'Bianca Carvalho', 'Gustavo Martins', 'Vanessa Barbosa', 'Ricardo Rocha', 'Adriana Lima',
            'Fernando Santos', 'Beatriz Oliveira', 'Alexandre Costa', 'Renata Ferreira', 'Bruno Almeida',
            'Luciana Pereira', 'Roberto Rodrigues', 'Marina Castro', 'Felipe Martins', 'Cristina Lima',
            'Leonardo Garcia', 'Patrícia Santos', 'Daniel Costa', 'Sofia Oliveira', 'Marcos Ferreira',
            ' Isabela Rodrigues', 'Eduardo Almeida', 'Andréia Costa', 'Vinícius Pereira', 'Tatiana Santos',
            'Rodrigo Lima', 'Priscila Oliveira', 'Fabiano Costa', 'Vanessa Ribeiro', 'Almeida Santos',
            'Mariana Ferreira', 'Sérgio Rodrigues', 'Raquel Castro', 'David Lima', 'Tatiane Garcia'
        ];

        $emails = [
            'joao.silva@email.com', 'maria.santos@email.com', 'pedro.oliveira@email.com',
            'ana.costa@email.com', 'carlos.souza@email.com', 'paula.almeida@email.com',
            'lucas.rodrigues@email.com', 'camila.lima@email.com', 'gabriel.pereira@email.com',
            'juliana.alves@email.com', 'rafael.ferreira@email.com', 'bruna.martins@email.com',
            'diego.costa@email.com', 'larissa.gomes@email.com', 'thiago.ribeiro@email.com',
            'bianca.carvalho@email.com', 'gustavo.martins@email.com', 'vanessa.barbosa@email.com',
            'ricardo.rocha@email.com', 'adriana.lima@email.com', 'fernando.santos@email.com',
            'beatriz.oliveira@email.com', 'alexandre.costa@email.com', 'renata.ferreira@email.com',
            'bruno.almeida@email.com', 'luciana.pereira@email.com', 'roberto.rodrigues@email.com',
            'marina.castro@email.com', 'felipe.martins@email.com', 'cristina.lima@email.com'
        ];

        $messages = [
            'Tenho interesse neste veículo, gostaria de mais informações.',
            'Gostaria de agendar um test drive.',
            'Aceita troca por outro veículo?',
            'Qual o melhor horário para visitação?',
            'Veículo ainda está disponível?',
            'Posso fazer parcelamento?',
            'Tem garantia de fábrica?',
            'Aceita entrada + financiamento?',
            'Qual o estado de conservação?',
            'Documentação completa?'
        ];

        for ($i = 0; $i < 50; $i++) {
            Lead::create([
                'name' => $names[$i % count($names)],
                'email' => $emails[$i % count($emails)],
                'phone' => '(11) 9' . rand(4000, 9999) . '-' . rand(1000, 9999),
                'vehicle_id' => $vehicleIds[array_rand($vehicleIds)],
                'message' => $messages[array_rand($messages)],
            ]);
        }
    }
}