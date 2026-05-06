# 📊 Gráficos e Relatórios em PDF - Documentação

## 📋 Resumo do Projeto

Foi implementado um sistema completo de gráficos e relatórios em PDF para o aplicativo de gestão de restaurante. O sistema inclui:

### ✅ Implementações Realizadas

#### 1. **Dois Gráficos Interativos**

##### Gráfico 1: Gráfico de Barras 📊
- **Formato:** Gráfico de Barras
- **Dados:** Quantidade de pedidos por cliente (Top 10)
- **URL:** `/graficos/clientes-pedidos`
- **Características:**
  - Visualização clara dos 10 clientes com mais pedidos
  - Cores diferentes para cada barra
  - Estatísticas: Total de dados, maior valor, menor valor, média
  - Biblioteca: Chart.js

##### Gráfico 2: Gráfico de Pizza (Donut) 🍰
- **Formato:** Gráfico de Pizza/Donut
- **Dados:** Distribuição de pratos por categoria
- **URL:** `/graficos/pratos-categoria`
- **Características:**
  - Visualização em formato de pizza interativa
  - Cores diferenciadas para cada categoria
  - Tabela de legenda com percentuais
  - Estatísticas: Total de categorias, total de pratos, categoria maior, média
  - Biblioteca: Chart.js

---

#### 2. **Dois Relatórios em PDF**

##### Relatório 1: Listagem de Pedidos 📋
- **Formato:** PDF
- **Dados:** Todos os pedidos cadastrados
- **URL Visualização:** `/relatorios/pedidos`
- **URL Download PDF:** `/relatorios/pedidos/pdf`
- **Informações Incluídas:**
  - ID do Pedido
  - Nome do Cliente
  - Total do Pedido
  - Status (Concluído, Pendente, Cancelado)
  - Data de Criação
  - Quantidade de Itens
  - Método de Pagamento
  - Estatísticas:
    - Total de Pedidos
    - Total de Vendas
    - Média por Pedido

##### Relatório 2: Listagem de Clientes 👥
- **Formato:** PDF
- **Dados:** Todos os clientes cadastrados
- **URL Visualização:** `/relatorios/clientes`
- **URL Download PDF:** `/relatorios/clientes/pdf`
- **Informações Incluídas:**
  - Nome do Cliente
  - Email
  - Telefone
  - CPF
  - Quantidade de Pedidos
  - Quantidade de Reservas
  - Total Gasto
  - Status (VIP, Premium, Ativo, Novo)
  - Estatísticas:
    - Total de Clientes
    - Total Gasto
    - Média por Cliente

---

## 🛠️ Estrutura Técnica

### Arquivos Criados/Modificados

#### 1. **Controllers**
```
app/Http/Controllers/GraficoController.php
app/Http/Controllers/RelatorioController.php
```

#### 2. **Views - Gráficos**
```
resources/views/graficos/clientes-pedidos.blade.php
resources/views/graficos/pratos-categoria.blade.php
```

#### 3. **Views - Relatórios**
```
resources/views/relatorios/pedidos-pdf.blade.php
resources/views/relatorios/clientes-pdf.blade.php
resources/views/relatorios/pedidos.blade.php
resources/views/relatorios/clientes.blade.php
```

#### 4. **Rotas** (em `routes/web.php`)
```php
// Gráficos
Route::get('/graficos/clientes-pedidos', [GraficoController::class, 'graficoClientePedidos'])->name('grafico.clientes-pedidos');
Route::get('/graficos/pratos-categoria', [GraficoController::class, 'graficoPratosPorCategoria'])->name('grafico.pratos-categoria');

// Relatórios
Route::get('/relatorios/pedidos', [RelatorioController::class, 'viewRelatorioPedidos'])->name('relatorio.pedidos');
Route::get('/relatorios/pedidos/pdf', [RelatorioController::class, 'relatorioPedidos'])->name('relatorio.pedidos.pdf');
Route::get('/relatorios/clientes', [RelatorioController::class, 'viewRelatorioClientes'])->name('relatorio.clientes');
Route::get('/relatorios/clientes/pdf', [RelatorioController::class, 'relatorioClientes'])->name('relatorio.clientes.pdf');
```

---

## 📦 Dependências Instaladas

### Composer
```bash
composer require barryvdh/laravel-dompdf
```

- **barryvdh/laravel-dompdf** - Biblioteca para geração de PDFs
- **dompdf/dompdf** - Motor de renderização PDF

### JavaScript
- **Chart.js** - Biblioteca de gráficos (carregada via CDN)

---

## 🚀 Como Usar

### Acessar os Gráficos

1. **Gráfico de Barras (Pedidos por Cliente)**
   - Clique em "Gráficos" → "Barras" no Dashboard
   - Ou acesse: `http://localhost/graficos/clientes-pedidos`

2. **Gráfico de Pizza (Pratos por Categoria)**
   - Clique em "Gráficos" → "Pizza" no Dashboard
   - Ou acesse: `http://localhost/graficos/pratos-categoria`

### Gerar Relatórios

#### Visualizar (HTML)
1. **Relatório de Pedidos**
   - Clique em "Relatórios" → "Pedidos" no Dashboard
   - Ou acesse: `http://localhost/relatorios/pedidos`

2. **Relatório de Clientes**
   - Clique em "Relatórios" → "Clientes" no Dashboard
   - Ou acesse: `http://localhost/relatorios/clientes`

#### Baixar (PDF)
- Na página de visualização, clique no botão "⬇️ Baixar PDF"
- Ou acesse diretamente:
  - Pedidos: `http://localhost/relatorios/pedidos/pdf`
  - Clientes: `http://localhost/relatorios/clientes/pdf`

---

## 🎨 Design e UX

### Gráficos
- ✅ Interface moderna com gradiente purpura
- ✅ Responsivo (funciona em mobile e desktop)
- ✅ Estatísticas em tempo real
- ✅ Cores diferenciadas para cada categoria
- ✅ Navegação fácil entre gráficos e relatórios

### Relatórios
- ✅ Layout profissional
- ✅ Tabelas bem organizadas
- ✅ Estatísticas destacadas
- ✅ PDF pronto para impressão
- ✅ Botões de ação intuitivos

---

## 📊 Dados Utilizados

### Gráfico 1 (Barras - Pedidos por Cliente)
- **Fonte:** Tabela `pedidos` + `clientes`
- **Agrupamento:** Por cliente
- **Limite:** Top 10 clientes
- **Ordenação:** Decrescente por quantidade de pedidos

### Gráfico 2 (Pizza - Pratos por Categoria)
- **Fonte:** Tabela `pratos` + `categorias_pratos`
- **Agrupamento:** Por categoria
- **Cores:** 8 cores diferentes atribuídas dinamicamente

### Relatório 1 (Pedidos)
- **Fonte:** Tabela `pedidos` com relacionamentos
- **Incluem:** Cliente, Itens, Pagamento
- **Ordenação:** Por data decrescente
- **Estatísticas:** Total, Total de Vendas, Média

### Relatório 2 (Clientes)
- **Fonte:** Tabela `clientes` com relacionamentos
- **Incluem:** Pedidos e Reservas
- **Ordenação:** Alfabética
- **Classificação:** VIP, Premium, Ativo, Novo (baseado em gasto total)

---

## 🔧 Personalizações Possíveis

### Gráficos
- Modificar cores em: `resources/views/graficos/[nome].blade.php`
- Alterar dados: Modificar queries em `app/Http/Controllers/GraficoController.php`
- Mudar tipo de gráfico: Alterar propriedade `type` em Chart.js

### Relatórios
- Adicionar mais colunas: Editar tabelas nas views
- Mudar estilos: Editar CSS nas views
- Adicionar filtros: Criar métodos nos controllers

---

## 🐛 Troubleshooting

### Gráficos não aparecem
- Verifique se há dados nas tabelas
- Verifique conexão com internet (Chart.js via CDN)
- Verifique console do navegador para erros

### PDFs não geram
- Verifique se DOMPDF está instalado: `composer require barryvdh/laravel-dompdf`
- Verifique permissões na pasta `storage/`
- Verifique se há dados para relatório

### Dados vazios
- Execute migrations: `php artisan migrate`
- Execute seeders: `php artisan db:seed`
- Verifique relações entre modelos

---

## 📝 Exemplos de URLs

```
http://localhost/graficos/clientes-pedidos
http://localhost/graficos/pratos-categoria
http://localhost/relatorios/pedidos
http://localhost/relatorios/pedidos/pdf
http://localhost/relatorios/clientes
http://localhost/relatorios/clientes/pdf
```

---

## ✨ Recursos Extras Implementados

1. **Dashboard Integrada** - Links diretos no dashboard
2. **Navegação Cruzada** - Botões para navegar entre gráficos e relatórios
3. **Estatísticas em Tempo Real** - Cálculos dinâmicos
4. **Responsividade** - Funciona em todos os dispositivos
5. **Impressão PDF** - Layouts otimizados para PDF
6. **Classificação de Clientes** - VIP, Premium, Ativo, Novo

---

## 📅 Data de Criação
Maio de 2026

## 👨‍💻 Desenvolvido por
Sistema de Gestão - Restaurante

---

**Fim da Documentação** ✅
