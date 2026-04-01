<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nomesBrasileiros = [
            'João Silva', 'Maria Santos', 'Carlos Oliveira', 'Ana Costa', 'Pedro Pereira',
            'Lúcia Ferreira', 'Roberto Gomes', 'Francisca Alves', 'Marcelo Rocha', 'Juliana Martins',
            'Antonio Medeiros', 'Gabriela Lima', 'Fernando Dias', 'Patricia Mendes', 'André Ribeiro',
            'Camila Cardoso', 'Lucas Barbosa', 'Fernanda Castro', 'Bruno Souza', 'Nicole Correia',
            'Thiago Passos', 'Beatriz Monteiro', 'Felipe Henrique', 'Leticia Vieira', 'Matheus Araujo',
        ];

        $sobrenomeBrasileiros = [
            'Silva', 'Santos', 'Oliveira', 'Costa', 'Pereira', 'Ferreira', 'Gomes', 'Alves',
            'Rocha', 'Martins', 'Medeiros', 'Lima', 'Dias', 'Mendes', 'Ribeiro', 'Cardoso',
            'Barbosa', 'Castro', 'Souza', 'Correia', 'Passos', 'Monteiro', 'Henrique', 'Vieira',
            'Araujo', 'Nunes', 'Pinto', 'Azevedo', 'Tavares', 'Lopes',
        ];

        $enderecoBrasileiros = [
            'Rua Augusta, São Paulo - SP', 'Avenida Paulista, São Paulo - SP', 'Rua das Flores, Rio de Janeiro - RJ',
            'Avenida Atlântica, Rio de Janeiro - RJ', 'Rua XV de Novembro, Curitiba - PR',
            'Avenida Getúlio Vargas, Belo Horizonte - MG', 'Rua Oscar Freire, São Paulo - SP',
            'Avenida Cristovão Colombo, Porto Alegre - RS', 'Rua Barão de Aracati, Fortaleza - CE',
            'Avenida Delmiro Gouveia, Brasília - DF', 'Rua das Laranjeiras, Rio de Janeiro - RJ',
            'Avenida Vieira Souto, Rio de Janeiro - RJ', 'Rua Boa Vista, São Paulo - SP',
            'Avenida Brasil, São Paulo - SP', 'Rua Visconde de Ouro Preto, Belo Horizonte - MG',
        ];

        $nome = fake()->randomElement($nomesBrasileiros);
        $emailBase = strtolower(str_replace(' ', '.', $nome));
        $emailSuffix = fake()->numberBetween(1, 999);
        $email = $emailBase . $emailSuffix . '@' . fake()->freeEmailDomain();

        return [
            'nome' => $nome,
            'email' => $email,
            'telefone' => fake()->numerify('(11) 9####-####'),
            'cpf' => fake()->numerify('###.###.###-##'),
            'endereco' => fake()->randomElement($enderecoBrasileiros),
            'imagem' => null,
        ];
    }
}