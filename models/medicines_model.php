<?php

class medicines_model {

    public $db;
    private $medicines;
    private $med_spe;
    private $species;
    private $administration;
    private $id;
    private $name;

    public function __construct() {
        $this->db = Conectar::conexion();
        $this->medicies = array();
        $this->med_spe = array();
        $this->species = array();
        $this->administration = array();
    }

    // Función que devuelve todos los productos
    public function get_all_medicines() {
        $query = "SELECT med.id, medN.nombre, cat.nombre as categoria, efe.efecto, efeSec.efecto_secundario, adm.administramiento, img.url, lab.marca FROM "
                . "medicamento med, medicamento_nombre medN, categoria_medicamento cat, efecto_medicamento efe, efectos_secundarios efeSec, administramiento_medicamento adm, imagenes img, laboratorio lab "
                . "where med.nombre = medN.id AND med.categoria = cat.id AND med.efecto = efe.id AND med.efecto_secundario = efeSec.id AND med.administramiento = adm.id AND med.imagen = img.id AND med.marca = lab.id";

        $consulta = $this->db->query($query);
        while ($filas = $consulta->fetch_assoc()) {
            $this->medicines[] = $filas;
        }
        return $this->medicines;
    }

    // Función para el buscador, devuelve la descripcion corta y el ID todos los productos
    public function get_medicine_by_efect($word) {
        $query = "SELECT med.id, medN.nombre, cat.nombre as categoria, efe.efecto, efeSec.efecto_secundario, adm.administramiento, img.url, lab.marca FROM "
                . "medicamento med, medicamento_nombre medN, categoria_medicamento cat, efecto_medicamento efe, efectos_secundarios efeSec, administramiento_medicamento adm, imagenes img, laboratorio lab "
                . "where med.nombre = medN.id AND med.categoria = cat.id AND med.efecto = efe.id AND med.efecto_secundario = efeSec.id AND med.administramiento = adm.id AND med.imagen = img.id AND med.marca = lab.id
                AND efe.efecto like '%$word%'";
        $consulta = $this->db->query($query);
        while ($filas = $consulta->fetch_assoc()) {
            $this->medicines[] = $filas;
        }
        return $this->medicines;
    }


    public function get_species() {
        $query = "sELECT med_spe.*, a.especie FROM medicamento_especie med_spe, animales a where a.id = med_spe.id_especie";
        $consulta = $this->db->query($query);
        while ($filas = $consulta->fetch_assoc()) {
            $this->species[] = $filas;
        }
        return $this->species;
    }
    
        public function get_all_species() {
        $query = "SELECT * FROM animales";
        $consulta = $this->db->query($query);
        while ($filas = $consulta->fetch_assoc()) {
            $this->species[] = $filas;
        }
        return $this->species;
    }

    public function get_way_administration() {
        $query = "SELECT * FROM administramiento_medicamento";
        $consulta = $this->db->query($query);
        while ($filas = $consulta->fetch_assoc()) {
            $this->administration[] = $filas;
        }
        return $this->administration;
        
        
        
    }

}