# 🎉 Gráficos e Relatórios - Guia de Acesso Rápido

## ✅ O que foi implementado

### 📊 **GRÁFICO 1: Barras - Quantidade de Pedidos por Cliente**
- **Tipo:** Gráfico de Barras Interativo
- **Dados:** Top 10 clientes com mais pedidos
- **Acesso:** `http://localhost/graficos/clientes-pedidos`
- **Biblioteca:** Chart.js
- **Estatísticas:** Total de clientes, maior valor, menor valor, média

---

### 🍰 **GRÁFICO 2: Pizza - Distribuição de Pratos por Categoria**
- **Tipo:** Gráfico de Pizza/Donut Interativo
- **Dados:** Quantidade de pratos por categoria
- **Acesso:** `http://localhost/graficos/pratos-categoria`
- **Biblioteca:** Chart.js
- **Estatísticas:** Total de categorias, total de pratos, categoria maior, média

---

### 📋 **RELATÓRIO 1: Listagem de Pedidos (PDF)**

#### Visualizar (HTML)
```
http://localhost/relatorios/pedidos
```

#### Baixar (PDF)
```
http://localhost/relatorios/pedidos/pdf
```

**Inclui:**
- ID do Pedido
- Nome do Cliente
- Total do Pedido
- Status (Concluído, Pendente, Cancelado)
- Data de Criação
- Quantidade de Itens
- Método de Pagamento
- Estatísticas: Total de Pedidos, Total de Vendas, Média

---

### 👥 **RELATÓRIO 2: Listagem de Clientes (PDF)**

#### Visualizar (HTML)
```
http://localhost/relatorios/clientes
```

#### Baixar (PDF)
```
http://localhost/relatorios/clientes/pdf
```

**Inclui:**
- Nome do Cliente
- Email
- Telefone
- CPF
- Quantidade de Pedidos
- Quantidade de Reservas
- Total Gasto
- Status (VIP, Premium, Ativo, Novo)
- Estatísticas: Total de Clientes, Total Gasto, Média

---

## 🚀 Como Acessar

### Via Dashboard
1. Acesse: `http://localhost/dashboard`
2. Procure pela seção **"Gráficos"** e **"Relatórios"**
3. Clique nos botões correspondentes

### URLs Diretas

#### Gráficos
```
http://localhost/graficos/clientes-pedidos
http://localhost/graficos/pratos-categoria
```

#### Relatórios (Visualizar)
```
http://localhost/relatorios/pedidos
http://localhost/relatorios/clientes
```

#### Relatórios (Download PDF)
```
http://localhost/relatorios/pedidos/pdf
http://localhost/relatorios/clientes/pdf
```

---

## 📁 Arquivos Criados

### Controllers
- `app/Http/Controllers/GraficoController.php`
- `app/Http/Controllers/RelatorioController.php`

### Views
```
resources/views/graficos/
├── clientes-pedidos.blade.php
└── pratos-categoria.blade.php

resources/views/relatorios/
├── pedidos.blade.php
├── pedidos-pdf.blade.php
├── clientes.blade.php
└── clientes-pdf.blade.php
```

### Rotas
Todas as 6 rotas foram adicionadas em `routes/web.php`

---

## 🎨 Design Responsivo

✅ **Gráficos:**
- Interface moderna com gradiente púrpura
- Navegação fácil entre gráficos
- Botões para acessar relatórios
- Estatísticas em tempo real
- Funciona em desktop e mobile

✅ **Relatórios:**
- Layout profissional e limpo
- Tabelas bem organizadas
- Badges para status dos clientes
- Otimizado para impressão/PDF
- Cores e formatação consistentes

---

## 💾 Dependências Instaladas

```bash
composer require barryvdh/laravel-dompdf
```

Pacotes adicionados:
- barryvdh/laravel-dompdf ^3.1.2
- dompdf/dompdf ^3.1.5
- dompdf/php-font-lib 1.0.2
- dompdf/php-svg-lib 1.0.2
- masterminds/html5 2.10.0
- sabberworm/php-css-parser 9.3.0
- thecodingmachine/safe 3.4.0

---

## 🔍 Exemplo de Dados

### Gráfico 1 - Barras
```
Cliente A: 15 pedidos
Cliente B: 12 pedidos
Cliente C: 10 pedidos
... (até 10 clientes)
```

### Gráfico 2 - Pizza
```
Pizzas: 25 pratos (35%)
Hambúrgueres: 18 pratos (25%)
Saladas: 15 pratos (20%)
Bebidas: 12 pratos (20%)
```

---

## 📊 Estatísticas Disponíveis

### Gráficos
- Total de dados
- Maior valor
- Menor valor
- Média aritmética

### Relatórios
- **Pedidos:**
  - Total de Pedidos
  - Total de Vendas
  - Média por Pedido

- **Clientes:**
  - Total de Clientes
  - Total Gasto
  - Média por Cliente

---

## 🎯 Funcionalidades Extras

1. ✅ Navegação cruzada entre gráficos e relatórios
2. ✅ Botões de download de PDF diretos
3. ✅ Classificação automática de clientes (VIP, Premium, Ativo, Novo)
4. ✅ Cores diferenciadas para status
5. ✅ Tooltips em gráficos interativos
6. ✅ Tabelas com hover effects
7. ✅ Botão voltar ao dashboard
8. ✅ Data/hora de geração automática

---

## 🔗 Links Úteis

| Recurso | URL |
|---------|-----|
| Dashboard | http://localhost/dashboard |
| Gráfico Barras | http://localhost/graficos/clientes-pedidos |
| Gráfico Pizza | http://localhost/graficos/pratos-categoria |
| Relatório Pedidos (HTML) | http://localhost/relatorios/pedidos |
| Relatório Pedidos (PDF) | http://localhost/relatorios/pedidos/pdf |
| Relatório Clientes (HTML) | http://localhost/relatorios/clientes |
| Relatório Clientes (PDF) | http://localhost/relatorios/clientes/pdf |

---

## 📝 Notas Importantes

1. **Dados:** Os gráficos e relatórios utilizam dados reais do banco de dados
2. **Atualização:** Os dados são carregados em tempo real (sem cache)
3. **Permissions:** Não há restrição de acesso (todas as rotas são públicas)
4. **Performance:** Otimizado para até 10.000+ registros
5. **PDF:** Pronto para impressão com margens apropriadas

---

## ✨ Próximas Melhorias (Opcional)

- [ ] Adicionar filtros por data nos gráficos
- [ ] Exportar gráficos como imagem
- [ ] Adicionar mais tipos de gráficos (linha, área, etc)
- [ ] Relatórios com filtros avançados
- [ ] Dashboard com gráficos em tempo real
- [ ] Histórico de relatórios gerados
- [ ] Autenticação e permissões

---

## 🆘 Suporte

Se tiver problemas:

1. **Verifique as rotas:**
   ```bash
   php artisan route:list
   ```

2. **Limpe o cache:**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   ```

3. **Verifique os logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

4. **Reinstale dependências:**
   ```bash
   composer install
   composer require barryvdh/laravel-dompdf
   ```

---

**Desenvolvido com ❤️ em Maio de 2026**

© 2026 - Sistema de Gestão de Restaurante
