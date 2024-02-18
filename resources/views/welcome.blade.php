@extends('layout.plantilla')

@section('tituloPagina', 'CRUD con Laravel')

@section('contenido')
<title>Selecciona una Película</title>
<style>
  /* Estilos básicos */
  body {
    font-family: 'Arial', sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
  }
  .movie-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
  }
  .movie-card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    transition: transform 0.3s ease;
    cursor: pointer;
    width: 150px; /* Ajustamos el ancho de todos los botones */
  }
  .movie-card:hover {
    transform: scale(1.05);
  }
  .movie-image {
    width: 100%; /* Para asegurar que la imagen se ajuste al contenedor */
    height: auto;
    border-bottom: 2px solid #ddd;
  }
  .movie-title {
    padding: 10px;
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    color: #333;
  }
  
  /* Estilos para el modal */
  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.7);
  }
  .modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 60%;
    text-align: center;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
  }
  .close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    color: #888;
    font-size: 24px;
  }
  /* Estilos para botones en el modal */
.modal-content button {
  background-color: #4CAF50; /* Color verde */
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.modal-content button:hover {
  background-color: #45A049;
}
</style>
<h2 style="text-align: center; color: #333;">Selecciona una Película</h2>
<div class="card-body">
  <div class="row">
      <div class="col-sm-12">
          @if ($mensaje = Session::get('success'))
              <div class="alert alert-success" role="alert" style="background-color: #060606; color: white; border: none;">
                  {{ $mensaje }}
              </div>
          @endif
      </div>
  </div>
<div class="movie-container">
  
  
  <div class="movie-card" onclick="openModal('Harry Potter', 'pelicula2.jpg')">
    <img class="movie-image" src="img2.jpg" alt="Harry Potter" id="imageUrl">
    <div class="movie-title">Harry Potter</div>
  </div>
  
  
  <div class="movie-card" onclick="openModal('EL Gigante de Hierro', 'img5.jpg')">
    <img class="movie-image" src="img5.jpg" alt="EL Gigante de Hierro" id="imageUrl">
    <div class="movie-title">EL Gigante de Hierro</div>
  </div>
  <div class="movie-card" onclick="openModal('El Hombre Vicentenario', 'img6.jpg')">
    <img class="movie-image" src="img6.jpg" alt="El Hombre Vicentenario" id="imageUrl">
    <div class="movie-title">El Hombre Vicentenario</div>
  </div>
  <div class="movie-card" onclick="openModal('Termineitor', 'img7.jpg')">
    <img class="movie-image" src="img7.jpg" alt="Termineitor" id="imageUrl">
    <div class="movie-title">Termineitor</div>
  </div>
  
</div>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h3 id="movieTitle" style="color: #333;"></h3>
    
    <form action="{{route('pelicula.store')}}" method="POST">
      @csrf
      <input type="hidden" id="movieName" name="movieName">
      <label for="cantidad1" style="color: #333;">Precio del boleto es de 70</label> <br>
      <input type="hidden" id="moviePrecio" name="moviePrecio">
      <label for="cantidad1" style="color: #333;">Cantidad de boletos:</label>
      <input type="number" id="cantidad" name="cantidad" min="1" value="1" onchange="calcularPrecio()" required><br>
      <p id="precio" style="color: #333;"></p>
      <label for="pago1" style="color: #333;">Billete con el que pagas:</label>
      <input type="number" id="pago" name="pago" min="1" value="100" onchange="calcularCambio()" required><br>
      <br>
      <p id="cambio" style="color: #333;"></p>
      <input type="hidden" id="activo" name="activo">
      <button style="background-color: #3438af; color: white;">Pagar</button>
    </form>
  </div>
</div>

<script>
  function openModal(movieTitle) {
    document.getElementById("movieTitle").innerText = movieTitle;
    document.getElementById("movieName").value = movieTitle;
    document.getElementById("moviePrecio").value = 70;
    document.getElementById("activo").value = 1;
    
   
    document.getElementById("myModal").style.display = "block";
  }

  function closeModal() {
    document.getElementById("myModal").style.display = "none";
  }

  function calcularCambio() {
    const cantidadBoletos = parseInt(document.getElementById("cantidad").value);
    const billetePago = parseInt(document.getElementById("pago").value);
    const costoBoleto = 70;
    const totalAPagar = cantidadBoletos * costoBoleto;
    const cambio = billetePago - totalAPagar;
    
    if (cambio >= 0) {
      document.getElementById("cambio").innerText = "Su cambio es: $" + cambio;
    } else {
      document.getElementById("cambio").innerText = "El pago es insuficiente";
    }
    
  }
  
  function calcularPrecio() {
    const cantidadBoletos = parseInt(document.getElementById("cantidad").value);
    const billetePago = parseInt(document.getElementById("pago").value);
    const costoBoleto = 70;
    const totalAPagar = cantidadBoletos * costoBoleto;

    document.getElementById("precio").innerText =  "Total a pagar $" +  totalAPagar;
  }

</script>
  @endsection
