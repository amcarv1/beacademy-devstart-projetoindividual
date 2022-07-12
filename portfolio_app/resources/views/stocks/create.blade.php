<h1>Criar Stock</h1>

<form action="{{ route('stocks.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">NOME DA STOCK:</label>
      <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
      <label for="ticket" class="form-label">TICKET DA STOCK:</label>
      <input type="ticket" class="form-control" id="ticket" name="ticket">
    </div>
    <div class="mb-3">
        <label for="value" class="form-label">VALOR DA STOCK:</label>
        <input type="text" class="form-control" id="price" name="price">
      </div>
      
    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>