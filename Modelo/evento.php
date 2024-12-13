<?php
class Empleado
{
    public $codigo,
    $nombre,
    $precio,
    $fechaEvento,
    $localizacion,
    $artista,
    $descripcion,
    $imgSource;
    public function __construct(

        $codigo,
        $nombre,
        $precio,
        $fechaEvento,
        $localizacion,
        $artista,
        $descripcion,
        $imgSource
    ) {

        $this->setCodigo($codigo);
        $this->setNombre($nombre);
        $this->setPrecio($precio);
        $this->setFechaEvento($fechaEvento);
        $this->setLocalizacion($localizacion);
        $this->setArtista($artista);
        $this->setDescripcion($descripcion);
        $this->setSource($imgSource);
    }


    public function setCodigo($codigo)
    {
        if (strlen($codigo) > 50 || strlen($codigo) < 0) {
            return false;
        } else {
            $this->codigo = $codigo;
        }
    }


    public function setNombre(string $nombre)
    {
        if (strlen($nombre) > 15 || strlen($nombre) < 0) {
            return false;
        } else {
            $this->nombre = $nombre;
        }

    }



    public function setPrecio(float $precio)
    {
        $this->precio = $precio;
    }

    public function setFechaEvento($fechaEvento)
    {
        $this->fechaEvento = $fechaEvento;
    }

    public function setLocalizacion($localizacion)
    {
        $this->localizacion = $localizacion;
    }

    public function setArtista($artista)
    {
        $this->artista = $artista;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function setSource($imgSource){
        $this->imgSource=$imgSource;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }


    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getFechaEvento()
    {
        return $this->fechaEvento;
    }
    public function getLocalizacion()
    {
        return $this->localizacion;
    }

    public function getArtista()
    {
        return $this->artista;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getSource()
    {
        return $this->imgSource;
    }
}
?>