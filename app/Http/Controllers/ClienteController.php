<?php // Este código é um controlador Laravel para gerenciar clientes. 
// Ele inclui métodos para listar, criar, editar, atualizar, excluir e 
// pesquisar clientes. 
// O controlador utiliza o modelo Cliente para interagir 
// com o banco de dados e retorna as views correspondentes para cada ação.
namespace App\Http\Controllers;// Importa as classes necessárias para o controlador

use Illuminate\Http\Request;// Importa a classe Request para lidar com as requisições HTTP
use App\Models\Cliente;// Importa o modelo Cliente para interagir com a tabela de clientes no banco de dados

class ClienteController extends Controller// Define a classe C
// lienteController que é uma extensão da classe base Controller
{
    public function index() // Método 2 para listar todos os clientes
    {
        $clientes = Cliente::all(); // Recupera todos os clientes do banco de dados
        return view('clientes.index', compact('clientes')); 
    }

    public function create() //Crud 1 - Método para exibir o formulário de criação de um novo cliente
    {
    return view('clientes.form'); // Abre o formulário para criar um novo cliente
    }

    public function store(Request $request) // Crud 3 - Método para salvar um novo cliente no banco de dados
    {
         $request->validate([  
            'nome' => 'required', 
            'email' => 'required',
            'telefone' => 'required',
        ]);

        Cliente::create($request->all()); // Cria um novo cliente com os dados fornecidos na requisição

        return redirect('cliente'); 
    }

    public function edit($id)// Crud 3 - Método para exibir o formulário de edição de um cliente existente
    {
        $cliente = Cliente::find($id); // Encontra o cliente pelo ID fornecido
        return view('clientes.form', compact('cliente')); // Abre o formulário para
        //  editar o cliente encontrado, 
        // passando os dados do cliente para a view
    }

    public function update(Request $request, $id) 
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
        ]);

        Cliente::find($id)->update($request->all());

        return redirect('cliente');
    }

    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect('cliente');
    }

    public function search(Request $request)
    {
        $clientes = Cliente::where('nome', 'like', '%' . $request->valor . '%')->get();

        return view('clientes.index', compact('clientes'));
    }
}